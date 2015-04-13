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
	
class UniteDBRev{
	
	private $db;
	private $lastRowID;
	
	/**
	 * 
	 * constructor - set database object
	 */
	public function __construct(){
		$db = JFactory::getDbo();
		$this->db = $db;
	}
	function prepare( $query, $args ) {
		if ( is_null( $query ) )
			return;
		$args = func_get_args();
		array_shift( $args );
		// If args were passed as an array (as in vsprintf), move them up
		if ( isset( $args[0] ) && is_array($args[0]) )
			$args = $args[0];
		$query = str_replace( "'%s'", '%s', $query ); // in case someone mistakenly already singlequoted it
		$query = str_replace( '"%s"', '%s', $query ); // doublequote unquoting
		$query = preg_replace( '|(?<!%)%f|' , '%F', $query ); // Force floats to be locale unaware
		$query = preg_replace( '|(?<!%)%s|', "'%s'", $query ); // quote the strings, avoiding escaped strings like %%s
		array_walk( $args, array( $this, 'escape_by_ref' ) );
		return @vsprintf( $query, $args );
	}
	function escape_by_ref( &$string ) {
		if ( ! is_float( $string ) )
			$string = $this->_real_escape( $string );
	}
	function _real_escape( $string ) {
		return addslashes( $string );
	}
	function _insert_replace_helper( $table, $data, $format = null, $type = 'INSERT' ) {
		if ( ! in_array( strtoupper( $type ), array( 'REPLACE', 'INSERT' ) ) )
			return false;
		$formats = $format = (array) $format;
		$fields = array_keys( $data );
		$formatted_fields = array();
		foreach ( $fields as $field ) {
			if ( !empty( $format ) )
				$form = ( $form = array_shift( $formats ) ) ? $form : $format[0];
			elseif ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$formatted_fields[] = $form;
		}
		$sql = "{$type} INTO `$table` (`" . implode( '`,`', $fields ) . "`) VALUES (" . implode( ",", $formatted_fields ) . ")";
		$this->db->setQuery($this->prepare( $sql, $data ));
		$this->db->query();
		return $this->db->insertid();
	}
	
	function insertDb( $table, $data, $format = null ) {
		return $this->_insert_replace_helper( $table, $data, $format, 'INSERT' );
	}
	public function insert($table,$arrItems){
		$this->lastRowID = $this->insertDb($table, $arrItems);
		$this->checkForErrors("Insert query error");
		return($this->lastRowID);
	}
	/**
	 * 
	 * throw error
	 */
	
	private function throwError($message,$code=-1){
		UniteFunctionsRev::throwError($message,$code);
	}
	
	//------------------------------------------------------------
	// validate for errors
	private function checkForErrors($prefix = ""){
		if($this->db->getErrorNum()){
			$message = $this->db->getErrorMsg();				
			if($prefix) $message = $prefix.' - <b>'.$message.'</b>';
			$this->throwError($message);
		}
	}
	
	
	/**
	 * 
	 * get last insert id
	 */
	public function getLastInsertID(){
		$this->lastRowID = $this->db->insertid();
		return($this->lastRowID);			
	}
	
	
	/**
	 * 
	 * delete rows
	 */
	public function delete($table,$where){
		
		UniteFunctionsRev::validateNotEmpty($table,"table name");
		UniteFunctionsRev::validateNotEmpty($where,"where");
		$query = "delete from $table where $where";
		$this->db->setQuery($query);
		$this->db->query();
		$this->checkForErrors("Delete query error");
	}
	
	
	/**
	 * 
	 * run some sql query
	 */
	public function runSql($query){
		
		$this->db->setQuery($query);			
		$this->db->query();			
		$this->checkForErrors("Regular query error");
	}
	
	function updateDb( $table, $data, $where, $format = null, $where_format = null ) {
		if ( ! is_array( $data ) || ! is_array( $where ) )
			return false;

		$formats = $format = (array) $format;
		$bits = $wheres = array();
		foreach ( (array) array_keys( $data ) as $field ) {
			if ( !empty( $format ) )
				$form = ( $form = array_shift( $formats ) ) ? $form : $format[0];
			elseif ( isset($this->field_types[$field]) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$bits[] = "`$field` = {$form}";
		}

		$where_formats = $where_format = (array) $where_format;
		foreach ( (array) array_keys( $where ) as $field ) {
			if ( !empty( $where_format ) )
				$form = ( $form = array_shift( $where_formats ) ) ? $form : $where_format[0];
			elseif ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$wheres[] = "`$field` = {$form}";
		}

		$sql = "UPDATE `$table` SET " . implode( ', ', $bits ) . ' WHERE ' . implode( ' AND ', $wheres );
		$this->db->setQuery( $this->prepare( $sql, array_merge( array_values( $data ), array_values( $where ) ) ) );
		return $this->db->query();
	}
	/**
	 * 
	 * insert variables to some table
	 */
	public function update($table,$arrItems,$where){
		
		$response = $this->updateDb($table, $arrItems, $where);
		if($response === false)
			UniteFunctionsRev::throwError("no update action taken!");
			
		$this->checkForErrors("Update query error");
		
		return($this->db->getErrorNum());
	}
	
	
	/**
	 * 
	 * get data array from the database
	 * 
	 */
	public function fetch($tableName,$where="",$orderField="",$groupByField="",$sqlAddon=""){
		$query = "select * from $tableName";
		if($where) $query .= " where $where";
		if($orderField) $query .= " order by $orderField";
		if($groupByField) $query .= " group by $groupByField";
		if($sqlAddon) $query .= " ".$sqlAddon;
		$this->db->setQuery($query);
		$response = $this->db->loadAssocList();
		$this->checkForErrors("fetch");
		
		return($response);
	}
	/**
	 * 
	 * fetch only one item. if not found - throw error
	 */
	public function fetchSingle($tableName,$where="",$orderField="",$groupByField="",$sqlAddon=""){
		$response = $this->fetch($tableName, $where, $orderField, $groupByField, $sqlAddon);
		if(empty($response))
			$this->throwError("Record not found");
		$record = $response[0];
		return($record);
	}
	
	/**
	 * 
	 * escape data to avoid sql errors and injections.
	 */
	public function escape($string){
		$string = $this->esc_sql($string);
		return($string);
	}
	public function esc_sql($data){
		if ( is_array( $data ) ) {
			foreach ( $data as $k => $v ) {
					if ( is_array($v) )
						$data[$k] = $this->escape( $v );
					else
						$data[$k] = $this->_real_escape( $v );
			}
		} else {
			$data = $this->_real_escape( $data );
		}
		return $data;
	}
	
}

?>