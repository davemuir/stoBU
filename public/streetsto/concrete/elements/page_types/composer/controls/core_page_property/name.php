<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="form-group">
	<label class="control-label"><?php echo $label?></label>
	<?php if($description): ?>
	<i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo $description?>"></i>
	<?php endif; ?>
	<div data-composer-field="name">
		<?php echo $form->text($this->field('name'), $control->getPageTypeComposerControlDraftValue())?>
	</div>
</div>

<script type="text/javascript">
var concreteComposerAddPageTimer = false;
$(function() {
	$('div[data-composer-field=name] input').on('keyup', function() {
		var val = $(this).val();
		var frm = $(this);
		clearTimeout(concreteComposerAddPageTimer);
        concreteComposerAddPageTimer = setTimeout(function() {
            $('.ccm-composer-url-slug-loading').show();
			$.post('<?php echo REL_DIR_FILES_TOOLS_REQUIRED?>/pages/url_slug', {
				'token': '<?php echo Loader::helper('validation/token')->generate('get_url_slug')?>',
				'name': val
			}, function(r) {
                $('.ccm-composer-url-slug-loading').hide();
				$('div[data-composer-field=url_slug] input').val(r);
			});
		}, 150);
	});
});
</script>