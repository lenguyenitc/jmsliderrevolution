<?php
/**
 * @version     1.0.0
 * @package     com_jm_slider_revolution
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      JoomlaMan <support@joomlaman.com> - http://JoomlaMan.com
 */

// No direct access. 
defined('_JEXEC') or die;
?>
<div id="dialog_preview_sliders" class="dialog_preview_sliders" title="Preview Slider" style="display:none;">
	<iframe id="frame_preview_slider" name="frame_preview_slider" style="width: 100%;"></iframe>
</div>

<form id="form_preview" name="form_preview" action="<?php echo JUri::root().'administrator/index.php?option=com_jm_slider_revolution&view=slider&format=slider';?>" target="frame_preview_slider" method="post">
	<input type="hidden" name="action" value="preview_slider">
	<input type="hidden" id="preview_sliderid" name="sliderid" value="">
	<input type="hidden" id="preview_slider_markup" name="only_markup" value="">
</form>
