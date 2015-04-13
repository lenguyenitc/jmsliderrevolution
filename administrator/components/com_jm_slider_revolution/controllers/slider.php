<?php
/**
 * @version     1.0.0
 * @package     com_jm_slider_revolution
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      JoomlaMan <support@joomlaman.com> - http://JoomlaMan.com
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Slider controller class.
 */
class Jm_slider_revolutionControllerSlider extends JControllerForm
{

    function __construct() {
        $this->view_list = 'sliders';
        parent::__construct();
    }
	function create_slider(){ 
		echo 'ok';die;
	}

}