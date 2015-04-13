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
class Jm_deluxe_layer_slideshowController extends JControllerDeluxeBaseJm
{
	/** 
	 * Method to display a view.
	 *
	 * @param	boolean			$cachable	If true, the view output will be cached
	 * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
            require_once JPATH_COMPONENT.'/helpers/jm_deluxe_layer_slideshow.php';
            $view		= JFactory::getApplication()->input->getCmd('view', 'slideshowsliders');
            JFactory::getApplication()->input->set('view', $view);
            parent::display($cachable, $urlparams);
            return $this;
	}
}
