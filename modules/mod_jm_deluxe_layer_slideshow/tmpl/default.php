<?php
/**
 * @version     1.3.2
 * @package     com_jm_deluxe_layer_slideshow
 * @copyright   Copyright (C) 2013 - joomlaman.com.
 * @license     http://www.gnu.org/copyleft/lgpl.html
 * @author      JoomlaMan <support@joomlaman.com> - http://joomlaman.com
 */
// No direct access
defined('_JEXEC') or die;
global $css_settings;
global $jquery;
global $js_plugins;
global $js_revolution;
$document = JFactory::getDocument();
if($include_jquery){
    $document->addScript('administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jquery.min.js');
}
if ($css_settings != 1) {
	$document->addStyleSheet('administrator/components/com_jm_deluxe_layer_slideshow/assets/css/settings.css');
	$css_settings = 1;
}
if ($js_plugins != 1) {
	$document->addScript('administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jquery.themepunch.plugins.min.js');
	$js_plugins = 1;
}
if ($js_revolution != 1) {
	$document->addScript('administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jquery.themepunch.revolution.min.js');
}