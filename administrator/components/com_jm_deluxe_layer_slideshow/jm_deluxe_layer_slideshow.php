<?php
/**
 * @version     1.2.2
 * @package     com_jm_deluxe_layer_slideshow
 * @copyright   Copyright (C) 2013 - joomlaman.com.
 * @license     http://www.gnu.org/copyleft/lgpl.html
 * @author      JoomlaMan <support@joomlaman.com> - http://joomlaman.com
 */
// No direct access
defined('_JEXEC') or die;

// Access check. 
if (!JFactory::getUser()->authorise('core.manage', 'com_jm_deluxe_layer_slideshow')) 
{
    throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');
require_once JPATH_COMPONENT.'/classes/includes.php';
// Include dependancies
jimport('joomla.application.component.controller');
if(Jm_deluxe_layer_slideshowHelper::isJoomla3())
    $controller	= JControllerLegacy::getInstance('Jm_deluxe_layer_slideshow');
else	
    $controller	= JController::getInstance('Jm_deluxe_layer_slideshow');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
