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
jimport('joomla.application.component.view');
require_once JPATH_COMPONENT . '/helpers/jm_deluxe_layer_slideshow.php';
/**
 * View to edit
 */
class Jm_deluxe_layer_slideshowViewCategory extends JMasterViewDeluxeBaseJm
{
	protected $state;
	protected $item;
	protected $form;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
                $this->isJoomla3 = Jm_deluxe_layer_slideshowHelper::isJoomla3();
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
		}
		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$canDo		= Jm_deluxe_layer_slideshowHelper::getActions();
		if (isset($this->item->checked_out)) {
		    $checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
        } else {
            $checkedOut = false;
        }
		JToolBarHelper::title(JText::_('JM Deluxe Layer Slideshow Category'), 'slideshowslider.png');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit')||($canDo->get('core.create'))))
		{

			JToolBarHelper::apply('category.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('category.save', 'Save');
		}
		if (!$checkedOut && ($canDo->get('core.create'))){
			JToolBarHelper::custom('category.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		}
		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::custom('category.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
		}
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('category.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::cancel('category.cancel', 'JTOOLBAR_CLOSE');
		}

	}
}
