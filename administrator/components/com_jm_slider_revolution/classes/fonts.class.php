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
if(!class_exists('ThemePunch_Fonts')) {
	 
	class ThemePunch_Fonts {
		const TP_TEXTDOMAIN = 'themepunch-fonts';
		
		/**
		 * Add a new Font 
		 */
		public function add_new_font($new_font){
			
			if(!isset($new_font['url']) || strlen($new_font['url']) < 3) return 'Wrong parameter received';
			if(!isset($new_font['handle']) || strlen($new_font['handle']) < 3) return 'Wrong handle received';
			
			$fonts = $this->get_all_fonts();
			
			if(!empty($fonts)){
				foreach($fonts as $font){
					if($font['handle'] == $new_font['handle']) return 'Font with handle already exist, choose a different handle';
				}
			}
			
			$new = array('url' => $new_font['url'], 'handle' => $new_font['handle']);
			
			$fonts[] = $new;
			
			$do = update_option('tp-google-fonts', $fonts);
			
			return true;
		}
		
		
		/**
		 * change font by handle
		 */
		public function edit_font_by_handle($edit_font){
			
			if(!isset($edit_font['handle']) || strlen($edit_font['handle']) < 3) return 'Wrong Handle received';
			if(!isset($edit_font['url']) || strlen($edit_font['url']) < 3) return 'Wrong Params received';
			
			$fonts = $this->get_all_fonts();
			
			if(!empty($fonts)){
				foreach($fonts as $key => $font){
					if($font['handle'] == $edit_font['handle']){
						$fonts[$key]['handle'] = $edit_font['handle'];
						$fonts[$key]['url'] = $edit_font['url'];
						
						$do = update_option('tp-google-fonts', $fonts);
						return true;
					}
				}
			}
			
			return false;
		}
		
		
		/**
		 * Remove Font
		 */
		public function remove_font_by_handle($handle){
			
			$fonts = $this->get_all_fonts();
			
			if(!empty($fonts)){
				foreach($fonts as $key => $font){
					if($font['handle'] == $handle){
						unset($fonts[$key]);
						$do = update_option('tp-google-fonts', $fonts);
						return true;
					}
				}
			}
			
			return 'Font not found! Wrong handle given.';
		}
		
		
		/**
		 * get all fonts
		 */
		public function get_all_fonts(){
		
			$fonts = '';//get_option('tp-google-fonts', array());
			
			return $fonts;
		}
		
		
		/**
		 * get all handle of fonts 
		 */
		public function get_all_fonts_handle(){
			$fonts = array();
			
			$font = get_option('tp-google-fonts', array());
			
			if(!empty($font)){
				foreach($font as $f){
					$fonts[] = $f['handle'];
				}
			}
			
			return $fonts;
		}
		
		
		/**
		 * register all fonts
		 */
		public function register_fonts(){
		
			$fonts = $this->get_all_fonts();
			
			if(!empty($fonts)){
				$http = (is_ssl()) ? 'https' : 'http';
				foreach($fonts as $font){
					if($font !== ''){
						wp_register_style('tp-'.sanitize_title($font['handle']), $http.'://fonts.googleapis.com/css?family='.strip_tags($font['url']));
						wp_enqueue_style('tp-'.sanitize_title($font['handle']));
					}
				}
			}
			
		}
		
		
		/**
		 * register all fonts
		 */
		public static function propagate_default_fonts(){
			
			$default = array (
					array('url' => 'Open+Sans:300,400,600,700,800', 'handle' => 'open-sans'),
					array('url' => 'Raleway:100,200,300,400,500,600,700,800,900', 'handle' => 'raleway'),
					array('url' => 'Droid+Serif:400,700', 'handle' => 'droid-serif' )
				); 
			
			$fonts = get_option('tp-google-fonts', array());
			
			if(!empty($fonts)){
				foreach($default as $d_key => $d_font){
					$found = false;
					foreach($fonts as $font){
						if($font['handle'] == $d_font['handle']){
							$found = true;
							break;
						}
					}
					
					if($found == false)
						$fonts[] = $default[$d_key];
				}
				
				update_option('tp-google-fonts', $fonts);
				
			}else{
				
				update_option('tp-google-fonts', $default);
				
			}
			
		}
		
	}
}
?>