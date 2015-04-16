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
global $revSliderAsTheme;
$exampleID = '"slider1"';
if(!empty($arrSliders))
	$exampleID = '"'.$arrSliders[0]->getAlias().'"';
	
$outputTemplates = false;
$GlobalsRevSlider = new GlobalsRevSlider();
$latest_version = '1.0.0';

?>

<div class='wrap'>
	<div class="clear_both"></div> 
	<div class="title_line" style="margin-bottom:10px">
		<div id="icon-options-general" class="icon32"></div>					
		<a href="<?php echo $GlobalsRevSlider::LINK_HELP_SLIDERS?>" class="button-primary float_right mtop_10 mleft_10" target="_blank"><?php echo "Help";?></a>			
	</div>
	
	<div class="clear_both"></div> 
	
	<div class="title_line nobgnopd">
		<div class="view_title">
			<?php echo "Revolution Sliders";?>
		</div>						
	</div>

	<?php
	$no_sliders = false;
	if(empty($arrSliders)){
		echo "No Sliders Found";
		$no_sliders = true;
		?>
		<br><?php
	}
	
	require ("sliders_list.php");
	
	?>
	<div style="width:100%;height:50px"></div>
	
	<?php
	if(!$revSliderAsTheme){
		?>
		<div style="width:100%;height:50px"></div>
		<!-- 
		THE CURRENT AND NEXT VERSION		
		-->
		<div class="title_line nobgnopd"><div class="view_title"><?php echo "Version Information";?></div></div>		
		
		<div style="border-top:1px solid #e5e5e5; padding:15px 15px 15px 80px; position:relative;overflow:hidden;background:#fff;">		
			<div class="revgray" style="left:0px;top:0px;position:absolute;height:100%;padding:27px 10px;"><i style="color:#fff;font-size:25px" class="revicon-info-circled"></i></div>
			<p style="margin-top:5px; margin-bottom:5px;">
				<?php echo "Installed Version";?>: <span  class="slidercurrentversion"><?php echo GlobalsRevSlider::SLIDER_REVISION; ?></span><br>
				<?php echo "Latest Available Version";?>: <span class="slideravailableversion"><?php echo $latest_version; ?></span>
				<a class='button-primary revblue' href='#' id="rev_check_version"><?php echo "Check Version";?> </a>
			</p>
		</div>
		<?php
	}
	?>

	<!-- THE UPDATE HISTORY OF SLIDER REVOLUTION -->
	<div style="width:100%;height:50px"></div>	
	
	<div class="title_line nobgnopd">
		<div class="view_title"><span style="margin-right:10px"><?php echo "Update History"; ?></span></div>
	</div>
			
	<div style="border-top:1px solid #e5e5e5;  height:500px;padding:25px 15px 15px 80px; position:relative;overflow:hidden;background:#fff">		
		<div class="revpurple" style="left:0px;top:0px;position:absolute;height:100%;padding:27px 10px;"><i style="color:#fff;font-size:27px" class="eg-icon-back-in-time"></i></div>
		<div style="height:485px;overflow-y:scroll;width:100%;"><?php echo file_get_contents(JPATH_COMPONENT_ADMINISTRATOR."/release_log.html"); ?></div>							
	</div>
</div>

<!-- Import slider dialog -->
<div id="dialog_import_slider" title="<?php echo "Import Slider";?>" class="dialog_import_slider" style="display:none">
	<form action="<?php echo JURI::root()."administrator/index.php?option=com_jm_slider_revolution&view=slider&format=slider";?>" enctype="multipart/form-data" method="post">
		<br>
		<input type="hidden" name="action" value="import_slider">
		<input type="hidden" name="client_action" value="import_slider_slidersview">
		<?php echo "Choose the import file";?>:   
		<br>
		<input type="file" size="60" name="import_file" class="input_import_slider">
		<br><br>
		<span style="font-weight: 700;"><?php echo "Note: custom styles will be updated if they exist!";?></span><br><br>
		<table>
			<tr>
				<td><?php echo "Custom Animations:";?></td>
				<td><input type="radio" name="update_animations" value="true" checked="checked"> <?php echo "overwrite";?></td>
				<td><input type="radio" name="update_animations" value="false"> <?php echo "append";?></td>
			</tr>
			<tr>
				<td><?php echo "Static Styles:";?></td>
				<td><input type="radio" name="update_static_captions" value="true" checked="checked"> <?php echo "overwrite";?></td>
				<td><input type="radio" name="update_static_captions" value="false"> <?php echo "append";?></td>
			</tr>
		</table>
		<br><br>
		<input type="submit" class='button-primary' value="<?php echo "Import Slider";?>">
	</form>
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){
		RevSliderAdmin.initSlidersListView();
		jQuery('#benefitsbutton').hover(function() {
			jQuery('#benefitscontent').slideDown(200);
		}, function() {
			jQuery('#benefitscontent').slideUp(200);				
		})
		
		jQuery('#tp-validation-box').click(function() {
			jQuery(this).css({cursor:"default"});
			if (jQuery('#rs-validation-wrapper').css('display')=="none") {
				jQuery('#tp-before-validation').hide();
				jQuery('#rs-validation-wrapper').slideDown(200);
			}
		})
	});
</script>
