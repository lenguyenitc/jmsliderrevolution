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

//set Slide settings
$operations = new RevOperations();
$UniteBaseAdminClassRev = new UniteBaseAdminClassRev();
$arrTransitions = $operations->getArrTransition();
$arrPremiumTransitions = $operations->getArrTransition(true);
$defaultTransition = $operations->getDefaultTransition();

$arrSlideNames = array();
if(isset($slider) && $slider->isInited())
	$arrSlideNames = $slider->getArrSlideNames();

$slideSettings = new UniteSettingsAdvancedRev();

//title
$params = array("description"=>"The title of the slide, will be shown in the slides list.","class"=>"medium");
$slideSettings->addTextBox("title","Slide","Slide Title", $params);

//state
$params = array("description"=>"The state of the slide. The unpublished slide will be excluded from the slider.");
$slideSettings->addSelect("state",array("published"=>"Published","unpublished"=>"Unpublished"),"State","published",$params);

$params = array("description"=>"If set, slide will be visible after the date is reached");
$slideSettings->addDatePicker("date_from","","Visible from", $params);

$params = array("description"=>"If set, slide will be visible till the date is reached");
$slideSettings->addDatePicker("date_to","","Visible until", $params);

$slideSettings->addHr("");

//transition
$params = array("description"=>"The appearance transitions of this slide.","minwidth"=>"250px");
$slideSettings->addChecklist("slide_transition",$arrTransitions,"Transitions",$defaultTransition,$params);

//slot amount
$params = array("description"=>"The number of slots or boxes the slide is divided into. If you use boxfade, over 7 slots can be juggy."
	,"class"=>"small","datatype"=>"number"
);
$slideSettings->addTextBox("slot_amount","7","Slot Amount", $params);

//rotation:
$params = array("description"=>"Rotation (-720 -> 720, 999 = random) Only for Simple Transitions."
	,"class"=>"small","datatype"=>"number"
);
$slideSettings->addTextBox("transition_rotation","0","Rotation", $params);

//transition speed
$params = array("description"=>"The duration of the transition (Default:300, min: 100 max 2000). "
	,"class"=>"small","datatype"=>"number"
);
$slideSettings->addTextBox("transition_duration","300","Transition Duration", $params);


if(!isset($sliderDelay))
	$sliderDelay = 0;

//delay
$params = array("description"=>"A new delay value for the Slide. If no delay defined per slide, the delay defined via Options (". $sliderDelay ."ms) will be used"
	,"class"=>"small","datatype"=>UniteSettingsRev::DATATYPE_NUMBEROREMTY
);
$slideSettings->addTextBox("delay","","Delay", $params);

$params = array("description"=>""
	,"class"=>"small"
);
$slideSettings->addRadio("save_performance", array("on"=>"On","off"=>"Off"), "Save Performance","off", $params);

$slideSettings->addHr("");

//-----------------------

//enable link
$slideSettings->addSelect_boolean("enable_link", "Enable Link", false, "Enable","Disable");

$slideSettings->startBulkControl("enable_link", UniteSettingsRev::CONTROL_TYPE_SHOW, "true");

	//link type
	$slideSettings->addRadio("link_type", array("regular"=>"Regular","slide"=>"To Slide"), "Link Type","regular");

	//link
	$params = array('id'=>'rev_link', "description"=>"A link on the whole slide pic (use %link% or %meta:somemegatag% in template sliders to link to a post or some other meta)");
	$slideSettings->addTextBox("link","","Slide Link", $params);

	//link target
	$params = array("description"=>"The target of the slide link");
	$slideSettings->addSelect("link_open_in",array("same"=>"Same Window","new"=>"New Window"),"Link Open In","same",$params);

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

	$slideSettings->addSelect("slide_link", $arrSlideLink, "Link To Slide","nothing");

	$params = array("description"=>"The position of the link related to layers");
	$slideSettings->addRadio("link_pos", array("front"=>"Front","back"=>"Back"), "Link Position","front",$params);

	//$slideSettings->addHr("link_sap");

$slideSettings->endBulkControl();

	$slideSettings->addControl("link_type", "slide_link", UniteSettingsRev::CONTROL_TYPE_ENABLE, "slide");
	$slideSettings->addControl("link_type", "link", UniteSettingsRev::CONTROL_TYPE_DISABLE, "slide");
	$slideSettings->addControl("link_type", "link_open_in", UniteSettingsRev::CONTROL_TYPE_DISABLE, "slide");

//-----------------------

$slideSettings->addHr("");

$params = array("description"=>"Slide Thumbnail. If not set - it will be taken from the slide image.");
$slideSettings->addImage("slide_thumb", "","Thumbnail" , $params);

//$params = array("description"=>"Apply to full width mode only. Centering vertically slide images.");
//$slideSettings->addCheckbox("fullwidth_centering", false, "Full Width Centering", $params);


//add background type (hidden)
$slideSettings->addTextBox("background_type","image","Background Type", array("hidden"=>true));
//store settings

$slideSettings->addHr("");

$params = array("description"=>'Adds a unique class to the li of the Slide like class="rev_special_class" (add only the classnames, seperated by space)');
$slideSettings->addTextBox("class_attr","","Class", $params);

$params = array("description"=>'Adds a unique ID to the li of the Slide like id="rev_special_id" (add only the id)');
$slideSettings->addTextBox("id_attr","","ID", $params);

$params = array("description"=>'Adds a unique Attribute to the li of the Slide like attr="rev_special_attr" (add only the attribute)');
$slideSettings->addTextBox("attr_attr","","Attribute", $params);

$params = array("description"=>'Add as many attributes as you wish here. (i.e.: data-layer="firstlayer" data-custom="somevalue")');
$slideSettings->addTextArea("data_attr","","Custom Fields", $params);

$UniteBaseAdminClassRev::storeSettings("slide_settings",$slideSettings);

?>
