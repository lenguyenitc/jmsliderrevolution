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
jimport('joomla.plugin.plugin');
JPluginHelper::importPlugin('plg_jm_slider_revolution');
class plgContentplg_jm_slider_revolution extends JPlugin {
	public function onContentPrepare($context, &$row, &$params, $page = 0){
		$runmode = $this->params->get('runmode');
		$jQuery = $this->params->get('include_jquery',0);
		if ($runmode != 0) return;
		$matches = null;
		$pattern = $this->get_shortcode_regex();
		preg_match_all( '/'. $pattern .'/s', $row->text, $matches );
		foreach($matches as $k=>$id){
			if($id[0]){
				$id[0] = trim($id[0]);
				$slideshowHTML = $this->getHTML($id[0],$jQuery);
				$row->text = str_replace("[rev_slider {$id[0]}]", $slideshowHTML, $row->text);
			}
		}
		return true;
	}
	
	function getHTML( $slider_id, $jquery ) {
		$slider_id = $this->getIdFromAlias($slider_id);
		if($slider_id){
			require_once JPATH_ADMINISTRATOR.'/components/com_jm_slider_revolution/helpers/jm_slider_revolution.php';
			ob_start();
			$slider = Jm_slider_revolutionHelper::putSlider($slider_id);
			$content_slider = ob_get_contents();
			// Do not output Slider if we are on mobile
			$disable_on_mobile = $slider->getParam("disable_on_mobile","off");
			if($disable_on_mobile == 'on'){
				$mobile = strstr($_SERVER['HTTP_USER_AGENT'],'Android') || strstr($_SERVER['HTTP_USER_AGENT'],'webOS') || strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') ||strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad') ? true : false;
				
				if($mobile)
					return false;
			}
			global $css_settings;
			global $js_plugins;
			global $js_revolution;
			$document = JFactory::getDocument();
			$urlPlugin = JURI::root()."administrator/components/com_jm_slider_revolution/";
			JHtml::_('jquery.framework');
			if($jquery){
				$document->addScript($urlPlugin.'assets/js/jquery.min.js');
			}
			if ($css_settings != 1) {
				$document->addStyleSheet($urlPlugin.'rs-plugin/css/settings.css');
				$css_settings = 1;
			}
			if ($js_plugins != 1) {
				$document->addScript($urlPlugin.'rs-plugin/js/jquery.themepunch.plugins.min.js');
				$document->addScript($urlPlugin.'rs-plugin/js/jquery.themepunch.tools.min.js');
				$js_plugins = 1;
			}
			if ($js_revolution != 1) {
				$document->addScript($urlPlugin.'rs-plugin/js/jquery.themepunch.revolution.min.js');
			}
			$db = new UniteDBRev();
			$GlobalsRevSlider = new GlobalsRevSlider();
			$styles = $db->fetch($GlobalsRevSlider::$table_css);
			$styles = UniteCssParserRev::parseDbArrayToCss($styles, "\n");
			$styles = UniteCssParserRev::compress_css($styles);
			// KRISZTIAN MODIFICATION
			$stylesinnerlayers = str_replace('.tp-caption', '',$styles);
			// KRISZTIAN MODIFICATION ENDS
			echo '<style type="text/css">'.$styles.$stylesinnerlayers.'</style>';
			$u = JFactory::getUri();
			$http = ($u->isSSL()) ? 'https' : 'http';
			$f = new ThemePunch_Fonts();
			$my_fonts = $f->get_all_fonts();
			if(!empty($my_fonts)){
				foreach($my_fonts as $c_font){
					?>
					<link rel='stylesheet' href="<?php echo $http.'://fonts.googleapis.com/css?family='.strip_tags($c_font['url']); ?>" type='text/css' />
					<?php
				}
			}
			$custom_css = RevOperations::getStaticCss();
			echo '<style type="text/css">'.UniteCssParserRev::compress_css($custom_css).'</style>';
			?>
			<div class="jm_slider_revolution">
				<?php echo $content_slider;?>
			</div>
			<?php
			return ob_get_clean();
		}
	}
	function get_shortcode_regex() {
		$tagregexp = 'rev_slider';
		return
			  '\\['                              // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagregexp)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			.     '(?:'
			.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
			.     ')*?'
			. ')'
			. '(?:'
			.     '(\\/)'                        // 4: Self closing tag ...
			.     '\\]'                          // ... and closing bracket
			. '|'
			.     '\\]'                          // Closing bracket
			.     '(?:'
			.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			.             '[^\\[]*+'             // Not an opening bracket
			.             '(?:'
			.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			.                 '[^\\[]*+'         // Not an opening bracket
			.             ')*+'
			.         ')'
			.         '\\[\\/\\2\\]'             // Closing shortcode tag
			.     ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
	function getIdFromAlias($alias){
		$db = JFactory::getDbo();
		$query = "SELECT id FROM #__revslider_sliders WHERE alias='{$alias}'";
		$db->setQuery($query);
		return $db->loadResult();
	}
}
?>

