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
//include frameword files
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/framework/include_framework.php';
//include bases
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/framework/base.class.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/framework/elements_base.class.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/framework/base_admin.class.php';
//require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/framework/base_front.class.php';
//include product files
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/revslider_settings_product.class.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/revslider_globals.class.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/revslider_operations.class.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/revslider_slider.class.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/revslider_output.class.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/revslider_slide.class.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/revslider_params.class.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/fonts.class.php';
/**
 * include the unitejoomla library
 */
require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/jm_slider_revolution.php';
$isJoomla3 = Jm_slider_revolutionHelper::isJoomla3();
//require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/revslider_admin.php';
jimport('joomla.application.component.view');
jimport('joomla.application.component.controller');
if($isJoomla3){ //joomla 3.x
		class RSliderView extends JViewLegacy{};
		class RSliderController extends JControllerLegacy{};

}else{ //joomla 2.5
		class RSliderView extends JView{};
		class RSliderController extends JController{};
}
	
?>