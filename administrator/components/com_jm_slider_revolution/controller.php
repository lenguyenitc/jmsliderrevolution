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

class Jm_slider_revolutionController extends RSliderController {

    /**
     * Method to display a view.
     *
     * @param	boolean			$cachable	If true, the view output will be cached
     * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
     *
     * @return	JController		This object to support chaining.
     * @since	1.5
     */
    public function display($cachable = false, $urlparams = false) {
        require_once JPATH_COMPONENT . '/helpers/jm_slider_revolution.php';
        $view = JFactory::getApplication()->input->getCmd('view', 'sliders');
        JFactory::getApplication()->input->set('view', $view);
		$document = JFactory::getDocument();
		if(Jm_slider_revolutionHelper::isJoomla3()){
			JHtml::_('jquery.framework');
		}else{
			$document->addScript('components/com_jm_slider_revolution/assets/js/jquery.min.js');
		}
		$document->addScript('components/com_jm_slider_revolution/assets/js/jquery-ui.js');
		$document->addStyleSheet('components/com_jm_slider_revolution/assets/css/jm_slider_revolution.css');
		$document->addStyleSheet('components/com_jm_slider_revolution/assets/css/codemirror.css');
		$document->addStyleSheet('components/com_jm_slider_revolution/assets/css/edit_layers.css');
		$document->addStyleSheet('components/com_jm_slider_revolution/assets/css/admin.css');
		$document->addStyleSheet('components/com_jm_slider_revolution/assets/css/jui/new/jquery-ui.css');
		$document->addStyleSheet('components/com_jm_slider_revolution/assets/css/tipsy.css');
		$document->addStyleSheet('components/com_jm_slider_revolution/rs-plugin/css/settings.css');
		$document->addStyleSheet('components/com_jm_slider_revolution/assets/js/farbtastic/farbtastic.css');
		$document->addScript('components/com_jm_slider_revolution/rs-plugin/js/jquery.themepunch.tools.min.js');
		$document->addScript('components/com_jm_slider_revolution/assets/js/farbtastic/farbtastic.js');
		$document->addScript('components/com_jm_slider_revolution/assets/js/codemirror.js');
		$document->addScript('components/com_jm_slider_revolution/assets/js/css_editor.js');
		$document->addScript('components/com_jm_slider_revolution/assets/js/css.js');
		$document->addScript('components/com_jm_slider_revolution/assets/js/ui.dropdownchecklist-1.4-min.js');
		$document->addScript('components/com_jm_slider_revolution/assets/js/admin.js');
		$document->addScript('components/com_jm_slider_revolution/assets/js/rev_admin.js');
		$document->addScript('components/com_jm_slider_revolution/assets/js/jquery.tipsy.js');
		$document->addScript('components/com_jm_slider_revolution/assets/js/settings.js');
		$document->addScript('components/com_jm_slider_revolution/assets/js/edit_layers.js');
        parent::display($cachable, $urlparams);
        return $this;
    }

}
?>