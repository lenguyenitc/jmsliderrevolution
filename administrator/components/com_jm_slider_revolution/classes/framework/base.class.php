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
class UniteBaseClassRev{
	
	protected static $db;
	protected static $table_prefix;		
	protected static $mainFile;
	protected static $t;
	
	protected static $dir_plugin;
	protected static $dir_languages;
	public static $url_plugin;
	protected static $url_ajax;
	public static $url_ajax_actions;
	protected static $url_ajax_showimage;
	protected static $path_settings;
	public static $path_plugin;
	protected static $path_languages;		
	protected static $path_temp;
	protected static $path_views;
	protected static $path_templates;
	protected static $path_cache;
	protected static $path_base;	
	protected static $is_multisite;
	protected static $debugMode = false;
	
	/**
	 * 
	 * the constructor
	 */
	public function __construct(){
		$db = JFactory::getDbo();
		self::$path_plugin = JPATH_COMPONENT_ADMINISTRATOR.'/';
		
		self::$url_plugin = JURI::root().'administrator/components/com_jm_slider_revolution/';
		self::$db = $db;
		self::$table_prefix = "#__";
	}
	/**
	 * 
	 * get image url to be shown via thumb making script.
	 */
	public static function getImageUrl($filepath, $width=null,$height=null,$exact=false,$effect=null,$effect_param=null){
		
		$urlImage = UniteImageViewRev::getUrlThumb(self::$url_ajax_showimage, $filepath,$width ,$height ,$exact ,$effect ,$effect_param);
		
		return($urlImage);
	}
	
	
	/**
	 * 
	 * on show image ajax event. outputs image with parameters 
	 */
	public static function onShowImage(){
	
		$pathImages = UniteFunctionsWPRev::getPathContent();
		$urlImages = UniteFunctionsWPRev::getUrlContent();
		
		try{
			$imageView = new UniteImageViewRev(self::$path_cache,$pathImages,$urlImages);
			$imageView->showImageFromGet();
			
		}catch (Exception $e){
			header("status: 500");
			echo $e->getMessage();
			exit();
		}
	}
	
	
	/**
	 * 
	 * get POST var
	 */
	protected static function getPostVar($key,$defaultValue = ""){
		$val = self::getVar($_POST, $key, $defaultValue);
		return($val);			
	}
	
	/**
	 * 
	 * get GET var
	 */
	protected static function getGetVar($key,$defaultValue = ""){
		$val = self::getVar($_GET, $key, $defaultValue);
		return($val);
	}
	
	
	/**
	 * 
	 * get post or get variable
	 */
	protected static function getPostGetVar($key,$defaultValue = ""){
		
		if(array_key_exists($key, $_POST))
			$val = self::getVar($_POST, $key, $defaultValue);
		else
			$val = self::getVar($_GET, $key, $defaultValue);				
		
		return($val);							
	}
	
	
	/**
	 * 
	 * get some var from array
	 */
	protected static function getVar($arr,$key,$defaultValue = ""){
		$val = $defaultValue;
		if(isset($arr[$key])) $val = $arr[$key];
		return($val);
	} 
	
}

?>