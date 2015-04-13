<?php
/**
 * @version     1.0.0
 * @package     com_jm_slider_revolution
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      JoomlaMan <support@joomlaman.com> - http://JoomlaMan.com
 */

// No direct access. 
defined('_JEXEC') or die;
?>
<div class="wrap settings_wrap">

	<div class="clear_both"></div> 

	<div class="title_line">
		<div id="icon-options-general" class="icon32"></div>
		<h2><?php echo "Edit Slides";?>: <?php echo $slider->getTitle();?></h2>
		
		<a href="<?php echo GlobalsRevSlider::LINK_HELP_SLIDE_LIST?>" class="button-primary float_right mtop_10 mleft_10" target="_blank"><?php echo"Help";?></a>			
		
	</div>
	
	<div class="vert_sap"></div>
	<?php if($numSlides >= 5):?>
		<a class='button-primary' id="button_new_slide_top" href='javascript:void(0)' ><?php echo "New Slide";?></a>
		<span class="hor_sap"></span>
		<a class='button-primary' id="button_new_slide_transparent_top" href='javascript:void(0)' ><?php echo "New Transparent Slide";?></a>
		<span class="loader_round new_trans_slide_loader" style="display:none"><?php echo "Adding Slide...";?></span>		
		<span class="hor_sap_double"></span>
		<a class="button_close_slide button-primary mright_20" href='<?php echo self::getViewUrl(RevSliderAdmin::VIEW_SLIDERS);?>' ><?php echo "Close";?></a>
				
	<?php endif?>
			
	<div class="vert_sap"></div>
	<div class="sliders_list_container">
		<?php require ("slides_list.php");?>
	</div>
	<div class="vert_sap_medium"></div>
	<a class='button-primary' id="button_new_slide" data-dialogtitle="<?php echo "Select image or multiple images to add slide or slides";?>" href='javascript:void(0)' ><?php echo "New Slide";?></a>
	<span class="hor_sap"></span>		
	<a class='button-primary' id="button_new_slide_transparent" href='javascript:void(0)' ><?php echo "New Transparent Slide";?></a>
	<span class="loader_round new_trans_slide_loader" style="display:none"><?php echo "Adding Slide...";?></span>		
	<?php
	if($useStaticLayers == 'on'){
		?>	
		<span class="hor_sap_double"></span>
		<a class='button-primary revgray' href='<?php echo $UniteFunctionsRev::getViewUrl(); ?>' style="width:150px; "><i style="color:#fff" class="eg-icon-lock"></i><?php echo "Edit Static Layers";?></a>
		<?php
	}
	?>
	<span class="hor_sap_double"></span>
	<a class="button_close_slide button-primary" href='<?php echo $UniteFunctionsRev::getViewUrl();?>' ><?php echo "Close";?></a>
	<span class="hor_sap"></span>
	
	<a href="<?php echo $linksSliderSettings?>" id="link_slider_settings"><?php echo "To Slider Settings";?></a>
	
</div>

<div id="dialog_copy_move" data-textclose="<?php echo "Close";?>" data-textupdate="<?php echo "Do It!";?>" title="<?php echo "Copy / move slide";?>" style="display:none">
	
	<br>
	
	<?php echo "Choose Slider";?> :
	<?php echo $selectSliders?>
	
	<br><br>
	
	<?php echo "Choose Operation";?> :
	 
	<input type="radio" id="radio_copy" value="copy" name="copy_move_operation" checked />
	<label for="radio_copy" style="cursor:pointer;"><?php echo "Copy";?></label>
	&nbsp; &nbsp;
	<input type="radio" id="radio_move" value="move" name="copy_move_operation" />
	<label for="radio_move" style="cursor:pointer;"><?php echo "Move";?></label>		
	
</div>

<?php require self::getPathTemplate("dialog_preview_slide");?>

<script type="text/javascript">

	var g_patternViewSlide = '<?php echo $patternViewSlide?>';
	
	jQuery(document).ready(function() {
		
		RevSliderAdmin.initSlidesListView("<?php echo $sliderID?>");
		
	});
	
</script>
