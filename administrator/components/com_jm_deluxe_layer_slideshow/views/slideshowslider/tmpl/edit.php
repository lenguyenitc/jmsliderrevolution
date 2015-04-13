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
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
// Import CSS
$document = JFactory::getDocument();
if ($this->isJoomla3) {
    $document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/jmparallax_slideshow_j3.css');
} else {
    $document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/jmparallax_slideshow.css');
}
?>
<script type="text/javascript">
    function getScript(url, success) {
        var script = document.createElement('script');
        script.src = url;
        var head = document.getElementsByTagName('head')[0],
                done = false;
        // Attach handlers for all browsers
        script.onload = script.onreadystatechange = function() {
            if (!done && (!this.readyState
                    || this.readyState == 'loaded'
                    || this.readyState == 'complete')) {
                done = true;
                success();
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
            }
        };
        head.appendChild(script);
    }
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
        js = jQuery.noConflict();
        js(document).ready(function() {
            Joomla.submitbutton = function(task)
            {
                if (task == 'slideshowslider.cancel') {
                    Joomla.submitform(task, document.getElementById('slideshowslider-form'));
                }
                else {

                    if (task != 'slideshowslider.cancel' && document.formvalidator.isValid(document.id('slideshowslider-form'))) {

                        Joomla.submitform(task, document.getElementById('slideshowslider-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }
        });
    });
</script>
<form action="<?php echo JRoute::_('index.php?option=com_jm_deluxe_layer_slideshow&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="slideshowslider-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_JM_DELUXE_LAYER_SLIDESHOW_LEGEND_SLIDESHOWSLIDER'); ?></legend>
            <ul class="adminformlist">
                <li><?php echo $this->form->getLabel('id'); ?>
                    <?php echo $this->form->getInput('id'); ?></li>
                <li><?php echo $this->form->getLabel('state'); ?>
                    <?php echo $this->form->getInput('state'); ?></li>
                <li><?php echo $this->form->getLabel('created_by'); ?>
                    <?php echo $this->form->getInput('created_by'); ?></li>
                <li><?php echo $this->form->getLabel('title'); ?>
                    <?php echo $this->form->getInput('title'); ?></li>
                <input type="hidden" name="jform[data]" value="<?php echo $this->item->data; ?>" />
            </ul>
        </fieldset>
    </div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>

    <style type="text/css">
        /* Temporary fix for drifting editor fields */
        .adminformlist li {
            clear: both;
        }
    </style>
</form>
<div class="copyright">
	<?php echo "Develop by JoomlaMan 2013 <a href='http://joomlaman.com' target='_blank'>joomlaman.com</a>";?>
</div>
