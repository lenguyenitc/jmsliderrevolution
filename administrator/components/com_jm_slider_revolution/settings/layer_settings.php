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
$operations = new RevOperations();
$UniteBaseAdminClassRev = new UniteBaseAdminClassRev();
$layerSettings = new UniteSettingsAdvancedRev();
$UniteSettingsRev = new UniteSettingsRev();
$UniteFunctionsRev = new UniteFunctionsRev();
$doc = JFactory::getDocument();
//set Layer settings
$contentCSS = $operations->getCaptionsContent();
?>
<style id="rs-plugin-captions-css" type="text/css">
	<?php echo $contentCSS; ?>
</style>
<?php
//$doc->addStyleDeclaration($contentCSS);
$arrAnimations = $operations->getArrAnimations();
$arrEndAnimations = $operations->getArrEndAnimations();

$htmlButtonDown = '<div id="layer_captions_down" style="width:30px; text-align:center;padding:0px;" class="revgray button-primary"><i class="eg-icon-down-dir"></i></div>';
$buttonEditStyles = $UniteFunctionsRev::getHtmlLink("javascript:void(0)", "<i class=\"revicon-magic\"></i>Edit Style","button_edit_css","button-primary revblue");
$buttonEditStylesGlobal = $UniteFunctionsRev::getHtmlLink("javascript:void(0)", "<i class=\"revicon-palette\"></i>Edit Global Style","button_edit_css_global","button-primary revblue");

$arrSplit = $operations->getArrSplit();
$arrEasing = $operations->getArrEasing();
$arrEndEasing = $operations->getArrEndEasing();

$captionsAddonHtml = $htmlButtonDown.$buttonEditStyles.$buttonEditStylesGlobal;

//set Layer settings
$layerSettings->addSection("Layer Params","layer_params");
$layerSettings->addSap("Layer Params","layer_params");
$layerSettings->addTextBox("layer_caption", "caption_green", "Style",array($UniteSettingsRev::PARAM_ADDTEXT=>$captionsAddonHtml,"class"=>"textbox-caption"));

$addHtmlTextarea = '';
if($sliderTemplate == "true"){
	$addHtmlTextarea .= $UniteFunctionsRev::getHtmlLink("javascript:void(0)", "Insert Meta","linkInsertTemplate","disabled revblue button-primary");
}
$addHtmlTextarea .= $UniteFunctionsRev::getHtmlLink("javascript:void(0)", "Insert Button","linkInsertButton","disabled revblue button-primary");

$layerSettings->addTextArea("layer_text", "","Text / Html",array("class"=>"area-layer-params",$UniteSettingsRev::PARAM_ADDTEXT_BEFORE_ELEMENT=>$addHtmlTextarea));
$layerSettings->addTextBox("layer_image_link", "","Image Link",array("class"=>"text-sidebar-link","hidden"=>true));
$layerSettings->addSelect("layer_link_open_in",array("same"=>"Same Window","new"=>"New Window"),"Link Open In","same",array("hidden"=>true));

$layerSettings->addSelect("layer_animation",$arrAnimations,"Start Animation","fade");
$layerSettings->addSelect("layer_easing", $arrEasing, "Start Easing","Power3.easeInOut");
$params = array("unit"=>"ms");
$paramssplit = array("unit"=>" ms (keep it low i.e. 1- 200)");
$layerSettings->addTextBox("layer_speed", "","Start Duration",$params);
$layerSettings->addTextBox("layer_splitdelay", "10","Split Delay",$paramssplit);
$layerSettings->addSelect("layer_split", $arrSplit, "Split Text per","none");
$layerSettings->addCheckbox("layer_hidden", false,"Hide Under Width");

$params = array("hidden"=>true);
$layerSettings->addTextBox("layer_link_id", "","Link ID",$params);
$layerSettings->addTextBox("layer_link_class", "","Link Classes",$params);
$layerSettings->addTextBox("layer_link_title", "","Link Title",$params);
$layerSettings->addTextBox("layer_link_rel", "","Link Rel",$params);

//scale for img
$textScaleX = "Width";
$textScaleProportionalX = "Width/Height";
$params = array("attrib_text"=>"data-textproportional='".$textScaleProportionalX."' data-textnormal='".$textScaleX."'", "hidden"=>false);
$layerSettings->addTextBox("layer_scaleX", "","Width",$params);
$layerSettings->addTextBox("layer_scaleY", "","Height",array("hidden"=>false));
$layerSettings->addCheckbox("layer_proportional_scale", false,"Scale Proportional",array("hidden"=>false));

$arrParallaxLevel = array(
						'-' => 'No Movement',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						);
$layerSettings->addSelect("parallax_level", $arrParallaxLevel, "Level","nowrap", array("hidden"=>false));


//put left top
$textOffsetX = "OffsetX";
$textX = "X";
$params = array("attrib_text"=>"data-textoffset='".$textOffsetX."' data-textnormal='".$textX."'");
$layerSettings->addTextBox("layer_left", "","X",$params);

$textOffsetY = "OffsetY";
$textY = "Y";
$params = array("attrib_text"=>"data-textoffset='".$textOffsetY."' data-textnormal='".$textY."'");
$layerSettings->addTextBox("layer_top", "","Y",$params);

$layerSettings->addTextBox("layer_align_hor", "left","Hor Align",array("hidden"=>true));
$layerSettings->addTextBox("layer_align_vert", "top","Vert Align",array("hidden"=>true));

$para = array("unit"=>"&nbsp;(example: 50px, 50%, auto)", 'hidden'=>true);
$layerSettings->addTextBox("layer_max_width", "auto","Max Width",$para);
$layerSettings->addTextBox("layer_max_height", "auto","Max Height",$para);

$layerSettings->addTextBox("layer_2d_rotation", "0","2D Rotation",array("hidden"=>false, 'unit'=>'&nbsp;(-360 - 360)'));
$layerSettings->addTextBox("layer_2d_origin_x", "50","Rotation Origin X",array("hidden"=>false, 'unit'=>'%&nbsp;(-100 - 200)'));
$layerSettings->addTextBox("layer_2d_origin_y", "50","Rotation Origin Y",array("hidden"=>false, 'unit'=>'%&nbsp;(-100 - 200)'));

//advanced params
$arrWhiteSpace = array("normal"=>"Normal",
					"pre"=>"Pre",
					"nowrap"=>"No-wrap",
					"pre-wrap"=>"Pre-Wrap",
					"pre-line"=>"Pre-Line");


$layerSettings->addSelect("layer_whitespace", $arrWhiteSpace, "White Space","nowrap", array("hidden"=>true));

$arrSlideNames = array();
if(isset($slider) && $slider->isInited())
	$arrSlideNames = $slider->getArrSlideNames();
//num_slide_link
$arrSlideLink = array();
$arrSlideLink["nothing"] = "-- Not Chosen --";
$arrSlideLink["next"] = "-- Next Slide --";
$arrSlideLink["prev"] = "-- Previous Slide --";

$arrSlideLinkLayers = $arrSlideLink;
$arrSlideLinkLayers["scroll_under"] = "-- Scroll Below Slider --";

foreach($arrSlideNames as $slideNameID=>$arr){
	$slideName = $arr["title"];
	$arrSlideLink[$slideNameID] = $slideName;
	$arrSlideLinkLayers[$slideNameID] = $slideName;
}
$layerSettings->addSelect("layer_slide_link", $arrSlideLinkLayers, "Link To Slide","nothing");

$params = array("unit"=>"px","hidden"=>true);
$layerSettings->addTextBox("layer_scrolloffset", "0","Scroll Under Slider Offset",$params);

$layerSettings->addButton("button_change_image_source", "Change Image Source",array("hidden"=>true,"class"=>"button-primary revblue"));
$layerSettings->addTextBox("layer_alt", "","Alt Text",array("hidden"=>true, "class"=>"area-alt-params"));
$layerSettings->addButton("button_edit_video", "Edit Video",array("hidden"=>true,"class"=>"button-primary revblue"));



$params = array("unit"=>"ms");
$paramssplit = array("unit"=>" ms (keep it low i.e. 1- 200)");
$params_1 = array("unit"=>"ms", 'hidden'=>true);
$layerSettings->addTextBox("layer_endtime", "","End Time",$params_1);
$layerSettings->addTextBox("layer_endspeed", "","End Duration",$params);
$layerSettings->addTextBox("layer_endsplitdelay", "10","End Split Delay",$paramssplit);
$layerSettings->addSelect("layer_endsplit", $arrSplit, "Split Text per","none");
$layerSettings->addSelect("layer_endanimation",$arrEndAnimations,"End Animation","auto");
$layerSettings->addSelect("layer_endeasing", $arrEndEasing, "End Easing","nothing");
$params = array("unit"=>"ms");

//advanced params
$arrCorners = array("nothing"=>"No Corner",
					"curved"=>"Sharp",
					"reverced"=>"Sharp Reversed");
$params = array();
$layerSettings->addSelect("layer_cornerleft", $arrCorners, "Left Corner","nothing",$params);
$layerSettings->addSelect("layer_cornerright", $arrCorners, "Right Corner","nothing",$params);
$layerSettings->addCheckbox("layer_resizeme", true,"Responsive Through All Levels",$params);

$params = array();
$layerSettings->addTextBox("layer_id", "","ID",$params);
$layerSettings->addTextBox("layer_classes", "","Classes",$params);
$layerSettings->addTextBox("layer_title", "","Title",$params);
$layerSettings->addTextBox("layer_rel", "","Rel",$params);

//Loop Animation
$arrAnims = array("none"=>"Disabled",
					"rs-pendulum"=>"Pendulum",
					"rs-slideloop"=>"Slideloop",
					"rs-pulse"=>"Pulse",
					"rs-wave"=>"Wave"
					);

$params = array();
$layerSettings->addSelect("layer_loop_animation", $arrAnims, "Animation","none",$params);
$layerSettings->addTextBox("layer_loop_speed", "2","Speed",array("unit"=>"&nbsp;(0.00 - 10.00)"));
$layerSettings->addTextBox("layer_loop_startdeg", "-20","Start Degree");
$layerSettings->addTextBox("layer_loop_enddeg", "20","End Degree",array("unit"=>"&nbsp;(-720 - 720)"));
$layerSettings->addTextBox("layer_loop_xorigin", "50","x Origin",array("unit"=>"%"));
$layerSettings->addTextBox("layer_loop_yorigin", "50","y Origin",array("unit"=>"% (-250% - 250%)"));
$layerSettings->addTextBox("layer_loop_xstart", "0","x Start Pos.",array("unit"=>"px"));
$layerSettings->addTextBox("layer_loop_xend", "0","x End Pos.",array("unit"=>"px (-2000px - 2000px)"));
$layerSettings->addTextBox("layer_loop_ystart", "0","y Start Pos.",array("unit"=>"px"));
$layerSettings->addTextBox("layer_loop_yend", "0","y End Pos.",array("unit"=>"px (-2000px - 2000px)"));
$layerSettings->addTextBox("layer_loop_zoomstart", "1","Start Zoom");
$layerSettings->addTextBox("layer_loop_zoomend", "1","End Zoom",array("unit"=>"&nbsp;(0.00 - 20.00)"));
$layerSettings->addTextBox("layer_loop_angle", "0","Angle",array("unit"=>"° (0° - 360°)"));
$layerSettings->addTextBox("layer_loop_radius", "10","Radius",array("unit"=>"px (0px - 2000px)"));
$layerSettings->addSelect("layer_loop_easing", $arrEasing, "Easing","Power3.easeInOut");

$UniteBaseAdminClassRev::storeSettings("layer_settings",$layerSettings);

//store settings of content css for editing on the client.
$UniteBaseAdminClassRev::storeSettings("css_captions_content",$contentCSS);

?>