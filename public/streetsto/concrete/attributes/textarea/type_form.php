<fieldset>
<legend><?php echo t('Text Area Options')?></legend>

<div class="control-group">
<?php echo $form->label('akTextareaDisplayMode', t('Input Format'))?>
<div class="controls">
	<?php  
	$akTextareaDisplayModeOptions = array(
		'text' => t('Plain Text'),
		'rich_text' => t('Rich Text - Default Setting'),
		'rich_text_custom' => t('Rich Text - Custom')
	);

	?>
	<?php echo $form->select('akTextareaDisplayMode', $akTextareaDisplayModeOptions, $akTextareaDisplayMode, array(
		'class' => 'span8'
	))?>
</div>
</div>

<?php 
$customOptions = array(
	'character_styles' => t('Bold, Italic, Underline'),
	'paragraph_styles' => t('Paragraph Styles Dropdown'),
	'lists' => t('Lists'),
	'indent' => t('Indent/Outdent'),
	'image' => t('Image'),
	'video' => t('Embed Video'),
	'table' => t('Table Controls'),
	'link' => t('Links'),
	'color' => t('Background/Text Color'),
	'alignment' => t('Alignment Dropdown'),
	'horizontalrule' => t('Horizontal Rule'),
	'html' => t('HTML Source'),
	'concrete5menu' => t('concrete5 Menu (if applicable)')
);
?>

<div id="akTextareaDisplayModeCustomOptionsWrapper" style="display: none">
	<div class="control-group">
	<?php echo $form->label('akTextareaDisplayModeCustom', t('Options'))?>
	<div class="controls">
		<?php foreach($customOptions as $key => $value) { ?>
		<label class="checkbox">
			<?php echo $form->checkbox('akTextareaDisplayModeCustomOptions[]', $key, (
				in_array($key, $akTextareaDisplayModeCustomOptions) || count($akTextareaDisplayModeCustomOptions) == 0
			))?>
			<span><?php echo $value?></span>
		</label>
		<?php } ?>
	</div>
	</div>
</div>
</fieldset>