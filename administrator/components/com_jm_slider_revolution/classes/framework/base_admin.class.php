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
 
 class UniteBaseAdminClassRev extends UniteBaseClassRev{
 	
		const ACTION_ADMIN_MENU = "admin_menu";
		const ACTION_ADMIN_INIT = "admin_init";	
		const ACTION_ADD_SCRIPTS = "admin_enqueue_scripts";
		const ACTION_ADD_METABOXES = "add_meta_boxes";
		const ACTION_SAVE_POST = "save_post";
		
		const ROLE_ADMIN = "admin";
		const ROLE_EDITOR = "editor";
		const ROLE_AUTHOR = "author";
		
		public $master_view;
		public $view;
		
		static $arrSettings = array();
		public $arrMenuPages = array();
		public $tempVars = array();
		public $startupError = "";
		public $menuRole = self::ROLE_ADMIN;
		public $arrMetaBoxes = "";		//option boxes that will be added to post
		
		
		/**
		 * 
		 * main constructor		 
		 */
		public function __construct(){
			
			parent::__construct();
			
			
		}
		/**
		 * require some template from "templates" folder
		 */
		public function getPathTemplate($templateName){
			
			$pathTemplate = self::$path_templates.$templateName.".php";
			UniteFunctionsRev::validateFilepath($pathTemplate,"Template");
			
			return($pathTemplate);
		}
		
		/**
		 * 
		 * require settings file, the filename without .php
		 */
		public static function requireSettings($settingsFile){
			
			try{
				require JPATH_COMPONENT_ADMINISTRATOR."/settings/{$settingsFile}.php";
			}catch (Exception $e){
				echo "<br><br>Settings ($settingsFile) Error: <b>".$e->getMessage()."</b>";
				dmp($e->getTraceAsString());
			}
		}		
		/**
		 * 
		 * get path to settings file
		 * @param $settingsFile
		 */
		public static function getSettingsFilePath($settingsFile){
			
			$filepath =JPATH_COMPONENT_ADMINISTRATOR."/settings/{$settingsFile}.php";
			return($filepath);
		}
		
		
		/**
		 * 
		 * add all js and css needed for media upload
		 */
		public function addMediaUploadIncludes(){
			
			self::addWPScript("thickbox");
			self::addWPStyle("thickbox");
			self::addWPScript("media-upload");
			
		}
		
		
		/**
		 * add admin menus from the list.
		 */
		public static function addAdminMenu(){
			
			$role = "manage_options";
			
			switch(self::$menuRole){
				case self::ROLE_AUTHOR:
					$role = "edit_published_posts";
				break;
				case self::ROLE_EDITOR:
					$role = "edit_pages";
				break;		
				default:		
				case self::ROLE_ADMIN:
					$role = "manage_options";
				break;
			}
			
			foreach(self::$arrMenuPages as $menu){
				$title = $menu["title"];
				$pageFunctionName = $menu["pageFunction"];
				add_menu_page( $title, $title, $role, self::$dir_plugin, array(self::$t, $pageFunctionName), 'dashicons-update' );
			}
			
			if(!isset($GLOBALS['admin_page_hooks']['themepunch-google-fonts'])){ //only add if menu is not already registered
				add_menu_page(__('Punch Fonts', REVSLIDER_TEXTDOMAIN), __('Punch Fonts', REVSLIDER_TEXTDOMAIN), $role, 'themepunch-google-fonts', array(self::$t, 'display_plugin_submenu_page_google_fonts'), 'dashicons-editor-textcolor');
			}
		}
		
		
		/**
		 * 
		 * add menu page
		 */
		public function addMenuPage($title,$pageFunctionName){
						
			self::$arrMenuPages[] = array("title"=>$title,"pageFunction"=>$pageFunctionName);
			
		}

		/**
		 * 
		 * get url to some view.
		 */
		public static function getViewUrl($viewName,$urlParams=""){
			$params = "&view=".$viewName;
			if(!empty($urlParams))
				$params .= "&".$urlParams;
			
			$link = admin_url( "admin.php?page=".self::$dir_plugin.$params);
			return($link);
		}
		
		/**
		 * 
		 * register the "onActivate" event
		 */
		protected function addEvent_onActivate($eventFunc = "onActivate"){
			register_activation_hook( self::$mainFile, array(self::$t, $eventFunc) );
		}
		
		
		protected function addAction_onActivate(){
			register_activation_hook( self::$mainFile, array(self::$t, 'onActivateHook') );
		}
		
		
		public static function onActivateHook(){
			
			$options = array('use_hammer_js' => 'on');
			
			$options = apply_filters('revslider_mod_activation_option', $options);
			
			$operations = new RevOperations();
			$operations->updateGeneralSettings($options);
			
		}
		
		/**
		 * 
		 * store settings in the object
		 */
		public static function storeSettings($key,$settings){
			self::$arrSettings[$key] = $settings;
		}
		
		/**
		 * 
		 * get settings object
		 */
		public static function getSettings($key){
			if(!isset(self::$arrSettings[$key]))
				UniteFunctionsRev::throwError("Settings $key not found");
			$settings = self::$arrSettings[$key];
			return($settings);
		}
		
		
		/**
		 * 
		 * add ajax back end callback, on some action to some function.
		 */
		public function addActionAjax($ajaxAction,$eventFunction){
			self::addAction('wp_ajax_'.self::$dir_plugin."_".$ajaxAction, $eventFunction);
			self::addAction('wp_ajax_nopriv_'.self::$dir_plugin."_".$ajaxAction, $eventFunction);
		}
		
		/**
		 * 
		 * echo json ajax response
		 */
		public function ajaxResponse($success,$message,$arrData = null){
			
			$response = array();			
			$response["success"] = $success;				
			$response["message"] = $message;
			
			if(!empty($arrData)){
				
				if(gettype($arrData) == "string")
					$arrData = array("data"=>$arrData);				
				
				$response = array_merge($response,$arrData);
			}
				
			$json = json_encode($response);
			
			echo $json;
			exit();
		}

		/**
		 * 
		 * echo json ajax response, without message, only data
		 */
		public function ajaxResponseData($arrData){
			if(gettype($arrData) == "string")
				$arrData = array("data"=>$arrData);
			
			self::ajaxResponse(true,"",$arrData);
		}
		
		/**
		 * 
		 * echo json ajax response
		 */
		public function ajaxResponseError($message,$arrData = null){
			
			self::ajaxResponse(false,$message,$arrData,true);
		}
		
		/**
		 * echo ajax success response
		 */
		public function ajaxResponseSuccess($message,$arrData = null){
			
			self::ajaxResponse(true,$message,$arrData,true);
			
		}
		
		/**
		 * echo ajax success response
		 */
		public function ajaxResponseSuccessRedirect($message,$url){
			$arrData = array("is_redirect"=>true,"redirect_url"=>$url);
			
			self::ajaxResponse(true,$message,$arrData,true);
		}
		

		/**
		 * 
		 * Enter description here ...
		 */
		public function updatePlugin($viewBack = false){
			$linkBack = self::getViewUrl($viewBack);
			$htmlLinkBack = UniteFunctionsRev::getHtmlLink($linkBack, "Go Back");
			
			//check if css table exist, if not, we need to verify that the current captions.css can be parsed
			if(UniteFunctionsWPRev::isDBTableExists(GlobalsRevSlider::TABLE_CSS_NAME)){
				$captions = RevOperations::getCaptionsCssContentArray();
				if($captions === false){
					$message = "CSS parse error! Please make sure your captions.css is valid CSS before updating the plugin!";
					echo "<div style='color:#B80A0A;font-size:18px;'><b>Update Error: </b> $message</div><br>";
					echo $htmlLinkBack;
					exit();
				}
			}
			
			$zip = new UniteZipRev();
						
			try{
				
				if(function_exists("unzip_file") == false){					
					if( UniteZipRev::isZipExists() == false)
						UniteFunctionsRev::throwError("The ZipArchive php extension not exists, can't extract the update file. Please turn it on in php ini.");
				}
				
				dmp("Update in progress...");
				
				$arrFiles = UniteFunctionsRev::getVal($_FILES, "update_file");
				if(empty($arrFiles))
					UniteFunctionsRev::throwError("Update file don't found.");
					
				$filename = UniteFunctionsRev::getVal($arrFiles, "name");
				
				if(empty($filename))
					UniteFunctionsRev::throwError("Update filename not found.");
				
				$fileType = UniteFunctionsRev::getVal($arrFiles, "type");
				
				/*				
				$fileType = strtolower($fileType);
				
				if($fileType != "application/zip")
					UniteFunctionsRev::throwError("The file uploaded is not zip.");
				*/
				
				$filepathTemp = UniteFunctionsRev::getVal($arrFiles, "tmp_name");
				if(file_exists($filepathTemp) == false)
					UniteFunctionsRev::throwError("Can't find the uploaded file.");	

				//crate temp folder
				UniteFunctionsRev::checkCreateDir(self::$path_temp);

				//create the update folder
				$pathUpdate = self::$path_temp."update_extract/";				
				UniteFunctionsRev::checkCreateDir($pathUpdate);
								
				//remove all files in the update folder
				if(is_dir($pathUpdate)){ 
					$arrNotDeleted = UniteFunctionsRev::deleteDir($pathUpdate,false);
					if(!empty($arrNotDeleted)){
						$strNotDeleted = print_r($arrNotDeleted,true);
						UniteFunctionsRev::throwError("Could not delete those files from the update folder: $strNotDeleted");
					}
				}
				
				//copy the zip file.
				$filepathZip = $pathUpdate.$filename;
				
				$success = move_uploaded_file($filepathTemp, $filepathZip);
				if($success == false)
					UniteFunctionsRev::throwError("Can't move the uploaded file here: ".$filepathZip.".");
				
				if(function_exists("unzip_file") == true){
					WP_Filesystem();
					$response = unzip_file($filepathZip, $pathUpdate);
				}
				else					
					$zip->extract($filepathZip, $pathUpdate);
				
				//get extracted folder
				$arrFolders = UniteFunctionsRev::getFoldersList($pathUpdate);
				if(empty($arrFolders))
					UniteFunctionsRev::throwError("The update folder is not extracted");
				
				if(count($arrFolders) > 1)
					UniteFunctionsRev::throwError("Extracted folders are more then 1. Please check the update file.");
					
				//get product folder
				$productFolder = $arrFolders[0];
				if(empty($productFolder))
					UniteFunctionsRev::throwError("Wrong product folder.");
					
				if($productFolder != self::$dir_plugin)
					UniteFunctionsRev::throwError("The update folder don't match the product folder, please check the update file.");
				
				$pathUpdateProduct = $pathUpdate.$productFolder."/";				
				
				//check some file in folder to validate it's the real one:
				$checkFilepath = $pathUpdateProduct.$productFolder.".php";
				if(file_exists($checkFilepath) == false)
					UniteFunctionsRev::throwError("Wrong update extracted folder. The file: ".$checkFilepath." not found.");
				
				//copy the plugin without the captions file.
				//$pathOriginalPlugin = $pathUpdate."copy/";
				$pathOriginalPlugin = self::$path_plugin;
				
				$arrBlackList = array();
				$arrBlackList[] = "rs-plugin/css/captions.css";
				$arrBlackList[] = "rs-plugin/css/dynamic-captions.css";
				$arrBlackList[] = "rs-plugin/css/static-captions.css";
				
				UniteFunctionsRev::copyDir($pathUpdateProduct, $pathOriginalPlugin,"",$arrBlackList);
				
				//delete the update
				UniteFunctionsRev::deleteDir($pathUpdate);
				
				dmp("Updated Successfully, redirecting...");
				echo "<script>location.href='$linkBack'</script>";
				
			}catch(Exception $e){
				$message = $e->getMessage();
				$message .= " <br> Please update the plugin manually via the ftp";
				echo "<div style='color:#B80A0A;font-size:18px;'><b>Update Error: </b> $message</div><br>";
				echo $htmlLinkBack;
				exit();
			}
			
		}
		
 	
 }
 
 ?>