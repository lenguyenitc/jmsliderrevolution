<?php
/**
 * @version     1.3.2
 * @package     com_jm_deluxe_layer_slideshow
 * @copyright   Copyright (C) 2013 - joomlaman.com.
 * @license     http://www.gnu.org/copyleft/lgpl.html
 * @author      JoomlaMan <support@joomlaman.com> - http://joomlaman.com
 */
// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.modeladmin');
/**
 * Jm_deluxe_layer_slideshow model.
 */
class Jm_deluxe_layer_slideshowModelslideshowslider extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_JM_DELUXE_LAYER_SLIDESHOW';
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Slideshowslider', $prefix = 'Jm_deluxe_layer_slideshowTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function save($data) {
		$table = $this->getTable();
		if ($table->save($data) === true) {
			return $table->id;
		} else {
			return false;
		}
	}
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();
		// Get the form.
		$form = $this->loadForm('com_jm_deluxe_layer_slideshow.slideshowslider', 'slideshowslider', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	
	protected function loadForm($name, $source = null, $options = array(), $clear = false, $xpath = false)
	{	
		// Handle the optional arguments.
		$options['control'] = JArrayHelper::getValue($options, 'control', false);
	
		// Create a signature hash.
		$hash = md5($source . serialize($options));
		// Check if we can use a previously loaded form.
		if (isset($this->_forms[$hash]) && !$clear)
		{
			return $this->_forms[$hash];
		}
		// Get the form.
		JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
		JForm::addFieldPath(JPATH_COMPONENT . '/models/fields');
		
		try
		{
			$form = JForm::getInstance($name, $source, $options, false, $xpath);
			
			if (isset($options['load_data']) && $options['load_data'])
			{
				// Get the data for the form.
				$data = $this->loadFormData();
			}
			else
			{
				$data = array();
			}
			// Allow for additional modification of the form, and events to be triggered.
			// We pass the data because plugins may require it.
			/*$this->preprocessForm($form, $data); */
			// Load the data into the form after the plugins have operated.
			$form->bind($data);
		}
		catch (Exception $e)
		{
			$this->setError($e->getMessage());
			return false;
		}
		// Store the form for later.
		$this->_forms[$hash] = $form;
		return $form;
	}
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_jm_deluxe_layer_slideshow.edit.slideshowslider.data', array());
		if (empty($data)) {
			$data = $this->getItem();
            
		}
		return $data;
	}
	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk)) {
			//Do any procesing on fields here if needed
		}
		return $item;
	}
	function getEasing($selected=null){ 
		$easing = "	easeOutBack, easeInQuad, easeOutQuad, easeInOutQuad, easeInCubic, easeOutCubic,
		easeInOutCubic, easeInQuart, easeOutQuart, easeInOutQuart, easeInQuint,
		easeOutQuint, easeInOutQuint, easeInSine, easeOutSine, easeInOutSine,
		easeInExpo, easeOutExpo, easeInOutExpo, easeInCirc, easeOutCirc, easeInOutCirc,
		easeInElastic, easeOutElastic, easeInOutElastic, easeInBack, easeOutBack, easeInOutBack,
		easeInBounce, easeOutBounce, easeInOutBounce, Linear.easeNone Power0.easeIn, Power0.easeInOut, Power0.easeOut, Power1.easeIn, Power1.easeInOut, Power1.easeOut, Power2.easeIn, Power2.easeInOut, Power2.easeOut, Power3.easeIn, Power3.easeInOut, Power3.easeOut, Power4.easeIn, Power4.easeInOut, Power4.easeOut, Quad.easeIn, Quad.easeInOut, Quad.easeOut, Cubic.easeIn, Cubic.easeInOut, Cubic.easeOut, Quart.easeIn, Quart.easeInOut, Quart.easeOut, Quint.easeIn, Quint.easeInOut, Quint.easeOut, Strong.easeIn, Strong.easeInOut, Strong.easeOut, Back.easeIn, Back.easeInOut, Back.easeOut, Bounce.easeIn, Bounce.easeInOut, Bounce.easeOut, Circ.easeIn, Circ.easeInOut, Circ.easeOut, Elastic.easeIn, Elastic.easeInOut, Elastic.easeOut, Expo.easeIn, Expo.easeInOut, Expo.easeOut, Sine.easeIn, Sine.easeInOut, Sine.easeOut, SlowMo.ease";
		$rows = explode(',', $easing);
		$option = null;
		foreach($rows as $i=>$row){
			$row = trim($row);
			if($row==$selected){
				$option .='<option selected="selected" value="'.$row.'">'.$row.'</option>';
			}else{
				$option .='<option value="'.$row.'">'.$row.'</option>';
			}
		}
		return $option; 
	}
	
	function getEffect($selected=null){
		$effect = "Slide To Top - slideup,
		Slide To Bottom - slidedown,
		Slide To Right - slideright,
		Slide To Left - slideleft,
		Slide Horizontal (depending on Next/Previous) - slidehorizontal,
		Slide Vertical (depending on Next/Previous) - slidevertical,
		Slide Boxes - boxslide,
		Slide Slots Horizontal - slotslide-horizontal,
		Slide Slots Vertical - slotslide-vertical,
		Fade Boxes - boxfade,
		Fade Slots Horizontal - slotfade-horizontal,
		Fade Slots Vertical - slotfade-vertical,
		Fade and Slide from Right - fadefromright,
		Fade and Slide from Left - fadefromleft,
		Fade and Slide from Top - fadefromtop,
		Fade and Slide from Bottom - fadefrombottom,
		Fade To Left and Fade From Right - fadetoleftfadefromright,
		Fade To Right and Fade From Left - fadetorightfadefromleft,
		Fade To Top and Fade From Bottom - fadetotopfadefrombottom,
		Fade To Bottom and Fade From Top - fadetobottomfadefromtop,
		Parallax to Right - parallaxtoright,
		Parallax to Left - parallaxtoleft,
		Parallax to Top - parallaxtotop,
		Parallax to Bottom - parallaxtobottom,
		Zoom Out and Fade From Right - scaledownfromright,
		Zoom Out and Fade From Left - scaledownfromleft,
		Zoom Out and Fade From Top - scaledownfromtop,
		Zoom Out and Fade From Bottom - scaledownfrombottom,
		ZoomOut - zoomout,
		ZoomIn - zoomin,
		Zoom Slots Horizontal - slotzoom-horizontal,
		Zoom Slots Vertical - slotzoom-vertical,
		Fade - fade,
		Random Flat - random-static,
		Random Flat and Premium - random,
		Curtain from Left - curtain-1,
		Curtain from Right - curtain-2,
		Curtain from Middle - curtain-3,
		3D Curtain Horizontal - 3dcurtain-horizontal,
		3D Curtain Vertical - 3dcurtain-vertical,
		Cube Vertical - cube,
		Cube Horizontal - cube-horizontal,
		In Cube Vertical - incube,
		In Cube Horizontal - incube-horizontal,
		TurnOff Horizontal - turnoff,
		TurnOff Vertical - turnoff-vertical,
		Paper Cut - papercut,
		Fly In - flyin,
		Random Premium - random-premium,
		Random Flat and Premium - random
		";
		$effs= array();
		$effs_a = explode(',',$effect);
		foreach($effs_a as $effs_b){
			$effs_c = explode('-',$effs_b);
			$effs[trim($effs_c[1])] = trim($effs_c[0]);
		}
        $option = '';
		foreach($effs as $k=>$eff){
			if($k==$selected){
				$option .='<option selected="selected" value="'.$k.'">'.$eff.'</option>';
			}else{
				$option .='<option value="'.$k.'">'.$eff.'</option>';
			}
		}
		return $option;
	}
        
        function getSelectStyle($selected=null){
            $values = array(
                'Large_White_Text_Left',
                'Large_White_Text_Right',
                'Large_White_Text_Centered',
                'Large_Black_Text_Left',
                'Large_Black_Text_Right',
                'Large_Black_Text_Centered',
                'Medium_White_Text_Left',
                'Medium_White_Text_Right',
                'Medium_White_Text_Centered',
                'Medium_Black_Text_Left',
                'Medium_Black_Text_Right',
                'Medium_Black_Text_Centered',
                'Small_White_Text_Left',
                'Small_White_Text_Right',
                'Small_White_Text_Centered',
                'Small_Black_Text_Left',
                'Small_Black_Text_Right',
                'Small_Black_Text_Centered',
                'Medium_White_Text_Left_Background',
                'Medium_Black_Text_Left_Background',
                'Medium_Orange_Text_Left',
                'Medium_Red_Text_Left',
                'Medium_Green_Text_Left',
                'Medium_Blue_Text_Left',
                );
            $option = '';
            $option .= '<option value="">Select style</option>';
            foreach($values as $i=>$row){
                    if($row==$selected){
                            $option .='<option selected="selected" value="'.$row.'">'.$row.'</option>';
                    }else{
                            $option .='<option value="'.$row.'">'.$row.'</option>';
                    }
            }
            return $option;
        }
        
	function getIncoming($selected=null){
		$incoming = "sft - Short from Top, sfb - Short from Bottom, sfr - Short from Right, sfl - Short from Left, lft - Long from Top, lfb - Long from Bottom, lfr - Long from Right, lfl - Long from Left, skewfromleft - Skew from Left, skewfromright - Skew from Right, skewfromleftshort - Skew Short from Left, skewfromrightshort - Skew Short from Right, fade - fading, randomrotate - randomrotate";
		$incomings = explode(',',$incoming);
		$option = null;
		foreach($incomings as $i=>$incoming){
			if(trim($incoming)==$selected){
				$option .='<option selected="selected" value="'.trim($incoming) .'">'.trim($incoming) .'</option>';
			}else{
				$option .='<option value="'.trim($incoming).'">'.trim($incoming).'</option>';
			}
		}
		return $option;
	}
        
	function getOutgoing($selected=null){
		$outcoming = " stt - Short to Top, stb - Short to Bottom, str - Short to Right, stl - Short to Left, ltt - Long to Top, ltb - Long to Bottom, ltr - Long to Right, ltl - Long to Left, skewtoleft - Skew to Left, skewtoright - Skew to Right, skewtoleftshort - Skew Short to Left,
		skewtorightshort - Skew Short to Right, fadeout - fading, randomrotateout - randomrotateout";
		$outcomings = explode(',',$outcoming);
		$option = '';
		foreach($outcomings as $i=>$outcoming){
			if(trim($outcoming)==$selected){
				$option .='<option selected="selected" value="'.trim($outcoming).'">'.trim($outcoming).'</option>';
			}else{
				$option .='<option value="'.trim($outcoming).'">'.trim($outcoming).'</option>';
			}
		}
		return $option;
	}
              
	function getTarget($selected=null){
		$rows = array('_blank','_self');
		$option = null;
		foreach($rows as $i=>$row){
			if($row==$selected){
				$option .='<option selected="selected" value="'.$row.'">'.$row.'</option>';
			}else{
				$option .='<option value="'.$row.'">'.$row.'</option>';
			}
		}
		return $option;
	}
	function getTypeVideo($selected=null){
		$rows = array('youtube'=>'Youtube','vimeo'=>'Vimeo','html5'=>'HTML5');
		$option = null;
		foreach($rows as $i=>$row){
			if($i==$selected){
				$option .='<option selected="selected" value="'.$i.'">'.$row.'</option>';
			}else{
				$option .='<option value="'.$i.'">'.$row.'</option>';
			}
		}
		return $option;
	}
	function getAutoPlay($selected=null){
		$rows = array('true'=>'True','false'=>'False');
		$option = null;
		foreach($rows as $i=>$row){
			if($i==$selected){
				$option .='<option selected="selected" value="'.$i.'">'.$row.'</option>';
			}else{
				$option .='<option value="'.$i.'">'.$row.'</option>';
			}
		}
		return $option;
	}
	function getBgfit($selected=null){
		$rows = array('cover','contain');
		$option = null;
		foreach($rows as $i=>$row){
			if($row==$selected){
				$option .='<option selected="selected" value="'.$row.'">'.$row.'</option>';
			}else{
				$option .='<option value="'.$row.'">'.$row.'</option>';
			}
		}
		return $option;
	}
	function getCaptionhidden($selected=null){
		$rows = array(0=>'Off',1=>'On');
		$option = null;
		foreach($rows as $i=>$row){
			if($i==$selected){
				$option .='<option selected="selected" value="'.$i.'">'.$row.'</option>';
			}else{
				$option .='<option value="'.$i.'">'.$row.'</option>';
			}
		}
		return $option;
	}
        
	function getDataURI($image, $mime = '') {    
        $info = pathinfo(JPATH_SITE.DS.$image);
		return 'data: image/'.$info['extension'].';base64,'.base64_encode(file_get_contents(JPATH_SITE.DS.$image));
	}
	
	function removeNewLine($value)
	{
		$string = preg_replace('@[\s]{2,}@',' ',$value);
		return trim(str_replace(array("/\n|\r/","\""),array("", "'"), $string));
	}
}