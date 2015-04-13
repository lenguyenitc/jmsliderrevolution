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
require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/jm_deluxe_layer_slideshow.php';
$isJoomla3 = Jm_deluxe_layer_slideshowHelper::isJoomla3();
/**
 * include the unitejoomla library
 */
$currentDir = dirname(__FILE__)."/";

jimport('joomla.application.component.view');
jimport('joomla.application.component.controller');

if($isJoomla3){
		class JMasterViewDeluxeBaseJm extends JViewLegacy{};
		class JControllerDeluxeBaseJm extends JControllerLegacy{};

}else{  //joomla 2.5
		class JMasterViewDeluxeBaseJm extends JView{};
		class JControllerDeluxeBaseJm extends JController{};
}
	
?>