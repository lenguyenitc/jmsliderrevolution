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

jimport('joomla.application.component.view');

/**
 * View class for a list of Jm_slider_revolution.
 */
class Jm_slider_revolutionViewSliders extends RSliderView {

    protected $items;
    protected $pagination;
    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null) {
		?>
		<script type="text/javascript">
			var g_settingsObj = {};
			var root = "<?php echo JURI::root();?>";
		</script>
		<div id="divColorPicker" style="display:none;"></div>
		<div id="div_debug"></div>
		<div class='unite_error_message' id="error_message" style="display:none;"></div>

		<div class='unite_success_message' id="success_message" style="display:none;"></div>
		<?php
		$classes = new UniteFunctionsRev();
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }
        $input = JFactory::getApplication()->input;
        $view = $input->getCmd('view', '');

        parent::display($tpl);
    }
}
