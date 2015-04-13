<?php
/**
 * @version     1.0.0
 * @package     com_jm_slider_revolution
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      JoomlaMan <support@joomlaman.com> - http://JoomlaMan.com
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHTML::_('script', 'system/multiselect.js', false, true);
JHTML::_('behavior.modal');
// Import CSS
$document = JFactory::getDocument();
?>
<script type="text/javascript">
function jInsertFieldValue(value, id) {
	var $ = jQuery.noConflict();
	var sliderid = $('#sliderid').val();
	var url = "<?php echo JURI::root();?>"+value;
	var data = {sliderid:sliderid,obj:url};
	UniteAdminRev.ajaxRequest("add_slide" ,data);
	if($("#" + id).length>0){
		var old_value = $("#" + id).val();
		if (old_value != value) {
			var $elem = $("#" + id);
			$elem.val(value);
			$elem.trigger("change");
			if (typeof($elem.get(0).onchange) === "function") {
				$elem.get(0).onchange();
			}
		}
	}
}
</script>
<?php
//get input
$sliderID = JRequest::getVar("id");
$operations = new RevOperations();
$UniteFunctionsRev = new UniteFunctionsRev();

if(empty($sliderID))
	$UniteFunctionsRev::throwError("Slider ID not found"); 

$slider = new RevSlider();
$slider->initByID($sliderID);
$sliderParams = $slider->getParams();

$arrSliders = $slider->getArrSlidersShort($sliderID);
$selectSliders = $UniteFunctionsRev::getHTMLSelect($arrSliders,"","id='selectSliders'",true);

$numSliders = count($arrSliders);

//set iframe parameters	
$width = $sliderParams["width"];
$height = $sliderParams["height"];

$iframeWidth = $width+60;
$iframeHeight = $height+50;

$iframeStyle = "width:".$iframeWidth."px;height:".$iframeHeight."px;";

$arrSlides = $slider->getSlides(false);

$numSlides = count($arrSlides);

$linksSliderSettings = $UniteFunctionsRev::getViewUrl($sliderID,'edit','slider');

$patternViewSlide = $UniteFunctionsRev::getViewUrl($sliderID,'edit');		

//treat in case of slides from gallery
$templateName = "slides_gallery";
require ($templateName.'.php');
	
?>
	
	
