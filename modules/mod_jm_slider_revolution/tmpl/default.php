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
global $css_settings;
global $jquery;
global $js_plugins;
global $js_revolution;
$document = JFactory::getDocument();
$urlPlugin = JURI::root()."administrator/components/com_jm_slider_revolution/";
if(Jm_slider_revolutionHelper::isJoomla3()){	JHtml::_('jquery.framework');}else if($include_jquery){	$document->addScript($urlPlugin.'assets/js/jquery.min.js');}
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
<div class="jm_slider_revolution <?php echo $moduleclass_sfx;?>">
	<?php echo $content_slider;?>
</div>