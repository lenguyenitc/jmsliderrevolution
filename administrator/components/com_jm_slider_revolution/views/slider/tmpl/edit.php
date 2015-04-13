<?php
/**
 * @version     1.0.0
 * @package     com_jm_slider_revolution
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      JoomlaMan <support@joomlaman.com> - http://JoomlaMan.com
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
// Import CSS
$sliderTemplate = false;
$UniteBaseAdminClassRev = new UniteBaseAdminClassRev();
$settingsSliderParams = new UniteSettingsProductSidebarRev();
$UniteBaseAdminClassRev::requireSettings("slider_settings");
$settingsMain = $UniteBaseAdminClassRev::getSettings("slider_main");
$settingsParams = $UniteBaseAdminClassRev::getSettings("slider_params");
$settingsSliderMain = new RevSliderSettingsProduct();
//check existing slider data:
$sliderID = JRequest::getVar("id");
if(!empty($sliderID)){	
	$slider = new RevSlider();
	$UniteFunctionsRev = new UniteFunctionsRev();
	$slider->initByID($sliderID);				
	//get setting fields
	$settingsFields = $slider->getSettingsFields();
	$arrFieldsMain = $settingsFields["main"];
	$arrFieldsParams = $settingsFields["params"];		
	//modify arrows type for backword compatability
	$arrowsType = $UniteFunctionsRev::getVal($arrFieldsParams, "navigation_arrows");
	switch($arrowsType){
		case "verticalcentered":
			$arrFieldsParams["navigation_arrows"] = "solo";
		break;
	}		
	//set custom type params values:
	$settingsMain = $settingsSliderMain::setSettingsCustomValues($settingsMain, $arrFieldsParams, $postTypesWithCats);		
	//set setting values from the slider
	$settingsMain->setStoredValues($arrFieldsParams);				
	$settingsParams->setStoredValues($arrFieldsParams);		
	//update short code setting
	$shortcode = $slider->getShortcode();
	$settingsMain->updateSettingValue("shortcode",$shortcode);
	$linksEditSlides = $UniteFunctionsRev::getViewUrl($sliderID,'default','slides');		
	$settingsSliderParams->init($settingsParams);	
	$settingsSliderMain->init($settingsMain);		
	$settingsSliderParams->isAccordion(true);
	require ("slider_edit.php");		
}else{
	//set custom type params values:
	$settingsMain = $settingsSliderMain::setSettingsCustomValues($settingsMain, array(), $postTypesWithCats);	
	$settingsSliderParams->init($settingsParams);	
	$settingsSliderMain->init($settingsMain);		
	$settingsSliderParams->isAccordion(true);
	require ("slider_new.php");		
}
?>