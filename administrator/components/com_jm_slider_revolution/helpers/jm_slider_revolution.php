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

/**
 * Jm_slider_revolution helper.
 */
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/framework/include_framework.php';
//include bases
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/framework/base.class.php';
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/framework/elements_base.class.php';
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/framework/base_admin.class.php';
//include product files
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/revslider_settings_product.class.php';
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/revslider_globals.class.php';
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/revslider_operations.class.php';
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/revslider_slider.class.php';
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/revslider_output.class.php';
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/revslider_slide.class.php';
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/revslider_params.class.php';
require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/classes/fonts.class.php';
class Jm_slider_revolutionHelper extends RevSliderOutput{

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '') {
		JSubMenuHelper::addEntry(
			JText::_('COM_JM_SLIDER_REVOLUTION_TITLE_SLIDERS'),
			'index.php?option=com_jm_slider_revolution&view=sliders',
			$vName == 'sliders'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JM_SLIDER_REVOLUTION_TITLE_SLIDES'),
			'index.php?option=com_jm_slider_revolution&view=slides',
			$vName == 'slides'
		);

    }
	public static function isJoomla3(){
		if(defined("JVERSION")){
				$version = JVERSION;
				$version = (int)$version;
				return($version == 3);
		}
		if(class_exists("JVersion")){
				$jversion = new JVersion;
				$version = $jversion->getShortVersion();
				$version = (int)$version;
				return($version == 3);
		}			
		return(!defined("DS"));
	}

    /**
     * Gets a list of the actions that can be performed.
     *
     * @return	JObject
     * @since	1.6
     */
    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;

        $assetName = 'com_jm_slider_revolution';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }


}
