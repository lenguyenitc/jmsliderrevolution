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

$generalSettings = new UniteSettingsRev();

$generalSettings->addSelect("role", 
							array(UniteBaseAdminClassRev::ROLE_ADMIN => "To Admin",
								  UniteBaseAdminClassRev::ROLE_EDITOR =>"To Editor, Admin",
								  UniteBaseAdminClassRev::ROLE_AUTHOR =>"Author, Editor, Admin"),									  
								  "View Plugin Permission", 
								  UniteBaseAdminClassRev::ROLE_ADMIN, 
								  array("description"=>"The role of user that can view and edit the plugin"));

$generalSettings->addRadio("includes_globally", 
						   array("on"=>"On","off"=>"Off"),
						   "Include RevSlider libraries globally",
						   "on",
						   array("description"=>"Add css and js includes only on all pages. Id turned to off they will added to pages where the rev_slider shortcode exists only. This will work only when the slider added by a shortcode."));

$generalSettings->addTextBox("pages_for_includes", "","Pages to include RevSlider libraries",
							  array("description"=>"Specify the page id's that the front end includes will be included in. Example: 2,3,5 also: homepage,3,4"));
								  
$generalSettings->addRadio("js_to_footer", 
						   array("on"=>"On","off"=>"Off"),
						   "Put JS Includes To Footer",
						   "off",
						   array("description"=>"Putting the js to footer (instead of the head) is good for fixing some javascript conflicts."));

$generalSettings->addRadio("show_dev_export", 
						   array("on"=>"On","off"=>"Off"),
						   "Enable Markup Export option",
						   "off",
						   array("description"=>"This will enable the option to export the Slider Markups to copy/paste it directly into websites."));
	
$generalSettings->addRadio("use_hammer_js", 
						   array("on"=>"On","off"=>"Off"),
						   "Use Own hammer.js",
						   "on",
						   array("description"=>"Disable this only if hammer.js is already loaded."));

//get stored values
$operations = new RevOperations();
$arrValues = $operations->getGeneralSettingsValues();
$generalSettings->setStoredValues($arrValues);

self::storeSettings("general", $generalSettings);

?>