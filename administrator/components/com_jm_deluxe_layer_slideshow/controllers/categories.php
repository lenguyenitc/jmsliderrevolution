<?php
/**
 * @version     1.2.0
 * @package     com_jm_deluxe_layer_slideshow
 * @copyright   Copyright (C) 2013 - joomlaman.com.
 * @license     http://www.gnu.org/copyleft/lgpl.html
 * @author      JoomlaMan <support@joomlaman.com> - http://joomlaman.com
 */
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * Slideshowsliders list controller class.
 */
class Jm_deluxe_layer_slideshowControllerCategories extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'Category', $prefix = 'Jm_deluxe_layer_slideshowModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
    
    
	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function saveOrderAjax()
	{
		// Get the input
		$input = JFactory::getApplication()->input;
		$pks = $input->post->get('cid', array(), 'array');
		$order = $input->post->get('order', array(), 'array');

		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		// Close the application
		JFactory::getApplication()->close();
	}
    
    
    
}