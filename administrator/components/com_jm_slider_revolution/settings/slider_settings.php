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

//set "slider_main" settings
$sliderMainSettings = new UniteSettingsAdvancedRev();
$UniteBaseAdminClassRev = new UniteBaseAdminClassRev();
$sliderMainSettings->addTextBox("title", "","Slider Title",array("description"=>"The title of the slider. Example: Slider1","required"=>"true"));
$sliderMainSettings->addTextBox("alias", "","Slider Alias",array("description"=>"The alias that will be used for embedding the slider. Example: slider1","required"=>"true"));
$sliderMainSettings->addTextBox("shortcode", "","Slider Shortcode", array("readonly"=>true,"class"=>"code"));

$sliderMainSettings->addHr();

//set slider type / texts
$sliderMainSettings->addRadio("slider_type", array("fixed"=>"Fixed",
	"responsitive"=>"Custom",
	"fullwidth"=>"Auto Responsive",
	"fullscreen"=>"Full Screen"
	),"Slider Layout",		
	"fullwidth");

$arrParams = array("class"=>"medium","description"=>"Example: #header or .header, .footer, #somecontainer | The height of fullscreen slider will be decreased with the height of these Containers to fit perfect in the screen");
$sliderMainSettings->addTextBox("fullscreen_offset_container", "","Offset Containers", $arrParams);

$sliderMainSettings->addControl("slider_type", "fullscreen_offset_container", UniteSettingsRev::CONTROL_TYPE_SHOW, "fullscreen");

$arrParams = array("class"=>"medium","description"=>"Defines an Offset to the top. Can be used with px and %. Example: 40px or 10%");
$sliderMainSettings->addTextBox("fullscreen_offset_size", "","Offset Size", $arrParams);

$sliderMainSettings->addControl("slider_type", "fullscreen_offset_size", UniteSettingsRev::CONTROL_TYPE_SHOW, "fullscreen");

$arrParams = array("description"=>"");
$sliderMainSettings->addTextBox("fullscreen_min_height", "","Min. Fullscreen Height", $arrParams);

$sliderMainSettings->addControl("slider_type", "fullscreen_min_height", UniteSettingsRev::CONTROL_TYPE_SHOW, "fullscreen");
	
$sliderMainSettings->addRadio("full_screen_align_force", array("on"=>"On", "off"=>"Off"),"FullScreen Align","off");


$sliderMainSettings->addRadio("auto_height", array("on"=>"On", "off"=>"Off"),"Unlimited Height","off");
$sliderMainSettings->addRadio("force_full_width", array("on"=>"On", "off"=>"Off"),"Force Full Width","off");

$paramsSize = array("width"=>960,"height"=>350,"datatype"=>UniteSettingsRev::DATATYPE_NUMBER);
$sliderMainSettings->addCustom("slider_size", "slider_size","","Grid Settings",$paramsSize);

$paramsResponsitive = array("w1"=>940,"sw1"=>770,"w2"=>780,"sw2"=>500,"w3"=>510,"sw3"=>310,"datatype"=>UniteSettingsRev::DATATYPE_NUMBER);
$sliderMainSettings->addCustom("responsitive_settings", "responsitive","","Responsive Sizes",$paramsResponsitive);

$sliderMainSettings->addHr();
$UniteBaseAdminClassRev::storeSettings("slider_main",$sliderMainSettings);


//set "slider_params" settings. 
$sliderParamsSettings = new UniteSettingsAdvancedRev();	
$sliderParamsSettings->loadXMLFile($sliderParamsSettings::$path_settings."/slider_settings.xml");
//store params
$UniteBaseAdminClassRev::storeSettings("slider_params",$sliderParamsSettings);
 
?>
				