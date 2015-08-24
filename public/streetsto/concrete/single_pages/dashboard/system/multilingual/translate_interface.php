<?php defined('C5_EXECUTE') or die("Access Denied.")?>

<?php $valt = Loader::helper('validation/token')?>

<?php
if ($this->controller->getTask() == 'translate_po') { ?>

    <style type="text/css">
        div.ccm-translate-site-interface-messages span.original {
            float: left;
            width: 50%;
            height: 20px;
            overflow: hidden;
        }
        div.ccm-translate-site-interface-messages span.translation {
            float: left;
            width: 50%;
            height: 20px;
            overflow: hidden;
        }

        div.ccm-translate-site-interface-messages li.list-group-item {
            transition: all 0.2s linear;
        }

        li.list-group-item:hover {
            background-color: #dedede;
            cursor:pointer;
        }

        div.ccm-translate-site-interface-messages ul.list-group {
            overflow: scroll;
        }

        div.ccm-translate-site-interface-translate form.translate-form {
            display:none;
        }
    </style>


    <div class="row">
        <div class="ccm-translate-site-interface-messages col-md-7">
            <div class="panel panel-primary">
                <div class="panel-heading clearfix">
                    <span class="original"><?php echo t('Original String')?></span>
                    <span class="translation"><?php echo t('Translation')?></span>
                </div>
                <ul class="list-group">
                    <?php foreach($translations as $string) { ?>
                        <li class="list-group-item <?php if ($string->hasTranslation()) { ?>list-group-item-success<?php } ?> clearfix" data-translation="<?php echo $string->getID()?>">
                            <span class="original">
                                <?php echo $string->getOriginal()?>
                            </span>
                            <span class="translation">
                                <?php echo $string->getTranslation()?>
                            </span>
                        </li>
                    <?php } ?>
                </ul>
                <div class="panel-footer"></div>
            </div>
        </div>
        <div class="col-md-5 ccm-translate-site-interface-translate">
            <div class="panel panel-primary">
                <div class="panel-heading"><?php echo t('Translate')?></div>
                <div class="panel-body">
                    <?php foreach($translations as $string) { ?>
                        <form method="post" class="translate-form" action="<?php echo $controller->action('save_translation')?>" data-form="<?php echo $string->getID()?>">
                            <input type="hidden" name="mtID" value="<?php echo $string->getID()?>">
                            <div class="form-group">
                                <label class="control-label" for="original-<?php echo $string->getID()?>"><?php echo t('Original String')?></label>
                                <textarea class="form-control" disabled id="original-<?php echo $string->getID()?>" rows="8"><?php echo h($string->getOriginal())?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="translation-<?php echo $string->getID()?>"><?php echo t('Translation')?></label>
                                <textarea class="form-control" name="msgstr" id="translation-<?php echo $string->getID()?>" rows="8"><?php echo h($string->getTranslation())?></textarea>
                            </div>
                            <button class="btn btn-primary" data-btn="save"><?php echo t('Save &amp; Continue')?></button>
                        </form>
                    <?php } ?>
                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
    </div>

    <div class="ccm-dashboard-header-buttons">
        <a href="<?php echo $controller->action('view')?>" class="btn btn-default"><?php echo t('Back to List')?></a>
    </div>

    <script type="text/javascript">
        var $translateBody;
        activateTranslation = function(id) {
            var $listItem = $('li[data-translation=' + id + ']'),
                $form = $('form[data-form=' + id + ']');

            $('div.ccm-translate-site-interface-messages li.list-group-item-info').removeClass('list-group-item-info');
            $('div.ccm-translate-site-interface-translate form').hide();
            $listItem.addClass('list-group-item-info');
            $form.concreteAjaxForm({
                success: function(r) {
                    $listItem.addClass('list-group-item-success');
                    return;
                }
            }).show();
        }

        saveAndContinue = function(id) {
            var $activeTranslation = $('li.list-group-item-info'),
                $next = $activeTranslation.next(),
                $form = $('form[data-form=' + id + ']');

            if ($next.length) {
                activateTranslation($next.attr('data-translation'));
                $form.submit();
            }
        }

        $(function() {
            $translateBody = $('div.ccm-translate-site-interface-translate div.panel-body');
            var windowHeight = $(window).height();
            var height = windowHeight - 350;
            $('div.ccm-translate-site-interface-messages ul.list-group').css('height', height);
            $('div.ccm-translate-site-interface-translate div.panel-body').css('height', height);

            $('div.ccm-translate-site-interface-messages').on('click', 'li[data-translation]', function() {
                var translation = $(this).attr('data-translation');
                activateTranslation(translation);
            });

            $('div.ccm-translate-site-interface-translate').on('click', 'button[data-btn=save]', function() {
                var translation = $(this).attr('data-translation');
                saveAndContinue(translation);
            });

            $(window).on('keydown', function(e) {
                if (e.keyCode == 40) {
                    e.preventDefault();
                    var $activeTranslation = $('li.list-group-item-info');
                    saveAndContinue($activeTranslation.attr('data-translation'));
                }

                if (e.keyCode == 38) {
                    e.preventDefault();
                    var $activeTranslation = $('li.list-group-item-info'),
                        $previous = $activeTranslation.prev();
                    if ($previous.length) {
                        activateTranslation($previous.attr('data-translation'));
                    }
                }
            });

            activateTranslation($('div.ccm-translate-site-interface-messages li[data-translation]:first-child').attr('data-translation'));
        });



    </script>

    <?php
}  else {

	if (!is_dir(DIR_LANGUAGES_SITE_INTERFACE) || !is_writable(DIR_LANGUAGES_SITE_INTERFACE)) { ?>
		<div class="alert alert-warning"><?php echo t('You must create the directory %s and make it writable before you may run this tool. Additionally, all files within this directory must be writable.', DIR_LANGUAGES_SITE_INTERFACE)?></div>
	<?php } ?>

	<?php
	$nav = Loader::helper('navigation');
	Loader::model('section', 'multilingual');
	$pages = \Concrete\Core\Multilingual\Page\Section\Section::getList();
	$defaultSourceLocale = Config::get('concrete.multilingual.default_source_locale');

	$ch = Core::make('multilingual/interface/flag');
	$dh = Core::make('helper/date');
	if (count($pages) > 0) { ?>

<div class="ccm-dashboard-content-full">
    <div class="table-responsive">
        <table class="ccm-search-results-table">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th><span><?php echo t("Name")?></span></th>
                <th><span><?php echo t('Locale')?></span></th>
                <th colspan="2"><span><?php echo t('Completion')?></span></th>
                <th><span><?php echo t('Last Updated')?></span></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($pages as $pc) {
                $pcl = \Concrete\Core\Multilingual\Page\Section\Section::getByID($pc->getCollectionID());?>
                <tr>
                    <td><?php echo $ch->getSectionFlagIcon($pc)?></td>
                    <td>
                        <a href="<?php echo $nav->getLinkToCollection($pc)?>">
                            <?php echo $pc->getCollectionName()?>
                        </a>
                    </td>
                    <td style="white-space: nowrap">
                        <?php echo $pc->getLocale(); ?>
                        <?php if ($pc->getLocale() != $defaultSourceLocale) { ?>
                            <a href="#" class="icon-link launch-tooltip" title="<?php echo REL_DIR_LANGUAGES_SITE_INTERFACE?>/<?php echo $pc->getLocale()?>.mo"><i class="fa fa-question-circle"></i></a>
                        <?php } ?>
                    </td>
                    <td style="width: 40%">
                        <?php if ($pc->getLocale() != $defaultSourceLocale) { ?>
                            <?php
                            $data = $extractor->getSectionSiteInterfaceCompletionData($pc);
                            ?>
                            <div class="progress">
                                <div class="progress-bar" style="width: <?php echo $data['completionPercentage']?>%">&nbsp;</div>
                            </div>
                        <?php } ?>
                    </td>
                    <td style="white-space: nowrap">
                        <?php if ($pc->getLocale() != $defaultSourceLocale) { ?>
                            <span class="percent"><?php echo $data['completionPercentage']?>%</span> - <span class="translated"><?php echo $data['translatedCount']?></span> <?php echo t('of')?> <span class="total"><?php echo $data['messageCount']?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($pc->getLocale() != $defaultSourceLocale) {
                            if (file_exists(DIR_LANGUAGES_SITE_INTERFACE . '/' . $pc->getLocale() . '.mo'))
                                print $dh->formatDateTime(filemtime(DIR_LANGUAGES_SITE_INTERFACE . '/' . $pc->getLocale() . '.mo'), true);
                            else
                                print t('File not found.');
                        }
                        else
                            echo t('N/A'); ?>
                    </td>
                    <?php if ($pc->getLocale() == $defaultSourceLocale) { ?>
                        <td></td>
                    <?php } else { ?>
                        <td><a href="<?php echo $this->action('translate_po', $pc->getCollectionID())?>" class="icon-link"><i class="fa fa-pencil"></i></a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

        <?php
        if (is_dir(DIR_LANGUAGES_SITE_INTERFACE) && is_writable(DIR_LANGUAGES_SITE_INTERFACE)) { ?>

        <form method="post" action="<?php echo $controller->action('submit')?>">
        <div class="ccm-dashboard-header-buttons btn-group">
            <button class="btn btn-default" type="submit" name="action" value="reload"><?php echo t('Reload Strings')?></button>
            <button class="btn btn-default" type="submit" name="action" value="export"><?php echo t('Export to .PO')?></button>
            <?php echo $valt->output()?>
            <button class="btn btn-danger" type="button" data-dialog="reset" value="reset"><?php echo t('Reset All')?></button>
        </div>
        </form>


            <div style="display: none">
                <div id="ccm-dialog-reset-languages" class="ccm-ui">
                    <?php
                    $u = new User();
                    if ($u->isSuperUser()) { ?>
                    <form method="post" class="form-stacked" style="padding-left: 0px" action="<?php echo $view->action('reset_languages')?>">
                        <?php echo Loader::helper("validation/token")->output('reset_languages')?>
                        <p><?php echo t('Are you sure? This will remove all translations from all languages, in the database and in your site PO files. This cannot be undone.')?></p>
                    </form>
                    <div class="dialog-buttons">
                        <button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
                        <button class="btn btn-danger pull-right" onclick="$('#ccm-dialog-reset-languages form').submit()"><?php echo t('Confirm Reset')?></button>
                    </div>
                    <?php } else { ?>
                        <p><?php echo t("Only the admin user may reset all languages.")?></p>
                    <?php } ?>
                </div>
            </div>

            <script type="text/javascript">
                $(function() {
                    $('button[data-dialog=reset]').on('click', function() {
                        jQuery.fn.dialog.open({
                            element: '#ccm-dialog-reset-languages',
                            modal: true,
                            width: 320,
                            title: '<?php echo t("Reset Languages")?>',
                            height: 'auto'
                        });
                    });
                });
            </script>

        <?php } ?>

        <style type="text/css">
            table.ccm-search-results-table div.progress {
                margin-bottom: 0px;
            }
        </style>


	<?php } else { ?>
		<p><?php echo t('You have not created any multilingual content sections yet.')?></p>
	<?php } ?>
<?php } ?>
</div>