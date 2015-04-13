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
 * View to edit
 */
class Jm_slider_revolutionViewSlide extends RSliderView {

    protected $state;
    protected $item;
    protected $form;

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
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }
        parent::display($tpl);
    }
}
