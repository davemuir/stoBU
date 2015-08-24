<?php
use Concrete\Core\Attribute\Key\Key;
use Concrete\Core\Http\ResponseAssetGroup;

defined('C5_EXECUTE') or die('Access denied.');

$r = ResponseAssetGroup::get();
$r->requireAsset('javascript', 'underscore');
$r->requireAsset('javascript', 'core/events');
$r->requireAsset('core/legacy');

$activeAuths = AuthenticationType::getList(true, true);
$form = Loader::helper('form');

$active = null;
if ($authType) {
    $active = $authType;
    $activeAuths = array($authType);
}
$image = date('Ymd') . '.jpg';

/** @var Key[] $required_attributes */

$attribute_mode = (isset($required_attributes) && count($required_attributes));

?>
<style>
    body {
        /*background: url("<?php echo ASSETS_URL_IMAGES ?>/bg_login.png");*/
    }
</style>
<div class="login-page">
    <div class="col-sm-6 col-sm-offset-3 login-title">
        <span><?php echo !$attribute_mode ? t('Sign into your website.') : t('Required Attributes') ?></span>
    </div>
    <div class="col-sm-6 col-sm-offset-3 login-form">
        <div class="row">
            <div class="visible-xs ccm-authentication-type-select form-group text-center">
                <?php
                if ($attribute_mode) {
                    ?>
                    <i class="fa fa-question"></i>
                    <span><?php echo t('Attributes') ?></span>
                <?php
                } else if (count($activeAuths) > 1) {
                    ?>
                    <select class="form-control col-xs-12">
                        <?php
                        foreach ($activeAuths as $auth) {
                            ?>
                            <option value="<?php echo $auth->getAuthenticationTypeHandle() ?>">
                                <?php echo $auth->getAuthenticationTypeName() ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>

                    <?php
                }
                ?>
                <label>&nbsp;</label>
            </div>
        </div>
        <div class="row login-row">
            <div class="types col-sm-4 hidden-xs">
                <ul class="auth-types">
                    <?php
                    if ($attribute_mode) {
                        ?>
                        <li data-handle="required_attributes">
                            <i class="fa fa-question"></i>
                            <span><?php echo t('Attributes') ?></span>
                        </li>
                        <?php
                    } else {
                        /** @var AuthenticationType[] $activeAuths */
                        foreach ($activeAuths as $auth) {
                            ?>
                            <li data-handle="<?php echo $auth->getAuthenticationTypeHandle() ?>">
                                <?php echo $auth->getAuthenticationTypeIconHTML() ?>
                                <span><?php echo $auth->getAuthenticationTypeName() ?></span>
                            </li>
                        <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="controls col-sm-8 col-xs-12">
                <?php
                if ($attribute_mode) {
                    $attribute_helper = new Concrete\Core\Form\Service\Widget\Attribute();
                    ?>
                    <form action="<?php echo View::action('fill_attributes') ?>" method="POST">
                        <div data-handle="required_attributes"
                             class="authentication-type authentication-type-required-attributes">
                            <div class="ccm-required-attribute-form"
                                 style="height:340px;overflow:auto;margin-bottom:20px;">
                                <?php
                                foreach ($required_attributes as $key) {
                                    echo $attribute_helper->display($key, true);
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary pull-right"><?php echo t('Submit') ?></button>
                            </div>

                        </div>
                    </form>
                    <?php
                } else {
                    /** @var AuthenticationType[] $activeAuths */

                    foreach ($activeAuths as $auth) {
                        ?>
                        <div data-handle="<?php echo $auth->getAuthenticationTypeHandle() ?>"
                             class="authentication-type authentication-type-<?php echo $auth->getAuthenticationTypeHandle() ?>">
                            <?php $auth->renderForm($authTypeElement ?: 'form', $authTypeParams ?: array()) ?>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="background-credit" style="display:none">
        <?php echo t('Photo Credit:') ?>
        <a href="#" style="pull-right"></a>
    </div>

    <script type="text/javascript">
        (function ($) {
            "use strict";

            var forms = $('div.controls').find('div.authentication-type').hide(),
                select = $('div.ccm-authentication-type-select > select');
            var types = $('ul.auth-types > li').each(function () {
                var me = $(this),
                    form = forms.filter('[data-handle="' + me.data('handle') + '"]');
                me.click(function () {
                    select.val(me.data('handle'));
                    if (typeof Concrete !== 'undefined') {
                        Concrete.event.fire('AuthenticationTypeSelected', me.data('handle'));
                    }

                    if (form.hasClass('active')) return;
                    types.removeClass('active');
                    me.addClass('active');
                    if (forms.filter('.active').length) {
                        forms.stop().filter('.active').removeClass('active').fadeOut(250, function () {
                            form.addClass('active').fadeIn(250);
                        });
                    } else {
                        form.addClass('active').show();
                    }
                });
            });

            select.change(function() {
                types.filter('[data-handle="' + $(this).val() + '"]').click();
            });
            types.first().click();

            var title = $('.login-title').find('span');
            title.css({
                lineHeight: '1000px',
                fontSize: 10
            });

            setTimeout(function() {
                var start_height = title.parent().height(), size = 10, last;
                while (title.parent().height() === start_height) {
                    last = size++;
                    title.css('font-size', size);
                }
                title.css({
                    fontSize: last,
                    lineHeight: ''
                });
                var fade_div = $('<div/>').css({
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    width: '100%'
                }).prependTo('body').height(title.offset().top + title.outerHeight() + 50);

                fade_div.hide()
                    .append(
                    $('<img/>')
                        .css({ width: '100%', height: '100%' })
                        .attr('src', '<?php echo DIR_REL ?>/concrete/images/login_fade.png'))
                    .fadeIn();
            }, 0);


            <?php if(Config::get('concrete.white_label.background_image') !== 'none') { ?>
            $(function () {
                var shown = false, info;
                $.getJSON('<?php echo BASE_URL . DIR_REL . '/' . DISPATCHER_FILENAME . '/tools/required/dashboard/get_image_data' ?>', { image: '<?php echo $image ?>' }, function (data) {
                    if (shown) {
                        var link = 'streetsto/concrete/images/bg1.jpg';
                        $('div.background-credit').fadeIn().children().attr('href', link);//.text(data.author.join());//data.link
                        

                    } else {
                        info = data;
                    }
                });
                $(window).on('backstretch.show', function() {
                    shown = true;

                    if (info) {
                        var link = 'streetsto/concrete/images/bg1.jpg';
                        $('div.background-credit').fadeIn().children().attr('href', link).text(info.author.join());//info.link
                    }

                });
                $.backstretch("http://sto.apengage.io/streetsto/concrete/images/bg1.jpg", {//<?php echo Config::get('concrete.urls.background_feed') . '/' . $image ?>
                    fade: 500
                });
            });
            <?php } ?>
            $('ul.nav.nav-tabs > li > a').on('click', function () {
                var me = $(this);
                if (me.parent().hasClass('active')) return false;
                $('ul.nav.nav-tabs > li.active').removeClass('active');
                var at = me.attr('data-authType');
                me.parent().addClass('active');
                $('div.authTypes > div').hide().filter('[data-authType="' + at + '"]').show();
                return false;
            });
        })(jQuery);
    </script>
</div>
