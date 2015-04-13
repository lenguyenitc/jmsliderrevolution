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

	/**
	 * 
	 * get / update params in db
	 *
	 */
class RevSliderParams extends UniteElementsBaseRev{
	
	
	/**
	 * 
	 * update settign in db
	 */		
	public function updateFieldInDB($name,$value){
		$GlobalsRevSlider = new GlobalsRevSlider();
		$arr = $this->db->fetch($GlobalsRevSlider::$table_settings);
		if(empty($arr)){	//insert to db
			$arrInsert = array();
			$arrInsert["general"] = "";
			$arrInsert["params"] = "";
			$arrInsert[$name] = $value;
			
			$this->db->insert($GlobalsRevSlider::$table_settings,$arrInsert);
		}else{	//update db
			$arrUpdate = array();
			$arrUpdate[$name] = $value;
			
			$id = $arr[0]["id"];
			$this->db->update($GlobalsRevSlider::$table_settings,$arrUpdate,array("id"=>$id));
		}
	}
	
	
	/**
	 * 
	 * get field from db
	 */
	public function getFieldFromDB($name){
		$GlobalsRevSlider = new GlobalsRevSlider();
		$arr = $this->db->fetch($GlobalsRevSlider::$table_settings);
					
		if(empty($arr))
			return("");
			
		
		$arr = $arr[0];
		
		if(array_key_exists($name, $arr) == false)
			UniteFunctionsRev::throwError("The settings db should cotnain field: $name");
		
		$value = $arr[$name];
		return($value);
	}
	
	
}

?>
