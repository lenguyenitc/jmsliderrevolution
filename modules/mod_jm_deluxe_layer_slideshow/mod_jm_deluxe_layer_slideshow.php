<?php
/**
 * @version     1.2.0
 * @package     com_jm_deluxe_layer_slideshow
 * @copyright   Copyright (C) 2013 - joomlaman.com.
 * @license     http://www.gnu.org/copyleft/lgpl.html
 * @author      JoomlaMan <support@joomlaman.com> - http://joomlaman.com
 */
// No direct access
defined('_JEXEC') or die;
// include the helper file
require_once(dirname(__FILE__).'/helper.php');
 
/**
 * Example to get a parameter from the module's configuration
 * $chanelCount = $params->get('chanelcount');
 */
/**
 * Example to get the items to display from the helper
 * $items = ModJmsliderHelper::getItems($params);
 */
$slider_id = $params->get('layer_id',1);
$include_jquery = $params->get('include_jquery',0);
$moduleclass_sfx = $params->get('moduleclass_sfx','');
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/helpers/jm_slider_revolution.php';
ob_start();
$slider = Jm_slider_revolutionHelper::putSlider(71);
$content = ob_get_contents();
ob_clean();
ob_end_clean();

// Do not output Slider if we are on mobile
$disable_on_mobile = $slider->getParam("disable_on_mobile","off");
if($disable_on_mobile == 'on'){
	$mobile = strstr($_SERVER['HTTP_USER_AGENT'],'Android') || strstr($_SERVER['HTTP_USER_AGENT'],'webOS') || strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') ||strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad') ? true : false;
	
	if($mobile)
		return false;
}
require(JModuleHelper::getLayoutPath('mod_jm_deluxe_layer_slideshow'));
?>