<?php
defined('C5_EXECUTE') or die("Access Denied.");

$backgroundColor = '';
$image = false;
$baseFontSize = '';
$backgroundRepeat = 'no-repeat';
$textColor = '';
$linkColor = '';
$marginTop = '';
$marginLeft = '';
$marginRight = '';
$marginBottom = '';
$paddingTop = '';
$paddingLeft = '';
$paddingRight = '';
$paddingBottom = '';
$borderStyle = '';
$borderWidth = '';
$borderColor = '';
$borderRadius = '';
$alignment = '';
$rotate = '';
$boxShadowHorizontal = '';
$boxShadowVertical = '';
$boxShadowBlur = '';
$boxShadowSpread = '';
$boxShadowColor = '';
$customClass = '';
$set = $style->getStyleSet();
if (is_object($set)) {
    $backgroundColor = $set->getBackgroundColor();
    $textColor = $set->getTextColor();
    $linkColor = $set->getLinkColor();
    $image = $set->getBackgroundImageFileObject();
    $backgroundRepeat = $set->getBackgroundRepeat();
    $baseFontSize = $set->getBaseFontSize();
    $marginTop = $set->getMarginTop();
    $marginLeft = $set->getMarginLeft();
    $marginRight = $set->getMarginRight();
    $marginBottom = $set->getMarginBottom();
    $paddingTop = $set->getPaddingTop();
    $paddingLeft = $set->getPaddingLeft();
    $paddingRight = $set->getPaddingRight();
    $paddingBottom = $set->getPaddingBottom();
    $borderStyle = $set->getBorderStyle();
    $borderWidth = $set->getBorderWidth();
    $borderColor = $set->getBorderColor();
    $borderRadius = $set->getBorderRadius();
    $alignment = $set->getAlignment();
    $rotate = $set->getRotate();
    $boxShadowHorizontal = $set->getBoxShadowHorizontal();
    $boxShadowVertical = $set->getBoxShadowVertical();
    $boxShadowBlur = $set->getBoxShadowBlur();
    $boxShadowSpread = $set->getBoxShadowSpread();
    $boxShadowColor = $set->getBoxShadowColor();
    $customClass = $set->getCustomClass();
}

$repeatOptions = array(
    'no-repeat' => t('None'),
    'repeat-x' => t('Horizontal'),
    'repeat-y' => t('Vertical'),
    'repeat' => t('Tile')
);
$borderOptions = array(
    'none' => t('None'),
    'solid' => t('Solid'),
    'dotted' => t('Dotted'),
    'dashed' => t('Dashed'),
    'double' => t('Double'),
    'groove' => t('Groove'),
    'ridge' => t('Ridge'),
    'inset' => t('Inset'),
    'outset' => t('Outset')
);

$alignmentOptions = array(
    '' => t('None'),
    'left' => t('Left'),
    'center' => t('Center'),
    'right' => t('Right'),
);


$customClassesSelect = array();

if (is_array($customClasses)) {
    foreach($customClasses as $class) {
        $customClassesSelect[$class] = $class;
    }
}

if ($style instanceof \Concrete\Core\Block\CustomStyle) {
    $method = 'concreteBlockInlineStyleCustomizer';
} else {
    $method = 'concreteAreaInlineStyleCustomizer';
}

$al = new Concrete\Core\Application\Service\FileManager();
$form = Core::make('helper/form');
?>

<form method="post" action="<?php echo $saveAction?>" id="ccm-inline-design-form">
<ul class="ccm-inline-toolbar ccm-ui">
    <li class="ccm-inline-toolbar-icon-cell"><a href="#" data-toggle="dropdown" title="<?php echo t('Text Size and Color')?>"><i class="fa fa-font"></i></a>

        <div class="ccm-inline-design-dropdown-menu dropdown-menu">
            <div>
                <?php echo t('Text Color')?>
                <?php echo Loader::helper('form/color')->output('textColor', $textColor);?>
            </div>
            <hr />
            <div>
                <?php echo t('Link Color')?>
                <?php echo Loader::helper('form/color')->output('linkColor', $linkColor);?>
            </div>
            <hr />
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Base Font Size')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="baseFontSize" id="baseFontSize" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $baseFontSize ? $baseFontSize : '' ?>" <?php echo $baseFontSize ? '' : 'disabled' ?> />
                </div>
                <span class="ccm-inline-style-slider-display-value"><?php echo $baseFontSize ? $baseFontSize.'' : '0' ?></span>
            </div>
            <div class="ccm-inline-select-container">
                <?php echo t('Alignment')?>
                <?php echo $form->select('alignment', $alignmentOptions, $alignment);?>
            </div>

        </div>

    </li>
    <li class="ccm-inline-toolbar-icon-cell"><a href="#" data-toggle="dropdown" title="<?php echo t('Background Color and Image')?>"><i class="fa fa-image"></i></a>

        <div class="ccm-inline-design-dropdown-menu dropdown-menu">
            <h3><?php echo t('Background')?></h3>
            <div>
                <?php echo t('Color')?>
                <?php echo Loader::helper('form/color')->output('backgroundColor', $backgroundColor);?>
            </div>
            <hr />
            <div>
                <?php echo t('Image')?>
                <?php echo $al->image('backgroundImageFileID', 'backgroundImageFileID', t('Choose Image'), $image);?>
            </div>
            <div class="ccm-inline-select-container">
                <?php echo t('Tile')?>
                <?php echo $form->select('backgroundRepeat', $repeatOptions, $backgroundRepeat);?>
            </div>
        </div>

    </li>
    <li class="ccm-inline-toolbar-icon-cell"><a href="#" data-toggle="dropdown" title="<?php echo t('Borders')?>"><i class="fa fa-square-o"></i></a>
        <div class="ccm-inline-design-dropdown-menu dropdown-menu">
            <h3><?php echo t('Border')?></h3>
            <div>
                <?php echo t('Color')?>
                <?php echo Loader::helper('form/color')->output('borderColor', $borderColor);?>
            </div>
            <hr />
            <div class="ccm-inline-select-container">
                <?php echo t('Style')?>
                <?php echo $form->select('borderStyle', $borderOptions, $borderStyle);?>
            </div>
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Width')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="borderWidth" id="borderWidth" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $borderWidth ? $borderWidth : '' ?>" <?php echo $borderWidth ? '' : 'disabled' ?> />
                </div>
               <span class="ccm-inline-style-slider-display-value"><?php echo $borderWidth ? $borderWidth.'' : '0' ?></span>
            </div>
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Radius')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="borderRadius" id="borderRadius" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $borderRadius ? $borderRadius : '' ?>" <?php echo $borderRadius ? '' : 'disabled' ?> />
                </div>
                <span class="ccm-inline-style-slider-display-value"><?php echo $borderRadius ? $borderRadius.'' : '0' ?></span>
            </div>
        </div>
    </li>
    <li class="ccm-inline-toolbar-icon-cell"><a href="#" data-toggle="dropdown" title="<?php echo t('Margin and Padding')?>"><i class="fa fa-arrows-h"></i></a>
        <div class="ccm-inline-design-dropdown-menu dropdown-menu">
            <h3><?php echo t('Padding')?></h3>
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Top')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="paddingTop" id="paddingTop" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $paddingTop ? $paddingTop : '' ?>" <?php echo $paddingTop ? '' : 'disabled' ?> />
                </div>
                <span class="ccm-inline-style-slider-display-value"><?php echo $paddingTop ? $paddingTop.'' : '0' ?></span>
            </div>
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Right')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="paddingRight" id="paddingRight" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $paddingRight ? $paddingRight : '' ?>" <?php echo $paddingRight ? '' : 'disabled' ?> />
                </div>
                <span class="ccm-inline-style-slider-display-value"><?php echo $paddingRight ? $paddingRight.'' : '0' ?></span>
            </div>
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Bottom')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="paddingBottom" id="paddingBottom" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $paddingBottom ? $paddingBottom : '' ?>" <?php echo $paddingBottom ? '' : 'disabled' ?> />
                </div>
                <span class="ccm-inline-style-slider-display-value"><?php echo $paddingBottom ? $paddingBottom.'' : '0' ?></span>
            </div>
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Left')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="paddingLeft" id="paddingLeft" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $paddingLeft ? $paddingLeft : '' ?>" <?php echo $paddingLeft ? '' : 'disabled' ?> />
                </div>
               <span class="ccm-inline-style-slider-display-value"><?php echo $paddingLeft ? $paddingLeft.'' : '0' ?></span>
            </div>

            <?php if ($style instanceof \Concrete\Core\Block\CustomStyle) { ?>
                <hr />
                <h3><?php echo t('Margin')?></h3>
                <div>
                    <span class="ccm-inline-style-slider-heading"><?php echo t('Top')?></span>
                    <div class="ccm-inline-style-sliders" data-style-slider-min="-50" data-style-slider-max="200" data-style-slider-default-setting="0">
                        <input type="hidden" name="marginTop" id="marginTop" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $marginTop ? $marginTop : '' ?>" <?php echo $marginTop ? '' : 'disabled' ?> />
                    </div>
                    <span class="ccm-inline-style-slider-display-value"><?php echo $marginTop ? $marginTop.'' : '0' ?></span>
                </div>
                <div>
                    <span class="ccm-inline-style-slider-heading"><?php echo t('Right')?></span>
                    <div class="ccm-inline-style-sliders" data-style-slider-min="-50" data-style-slider-max="200" data-style-slider-default-setting="0">
                        <input type="hidden" name="marginRight" id="marginRight" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $marginRight ? $marginRight : '' ?>" <?php echo $marginRight ? '' : 'disabled' ?> />
                    </div>
                    <span class="ccm-inline-style-slider-display-value"><?php echo $marginRight ? $marginRight.'' : '0' ?></span>
                </div>
                <div>
                    <span class="ccm-inline-style-slider-heading"><?php echo t('Bottom')?></span>
                    <div class="ccm-inline-style-sliders" data-style-slider-min="-50" data-style-slider-max="200" data-style-slider-default-setting="0">
                        <input type="hidden" name="marginBottom" id="marginBottom" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $marginBottom ? $marginBottom : '' ?>" <?php echo $marginBottom ? '' : 'disabled' ?> />
                    </div>
                    <span class="ccm-inline-style-slider-display-value"><?php echo $marginBottom ? $marginBottom.'' : '0' ?></span>
                </div>
                <div>
                    <span class="ccm-inline-style-slider-heading"><?php echo t('Left')?></span>
                    <div class="ccm-inline-style-sliders" data-style-slider-min="-50" data-style-slider-max="200" data-style-slider-default-setting="0">
                        <input type="hidden" name="marginLeft" id="marginLeft" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $marginLeft ? $marginLeft : '' ?>" <?php echo $marginLeft ? '' : 'disabled' ?> />
                    </div>
                    <span class="ccm-inline-style-slider-display-value"><?php echo $marginLeft ? $marginLeft.'' : '0' ?></span>
                </div>

            <?php } ?>
        </div>

    </li>
    <li class="ccm-inline-toolbar-icon-cell"><a href="#" data-toggle="dropdown" title="<?php echo t('Shadow and Rotation (CSS3)')?>"><i class="fa fa-magic"></i></a>
        <div class="ccm-inline-design-dropdown-menu dropdown-menu">
            <h3><?php echo t('Shadow')?></h3>
            <div>
                <?php echo t('Color')?>
                <?php echo Loader::helper('form/color')->output('boxShadowColor', $boxShadowColor);?>
            </div>
            <hr />
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Horizontal Position')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="boxShadowHorizontal" id="boxShadowHorizontal" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $boxShadowHorizontal ? $boxShadowHorizontal : '' ?>" <?php echo $boxShadowHorizontal ? '' : 'disabled' ?> />
                </div>
                <span class="ccm-inline-style-slider-display-value"><?php echo $boxShadowHorizontal ? $boxShadowHorizontal.'' : '0' ?></span>
            </div>
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Vertical Position')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="boxShadowVertical" id="boxShadowVertical" data-value-format="px" class="ccm-inline-style-slider-value" value="<?php echo $boxShadowVertical ? $boxShadowVertical : '' ?>" <?php echo $boxShadowVertical ? '' : 'disabled' ?> />
                </div>
                <span class="ccm-inline-style-slider-display-value"><?php echo $boxShadowVertical ? $boxShadowVertical.'' : '0' ?></span>
            </div>
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Blur')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="boxShadowBlur" id="boxShadowBlur" class="ccm-inline-style-slider-value" data-value-format="px" value="<?php echo $boxShadowBlur ? $boxShadowBlur : '' ?>" <?php echo $boxShadowBlur ? '' : 'disabled' ?> />
                </div>
                <span class="ccm-inline-style-slider-display-value"><?php echo $boxShadowBlur ? $boxShadowBlur.'' : '0' ?></span>
            </div>
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Spread')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="-50" data-style-slider-max="200" data-style-slider-default-setting="0">
                    <input type="hidden" name="boxShadowSpread" id="boxShadowSpread" class="ccm-inline-style-slider-value" data-value-format="px" value="<?php echo $boxShadowSpread ? $boxShadowSpread : '' ?>" <?php echo $boxShadowSpread ? '' : 'disabled' ?> />
                </div>
                <span class="ccm-inline-style-slider-display-value"><?php echo $boxShadowSpread ? $boxShadowSpread.'' : '0' ?></span>
            </div>
            <hr/>
            <h3><?php echo t('Rotate')?></h3>
            <div>
                <span class="ccm-inline-style-slider-heading"><?php echo t('Rotation (in degrees)')?></span>
                <div class="ccm-inline-style-sliders" data-style-slider-min="0" data-style-slider-max="360" data-style-slider-default-setting="0">
                    <input type="hidden" name="rotate" id="rotate" class="ccm-inline-style-slider-value" data-value-format="" value="<?php echo $rotate ? $rotate : '' ?>" />
                </div>
               <span class="ccm-inline-style-slider-display-value"><?php echo $rotate ? $rotate.'' : '0' ?>&deg;</span>
            </div>

        </div>

    </li>
    <li class="ccm-inline-toolbar-icon-cell"><a href="#" data-toggle="dropdown" title="<?php echo t('Custom CSS Classes, Block Name, Custom Templates and Reset Styles')?>"><i class="fa fa-cog"></i></a>
        <div class="ccm-inline-design-dropdown-menu dropdown-menu">
            <h3><?php echo t('Advanced')?></h3>

            <div>
                <?php echo t('Custom Class')?>
                <?php echo $form->text('customClass', $customClass);?>
            </div>
            <hr/>

            <?php if ($style instanceof \Concrete\Core\Block\CustomStyle && $canEditCustomTemplate) { ?>
                <div class="ccm-inline-select-container">
                    <?php echo t('Custom Template')?>
                    <select id="bFilename" name="bFilename" class="form-control">
                        <option value="">(<?php echo t('None selected')?>)</option>
                        <?php
                        foreach($templates as $tpl) {
                            ?><option value="<?php echo $tpl->getTemplateFileFilename()?>" <?php if ($bFilename == $tpl->getTemplateFileFilename()) { ?> selected <?php } ?>><?php echo $tpl->getTemplateFileDisplayName()?></option><?php
                        }
                        ?>
                    </select>
                 </div>
                <hr/>

            <?php } ?>
            <div>
                <button data-reset-action="<?php echo $resetAction?>" data-action="reset-design" type="button" class="btn-block btn btn-danger"><?php echo t("Clear Styles")?></button>
            </div>
        </div>
    </li>
    <li class="ccm-inline-toolbar-button ccm-inline-toolbar-button-cancel">
        <button data-action="cancel-design" type="button" class="btn btn-mini"><?php echo t("Cancel")?></button>
    </li>
    <li class="ccm-inline-toolbar-button ccm-inline-toolbar-button-save">
        <button data-action="save-design" class="btn btn-primary" type="button"><?php echo t('Save')?></button>
    </li>
</ul>
</form>

<script type="text/javascript">
    $('#ccm-inline-design-form').<?php echo $method?>();
    $("#customClass").select2({tags:<?php echo json_encode(array_values($customClassesSelect)); ?>, separator: " "});
</script>