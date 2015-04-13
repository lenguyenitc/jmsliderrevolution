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

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_jm_slider_revolution')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}
jimport('joomla.application.component.controller');
require_once JPATH_COMPONENT.'/classes/includes.php';
// Include dependancies
jimport('joomla.application.component.controller');
if(Jm_slider_revolutionHelper::isJoomla3()){
    $controller	= JControllerLegacy::getInstance('Jm_slider_revolution');
}else{	
    $controller	= JController::getInstance('Jm_slider_revolution');
}
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
