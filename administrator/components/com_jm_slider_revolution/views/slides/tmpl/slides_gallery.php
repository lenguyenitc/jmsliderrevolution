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
		<div class="view_title"><?php echo "Edit Slides";?>: <?php echo $slider->getTitle()?></div>
		<?php $GlobalsRevSlider = new GlobalsRevSlider();?>
		<a href="<?php echo $GlobalsRevSlider::LINK_HELP_SLIDE_LIST?>" class="button-primary float_right mtop_10 mleft_10" target="_blank"><?php echo "Help";?></a>			
		
	</div>
	
	<div class="vert_sap"></div>
	<?php if($numSlides >= 5){ ?>
		<a class='button-primary revblue' id="button_new_slide_top" href='javascript:void(0)' ><i class="revicon-list-add"></i><?php echo "New Slide";?></a>
		<a class='button-primary revblue' id="button_new_slide_transparent_top" href='javascript:void(0)' ><i class="revicon-list-add"></i><?php echo "New Transparent Slide";?></a>
		<span class="loader_round new_trans_slide_loader" style="display:none"><?php echo "Adding Slide...";?></span>		

		<a class="button-primary revyellow" href='<?php echo $UniteFunctionsRev::getViewUrl();?>' ><i class="revicon-cancel"></i><?php echo "Close";?></a>
	<?php } ?>
			
	<div class="vert_sap"></div>
	<div class="sliders_list_container">
		<?php require ("slides_list.php");?>
	</div>
	<div class="vert_sap_medium"></div>
	<a class='button-primary revblue modal' id="button_new_slide" rel="{handler: 'iframe', size: {x: 800, y: 500}}" title="<?php echo "Select image";?>"  href="index.php?option=com_media&view=images&tmpl=component&asset=com_jm_slider_revolution&fieldid=thumbnail_img&folder=revslider"><i class="revicon-list-add"></i><?php echo "New Slide";?></a>
	<a class='button-primary revblue' id="button_new_slide_transparent" href='javascript:void(0)' ><i class="revicon-list-add"></i><?php echo "New Transparent Slide";?></a>
	<span class="loader_round new_trans_slide_loader" style="display:none"><?php echo "Adding Slide...";?></span>
	<?php
	if($useStaticLayers == 'on'){
		?>		
		<a class='button-primary revgray' href='<?php echo $UniteFunctionsRev::getViewUrl($slider->getID(),'slide'); ?>' style="width:150px; "><i class="eg-icon-lock"></i><?php echo "Edit Static Layers";?></a>
		<?php
	}
	?>
	<a class="button-primary revyellow" href='<?php echo $UniteFunctionsRev::getViewUrl();?>' ><i class="revicon-cancel"></i><?php echo "Close";?></a>		
	<a href="<?php echo $linksSliderSettings?>" class="button-primary revgreen"><i class="revicon-cog"></i><?php echo "Slider Settings";?></a>		

	
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

<?php require ("dialog_preview_slide.php");?>

<script type="text/javascript">

	var g_patternViewSlide = '<?php echo $patternViewSlide?>';
	
	var g_messageChangeImage = "<?php echo "Select Slide Image";?>";
	
	jQuery(document).ready(function() {
		var g_messageDeleteSlide = "<?php echo "Delete this slide?";?>";
		RevSliderAdmin.initSlidesListView("<?php echo $sliderID?>");
		
	});
	
</script>
