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
<!--  load good font -->
<?php
	$GlobalsRevSlider = new GlobalsRevSlider();
	if($loadGoogleFont == "true"){
		$googleFont = $slider->getParam("google_font","");
		if(!empty($googleFont)){
			if(is_array($googleFont)){
				foreach($googleFont as $key => $font){
					echo RevOperations::getCleanFontImport($font);
				}
			}else{
				echo RevOperations::getCleanFontImport($googleFont);
			}
		}
	}

	if($slide->isStaticSlide()){ //insert sliderid for preview
		?>
		<input type="hidden" id="sliderid" value="<?php echo $slider->getID(); ?>" />
		<input type="hidden" id="urlCssCaptions" value="<?php echo JURI::root().'components/com_jm_slider_revolution/rs-plugin/css/captions.php';?>" />
		<?php
	}
	?>
	
<div class="wrap settings_wrap settings_panel">
	<div class="clear_both"></div>

	<div class="title_line">
		<div id="icon-options-general" class="icon32"></div>
		<div class="view_title">
			<?php echo 'Slider:'; echo ' '.$slider->getParam("title",""); ?>, 
			<?php
			if($sliderTemplate == "true"){
				echo "Edit Template Slide";
			}else{
				echo "Edit Slide";
			}
			?> <?php echo $slideOrder?>, <?php echo "Title:"; ?> <?php echo $slideTitle?>
		</div>

		<a href="<?php echo $GlobalsRevSlider::LINK_HELP_SLIDE?>" class="button-primary float_right revblue mtop_10 mleft_10" target="_blank"><?php echo "Help"?></a>

	</div>
	
	<div id="slide_selector" class="slide_selector">
		<?php
		$sID = $slider->getID();
		
		$useStaticLayers = $slider->getParam("enable_static_layers","off");
		if($useStaticLayers == 'on'){
			?>
			<ul class="list_static_slide_links">
				<li class="revgray nowrap">
					<a href="<?php echo $UniteFunctionsRev::getViewUrl("static_$sID",'edit','slide'); ?>" class="add_slide"><i class="eg-icon-lock"></i><span><?php echo "Static Layer"?></span></a>
				</li>
			</ul>
			<?php
		}
		?>
		<ul class="list_slide_links">
			<?php
			foreach($arrSlideNames as $slidelistID=>$c_slide){

				$slideName = $c_slide["name"];
				$title = $c_slide["title"];
				$arrChildrenIDs = $c_slide["arrChildrenIDs"];

				$class = "tipsy_enabled_top";
				$titleclass = "";
				$urlEditSlide = $UniteFunctionsRev::getViewUrl($slidelistID,'edit','slide');
				if($slideID == $slidelistID || in_array($slideID, $arrChildrenIDs)){
					$class .= " selected";
					$titleclass = " slide_title";
					$urlEditSlide = "javascript:void(0)";
				}

				$addParams = "class='".$class."'";
				$slideName = str_replace("'", "", $slideName);
	
				?>
				<li id="slidelist_item_<?php echo $slidelistID?>">
					<a href="<?php echo $urlEditSlide?>" title='<?php echo $slideName?>' <?php echo $addParams?>><span class="nowrap<?php echo $titleclass?>"><?php echo $title?></span></a>
				</li>
				<?php
			}
			?>
			<li>
				<a id="link_add_slide" href="javascript:void(0);" class="add_slide"><span class="nowrap"><?php echo "Add Slide"?></span></a>
			</li>
			<li>
				<div id="loader_add_slide" class="loader_round" style="display:none"></div>
			</li>
		</ul>
	</div>

	<div class="clear"></div>
	<!--<hr class="tabdivider">-->

	<div class="divide220"></div>
	
	<?php
	if(!$slide->isStaticSlide()){
	?>
	
		<div id="slide_params_holder" class="postbox unite-postbox" style="max-width:100% !important;">
			<h3 class="box-closed tp-accordion"><span class="postbox-arrow2">-</span><span><?php echo "General Slide Settings" ?></span></h3>
			<div class="toggled-content">
				<form name="form_slide_params" id="form_slide_params">
				<?php
					$settingsSlideOutput->draw("form_slide_params",false);
				?>
					<input type="hidden" id="image_url" name="image_url" value="<?php echo $imageUrl?>" />
					<input type="hidden" id="urlCssCaptions" value="<?php echo JURI::root().'components/com_jm_slider_revolution/rs-plugin/css/captions.php';?>" />
				</form>
			</div>
		</div>

	<?php
	}
	?>

	<div id="jqueryui_error_message" class="unite_error_message" style="display:none;">
			<b>Warning!!! </b>The jquery ui javascript include that is loaded by some of the plugins are custom made and not contain needed components like 'autocomplete' or 'draggable' function.
			Without those functions the editor may not work correctly. Please remove those custom jquery ui includes in order the editor will work correctly.
	 </div>

	<?php require ("edit_layers.php");?>

	<?php
	if(!$slide->isStaticSlide()){
	?>
		<a href="javascript:void(0)" id="button_save_slide" class="revgreen button-primary"><div class="updateicon"></div><?php echo "Update Slide"?></a>
	<?php }else{ ?>
		<a href="javascript:void(0)" id="button_save_static_slide" class="revgreen button-primary"><div class="updateicon"></div><?php echo "Update Static Layers"?></a>
	<?php } ?>
	<span id="loader_update" class="loader_round" style="display:none;"><?php echo "updating"?>...</span>
	<span id="update_slide_success" class="success_message" class="display:none;"></span>
	<a href="<?php echo $UniteFunctionsRev::getViewUrl($sliderID,'edit','slider');?>" class="button-primary revblue"><?php echo "To Slider Settings"?></a>
	<a id="button_close_slide" href="<?php echo $closeUrl?>" class="button-primary revyellow"><div class="closeicon"></div><?php echo "To Slide List"?></a>
	
	<?php
	if(!$slide->isStaticSlide()){
	?>
	<a href="javascript:void(0)" id="button_delete_slide" class="button-primary revred" original-title=""><i class="revicon-trash"></i><?php echo "Delete Slide"?></a>
	<?php } ?>
</div>

<div class="vert_sap"></div>

<?php require ("dialog_preview_slide.php");?>
<?php require ("video_dialog.php");?>
<?php
if($slide->isStaticSlide())
	require ("dialog_preview_slider.php");
?>

<!-- FIXED POSITIONED TOOLBOX -->
	<div class="" style="position:fixed;right:-10px;top:148px;z-index:100;">
		<?php
		if(!$slide->isStaticSlide()){
		?>
		<a href="javascript:void(0)" id="button_save_slide-tb" class="revgreen button-primary button-fixed"><div style="font-size:16px; padding:10px 5px;" class="revicon-arrows-ccw"></div></a>
		<?php }else{ ?>
		<a href="javascript:void(0)" id="button_save_static_slide-tb" class="revgreen button-primary button-fixed"><div style="font-size:16px; padding:10px 5px;" class="revicon-arrows-ccw"></div></a>
		<?php } ?>
	</div>

<div class="" style="position:fixed;right:-10px;top:100px;z-index:100;">

</div>

<?php
if($slide->isStaticSlide()){
	$slideID = $slide->getID();
}
?>
<script type="text/javascript">
	var g_messageDeleteSlide = "<?php echo "Delete this slide?"?>";
	jQuery(document).ready(function(){
		RevSliderAdmin.initEditSlideView(<?php echo $slideID?>,<?php echo $sliderID?>);
	});
</script>