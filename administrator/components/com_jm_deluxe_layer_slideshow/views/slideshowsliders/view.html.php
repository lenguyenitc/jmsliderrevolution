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
 * View class for a list of Jm_deluxe_layer_slideshow.
 */
class Jm_deluxe_layer_slideshowViewSlideshowsliders extends JMasterViewDeluxeBaseJm {

    protected $items;
    protected $pagination;
    protected $state; 

    /**
     * Display the view
     */
    public function display($tpl = null) {
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->isJoomla3 = Jm_deluxe_layer_slideshowHelper::isJoomla3();
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        $this->addToolbar();

        $input = JFactory::getApplication()->input; 
        $view = $input->getCmd('view', '');
        Jm_deluxe_layer_slideshowHelper::addSubmenu($view);

        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @since	1.6
     */
    protected function addToolbar() {
        require_once JPATH_COMPONENT . '/helpers/jm_deluxe_layer_slideshow.php';

        $state = $this->get('State');
        $canDo = Jm_deluxe_layer_slideshowHelper::getActions($state->get('filter.category_id'));

        JToolBarHelper::title(JText::_('COM_JM_DELUXE_LAYER_SLIDESHOW_TITLE_SLIDESHOWSLIDERS'), 'slideshowsliders.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/slideshowslider';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
                JToolBarHelper::custom('slideshowslider.import','import','Import Sample Slider','Import Sample Slider',false);
            }
            if ($canDo->get('core.create')) {
                JToolBarHelper::addNew('slideshowslider.add', 'JTOOLBAR_NEW');
            }

            if ($canDo->get('core.edit') && isset($this->items[0])) {
                JToolBarHelper::editList('slideshowslider.edit', 'JTOOLBAR_EDIT');
            }
        }

        if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::custom('slideshowsliders.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('slideshowsliders.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'slideshowsliders.delete', 'JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::archiveList('slideshowsliders.archive', 'JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
                JToolBarHelper::custom('slideshowsliders.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
        }

        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
            if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
                JToolBarHelper::deleteList('', 'slideshowsliders.delete', 'JTOOLBAR_EMPTY_TRASH');
                JToolBarHelper::divider();
            } else if ($canDo->get('core.edit.state')) {
                JToolBarHelper::trash('slideshowsliders.trash', 'JTOOLBAR_TRASH');
                JToolBarHelper::divider();
            }
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_jm_deluxe_layer_slideshow');
        }
    }

}
