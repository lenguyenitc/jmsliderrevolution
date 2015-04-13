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
jimport('joomla.plugin.plugin');
JPluginHelper::importPlugin('plg_jmshortcode');
class plgContentplg_jmshortcode extends JPlugin {
	public function __construct(& $subject, $config){
		parent::__construct($subject, $config);
	}
	public function onAfterRender()
	{
		$runmode = $this->params->get('runmode');
		if ($runmode != 1) return;
		$app = JFactory::getApplication();
		if ($app->isSite()) {
		$page = JResponse::GetBody();
		$matches = null;
		preg_match_all("'\[jmslider[\s]+slider_id=\'(.*?)\'\]\[\/jmslider\]'si", $page , $matches);
		foreach($matches[1] as $k=>$id){
			$slideshowHTML = $this->getHTML($id);
			$page = str_replace($matches[0][$k], $slideshowHTML, $page);
		}
		JResponse::SetBody($page);
	  }
	}
	public function onContentPrepare($context, &$row, &$params, $page = 0){
		$runmode = $this->params->get('runmode');
		$jQuery = $this->params->get('include_jquery',0);
          if($jQuery){
              echo '<script type="text/javascript" src="'.JURI::root().'administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jquery.min.js"></script>';
          }
		if ($runmode != 0) return;
		$matches = null;
		preg_match_all("'\[jmslider[\s]+slider_id=\'(.*?)\'\]\[\/jmslider\]'si", $row->text , $matches);
		foreach($matches[1] as $k=>$id){
			$slideshowHTML = $this->getHTML($id);
			$row->text = str_replace($matches[0][$k], $slideshowHTML, $row->text);
		}
		return true;
	}
	
	function getHTML( $slider_id, $content = null ) {
		global $css_responsive;
		global $css_settings;
		global $js_plugins;
		global $js_revolution;
		$document = JFactory::getDocument();
		$content = '';
		if ($css_settings != 1) {
			$document->addStyleSheet('administrator/components/com_jm_deluxe_layer_slideshow/assets/css/settings.css');
		$css_settings = 1;
		}
		if ($js_plugins != 1) {
			$document->addScript('administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jquery.themepunch.plugins.min.js');
		$js_plugins = 1;
		}
		if ($js_revolution != 1) {
			$document->addScript('administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jquery.themepunch.revolution.min.js');
		}
		require_once JPATH_ADMINISTRATOR.'/components/com_jm_deluxe_layer_slideshow/helpers/jm_deluxe_layer_slideshow.php';
		$data = Jm_deluxe_layer_slideshowHelper::getData($slider_id);
		$settings = json_decode(base64_decode(Jm_deluxe_layer_slideshowHelper::getSetting($slider_id)));
		$layers = json_decode(base64_decode($data));
		$delay = isset($settings->delay)?(!empty($settings->delay)?$settings->delay:9000):9000;
		$width = isset($settings->width)?(!empty($settings->width)?$settings->width:800):800;
		$height = isset($settings->height)?(!empty($settings->height)?$settings->height:350):350;
		$responsive = isset($settings->responsive)?(!empty($settings->responsive)?$settings->responsive:0):0;
		$fullwidth = isset($settings->fullwidth)?(!empty($settings->fullwidth)?$settings->fullwidth:'off'):'off';
		$fullScreen = isset($settings->fullScreen)?(!empty($settings->fullScreen)?$settings->fullScreen:'off'):'off';
		$backgroundcolor = isset($settings->backgroundcolor)?(!empty($settings->backgroundcolor)?$settings->backgroundcolor:''):'';
		$backgroundimage = isset($settings->backgroundimage)?(!empty($settings->backgroundimage)?$settings->backgroundimage:''):'';
		$onhover = isset($settings->onhover)?(!empty($settings->onhover)?$settings->onhover:'off'):'off';
		$touchenabled = isset($settings->touchenabled)?(!empty($settings->touchenabled)?$settings->touchenabled:''):'';
		$thumbWidth = isset($settings->thumbWidth)?(!empty($settings->thumbWidth)?$settings->thumbWidth:100):100;
		$thumbHeight = isset($settings->thumbHeight)?(!empty($settings->thumbHeight)?$settings->thumbHeight:50):50;
		$thumbAmount = isset($settings->thumbAmount)?(!empty($settings->thumbAmount)?$settings->thumbAmount:5):5;
		$hideThumbs = isset($settings->hideThumbs)?(!empty($settings->hideThumbs)?$settings->hideThumbs:0):200;
		$shuffle = isset($settings->shuffle)?(!empty($settings->shuffle)?$settings->shuffle:'off'):'off';
		$parallax = isset($settings->parallax)?(!empty($settings->parallax)?$settings->parallax:'off'):'off';
		$parallaxLevels = isset($settings->parallaxLevels)?(!empty($settings->parallaxLevels)?$settings->parallaxLevels:10):10;
		$parallaxBgFreeze = isset($settings->parallaxBgFreeze)?(!empty($settings->parallaxBgFreeze)?$settings->parallaxBgFreeze:'off'):'off';
		$navigationType = isset($settings->navigationType)?(!empty($settings->navigationType)?$settings->navigationType:'none'):'none';
		$navigationArrows = isset($settings->navigationArrows)?(!empty($settings->navigationArrows)?$settings->navigationArrows:'verticalcentered'):'verticalcentered';
		$navigationHOffset = isset($settings->navigationHOffset)?(!empty($settings->navigationHOffset)?$settings->navigationHOffset:0):0;
		$navigationVOffset = isset($settings->navigationVOffset)?(!empty($settings->navigationVOffset)?$settings->navigationVOffset:0):0;
		$soloArrowLeftHalign = isset($settings->soloArrowLeftHalign)?(!empty($settings->soloArrowLeftHalign)?$settings->soloArrowLeftHalign:'left'):'left';
		$soloArrowLeftValign = isset($settings->soloArrowLeftValign)?(!empty($settings->soloArrowLeftValign)?$settings->soloArrowLeftValign:'center'):'center';
		$soloArrowLeftHOffset = isset($settings->soloArrowLeftHOffset)?(!empty($settings->soloArrowLeftHOffset)?$settings->soloArrowLeftHOffset:0):20;
		$soloArrowLeftVOffset = isset($settings->soloArrowLeftVOffset)?(!empty($settings->soloArrowLeftVOffset)?$settings->soloArrowLeftVOffset:0):20;
		$soloArrowRightHalign = isset($settings->soloArrowRightHalign)?(!empty($settings->soloArrowRightHalign)?$settings->soloArrowRightHalign:'right'):'right';
		$soloArrowRightValign = isset($settings->soloArrowRightValign)?(!empty($settings->soloArrowRightValign)?$settings->soloArrowRightValign:'center'):'center';
		$soloArrowRightHOffset = isset($settings->soloArrowRightHOffset)?(!empty($settings->soloArrowRightHOffset)?$settings->soloArrowRightHOffset:0):20;
		$soloArrowRightVOffset = isset($settings->soloArrowRightVOffset)?(!empty($settings->soloArrowRightVOffset)?$settings->soloArrowRightVOffset:0):20;
		$navigationStyle = isset($settings->navigationStyle)?(!empty($settings->navigationStyle)?$settings->navigationStyle:'round'):'round';
		$navigationHAlign = isset($settings->navigationHAlign)?(!empty($settings->navigationHAlign)?$settings->navigationHAlign:'center'):'center';
		$navigationVAlign = isset($settings->navigationVAlign)?(!empty($settings->navigationVAlign)?$settings->navigationVAlign:'bottom'):'bottom';
		$startwidth = $fullwidth=='on'?1200:$width;
		$content .='<script type="text/javascript">
		jQuery(document).ready(function(){
			if (jQuery.fn.cssOriginal!=undefined) jQuery.fn.css = tpj.fn.cssOriginal;
			jQuery("#jmlayerslider'.$slider_id.' .banner").revolution(
				{
					delay:'.$delay.',
					startheight:'.$height.',
					startwidth:'.$startwidth.',
					hideThumbs:'.$hideThumbs.',
					thumbWidth:'.$thumbWidth.',
					thumbHeight:'.$thumbHeight.',
					thumbAmount:'.$thumbAmount.',
					navigationType:"'.$navigationType.'",
					navigationArrows:"'.$navigationArrows.'",
					navigationStyle:"'.$navigationStyle.'",
					navigationHAlign:"'.$navigationHAlign.'",
					navigationVAlign:"'.$navigationVAlign.'",
					navigationHOffset:'.$navigationHOffset.',
					navigationVOffset:'.$navigationVOffset.',
					soloArrowLeftHalign:"'.$soloArrowLeftHalign.'",
					soloArrowLeftValign:"'.$soloArrowLeftValign.'",
					soloArrowLeftHOffset:'.$soloArrowLeftHOffset.',
					soloArrowLeftVOffset:'.$soloArrowLeftVOffset.',
					soloArrowRightHalign:"'.$soloArrowRightHalign.'",
					soloArrowRightValign:"'.$soloArrowRightValign.'",
					soloArrowRightHOffset:'.$soloArrowRightHOffset.',
					soloArrowRightVOffset:'.$soloArrowRightVOffset.',
					touchenabled:"'.$touchenabled.'",
					onHoverStop:"'.$onhover.'",
					stopAtSlide:-1,
					stopAfterLoops:-1,
					hideCaptionAtLimit:0,	
					hideAllCaptionAtLilmit:0,	
					hideSliderAtLimit:0,		
					shadow:0,
					fullWidth:"'.$fullwidth.'",
					fullScreen:"'.$fullScreen.'",
					shuffle:"'.$shuffle.'",
					parallax:"'.$parallax.'",
					parallaxLevels: '.$parallaxLevels.',
					parallaxBgFreeze: "'.$parallaxBgFreeze.'"
				});
		})
		</script>';
		$html = Jm_deluxe_layer_slideshowHelper::showSlider($layers,$width,$height,$backgroundcolor,$fullwidth,false);
		$content .="<div id='jmlayerslider{$slider_id}'>". $html . "</div>";
		return $content;
	}
}
?>

