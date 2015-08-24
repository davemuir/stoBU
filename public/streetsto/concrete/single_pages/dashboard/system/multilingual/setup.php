<?php defined('C5_EXECUTE') or die("Access Denied.");?>
<?php
use Concrete\Core\Multilingual\Page\Section\Section as MultilingualSection;
?>
<fieldset>
    <legend><?php echo t('Content Sections')?></legend>
    <?php
    $nav = Loader::helper('navigation');
    if (count($pages) > 0) { ?>
        <table class="table table-striped">
        <tr>
            <th>&nbsp;</th>
            <th style="width: 45%"><?php echo t("Name")?></th>
            <th style="width: auto"><?php echo t('Locale')?></th>
            <th style="width: 30%"><?php echo t('Path')?></th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach($pages as $pc) {
            $pcl = MultilingualSection::getByID($pc->getCollectionID()); ?>
            <tr>
                <td><?php echo $ch->getSectionFlagIcon($pc)?></td>
                <td><a href="<?php echo $nav->getLinkToCollection($pc)?>"><?php echo $pc->getCollectionName()?></a></td>
                <td><?php echo $pcl->getLanguageText()?> (<?php echo $pcl->getLocale();?>)</td>
                <td><?php echo $pc->getCollectionPath()?></td>
                <td><a href="<?php echo $this->action('remove_locale_section', $pc->getCollectionID(), Loader::helper('validation/token')->generate())?>" class="icon-link"><i class="fa fa-trash"></i></a></td>
            </tr>
        <?php } ?>
        </table>

    <?php } else { ?>
        <p><?php echo t('You have not created any multilingual content sections yet.')?></p>
    <?php } ?>
    <form method="post" action="<?php echo $this->action('add_content_section')?>">
        <h4><?php echo t('Add a Locale')?></h4>
        <div class="form-group">
            <label class="control-label"><?php echo t('Choose a Parent Page')?></label>
            <?php echo Loader::helper('form/page_selector')->selectPage('pageID', '')?>
        </div>
        <div class="form-group">
            <?php echo $form->label('msLanguage', t('Choose Language'))?>
            <?php echo $form->select('msLanguage', $languages);?>
        </div>
        <div class="form-group">
            <?php echo $form->label('msCountry', t('Choose Country'))?>
            <?php echo $form->select('msCountry', $countries);?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo t('Language Icon')?></label>
            <div id="ccm-multilingual-language-icon"><?php echo t('None')?></div>
        </div>
        <div class="alert alert-info"><?php echo t('Your locale will be computed from your choice of language and country. Your language icon will be chosen based on the country.')?></div>

        <div class="form-group">
            <?php echo Loader::helper('validation/token')->output('add_content_section')?>
            <button class="btn btn-default pull-left" type="submit" name="add"><?php echo t('Add Content Section')?></button>
        </div>
    </form>
</fieldset>

<div class="spacer-row-6"></div>

<script type="text/javascript">
$(function() {
	$("select[name=msCountry]").change(function() {
		ccm_multilingualPopulateIcons($(this).val());
	});
	ccm_multilingualPopulateIcons($("select[name=msCountry]").val());
});

ccm_multilingualPopulateIcons = function(country) {
    if (country && country != '') {
	    $("#ccm-multilingual-language-icon").load('<?php echo $view->action("load_icon")?>', {'msCountry': country});
	}
};

</script>


<fieldset>
    <legend><?php echo t('Copy Locale Tree')?></legend>
<?php
$u = new User();
$copyLocales = array();
$includesHome = false;
foreach($pages as $pc) {
	$pcl = MultilingualSection::getByID($pc->getCollectionID());
	if ($pc->getCollectionID() == HOME_CID) {
		$includesHome = true;
	}
	$copyLocales[$pc->getCollectionID()] = tc(/*i18n: %1$s is a page name, %2$s is a language name, %3$s is a locale identifier (eg en_US)*/'PageWithLocale', '%1$s (%2$s, %3$s)', $pc->getCollectionName(), $pcl->getLanguageText(), $pcl->getLocale());
}

if ($u->isSuperUser() && !$includesHome) { ?>
<form method="post" id="ccm-internationalization-copy-tree" action="#">
	<?php if (count($pages) > 1) {
		$copyLocaleSelect1 = $form->select('copyTreeFrom', $copyLocales);
		$copyLocaleSelect2 = $form->select('copyTreeTo', $copyLocales);
		
		?>
		<p><?php echo t('Copy all pages from a locale to another section. This will only copy pages that have not been associated. It will not replace or remove any pages from the destination section.')?></p>
		<div class="form-group">
    		<label class="control-label"><?php echo t('Copy From')?></label>
		    <?php echo $copyLocaleSelect1?>
		</div>

        <div class="form-group">
		    <label class="control-label"><?php echo tc('Destination', 'To')?></label>
		    <?php echo $copyLocaleSelect2?>
		</div>

        <?php echo Loader::helper('validation/token')->output('copy_tree')?>
        <button class="btn btn-default pull-left" type="submit" name="copy"><?php echo t('Copy Tree')?></button>

	<?php } else if (count($pages) == 1) { ?>
		<p><?php echo t("You must have more than one multilingual section to use this tool.")?></p>
	<?php } else { ?>
		<p><?php echo t('You have not created any multilingual content sections yet.')?></p>
	<?php } ?>

	<?php if(version_compare(APP_VERSION, '5.6.0.3', '>')) { 
			// 5.6.1 OR GREATER
		?>
		<script type="text/javascript">
		$(function() {
			$("#ccm-internationalization-copy-tree").on('submit', function() {
				var ctf = $('select[name=copyTreeFrom]').val();
				var ctt = $('select[name=copyTreeTo]').val();
				if (ctt > 0 && ctf > 0 && ctt != ctf) {
					ccm_triggerProgressiveOperation(
						CCM_TOOLS_PATH + '/dashboard/sitemap_copy_all', 
						[{'name': 'origCID', 'value': ctf}, {'name': 'destCID', 'value': ctt}, {'name': 'copyChildrenOnly', 'value': true}],
						"<?php echo t('Copy Locale Tree')?>", function() {
							window.location.href= "<?php echo $this->action('tree_copied')?>";
						}
					);
				} else {
					alert("<?php echo t('You must choose two separate multilingual sections to copy from/to')?>");
				}
				return false;
			});
		});
		</script>

	<?php } ?>

</form>
<?php } else if (!$u->isSuperUser()) { ?>
	<p><?php echo t('Only the super user may copy locale trees.')?></p>
<?php } else if ($includesHome) { ?>
	<p><?php echo t('Since one of your multilingual sections is the home page, you may not duplicate your site tree using this tool. You must manually assign pages using the page report.')?></p>
<?php } ?>
</fieldset>

<div class="spacer-row-6"></div>

<?php if (count($pages) > 0) {
	$defaultLocales = array('' => t('** None Set'));
	foreach($pages as $pc) {
		$pcl = MultilingualSection::getByID($pc->getCollectionID());
		$defaultLocales[$pcl->getLocale()] = tc(/*i18n: %1$s is a page name, %2$s is a language name, %3$s is a locale identifier (eg en_US)*/'PageWithLocale', '%1$s (%2$s, %3$s)', $pc->getCollectionName(), $pcl->getLanguageText(), $pcl->getLocale());
	}
	$defaultLocalesSelect = $form->select('defaultLocale', $defaultLocales, $defaultLocale);
	?>
   <legend><?php echo t('Multilingual Settings')?></legend>
	<fieldset>
        <form method="post" action="<?php echo $this->action('set_default')?>">
            <div class="form-group">
                <label class="control-label"><?php echo t('Default Locale');?></label>
                <?php print $defaultLocalesSelect; ?>
            </div>
            
            <div class="form-group">
                <div class="checkbox">
                <label>
                    <?php echo $form->checkbox('useBrowserDetectedLocale', 1, $useBrowserDetectedLocale)?>
                    <span><?php echo t('Attempt to use visitor\'s locale based on their browser information.') ?></span>
                </label>
                </div>
                <div class="checkbox">
                <label>
                    <?php echo $form->checkbox('redirectHomeToDefaultLocale', 1, $redirectHomeToDefaultLocale)?>
                    <span><?php echo t('Redirect home page to default locale.') ?></span>
                </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label"><?php echo t('Site interface source locale');?></label>
                <?php
                echo $form->select('defaultSourceLanguage', array_merge(array('' => t('*** Unknown or mixed language')), $languages), $defaultSourceLanguage);
                echo $form->select('defaultSourceCountry', array_merge(array('' => ''), $countries), $defaultSourceCountry);
                ?>
                <script>
                $(document).ready(function() {
                    function update() {
                        if($('#defaultSourceLanguage').val()) {
                        	$('#defaultSourceCountry').removeAttr('disabled');
                        }
                        else {
                        	$('#defaultSourceCountry').attr('disabled', 'disabled');                        	
                        }
                    }
                    update();
                    $('#defaultSourceLanguage').on('change', function() {
                        update();
                    });
                });
                </script>
            </div>
            
            <div class="form-group">
                <?php echo Loader::helper('validation/token')->output('set_default')?>
                <button class="btn btn-default pull-left" type="submit" name="save"><?php echo t('Save Settings')?></button>
            </div>
        </form>
    </fieldset>
	<?php } ?>
