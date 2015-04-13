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
$UniteBaseAdminClassRev = new UniteBaseAdminClassRev();
$UniteBaseAdminClassRev::requireSettings("general_settings");
$generalSettings = UniteBaseAdminClassRev::getSettings("general");
$role = $generalSettings->getSettingValue("role",$UniteBaseAdminClassRev::ROLE_ADMIN);
$includes_globally = $generalSettings->getSettingValue("includes_globally",'on');
$pages_for_includes = $generalSettings->getSettingValue("pages_for_includes",'');
$js_to_footer = $generalSettings->getSettingValue("js_to_footer",'off');
?>

<div id="dialog_general_settings" title="<?php echo "General Settings";?>" style="display:none;">

	<div class="settings_wrapper unite_settings_wide">
			<form name="form_general_settings" id="form_general_settings">
					<script type="text/javascript">
						g_settingsObj['form_general_settings'] = {};
					</script>
					<table class="form-table">				
						<tbody>
							<tr id="role_row" valign="top">
								<th scope="row">
									<?php echo "View Plugin Permission:";; ?>
								</th>
								<td>
									<select id="role" name="role">
										<option <?php echo $role=='admin'?"selected":"";?> value="admin"><?php echo "To Admin"; ?></option>
										<option <?php echo $role=='editor'?"selected":"";?> value="editor"><?php echo "To Editor, Admin"; ?></option>
										<option <?php echo $role=='author'?"selected":"";?> value="author"><?php echo "Author, Editor, Admin"; ?></option>
									</select>
								
									<div class="description_container">
										<span class="description"><?php echo "The role of user that can view and edit the plugin";?></span>					
									</div>
								</td>
							</tr>								
							<tr id="includes_globally_row" valign="top">
								<th scope="row">
									<?php echo "Include RevSlider libraries globally:";; ?>
								</th>
								<td>
									<span id="includes_globally_wrapper" class="radio_settings_wrapper">
									<div class="radio_inner_wrapper">
										<input type="radio" id="includes_globally_1" value="on" name="includes_globally" <?php echo $includes_globally=='on'?'checked':'';?>>
										<label for="includes_globally_1" style="cursor:pointer;"><?php echo "On";; ?></label>
									</div>
						
									<div class="radio_inner_wrapper">
										<input type="radio" id="includes_globally_2" value="off" name="includes_globally" <?php echo $includes_globally=='off'?'checked':'';?> >
										<label for="includes_globally_2" style="cursor:pointer;"><?php echo "Off";; ?></label>
									</div>					
									</span>
						
									<div class="description_container">
										<span class="description"><?php echo "ON - Add CSS and JS Files to all pages. </br>Off - CSS and JS Files will be only loaded on Pages where any rev_slider shortcode exists.";?></span>					
									</div>
								</td>
							</tr>								
							<tr id="pages_for_includes_row" valign="top">
								<th scope="row">
									<?php echo "Pages to include RevSlider libraries:";; ?>
								</th>
								<td>
									<input type="text" class="regular-text" id="pages_for_includes" name="pages_for_includes" value="<?php echo $pages_for_includes; ?>">			
									<div class="description_container">
										<span class="description"><?php echo "Specify the page id's that the front end includes will be included in. Example: 2,3,5 also: homepage,3,4";?></span>
					
									</div>
								</td>
							</tr>								
							<tr id="js_to_footer_row" valign="top">
								<th scope="row">
									<?php echo "Put JS Includes To Footer:";; ?>
								</th>
								<td>
									<span id="js_to_footer_wrapper" class="radio_settings_wrapper">
										<div class="radio_inner_wrapper">
											<input type="radio" id="js_to_footer_1" value="on" name="js_to_footer" <?php echo $js_to_footer=='on'?'checked':'';?>>
											<label for="js_to_footer_1" style="cursor:pointer;"><?php echo "On";; ?></label>
										</div>
						
										<div class="radio_inner_wrapper">
											<input type="radio" id="js_to_footer_2" value="off" name="js_to_footer" <?php echo $js_to_footer=='off'?'checked':'';?>>
											<label for="js_to_footer_2" style="cursor:pointer;"><?php echo "Off";; ?></label>
										</div>					
									</span>					
									<div class="description_container">
										<span class="description"><?php echo "Putting the js to footer (instead of the head) is good for fixing some javascript conflicts.";?></span>				
									</div>
								</td>
							</tr>								
					</tbody>
				</table>				
			</form>
	</div>
<br>

<a id="button_save_general_settings" class="button-primary" original-title=""><?php echo "Update";; ?></a>
<span id="loader_general_settings" class="loader_round mleft_10" style="display: none;"></span>

<!-- 
&nbsp;
<a class="button-primary">Close</a>
-->

</div>
