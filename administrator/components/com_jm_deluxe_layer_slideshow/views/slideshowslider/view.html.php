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
class Jm_deluxe_layer_slideshowViewSlideshowslider extends JMasterViewDeluxeBaseJm {

    protected $state;
    protected $item;
    protected $form;

    /**
     * Display the view
     */
    public function display($tpl = null) {
        $this->state = $this->get('State');
        $this->item = $this->get('Item');
        $this->form = $this->get('Form');
        $this->isJoomla3 = Jm_deluxe_layer_slideshowHelper::isJoomla3();
        $this->initString  = Jm_deluxe_layer_slideshowHelper::initString ();
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        $this->addToolbar();
        require_once JPATH_COMPONENT . '/helpers/jm_deluxe_layer_slideshow.php';
        $input = JFactory::getApplication()->input;
        $view = $input->getCmd('view', '');
        $id = JRequest::getVar('id');
		if(!$this->isJoomla3){
			Jm_deluxe_layer_slideshowHelper::addSubmenuDetail($view, $id);
		}
        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     */
    protected function addToolbar() {
        //JFactory::getApplication()->input->set('hidemainmenu', true);
        $user = JFactory::getUser();
        $isNew = ($this->item->id == 0);
        if (isset($this->item->checked_out)) {
            $checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
        } else {
            $checkedOut = false;
        }
        $canDo = Jm_deluxe_layer_slideshowHelper::getActions();
        $layout = JRequest::getVar('layout');
        JToolBarHelper::title(JText::_('JM Deluxe Layer Slideshow'), 'slideshowslider.png');

        // If not checked out, can save the item.
        if ($layout == 'edit') {
            if (!$checkedOut && ($canDo->get('core.edit') || ($canDo->get('core.create')))) {

                JToolBarHelper::apply('slideshowslider.apply', 'JTOOLBAR_APPLY');
                JToolBarHelper::save('slideshowslider.save', 'Save & Close');
            }
            if (!$checkedOut && ($canDo->get('core.create'))) {
                JToolBarHelper::custom('slideshowslider.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
            }
            // If an existing item, can save to a copy.
            if (!$isNew && $canDo->get('core.create')) {
                JToolBarHelper::custom('slideshowslider.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
            }
            if (empty($this->item->id)) {
                JToolBarHelper::cancel('slideshowslider.cancel', 'JTOOLBAR_CANCEL');
            } else {
                JToolBarHelper::cancel('slideshowslider.cancel', 'JTOOLBAR_CLOSE');
            }
        } else {

            if (!$checkedOut && ($canDo->get('core.edit') || ($canDo->get('core.create')))) {
                JToolBarHelper::save('slideshowslider.save', 'Save');
            }
            if (empty($this->item->id)) {
                JToolBarHelper::cancel('slideshowslider.cancel', 'JTOOLBAR_CANCEL');
            } else {
                JToolBarHelper::cancel('slideshowslider.cancel', 'JTOOLBAR_CLOSE');
            }
        } 
    }

}
