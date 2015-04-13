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
jimport('joomla.application.component.modeladmin');
/**
 * Jm_deluxe_layer_slideshow model.
 */
class Jm_deluxe_layer_slideshowModelCategory extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_JM_DELUXE_LAYER_SLIDESHOW';
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Category', $prefix = 'Jm_deluxe_layer_slideshowTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();
		
		// Get the form.
		$form = $this->loadForm('com_jm_deluxe_layer_slideshow.category', 'category', array('control' => 'jform', 'load_data' => $loadData));
		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	protected function loadForm($name, $source = null, $options = array(), $clear = false, $xpath = false)
	{	
		// Handle the optional arguments.
		$options['control'] = JArrayHelper::getValue($options, 'control', false);
	
		// Create a signature hash.
		$hash = md5($source . serialize($options));
		// Check if we can use a previously loaded form.
		if (isset($this->_forms[$hash]) && !$clear)
		{
			return $this->_forms[$hash];
		}
		// Get the form.
		JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
		JForm::addFieldPath(JPATH_COMPONENT . '/models/fields');
		
		try
		{
			$form = JForm::getInstance($name, $source, $options, false, $xpath);
			
			if (isset($options['load_data']) && $options['load_data'])
			{
				// Get the data for the form.
				$data = $this->loadFormData();
			}
			else
			{
				$data = array();
			}
			// Allow for additional modification of the form, and events to be triggered.
			// We pass the data because plugins may require it.
			/* $this->preprocessForm($form, $data); */
			// Load the data into the form after the plugins have operated.
			$form->bind($data);
		}
		catch (Exception $e)
		{
			$this->setError($e->getMessage());
			return false;
		}
		// Store the form for later.
		$this->_forms[$hash] = $form;
		return $form;
	}
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_jm_deluxe_layer_slideshow.edit.category.data', array());
		if (empty($data)) {
			$data = $this->getItem();
            
		}
		return $data;
	}
	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk)) {
			//Do any procesing on fields here if needed
		}
		return $item;
	}
	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @since	1.6
	 */
	/* protected function prepareTable(&$table)
	{
		jimport('joomla.filter.output');
		if (empty($table->id)) {
			// Set ordering to the last item if not set
			if (@$table->ordering === '') {
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__jmparallax_slideshow_category');
				$max = $db->loadResult();
				$table->ordering = $max+1;
			}
		}
	} */
}