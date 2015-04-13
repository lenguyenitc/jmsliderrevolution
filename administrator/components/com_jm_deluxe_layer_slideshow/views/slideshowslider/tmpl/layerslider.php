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
JHtml::_('behavior.tooltip');
JHTML::_('behavior.modal');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
jimport('joomla.filesystem.file');
$layout = JRequest::getVar('layout');
//Import CSS
$document = JFactory::getDocument();
if($this->isJoomla3){
    $document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/jmparallax_slideshow_j3.css');
    $document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/layerslider_j3.css');
}else{
    $document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/jmparallax_slideshow.css');
    $document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/layerslider.css'); 
	$document->addScript('components/com_jm_deluxe_layer_slideshow/assets/js/jquery.min.js'); 
}
$document->addScript('components/com_jm_deluxe_layer_slideshow/assets/js/jquery.min.js'); 
$document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/settings.css');
$document->addScript('components/com_jm_deluxe_layer_slideshow/assets/js/jmbase64.min.js');
$document->addScript('components/com_jm_deluxe_layer_slideshow/assets/js/mediaupload.js');
$document->addScript('components/com_jm_deluxe_layer_slideshow/assets/js/jquery-ui.js');
$document->addScript('components/com_jm_deluxe_layer_slideshow/assets/js/jquery.themepunch.plugins.min.js');
$document->addScript('components/com_jm_deluxe_layer_slideshow/assets/js/jquery.themepunch.revolution.min.js');
$document->addScript('components/com_jm_deluxe_layer_slideshow/assets/js/sprintf.min.js');
$model = $this->getModel();
$id = JRequest::getVar('id');
$layers = (json_decode(base64_decode($this->item->data)));
$settings = (json_decode(base64_decode($this->item->setting)));
$title = $this->item->title;
$slider = new stdClass();
$slider->setting = $settings;
$slider->title = $title;
$delay = isset($settings->delay)?(!empty($settings->delay)?$settings->delay:9000):9000;
$width = isset($settings->width)?(!empty($settings->width)?$settings->width:800):800;
$height = isset($settings->height)?(!empty($settings->height)?$settings->height:350):350;
$responsive = isset($settings->responsive)?(!empty($settings->responsive)?$settings->responsive:0):0;
$fullwidth = isset($settings->fullwidth)?(!empty($settings->fullwidth)?$settings->fullwidth:'off'):'off';
$backgroundcolor = isset($settings->backgroundcolor)?(!empty($settings->backgroundcolor)?$settings->backgroundcolor:''):'';
$backgroundimage = isset($settings->backgroundimage)?(!empty($settings->backgroundimage)?$settings->backgroundimage:''):'';
$onhover = isset($settings->onhover)?(!empty($settings->onhover)?$settings->onhover:'off'):'off';
$shuffle = isset($settings->shuffle)?(!empty($settings->shuffle)?$settings->shuffle:'off'):'off';
$parallax = isset($settings->parallax)?(!empty($settings->parallax)?$settings->parallax:'off'):'off';
$parallaxLevels = isset($settings->parallaxLevels)?(!empty($settings->parallaxLevels)?$settings->parallaxLevels:10):10;
$parallaxBgFreeze = isset($settings->parallaxBgFreeze)?(!empty($settings->parallaxBgFreeze)?$settings->parallaxBgFreeze:'off'):'off';
$touchenabled = isset($settings->touchenabled)?(!empty($settings->touchenabled)?$settings->touchenabled:''):'';
$thumbWidth = isset($settings->thumbWidth)?(!empty($settings->thumbWidth)?$settings->thumbWidth:100):100;
$thumbHeight = isset($settings->thumbHeight)?(!empty($settings->thumbHeight)?$settings->thumbHeight:50):50;
$thumbAmount = isset($settings->thumbAmount)?(!empty($settings->thumbAmount)?$settings->thumbAmount:5):5;
$hideThumbs = isset($settings->hideThumbs)?(!empty($settings->hideThumbs)?$settings->hideThumbs:200):200;
$navigationType = isset($settings->navigationType)?(!empty($settings->navigationType)?$settings->navigationType:'none'):'none';
$navigationArrows = isset($settings->navigationArrows)?(!empty($settings->navigationArrows)?$settings->navigationArrows:'verticalcentered'):'verticalcentered';
$navigationHOffset = isset($settings->navigationHOffset)?(!empty($settings->navigationHOffset)?$settings->navigationHOffset:0):0;
$navigationVOffset = isset($settings->navigationVOffset)?(!empty($settings->navigationVOffset)?$settings->navigationVOffset:20):0;
$soloArrowLeftHalign = isset($settings->soloArrowLeftHalign)?(!empty($settings->soloArrowLeftHalign)?$settings->soloArrowLeftHalign:'left'):'left';
$soloArrowLeftValign = isset($settings->soloArrowLeftValign)?(!empty($settings->soloArrowLeftValign)?$settings->soloArrowLeftValign:'center'):'center';
$soloArrowLeftHOffset = isset($settings->soloArrowLeftHOffset)?(!empty($settings->soloArrowLeftHOffset)?$settings->soloArrowLeftHOffset:20):0;
$soloArrowLeftVOffset = isset($settings->soloArrowLeftVOffset)?(!empty($settings->soloArrowLeftVOffset)?$settings->soloArrowLeftVOffset:0):0;
$soloArrowRightHalign = isset($settings->soloArrowRightHalign)?(!empty($settings->soloArrowRightHalign)?$settings->soloArrowRightHalign:'right'):'right';
$soloArrowRightValign = isset($settings->soloArrowRightValign)?(!empty($settings->soloArrowRightValign)?$settings->soloArrowRightValign:'center'):'center';
$soloArrowRightHOffset = isset($settings->soloArrowRightHOffset)?(!empty($settings->soloArrowRightHOffset)?$settings->soloArrowRightHOffset:20):0;
$soloArrowRightVOffset = isset($settings->soloArrowRightVOffset)?(!empty($settings->soloArrowRightVOffset)?$settings->soloArrowRightVOffset:0):0;
$navigationStyle = isset($settings->navigationStyle)?(!empty($settings->navigationStyle)?$settings->navigationStyle:'round'):'round';
$navigationHAlign = isset($settings->navigationHAlign)?(!empty($settings->navigationHAlign)?$settings->navigationHAlign:'center'):'center';
$navigationVAlign = isset($settings->navigationVAlign)?(!empty($settings->navigationVAlign)?$settings->navigationVAlign:'bottom'):'bottom';
$styles = null;
$startWidth = $fullwidth=='on'?1200:$width;
$styles .= ".preview_sublayer{
			width: 100%;
		}
		.jm_preview_wrap{
			height: {$height}px;
		}
		.preview_sublayer_inner{
			width: {$startWidth}px;   
			position: relative;
			margin: 0 auto;
			height: {$height}px;
			background-size: cover;
		}";
$document->addStyleDeclaration( $styles );	
if($this->isJoomla3){
	$menu = '
	<div class="global_setting_wrap">
		<a class="global_setting" href="'.JURI::base().'index.php?option=com_jm_deluxe_layer_slideshow&view=slideshowslider&layout=globalsettings&id='.$id.'">Global Setting</a>
	</div>';
}
?>
<script src="<?php echo JURI::root() . 'administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jquery-ui.js'; ?>"></script>
<script src="<?php echo JURI::root() . 'administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jquery.themepunch.plugins.min.js'; ?>"></script>
<script src="<?php echo JURI::root() . 'administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jquery.themepunch.revolution.min.js'; ?>"></script>
<form action="<?php echo JRoute::_('index.php?option=com_jm_deluxe_layer_slideshow&view=slideshowslider&layout=layerslider&id=' . $id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm" class="form-validate">
<div id="jm_dl_container">
	<div id="jm_dl_inner">
		<div id="jm_dl_wrap">
			<div class="jm_title_group header">
				<label class="">Slideshow Title:</label>
				<input type="text" value="<?php echo $this->item->title; ?>" class="val_title">
				<?php echo $this->isJoomla3?$menu:'';?>
			</div>
			<div class="jm_dl_wrap_detail">
				<div class="jm_dl_link_tab">
					<ul class="jmtabsnav">
					<?php
						if ($layers) {
						foreach ($layers as $i => $item) {
							echo $i==0?sprintf($this->initString->link_tab,$i,'link_jmtab_active'):sprintf($this->initString->link_tab,$i,'');
						}}?>
					<li onclick="addLayer(this);" class="link-add-tab">Click to add new slide</li>
					<div class='clr'></div>	
					</ul>
				</div>
				<?php
				if ($layers) {
				foreach ($layers as $i => $item) {
					if(is_file(JPATH_SITE.'/'.$item->background)){
						$url_background = JURI::root().$item->background;
					}else{
						$url_background = $item->background;
					}
					$bgfit = isset($item->bgfit)?(!empty($item->bgfit)?$item->bgfit:'cover'):'cover';
					$sublayers = $item->slidesublayer;
					$count = count($sublayers,true);?>
				<div id="tabs-<?php echo $i;?>" class="tabs_wrap <?php echo $i==0?'jmtab_active':'';?>">
					<div class="jm_dl_slide_setting">
						<div class="jm_title_group header">Slide setting</div>
						<?php echo sprintf($this->initString->slide_setting,$i,$item->background,$model->getEffect($item->transition),$item->slotamount,$item->masterspeed,$item->link,$model->getTarget($item->target),$item->index,$item->thumb,$model->getBgfit($bgfit));?>
					</div>
					<div class="jm_dl_slide_preview">
						<div class="jm_title_group header">
							<label>Preview</label>
							<label class="using_grid_wrap">Snap to Grid:</label>
							<input type="checkbox" class="using_grid" onclick="Offdraggable(this);">
							<a onclick="showgrid(this);" class="checkbox_grid" href="javascript:void(0);">Toggle Show/Hide Grid</a>
						</div>
						<div class="jm_preview_wrap">
							<div class="preview_sublayer">
							<div class="iframe_preview_wrap"></div>
							<div class="preview_sublayer_inner" style="background-color:<?php echo $backgroundcolor;?>;background-size:<?php echo $bgfit;?>;background-image: url('<?php echo $url_background;?>');">
								<?php
								$deluxe_layer = null;
								if($sublayers){
									foreach($sublayers as $k=>$sublayer){
										$width_video = !empty($sublayer->width_video) ? $sublayer->width_video : 400;
										$height_video = !empty($sublayer->height_video) ? $sublayer->height_video : 200;
										$autoplay = !empty($sublayer->autoplay)?$sublayer->autoplay:'false';
										$content = !empty($sublayer->content)? $sublayer->content : '';
										$type = !empty($sublayer->type)? $sublayer->type : 'custom_html';
										$name_sublayer = !empty($sublayer->name_sublayer) ? $sublayer->name_sublayer : '';
										$speed = !empty($sublayer->speed) ? $sublayer->speed : '';
										$customin = !empty($sublayer->customin) ? $sublayer->customin : '';
										$customout = !empty($sublayer->customout) ? $sublayer->customout : '';
										$start = !empty($sublayer->start) ? $sublayer->start : 0;
										$endeasing = !empty($sublayer->endeasing) ? $sublayer->endeasing : '';
										$end = !empty($sublayer->end) ? $sublayer->end : $delay;
										$easing = !empty($sublayer->easing) ? $sublayer->easing : '';
										$captionhidden = !empty($sublayer->captionhidden) ? $sublayer->captionhidden : 0;
										$data_x = !empty($sublayer->data_x) ? $sublayer->data_x : '';
										$data_y = !empty($sublayer->data_y) ? $sublayer->data_y : '';
										$class_style = !empty($sublayer->class_style) ? $sublayer->class_style : '';
										$style = !empty($sublayer->style) ? $sublayer->style : '';
										$url_sublayer = !empty($sublayer->url_sublayer) ? $sublayer->url_sublayer : '';
										$sl_target = !empty($sublayer->sl_target)?$sublayer->sl_target: '_blank';
										$incoming = !empty($sublayer->incoming) ? $sublayer->incoming : '';
										$outgoing = !empty($sublayer->outgoing) ? $sublayer->outgoing : '';
									?>
										<div onclick="dragClick(this);" data-atl="<?php echo $k;?>" class="sublayer_drag sublayer<?php echo $k;?>" style="left:<?php echo $data_x;?>px;top:<?php echo $data_y;?>px;z-index:<?php echo ($count-$k);?>">
											<?php 
											$video_checked = '';
											$html_checked = '';
											$img_checked = '';
											if($type=='youtube'):
											$video_checked = "checked='checked'";
											$deluxe_layer .= sprintf($this->initString->sublayer_detail,$name_sublayer,$i,$k,$speed,$start,$model->getEasing($easing),$model->getCaptionhidden($captionhidden),$end,$model->getEasing($endeasing),$model->getIncoming($incoming),$model->getOutgoing($outgoing),'','','',$model->getTarget(),$model->getSelectStyle(),'','','','',$model->getTarget(),'','','',$model->getTypeVideo($type),$content,$width_video,$height_video,$model->getAutoPlay($autoplay),$style,$customin,$customout,$html_checked,$img_checked,$video_checked);
											$thum_image = "url(http://img.youtube.com/vi/".$content ."/mqdefault.jpg)";
											echo sprintf($this->initString->sublayer_video,$style,$width_video,$height_video,$thum_image);
											endif;
											if($type=='html5'):
											$video_checked = "checked='checked'";
											$deluxe_layer .= sprintf($this->initString->sublayer_detail,$name_sublayer,$i,$k,$speed,$start,$model->getEasing($easing),$model->getCaptionhidden($captionhidden),$end,$model->getEasing($endeasing),$model->getIncoming($incoming),$model->getOutgoing($outgoing),'','','',$model->getTarget(),$model->getSelectStyle(),'','','','',$model->getTarget(),'','','',$model->getTypeVideo($type),$content,$width_video,$height_video,$model->getAutoPlay($autoplay),$style,$customin,$customout,$html_checked,$img_checked,$video_checked);
											echo sprintf($this->initString->sublayer_video_html5,$style,$width_video,$height_video,$content);
											endif;
											if($type=='vimeo'):
											$video_checked = "checked='checked'";
											$deluxe_layer .= sprintf($this->initString->sublayer_detail,$name_sublayer,$i,$k,$speed,$start,$model->getEasing($easing),$model->getCaptionhidden($captionhidden),$end,$model->getEasing($endeasing),$model->getIncoming($incoming),$model->getOutgoing($outgoing),'','','',$model->getTarget(),$model->getSelectStyle(),'','','','',$model->getTarget(),'','','',$model->getTypeVideo($type),$content,$width_video,$height_video,$model->getAutoPlay($autoplay),$style,$customin,$customout,$html_checked,$img_checked,$video_checked);
											$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/" . $content . ".php"));
											$thum_image = "url(" .$hash[0]['thumbnail_medium'] .")";
											echo sprintf($this->initString->sublayer_video,$style,$width_video,$height_video,$thum_image);
											endif;
											if($type=='custom_html'):
											$html_checked = "checked='checked'"; 
											$deluxe_layer .= sprintf($this->initString->sublayer_detail,$name_sublayer,$i,$k,$speed,$start,$model->getEasing($easing),$model->getCaptionhidden($captionhidden),$end,$model->getEasing($endeasing),$model->getIncoming($incoming),$model->getOutgoing($outgoing), $content ,$style,$url_sublayer,$model->getTarget($sl_target),$model->getSelectStyle($class_style),$customin,$customout,'','',$model->getTarget(),'','','',$model->getTypeVideo(),'',$width_video,$height_video,$model->getAutoPlay(), '','','',$html_checked,$img_checked,$video_checked);
											echo sprintf($this->initString->sublayer_text,$style,$content);
											endif;
											if($type=='image'):
											$img_checked = "checked='checked'";
											$deluxe_layer .= sprintf($this->initString->sublayer_detail,$name_sublayer,$i,$k,$speed,$start,$model->getEasing($easing),$model->getCaptionhidden(),$end,$model->getEasing($endeasing),$model->getIncoming($incoming),$model->getOutgoing($outgoing), '','','',$model->getTarget(),$model->getSelectStyle($class_style),'','',$content,$url_sublayer,$model->getTarget($sl_target),$style,$customin,$customout,$model->getTypeVideo(),'',$width_video,$height_video,$model->getAutoPlay(), '','','',$html_checked,$img_checked,$video_checked);
											echo sprintf($this->initString->sublayer_img,$style,JURI::root() . $content);
											endif;?>
										</div>
								<?php }} ?>
							</div>
							</div>
							<div class="btn_preview_wrap">
								<a tabs="tabs-<?php echo $i;?>" class="btn_preview" onclick="previewSlider(this);">Enter Preview</a>
							</div>
						</div>
					</div>
					<div class='clr'></div>
					<div class="jm_dl_slide_timer">
						<div class="jm_title_group header">Timeline</div>
						<div class="timeline" id="global_timeline">
							<div class="timerdot" id="timeline_handle"></div>
							<div class="layertime" id="layer_timeline"></div>
							<div class="mintime">0 ms</div>
							<div class="maxtime"><?php echo $delay;?> ms</div>
						</div>
					</div>
					<div class="jm_dl_layer">
						<div class="jm_title_group header">
							<label>Animated items</label>
						</div>
						<div class="jm_sublayer">
							<?php echo $deluxe_layer;?>
						</div>
						<div data-tabs="#tabs-<?php echo $i;?>" class="jmlink_add_sublayer" onclick="addSublayer(this);"><a href="javascript:void(0);">Click to add new slide layer</a></div>
					</div>
				</div>
				<?php 	} }?>
			</div>
		</div>
	</div>
	<div class="copyright">
		<?php echo "Develop by JoomlaMan 2013 <a href='http://joomlaman.com' target='_blank'>joomlaman.com</a>";?>
	</div>
</div>
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>
<?php
$slide_setting = $model->removeNewLine($this->initString->slide_setting);
$link_tab = $model->removeNewLine($this->initString->link_tab);
$sublayer_detail = $model->removeNewLine($this->initString->sublayer_detail);
?>
<script type="text/javascript">
	var slide_setting = "<?php echo $slide_setting;?>";
	var link_tab = "<?php echo $link_tab;?>";
	var sublayer_detail = "<?php echo $sublayer_detail;?>";
    jQuery(document).ready(function(){
        draggable();
        activeMenu();
        sortable();
		sortableTabs();
        SublayeronReady();
        obj = jQuery('.link-tab:eq(0)').find('.jmlink-tab');
        jmtab(obj);
        if(jQuery('#toolbar-save .toolbar').length)
			jQuery('#toolbar-save .toolbar').attr('onclick','');
		else
			jQuery('#toolbar-save .btn').attr('onclick','');
        jQuery('#toolbar-save').click(function(){
			if(jQuery('.icon-32-save').length)
            jQuery('.icon-32-save').addClass('loading');
			else
			jQuery('#toolbar-save .btn').addClass('loading');
            savaData();
            return false;
        })
		jQuery('.typeofvideo').each(function(){
			changeTypeVideo(this);
		})
    }) 	
	Joomla.submitbutton = function(task) {
		if (task == 'slideshowslider.cancel') {
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
	}
	function showModal(obj){
		var href = jQuery(obj).data('href');
		SqueezeBox.open(href, {handler: 'iframe', size: {x: 800, y: 500}});
	}
    
    function savaData(){
        var layer = [];
        var title = jQuery('.val_title').val();
        jQuery('.tabs_wrap').each(function(e){
            var sublayer = [];
            var slide = new Object();
            var obj = jQuery(this);
            var self = this;
            slide.title = title;
            jQuery('.value_param',obj).each(function(){
                var data = jQuery(this).attr('data');
                if(data){slide[data] = jQuery(this).val();}
            })
            jQuery('.sublayer_wrap',obj).each(function(i){
                var option = new Object();
                var eq = jQuery(this).find('.delete_sublayer').data('atl');
                if(jQuery('.tab_img',this).is(':checked')){
                    var content = jQuery('.img_sublayer',this).val();
                    var type = 'image';
                    var style = jQuery('.image_sublayer_wrap .style_sublayer',this).val();
					var customin = jQuery('.image_sublayer_wrap .customin_sublayer',this).val();
					var customout = jQuery('.image_sublayer_wrap .customout_sublayer',this).val();
                    var url_sublayer = jQuery('.image_sublayer_wrap .link_sublayer_value',this).val();
                    var sl_target = jQuery('.image_sublayer_wrap .sl_link_target',this).val();
                }else if(jQuery('.tab_video',this).is(':checked')){
                    var content = jQuery('.idvideo_sublayer',this).val();
                    option.width_video = jQuery('.width_video_sublayer',this).val();
                    option.height_video = jQuery('.height_video_sublayer',this).val();
                    var type = jQuery('.typeofvideo',this).val();
                    var style = jQuery('.video_sublayer_wrap .style_sublayer',this).val();
                    var autoplay = jQuery('.video_sublayer_wrap .autoplayvideo',this).val();
					var customin = jQuery('.video_sublayer_wrap .customin_sublayer',this).val();
					var customout = jQuery('.video_sublayer_wrap .customout_sublayer',this).val();
                }else if(jQuery('.tab_html',this).is(':checked')){
                    var content = jQuery('.html_sublayer',this).val();
                    var type = 'custom_html';
                    var style = jQuery('.customhtml_sublayer_wrap .style_sublayer',this).val();
                    var url_sublayer = jQuery('.customhtml_sublayer_wrap .link_sublayer_value',this).val();
                    var sl_target = jQuery('.customhtml_sublayer_wrap .sl_link_target',this).val();
                    var class_style = jQuery('.customhtml_sublayer_wrap .class_style',this).val();
					var customin = jQuery('.customhtml_sublayer_wrap .customin_sublayer',this).val();
					var customout = jQuery('.customhtml_sublayer_wrap .customout_sublayer',this).val();
                }
                var data_x = parseFloat(jQuery('.sublayer'+eq,self).css('left'));
                var data_y = parseFloat(jQuery('.sublayer'+eq,self).css('top'));
                option.customin = customin;
                option.customout = customout;
                option.content = content;
                option.type = type;
                option.class_style = class_style;
                option.style = style;
                option.autoplay = autoplay;
                option.url_sublayer = url_sublayer;
                option.sl_target = sl_target;
                option.data_x = data_x.toFixed(1);
                option.data_y = data_y.toFixed(1);
				$_this = jQuery(this);
                jQuery('.value_option',$_this).each(function(){
					//alert(jQuery(this).val());
                    var data = jQuery(this).attr('data');
                    if(data){option[data] = jQuery(this).val();}
                })
                if(content){
                    sublayer[i] = option;
                }
            })
            slide.slidesublayer = sublayer;
            layer[e] = slide;
        })
        //alert(JSON.stringify(layer)); return;
        var str = new JM.Base64().base64Encode(JSON.encode(layer));
        var data = {data:str,slider_id:<?php echo $id; ?>,title:title};
        jQuery.ajax({
            type:"POST",
            url: "index.php?option=com_jm_deluxe_layer_slideshow&view=slideshowslider&format=layer",
            data: data,
            success: function(data){
				if(jQuery('.icon-32-save').length)
					jQuery('.icon-32-save').removeClass('loading');
				else
					jQuery('#toolbar-save .btn').removeClass('loading');
            }
        }) 
    
    }
    function addLayer(obj){
        var index = jQuery(obj).index();
		var setting = sprintf(slide_setting,index,'','<?php echo $model->getEffect();?>','','','','<?php echo $model->getTarget();?>','','','<?php echo $model->getBgfit();?>');
        var $html = '<div id="tabs-'+index+'" class="tabs_wrap">' 
            +'			<div class="jm_dl_slide_setting">'
            +'				<div class="jm_title_group header">Slide setting</div>'
			+ setting
            +'			</div>'
            +'		<div class="jm_dl_slide_preview">'  
            +'      	<div class="jm_title_group header">'
			+'				<label>Preview</label>'
			+'				<label class="using_grid_wrap">Snap to Grid:</label>'
			+'				<input type="checkbox" class="using_grid" onclick="Offdraggable(this);">'
			+'				<a onclick="showgrid(this);" class="checkbox_grid" href="javascript:void(0);">Toggle Show/Hide Grid</a>'
            +'			</div>'
            +'			<div class="jm_preview_wrap">'
            +'				<div class="preview_sublayer">'
            +'					<div class="iframe_preview_wrap"></div>'
            +'					<div class="preview_sublayer_inner"></div>'
            +'				</div>'
            +'				<div class="btn_preview_wrap">'
            +'					<a data-tabs="tabs-'+index+'" class="btn_preview" onclick="previewSlider(this);">Enter Preview</a>'
            +'				</div>'
            +'			</div>'
            +'		</div>'
            +'	<div class="jm_dl_slide_timer">'
            +'		<div class="jm_title_group header">Timeline</div>'
            +'	</div>'
            +'	<div class="jm_dl_layer">'
            +'		<div class="jm_title_group header">'
            +'			<label>Animated items</label>'
            +'		</div>'
            +'		<div class="jm_sublayer">'
            +'		</div>'
            +'		<div data-tabs="#tabs-'+index+'" class="jmlink_add_sublayer" onclick="addSublayer(this);"><a href="javascript:void(0);">Click to add new slide layer</a></div>'
            +'	</div>'
            +'</div>';
		var link = sprintf(link_tab,index,'');
        jQuery(obj).before(link);
        jQuery('.jm_dl_wrap_detail').append($html);
        obj = jQuery('.link-tab:eq('+index+')').find('.jmlink-tab');
        jmtab(obj);
        SqueezeBoxShow();
    }
    function SqueezeBoxShow(){
        SqueezeBox.assign($$('a.modal'), {
            parse: 'rel'
        })
    }
    function jmtab(obj){
        exitPreview();
        var $data_tab = jQuery(obj).data('tab');
        jQuery(obj).parent().addClass('link_jmtab_active');
        jQuery('#jm_dl_container').find('.tabs_wrap').not($data_tab).removeClass('jmtab_active');
        jQuery($data_tab).addClass('jmtab_active');
        jQuery('#jm_dl_container').find('.link-tab').not(jQuery(obj).parent()).removeClass('link_jmtab_active');
    }
    function showSublayer(obj){
        var element = jQuery(obj).parent().find('.jmsublayer_wrap');
        if(element.is(':hidden')){
            element.slideDown(500);
        }else{
            element.slideUp(500);
            return;
        }
        jQuery(obj).parent().parent().find('.jmsublayer_wrap')
        .not(element).slideUp(500);
    }
    function addSublayer(obj){
        var tabs = jQuery(obj).data('tabs');
        var o = jQuery(tabs);
        var length = jQuery('.sublayer_wrap',o).length; 
        var i = parseInt(jQuery(obj).parents('.tabs_wrap').index());
        var k = parseInt(length);
        var element = jQuery(o).find('.jmsublayer_wrap');
        if(element.is(':visible')){
            element.slideUp(500);
        }
        var html = sprintf(sublayer_detail,'Slide layer '+k,i,k,200,500,'<?php echo $model->getEasing();?>','<?php echo $model->getCaptionhidden(); ?>',3000,'<?php echo $model->getEasing();?>','<?php echo $model->getIncoming();?>','<?php echo $model->getOutgoing();?>', '','','','<?php echo $model->getTarget();?>','<?php echo $model->getSelectStyle();?>','','','','','<?php echo $model->getTarget();?>','','','','<?php echo $model->getTypeVideo();?>','',400,200,'<?php echo $model->getAutoPlay();?>', '','','',"checked='checked'",'','');
        jQuery('.jm_sublayer',o).append(html);
        addSublayerDrag(o);
        SqueezeBoxShow();
    }
    function clearBackground(obj){
        tabs = jQuery(obj).attr('data-tab');
        var o = jQuery(tabs);
        jQuery(obj).parent().find('.media-upload').val('');
        if(jQuery(obj).parent().find('.background_layer').length){
            jQuery('.preview_sublayer_inner',o).css({'background-image':'none'});
        }
        return;
    }
	
	function Offdraggable(obj){
		var tabs = jQuery(obj).parents('.tabs_wrap');
		if(jQuery(obj).is(':checked')){
			jQuery(".sublayer_drag",tabs).each(function(){
				jQuery(this).draggable({grid: [ 10,10 ]});
			});
		}else{
			jQuery(".sublayer_drag",tabs).each(function(){
				jQuery(this).draggable({grid: [ 1,1 ]});
			});
		}
	}
	
    function draggable(){
        jQuery(".sublayer_drag").each(function(){
            jQuery(this).draggable({grid: [ 1,1 ],
				stop: function( event, ui ) {}
			});
        });
    }
    function sortable(){
        jQuery(".jm_sublayer").each(function(){
            jQuery(this).sortable({
				cancel: '.transition_sublayer,.easing_sublayer,.html_sublayer,.jmsublayer_wrap,.name_sublayer',
				beforeStop:function( event, ui ){
					orderItems(this);
				}
			});
        });
    }
	function orderItems(obj){
		var count = jQuery('.sublayer_wrap',obj).length;
		var tabs = jQuery(obj).parents('.tabs_wrap');
		jQuery('.sublayer_wrap',obj).each(function(){
			var index = jQuery(this).index(); 
			var atl = jQuery(this).find('.delete_sublayer').data('atl');
			jQuery('.sublayer'+atl, tabs).css({'z-index':(count-index)});
		})
	}
	function sortableTabs(){
        jQuery(".jmtabsnav").each(function(){
            jQuery(this).sortable({
				cancel: '.transition_sublayer,.easing_sublayer,.html_sublayer,.jmsublayer_outer,.name_sublayer',
				beforeStop:function( event, ui ){
					moveTab(ui.item);
				}
			});
        });
    }
	
	function moveTab(obj){
		var index = jQuery(obj).index();
		var tab = jQuery(obj).find('.jmlink-tab').data('tab');
		var count_tab = jQuery('.tabs_wrap').length;
		var item = jQuery(tab);
		if(index==0){
			var c_tab = jQuery('.tabs_wrap:eq(0)').attr('id');
			if(tab != '#'+c_tab){
				jQuery('.tabs_wrap:eq(0)').before(item);
			}
		}
		else if(index==(count_tab-1)){
			var c_tab = jQuery('.tabs_wrap:eq('+(count_tab-1)+')').attr('id');
			if((tab != '#'+c_tab)){
				jQuery('.tabs_wrap:eq('+(count_tab-1)+')').after(item);
			}
		}
		else {
			var c_tab = jQuery('.tabs_wrap:eq('+index+')').attr('id');
			if(tab != '#'+c_tab){
				jQuery('.tabs_wrap:eq('+(index-1)+')').after(item);
			}
		}
	}
    function SublayeronReady(){
        jQuery('.tabs_wrap').each(function(){
            jQuery('.jmsublayer_wrap:not(:last)',this).hide(); 
        })
    }
    function addSublayerDrag(obj){
        jQuery('.sublayer_wrap',obj).each(function(i){
            changeContent(this);
        })
        draggable();
    }
	
	function changeTypeVideo(obj){
		var type_video = jQuery(obj).val();
		var parent = jQuery(obj).parents('.video_sublayer_wrap');
		if(type_video=='html5'){
			jQuery('.videoid_wrap label',parent).text('Url of video');
			jQuery('.video_width_wrap',parent).hide();
			jQuery('.video_height_wrap',parent).hide();
		}else{
			jQuery('.videoid_wrap label',parent).text('ID of video');
			jQuery('.video_width_wrap',parent).show();
			jQuery('.video_height_wrap',parent).show();
		}
	}

    function changeContent(obj){
        exitPreview();
		if(!jQuery(obj).hasClass('sublayer_wrap')) obj = jQuery(obj).parents('.sublayer_wrap');
        var eq = jQuery(obj).index();
		var atl = jQuery(obj).find('.delete_sublayer').data('atl');
        var tabs = jQuery(obj).parents('.tabs_wrap');
        var content = '',src = '',width_video = '',height_video = '',html ='',type = '',new_style = '',value = '';
        if(jQuery('.tab_img',obj).is(':checked')){
            value = jQuery('.img_sublayer',obj).val();
            if(!value) return;
            type = "image";
            src = "<?php echo JURI::root(); ?>"+value;
            content = '<img class="img_drag" src="'+src+'" />';
            new_style = jQuery('.image_sublayer_wrap .style_sublayer',obj).val();
        }
        if(jQuery('.tab_video',obj).is(':checked')){
            value = jQuery('.idvideo_sublayer',obj).val();
            width_video = jQuery('.width_video_sublayer',obj).val();
            height_video = jQuery('.height_video_sublayer',obj).val();
            if(!value) return;
            type = jQuery('.typeofvideo',obj).val();
            new_style = jQuery('.video_sublayer_wrap .style_sublayer',obj).val();
            if(type=="youtube"){
                content = '<div class="thumb_video" style="width:'+width_video+'px;height:'+height_video+'px;background-image:url(http://img.youtube.com/vi/'+value+'/mqdefault.jpg)"></div>';
            } if(type=="html5"){
				content = '<video class="video-js vjs-default-skin" preload="none" width="100%" height="100%" poster=""><source src="'+value+'"/></video>';
			}else if(type=="vimeo"){
                jQuery.getJSON('http://www.vimeo.com/api/v2/video/' + value + '.json?callback=?', {format: "json"}, function(data) {
                    content = '<div class="thumb_video" style="width:'+width_video+'px;height:'+height_video+'px;background-image:url('+data[0].thumbnail_medium+')"></div>';
                    if(jQuery('.sublayer'+atl,tabs).length){
                        jQuery('.sublayer'+atl,tabs).html('<div class="content_tpl_wrap" style="'+new_style+'">'+content+'</div>');
                    }else{
                        html = '<div onclick="dragClick(this);" data-atl="'+eq+'" class="sublayer_drag sublayer'+eq+'"><div class="content_tpl_wrap" style="'+new_style+'">'+content+'</div></div>';
                        jQuery('.preview_sublayer .preview_sublayer_inner',tabs).append(html);
                    }
                    return false;
                }) 
            }
        }
        if(jQuery('.tab_html',obj).is(':checked')){
            content = jQuery('.html_sublayer',obj).val();
            new_style = jQuery('.customhtml_sublayer_wrap .style_sublayer',obj).val();
        }
        if(jQuery('.sublayer'+atl,tabs).length){
			jQuery('.sublayer'+atl,tabs).html('<div class="content_tpl_wrap" style="'+new_style+'">'+content+'</div>');
        }else{
            html = '<div onclick="dragClick(this);" data-atl="'+eq+'" class="sublayer_drag sublayer'+eq+'"><div class="content_tpl_wrap" style="'+new_style+'">'+content+'</div></div>';
            jQuery('.preview_sublayer .preview_sublayer_inner',tabs).append(html);
        }
    }
    function changeBackground(value,obj){
        var tabs = jQuery('#'+obj).data('tabs');
        var o = jQuery(tabs);
        jQuery('.preview_sublayer_inner',o).css({'background-image':"url(<?php echo JURI::root(); ?>"+value+")"});
    }
    function changeBackgroundSize(obj){
        var tabs = jQuery(obj).parents('.tabs_wrap');
		var bg_size = jQuery(obj).val();
        jQuery('.preview_sublayer_inner',tabs).css({'background-size':bg_size});
    }
    function removeLayer(obj){
        var tabs = jQuery(obj).parent().find('.jmlink-tab').data('tab');  
        var index = jQuery(obj).parent().index();
        jQuery(tabs).remove();
        jQuery(obj).parent().remove();
        if(index==0){
            obj = jQuery('.jmtabsnav .link-tab:eq('+index+')').find('.jmlink-tab');
        }else{
            obj = jQuery('.jmtabsnav .link-tab:eq('+(index-1)+')').find('.jmlink-tab');
        }
        jmtab(obj);
    }
    function removeSublayer(obj){
        var tabs = jQuery(obj).data('tabs');
        var o = jQuery(tabs);
        jQuery(obj).parents('.sublayer_wrap').remove(); 
        var eq = jQuery(obj).data('atl');
        jQuery('.sublayer_drag.sublayer'+eq,o).remove();
    }
    function dragClick(obj){
        var index = jQuery(obj).data('atl');
        var tabs = jQuery(obj).parents('.tabs_wrap');
        jQuery('.sublayer_wrap .delete_sublayer',tabs).each(function(){
            var atl = jQuery(this).data('atl');
            if(atl==index){
                var layer = jQuery(this).parent(); 
                var parents = jQuery(this).parents('.sublayer_wrap'); 
                showSublayer(layer);
				var start_sublayer = jQuery('.start_sublayer',parents).val();
				var end_sublayer = jQuery('.end_sublayer',parents).val();
				var full_width = <?php echo $delay;?>;
				if(end_sublayer>full_width) end_sublayer = full_width;
				var width = (end_sublayer-start_sublayer)*100/full_width;
				var left = start_sublayer*100/full_width;
				jQuery('.layertime',tabs).attr('style','width:'+width+'%;left:'+left+'%');
				
            }
        })
    }
    function previewSlider(obj){
        if(jQuery(obj).hasClass('iframe_active')){
            jQuery(obj).removeClass('iframe_active');
            jQuery(obj).text('Enter Preview');
            jQuery(obj).parents('.jm_preview_wrap').find('.iframe_preview_wrap').hide();
            jQuery(obj).parents('.jm_preview_wrap').find('.preview_sublayer_inner').show();
        }else{  
            var data = "id=<?php echo $id; ?>";
            jQuery(obj).addClass('iframe_active');
            jQuery(obj).text('Exit Preview');
            jQuery(obj).parents('.jm_dl_slide_preview').find('.preview_sublayer_inner').hide();
            jQuery.ajax({
                type:"POST",
                url: "index.php?option=com_jm_deluxe_layer_slideshow&view=slideshowslider&format=ajax",
                data: data,
                success: function(data){
                    jQuery(obj).parents('.jm_dl_slide_preview').find('.iframe_preview_wrap').html(data).show();
                    iView();
                }
            })
        } 
        return false;
    }

    function iView(){
        if (jQuery.fn.cssOriginal!=undefined) jQuery.fn.css = tpj.fn.cssOriginal;
        jQuery('.banner').revolution(
        {
            delay:<?php echo $delay; ?>,
            startheight:<?php echo $height; ?>,
            startwidth:<?php echo $startWidth; ?>,
            hideThumbs:<?php echo $hideThumbs; ?>,
            thumbWidth:<?php echo $thumbWidth; ?>,
            thumbHeight:<?php echo $thumbHeight; ?>,
            thumbAmount:<?php echo $thumbAmount; ?>,
            navigationType:"<?php echo $navigationType; ?>",
            navigationArrows:"<?php echo $navigationArrows; ?>",
            navigationStyle:"<?php echo $navigationStyle; ?>",	
            navigationHAlign:"<?php echo $navigationHAlign; ?>",
            navigationVAlign:"<?php echo $navigationVAlign; ?>",
            navigationHOffset:<?php echo $navigationHOffset; ?>,
            navigationVOffset:<?php echo $navigationVOffset; ?>,
            soloArrowLeftHalign:"<?php echo $soloArrowLeftHalign; ?>",
            soloArrowLeftValign:"<?php echo $soloArrowLeftValign; ?>",
            soloArrowLeftHOffset:<?php echo $soloArrowLeftHOffset; ?>,
            soloArrowLeftVOffset:<?php echo $soloArrowLeftVOffset; ?>,
            soloArrowRightHalign:"<?php echo $soloArrowRightHalign; ?>",
            soloArrowRightValign:"<?php echo $soloArrowRightValign; ?>",
            soloArrowRightHOffset:<?php echo $soloArrowRightHOffset; ?>,
            soloArrowRightVOffset:<?php echo $soloArrowRightVOffset; ?>,
            touchenabled:"<?php echo $touchenabled; ?>",
            onHoverStop:"<?php echo $onhover; ?>",
            stopAtSlide:-1,	
            stopAfterLoops:-1,	
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            hideSliderAtLimit:0,	
            shadow:0,
			shuffle:"<?php echo $shuffle; ?>",						
            fullWidth:"<?php echo $fullwidth; ?>",
			shuffle:"<?php echo $shuffle; ?>",
			parallax:"<?php echo $parallax; ?>",
			parallaxLevels: <?php echo $parallaxLevels; ?>,
			parallaxBgFreeze: "<?php echo $parallaxBgFreeze; ?>"
        });
    }
    function showgrid(obj){
        exitPreview();
        var length = jQuery(obj).parents('.jm_dl_slide_preview').find('.grid_10x10').length;
        if(length){
            jQuery(obj).parents('.jm_dl_slide_preview').find('.preview_sublayer_inner').removeClass('grid_10x10');
        }else{
            jQuery(obj).parents('.jm_dl_slide_preview').find('.preview_sublayer_inner').addClass('grid_10x10');
        }
        return false;
    }
    function exitPreview(){
        jQuery('.btn_preview').each(function(){
            if(jQuery(this).hasClass('iframe_active')){
                previewSlider(this);
            }
        })
    }
    function fiterStyle(obj){
        var styles = [];
        styles['Large_White_Text_Left'] = 'color: #fff;text-shadow: none;font-weight: 700; font-size: 46px; line-height: 46px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left;';
        styles['Large_White_Text_Right'] = 'color: #fff;text-shadow: none;font-weight: 700; font-size: 46px; line-height: 46px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:right;';
        styles['Large_White_Text_Centered'] = 'color: #fff;text-shadow: none;font-weight: 700; font-size: 46px; line-height: 46px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:center;';
        styles['Large_Black_Text_Left'] = 'color: #000;text-shadow: none;font-weight: 700; font-size: 46px; line-height: 46px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left;';
        styles['Large_Black_Text_Right'] = 'color: #000;text-shadow: none;font-weight: 700; font-size: 46px; line-height: 46px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:right;';
        styles['Large_Black_Text_Centered'] = ' color: #000;text-shadow: none;font-weight: 700; font-size: 46px; line-height: 46px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:center;';
        styles['Medium_White_Text_Left'] = 'color: #fff;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left;';
        styles['Medium_White_Text_Right'] = 'color: #fff;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:right;';
        styles['Medium_White_Text_Centered'] = 'color: #fff;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:center;';
        styles['Medium_Black_Text_Left'] = 'color: #000;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left;';
        styles['Medium_Black_Text_Right'] = 'color: #000;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:right;';
        styles['Medium_Black_Text_Centered'] = 'color: #000;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:center;';
        styles['Small_White_Text_Left'] = 'color: #fff;text-shadow: none;font-weight: 300; font-size: 24px; line-height: 24px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left;';
        styles['Small_White_Text_Right'] = 'color: #fff;text-shadow: none;font-weight: 300; font-size: 24px; line-height: 24px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:right;';
        styles['Small_White_Text_Centered'] = 'color: #fff;text-shadow: none;font-weight: 300; font-size: 24px; line-height: 24px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:center;';
        styles['Small_Black_Text_Left'] = 'color: #000;text-shadow: none;font-weight: 300; font-size: 24px; line-height: 24px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left;';
        styles['Small_Black_Text_Right'] = 'color: #000;text-shadow: none;font-weight: 300; font-size: 24px; line-height: 24px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:right;';
        styles['Small_Black_Text_Centered'] = 'color: #000;text-shadow: none;font-weight: 300; font-size: 24px; line-height: 24px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:center;';
        styles['Medium_White_Text_Left_Background'] = 'color: #fff;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left; background-color:#000;';
        styles['Medium_Black_Text_Left_Background'] = 'color: #000;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left; background-color:#fff;';
        styles['Medium_Orange_Text_Left'] = 'color: #ff7302;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left;';
        styles['Medium_Red_Text_Left'] = ' color: #db0000;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left;';
        styles['Medium_Green_Text_Left'] = 'color: #00a22a;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left;';
        styles['Medium_Blue_Text_Left'] = 'color: #1e2395;text-shadow: none;font-weight: 500; font-size: 36px; line-height: 36px; font-family: Arial; padding: 0px 4px; padding-top: 1px;margin: 0px; border-width: 0px; border-style: none; letter-spacing: -1.5px; text-align:left;';
		var style = jQuery(obj).val();
        jQuery(obj).parents('.content_outer').find('.style_sublayer').val(styles[style]);
        changeContent(jQuery(obj).parents('.sublayer_wrap'));
    }
    
    function activeMenu(){
        var layout = "<?php echo $layout;?>";
        if(layout=='layerslider'){
            jQuery('#submenu li a:last').addClass('active');
        }else{
            jQuery('#submenu li a:first').addClass('active');
        }
    }
	function orderDown(obj){
		var tabs = jQuery(obj).parents('.tabs_wrap');
		var item = jQuery(obj).parents('.sublayer_wrap');
		var o = jQuery(obj).parents('.jm_sublayer');
		var count = jQuery(item).next().length;
		if (!count){
			jQuery('.sublayer_wrap:eq(0)',o).before(item);
		}else{
			jQuery(item).next().after(item);
		}
		orderItems(o);
	}
	function orderUp(obj){
		var tabs = jQuery(obj).parents('.tabs_wrap');
		var item = jQuery(obj).parents('.sublayer_wrap');
		var o = jQuery(obj).parents('.jm_sublayer');
		var count = jQuery(item).prev().length;
		if (!count){
			jQuery('.sublayer_wrap:last',o).after(item);
		}else{
			jQuery(item).prev().before(item);
		}
		orderItems(o);
	}
	
	function toogleViewLayer(obj){
		var tabs = jQuery(obj).parents('.tabs_wrap');
		var item = jQuery(obj).parents('.sublayer_wrap');
		var atl = item.find('.delete_sublayer').data('atl');
		if(jQuery(obj).hasClass('off')){
			jQuery(obj).removeClass('off');
			jQuery('.sublayer'+atl, tabs).css({'display':'block'});
		}else{
			jQuery(obj).addClass('off');
			jQuery('.sublayer'+atl, tabs).css({'display':'none'});
		}
	}
</script> 