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
<div id="dialog_preview" class="dialog_preview" title="Preview Slide" style="display:none;">
	<iframe id="frame_preview" name="frame_preview" style="<?php echo $iframeStyle?>"></iframe>
</div>

<form id="form_preview_slide" name="form_preview_slide" action="<?php echo JUri::root().'administrator/index.php?option=com_jm_slider_revolution&view=slider&format=slider';?>" target="frame_preview" method="post">
	<input type="hidden" name="action" value="preview_slide">
	<input type="hidden" name="data" value="" id="preview_slide_data">
</form>
