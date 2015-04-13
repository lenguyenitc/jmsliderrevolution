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
jimport('joomla.application.component.controllerform');
/**
 * Slideshowslider controller class.
 */
class Jm_deluxe_layer_slideshowControllerCategory extends JControllerForm
{

    function __construct() {
        $this->view_list = 'categories';
        parent::__construct();
    }

}