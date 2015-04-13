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
JHtml::_('behavior.tooltip');
JHTML::_('script', 'system/multiselect.js', false, true);
$layout = JRequest::getVar('layout');
// Import CSS
$document = JFactory::getDocument();
if($this->isJoomla3){
    $document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/jmparallax_slideshow_j3.css');
    $document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/layerslider_j3.css');
}else{
    $document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/jmparallax_slideshow.css');
    $document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/layerslider.css'); 
	$document->addScript('components/com_jm_deluxe_layer_slideshow/assets/js/jquery-1.7.1.js'); 
}
$document->addStyleSheet('components/com_jm_deluxe_layer_slideshow/assets/css/farbtastic.css');
$id = JRequest::getVar('id'); 
JHTML::_('behavior.modal');
$settings = (json_decode(base64_decode($this->item->setting)));
	$delay = isset($settings->delay)?(!empty($settings->delay)?$settings->delay:9000):9000;
	$width = isset($settings->width)?(!empty($settings->width)?$settings->width:800):800;
	$height = isset($settings->height)?(!empty($settings->height)?$settings->height:350):350;
	$responsive = isset($settings->responsive)?(!empty($settings->responsive)?$settings->responsive:0):0;
	$fullwidth = isset($settings->fullwidth)?(!empty($settings->fullwidth)?$settings->fullwidth:'off'):'off';
	$fullScreen = isset($settings->fullScreen)?(!empty($settings->fullScreen)?$settings->fullScreen:'off'):'off';
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
	$hideThumbs = isset($settings->hideThumbs)?(!empty($settings->hideThumbs)?$settings->hideThumbs:0):200;
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
if($this->isJoomla3){
	$menu = '
	<div class="slideshow_setting_wrap">
		<a class="slideshow_setting" href="'.JURI::base().'index.php?option=com_jm_deluxe_layer_slideshow&view=slideshowslider&layout=layerslider&id='.$id.'">Slideshow</a>
	</div>';
}
?>
<script src="<?php echo JURI::root() . 'administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jquery.jmfields.js'; ?>"></script>
<script src="<?php echo JURI::root() . 'administrator/components/com_jm_deluxe_layer_slideshow/assets/js/jmbase64.min.js'; ?>"></script>
<script src="<?php echo JURI::root() . 'administrator/components/com_jm_deluxe_layer_slideshow/assets/js/mediaupload.js'; ?>"></script>
<form action="<?php echo JRoute::_('index.php?option=com_jm_deluxe_layer_slideshow&view=slideshowsliders&layout=globalsettings&id=' . (int) $id); ?>" method="post" name="adminForm" id="adminForm">
    <div class="jmglobal_setting_wrap">
        <div class="left">
            <div class="panel basic_setting">
                <h3 class="jm_title_group">Basic settings</h3> 
                <div class="basic_setting_inner">
                    <div class="params_wrap delay">
                        <div class="label fleft">Delay</div>
                        <div class="params fleft"><input value="<?php echo $delay; ?>" class="jm-field slide_delay value_setting" data="delay" type="text"/></div>
                        <div class="desc fleft">The time one slide stays on the screen(ms)</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap fullwidth">
                        <div class="label fleft">Full width slider</div>
                        <div class="params fleft">
                            <input type="checkbox" <?php echo $fullwidth == 'on' ? 'checked="checked"' : ''; ?> class="slide_fullwidth jm-field onoff value_setting" data="fullwidth" value="on"/>
                        </div>
                        <div class="desc fleft">Enable this option for your layers to work for full width</div>
                    </div>
                    <div class="clear"></div>
					<div class="params_wrap fullcsreen">
                        <div class="label fleft">Full screen slider</div>
                        <div class="params fleft">
                            <input type="checkbox" <?php echo $fullScreen == 'on' ? 'checked="checked"' : ''; ?> class="slide_fullscreen jm-field onoff value_setting" data="fullScreen" value="on"/>
                        </div>
                        <div class="desc fleft">defines if the fullscreen mode is activated</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap width">
                        <div class="label fleft">Width</div>
                        <div class="params fleft"><input value="<?php echo $width; ?>" class="jm-field slide_width value_setting" data="width" type="text"/></div>
                        <div class="desc fleft">Slideshow width in pixels</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap height">
                        <div class="label fleft">Height</div>
                        <div class="params fleft"><input value="<?php echo $height; ?>" class="jm-field slide_height value_setting" data="height" type="text"/></div>
                        <div class="desc fleft">Slideshow height in pixels</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap responsive">
                        <div class="label fleft">Responsive</div>
                        <div class="params fleft">
                            <input type="checkbox" <?php echo $responsive ? 'checked="checked"' : ''; ?> class="slide_responsive jm-field onoff value_setting" data="responsive" value="on"/>
                        </div>
                        <div class="desc fleft">Enable this option to make the slideshow responsive</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap touchenabled ">
                        <div class="label fleft">Touchenabled </div>
                        <div class="params fleft">
                            <input type="checkbox" <?php echo $touchenabled == 'on' ? 'checked="checked"' : ''; ?> class="slide_touchenabled jm-field onoff value_setting" data="touchenabled" value="on"/>
                        </div>
                        <div class="desc fleft">Enable Swipe Function on touch devices (Default: "on")</div>
                    </div>
                    <div class="clear"></div>
					<div class="params_wrap shuffle">
                        <div class="label fleft">Shuffle  </div>
                        <div class="params fleft">
                            <input type="checkbox" <?php echo $shuffle == 'on' ? 'checked="checked"' : ''; ?> class="slide_shuffle jm-field onoff value_setting" data="shuffle" value="on"/>
                        </div>
                        <div class="desc fleft">Randomize the list elements at start</div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="panel apprearance_setting">
                <h3 class="jm_title_group">Appearance settings</h3>
                <div class="apprearance_setting_inner">
                    <div class="params_wrap backgroundcolor">
                        <div class="label fleft">Background color</div>
                        <div class="params fleft"><?php echo $this->form->getInput('backgroundcolor'); ?></div>
                        <div id="colorpicker"></div>
                        <div class="desc fleft">Background color of the slideshow</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap backgroundimage">
                        <div class="label fleft">Background image</div>
                        <div class="params fleft">
                            <input type="text"  onclick="showModal(this);" value="<?php echo $backgroundimage; ?>" class="slide_backgroundimage media-upload jm-field value_setting" data="backgroundimage" readonly="readonly" value="" id="background_image"/>
                            <a rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="index.php?option=com_media&view=images&tmpl=component&asset=com_jm_deluxe_layer_slideshow&fieldid=background_image" title="Select" class="modal">Select</a>
                            <span onclick="clearBackground(this);" class="btn-clear" >x</span>
                        </div>
                        <div class="desc fleft">Background image of slideshow</div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="panel slideshow_setting">
                <h3 class="jm_title_group">Slideshow settings<?php echo $this->isJoomla3?$menu:'';?></h3> 
                <div class="slideshow_setting_inner">
                    <div class="params_wrap onhover">
                        <div class="label fleft">Pause on hover</div> 
                        <div class="params fleft"><input type="checkbox" <?php echo $onhover == 'on' ? 'checked="checked"' : ''; ?> class="slide_onhover jm-field onoff value_setting" data="onhover" value="on"/></div>
                        <div class="desc fleft">Stop the Timer if mouse is hovering the Slider.</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap navigationtype">
                        <div class="label fleft">Navigation type</div>
                        <div class="params fleft">
                            <select class="jm-field single slide_navigationtype value_setting" data="navigationType">
                                <option <?php echo $navigationType == 'bullet' ? 'selected="selected"' : ''; ?> value="bullet">bullet</option>
                                <option  <?php echo $navigationType == 'thumb' ? 'selected="selected"' : ''; ?> value="thumb">thumb</option>
                                <option <?php echo $navigationType == 'none' ? 'selected="selected"' : ''; ?> value="none">none</option>
                            </select>
                        </div>
                        <div class="desc fleft">Display type of the navigation bar</div>
                    </div>
                    <div class="clear"></div>
					<div class="params_wrap navigationarrows ">
                        <div class="label fleft">Navigation Arrows </div>
                        <div class="params fleft">
                            <select class="jm-field single slide_navigationarrows value_setting" data="navigationArrows">
                                <option <?php echo $navigationArrows == 'nexttobullets' ? 'selected="selected"' : ''; ?> value="nexttobullets">nexttobullets</option>
                                <option  <?php echo $navigationArrows == 'verticalcentered' ? 'selected="selected"' : ''; ?> value="verticalcentered">verticalcentered</option>
                                <option  <?php echo $navigationArrows == 'solo' ? 'selected="selected"' : ''; ?> value="solo">solo</option>
                            </select>
                        </div>
                        <div class="desc fleft">Display position of the Navigation Arrows</div>
                    </div>
                    <div class="clear"></div>
					<div class="params_wrap thumbwidth">
                        <div class="label fleft">Thumbnail width</div>
                        <div class="params fleft"><input class="jm-field slide_thumbwidth value_setting" data="thumbWidth" value="<?php echo $thumbWidth; ?>" type="text"/></div>
                        <div class="desc fleft">The width of the thumbnails in the navigation area</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap thumbheight">
                        <div class="label fleft">Thumbnail height</div>
                        <div class="params fleft"><input class="jm-field slide_thumbheight value_setting" data="thumbHeight" value="<?php echo $thumbHeight; ?>" type="text"/></div>
                        <div class="desc fleft">The height of the thumbnails in the navigation area</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap thumbAmount">
                        <div class="label fleft">Thumbnail Amount</div>
                        <div class="params fleft"><input class="jm-field slide_thumbAmount value_setting" data="thumbAmount" value="<?php echo $thumbAmount; ?>" type="text"/></div>
                        <div class="desc fleft">The Amount of visible Thumbs in the same time</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap hideThumbs">
                        <div class="label fleft">Hide thumbnail</div>
                        <div class="params fleft"><input class="jm-field slide_hideThumbs value_setting" data="hideThumbs" value="<?php echo $hideThumbs; ?>" type="text"/></div>
                        <div class="desc fleft">0 - Never hide Thumbs</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap navigationstyle ">
                        <div class="label fleft">Navigation style</div>
                        <div class="params fleft">
                            <select class="jm-field single slide_navigationstyle value_setting" data="navigationStyle">
                                <option <?php echo $navigationStyle == 'round' ? 'selected="selected"' : ''; ?> value="round">round</option>
                                <option <?php echo $navigationStyle == 'square' ? 'selected="selected"' : ''; ?> value="square">square</option>
                                <option <?php echo $navigationStyle == 'round-old' ? 'selected="selected"' : ''; ?> value="round-old">round-old</option>
                                <option <?php echo $navigationStyle == 'square-old' ? 'selected="selected"' : ''; ?> value="square-old">square-old</option>
                                <option <?php echo $navigationStyle == 'navbar-old' ? 'selected="selected"' : ''; ?> value="navbar-old">navbar-old</option>
                            </select>
                        </div>
                        <div class="desc fleft">Look of the navigation bullets if navigationType "bullet" selected</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap navigationHAlign">
                        <div class="label fleft">Navigation HAlign</div>
                        <div class="params fleft">
                            <select class="jm-field single slide_navigationHAlign value_setting" data="navigationHAlign">
                                <option <?php echo $navigationHAlign == 'left' ? 'selected="selected"' : ''; ?> value="left">left</option>
                                <option <?php echo $navigationHAlign == 'center' ? 'selected="selected"' : ''; ?> value="center">center</option>
                                <option <?php echo $navigationHAlign == 'right' ? 'selected="selected"' : ''; ?> value="right">right</option>
                            </select>
                        </div>
                        <div class="desc fleft">Possible values navigationHAlign</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap navigationVAlign">
                        <div class="label fleft">Navigation VAlign</div>
                        <div class="params fleft">
                            <select class="jm-field single slide_navigationVAlign value_setting" data="navigationVAlign">
                                <option <?php echo $navigationVAlign == 'top' ? 'selected="selected"' : ''; ?> value="top">top</option>
                                <option <?php echo $navigationVAlign == 'center' ? 'selected="selected"' : ''; ?> value="center">center</option>
                                <option <?php echo $navigationVAlign == 'bottom' ? 'selected="selected"' : ''; ?> value="bottom">bottom</option>
                            </select>
                        </div>
                        <div class="desc fleft">Possible values navigationVAlign</div>
                    </div>
                    <div class="clear"></div>
					<div class="params_wrap navigationHOffset ">
                        <div class="label fleft">navigationHOffset </div>
                        <div class="params fleft">
                           <input value="<?php echo $navigationHOffset ; ?>" class="jm-field slide_navigationHOffset  value_setting" data="navigationHOffset" type="text"/>
                        </div>
                        <div class="desc fleft">Horizontal Offset of the Navigation</div>
                    </div>
                    <div class="clear"></div>
					<div class="params_wrap navigationVOffset">
                        <div class="label fleft">navigationVOffset</div>
                        <div class="params fleft">
                            <input value="<?php echo $navigationVOffset; ?>" class="jm-field slide_navigationVOffset value_setting" data="navigationVOffset" type="text"/>
                        </div>
                        <div class="desc fleft">Vertical Offset of the Navigation</div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div><div class="panel apprearance_setting">
                <h3 class="jm_title_group">Advanced settings</h3>
                <div class="apprearance_setting_inner">
                    <div class="params_wrap parallax">
                        <div class="label fleft">Parallax</div>
                        <div class="params fleft">
                            <select class="jm-field single slide_parallax value_setting" data="parallax">
                                <option <?php echo $parallax == 'off' ? 'selected="selected"' : ''; ?> value="off">Off</option>
                                <option  <?php echo $parallax == 'scroll' ? 'selected="selected"' : ''; ?> value="scroll">Scroll</option>
							</select>
                        </div>
                        <div class="desc fleft">Parallax for slider</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap parallaxLevels">
                        <div class="label fleft">parallaxLevels</div>
                        <div class="params fleft">
                            <select class="jm-field single slide_parallaxLevels value_setting" data="parallaxLevels">
                                <option <?php echo $parallaxLevels == '10' ? 'selected="selected"' : ''; ?> value="10">10</option>
                                <option <?php echo $parallaxLevels == '15' ? 'selected="selected"' : ''; ?> value="15">15</option>
                                <option <?php echo $parallaxLevels == '20' ? 'selected="selected"' : ''; ?> value="20">20</option>
                                <option <?php echo $parallaxLevels == '25' ? 'selected="selected"' : ''; ?> value="25">25</option>
                                <option <?php echo $parallaxLevels == '30' ? 'selected="selected"' : ''; ?> value="30">30</option>
                                <option <?php echo $parallaxLevels == '35' ? 'selected="selected"' : ''; ?> value="35">35</option>
                                <option <?php echo $parallaxLevels == '40' ? 'selected="selected"' : ''; ?> value="40">40</option>
                                <option <?php echo $parallaxLevels == '45' ? 'selected="selected"' : ''; ?> value="45">45</option>
                                <option <?php echo $parallaxLevels == '50' ? 'selected="selected"' : ''; ?> value="50">50</option>
                                <option <?php echo $parallaxLevels == '55' ? 'selected="selected"' : ''; ?> value="55">55</option>
                                <option <?php echo $parallaxLevels == '60' ? 'selected="selected"' : ''; ?> value="60">60</option>
                                <option <?php echo $parallaxLevels == '65' ? 'selected="selected"' : ''; ?> value="65">65</option>
                                <option <?php echo $parallaxLevels == '70' ? 'selected="selected"' : ''; ?> value="70">70</option>
                                <option <?php echo $parallaxLevels == '75' ? 'selected="selected"' : ''; ?> value="75">75</option>
                                <option <?php echo $parallaxLevels == '80' ? 'selected="selected"' : ''; ?> value="80">80</option>
                                <option <?php echo $parallaxLevels == '85' ? 'selected="selected"' : ''; ?> value="85">85</option>
							</select>
                        </div>
                        <div class="desc fleft">Parallax effect for slider</div>
                    </div>
                    <div class="clear"></div>
                    <div class="params_wrap parallaxBgFreeze">
                        <div class="label fleft">parallaxBgFreeze</div> 
                        <div class="params fleft"><input type="checkbox" <?php echo $parallaxBgFreeze == 'on' ? 'checked="checked"' : ''; ?> class="slide_parallaxBgFreeze jm-field onoff value_setting" data="parallaxBgFreeze" value="on"/></div>
                        <div class="desc fleft">Parallax Background Freeze</div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>

        <div>
            <div>
                <input type="hidden" name="task" value="" />
                <input type="hidden" name="boxchecked" value="0" />
                <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
                <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
                <?php echo JHtml::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
<div class="copyright">
	<?php echo "Develop by JoomlaMan 2013 <a href='http://joomlaman.com' target='_blank'>joomlaman.com</a>";?>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        activeMenu();
        displayWH();
        displayTH();
        jQuery('.fullwidth .jmonoff').click(function(){
            displayWH();
        })
        jQuery('.navigationtype .option').click(function(){
            displayTH();
        })
        jQuery('#jform_backgroundcolor').val('<?php echo $backgroundcolor; ?>');
		if(jQuery('#toolbar-save .toolbar').length)
			jQuery('#toolbar-save .toolbar').attr('onclick','');
		else
			jQuery('#toolbar-save .btn').attr('onclick','');
        jQuery('#toolbar-save').click(function(event){
			if(jQuery('.icon-32-save').length)
            jQuery('.icon-32-save').addClass('loading');
			else
			jQuery('#toolbar-save .btn').addClass('loading');
            var setting = new Object();
            jQuery('input[type=text].value_setting,select.value_setting').each(function(){
                var data = jQuery(this).attr('data');
                if(data){setting[data] = jQuery(this).val().toString();}
            })
            jQuery('input[type="checkbox"].value_setting').each(function(){
				if(jQuery(this).is(':checked')){
					var data = jQuery(this).attr('data');
					if(data){setting[data] = jQuery(this).val().toString();}
				}else{
					setting[data] = null;
				}
            })
            setting.backgroundcolor = jQuery('#jform_backgroundcolor').val();
            var str = new JM.Base64().base64Encode(JSON.encode(setting));
            var data = {setting:str,id:<?php echo $id; ?>};
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
            return false;
        })
    }) 
	function showModal(obj){
		var modal = jQuery(obj).parent().find('.modal');
		var href = modal.attr('href');
		SqueezeBox.open(href, {handler: 'iframe', size: {x: 800, y: 500}});
	}
    function clearBackground(obj){
        jQuery(obj).parent().find('.media-upload').val(''); 
        return;
    }
	function activeMenu(){
        var layout = "<?php echo $layout;?>";
        if(layout=='layerslider'){
            jQuery('#submenu li a:last').addClass('active');
        }else{
            jQuery('#submenu li a:first').addClass('active');
        }
    }
    
    function displayWH(){
        var fullwidth = jQuery('.slide_fullwidth');
        if(fullwidth.is(':checked')){
            jQuery('.params_wrap.width').slideUp();
        }else{
            jQuery('.params_wrap.width').slideDown(); 
        }
    }
    function displayTH(){
        var navigationtype = jQuery('.slide_navigationtype').val();
        if(navigationtype=='thumb'){
            jQuery('.params_wrap.thumbwidth,.params_wrap.thumbheight,.params_wrap.thumbAmount,.params_wrap.hideThumbs').slideDown();
        }else{
            jQuery('.params_wrap.thumbwidth,.params_wrap.thumbheight,.params_wrap.thumbAmount,.params_wrap.hideThumbs').slideUp();
        }
    }
    
    
</script>