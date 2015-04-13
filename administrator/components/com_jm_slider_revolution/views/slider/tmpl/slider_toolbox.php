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
<div id="toolbox_wrapper" class="toolbox_wrapper postbox unite-postbox">
	<h3 class="box_closed tp-accordion tpa-closed"><div class="postbox-arrow"></div><i style="float:left;margin-top:4px;font-size:14px;" class="eg-icon-export"></i><span><?php echo "Import / Export"; ?></span></h3>
	<div class="toggled-content tp-closedatstart p20">
		
		<div class="api-caption"><?php echo "Import Slider";?>:</div>
		<div class="divide20"></div>
		<form action="<?php echo JUri::root().'administrator/index.php?option=com_jm_slider_revolution&view=slider&format=slider';?>" enctype="multipart/form-data" method="post">
			<input type="hidden" name="action" value="import_slider">
			<input type="hidden" name="sliderid" value="<?php echo $sliderID?>">								
			<input type="file" name="import_file" class="input_import_slider" style="width:100%">
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
			<div class="divide20"></div>				
			<input type="submit" class='button-primary revgreen' value="Import Slider">
		</form>	
		<div class="divide20"></div>
		<div class="api-desc"><?php echo "Note, that when you importing slider, it delete all the current slider settings and slides, then replace it with the new ones";?>.</div>
		<hr>
		<div class="divide20"></div>
		
		<div class="api-caption"><?php echo "Export Slider";?>:</div>
		<div class="divide20"></div>
		
		<a id="button_export_slider" class='button-primary revblue' href='javascript:void(0)' ><?php echo "Export Slider";?></a> <div style="display: none;"><input type="checkbox" name="export_dummy_images"> <?php echo "Export with Dummy Images";?></div>
		<!-- replace image url's -->
		
		<div class="divide20"></div>
		<hr>
		<div class="divide10"></div>
		<div class="api-caption"><?php echo "Replace Image Url's";?>:</div>
		<div class="divide5"></div>
		<div class="api-desc"><?php echo "Replace all layer and background image url's. Example: http://localhost/ to http://yourwbsite.com/. <br> Note, the replace is not reversible";?>.</div>
					
		<div class="divide10"></div>
		
		<?php echo "Replace From (example - http://localhost)";?>:
		<div class="divide5"></div>			
		<input type="text" class="text-sidebar-link" id="replace_url_from">
		
		<div class="divide10"></div>
		
		<?php echo "Replace To (example - http://yoursite.com)";?>:
		<div class="divide5"></div>
		<input type="text" class="text-sidebar-link" id="replace_url_to">
		
		<div class="divide10"></div>
		
		<a id="button_replace_url" class='button-primary revyellow' href='javascript:void(0)' ><?php echo "Replace";?></a>
		<div id="loader_replace_url" class="loader_round" style="display:none;"><?php echo "Replacing...";?> </div>
		<div id="replace_url_success" class="success_message" class="display:none;"></div>


	</div>	
</div>


