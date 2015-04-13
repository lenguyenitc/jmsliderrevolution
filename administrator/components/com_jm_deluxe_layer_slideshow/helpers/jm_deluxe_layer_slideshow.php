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
class Jm_deluxe_layer_slideshowHelper
{
	public static function addSubmenu($vName = '')
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_JM_DELUXE_LAYER_SLIDESHOW_TITLE_SLIDESHOWSLIDERS'),
			'index.php?option=com_jm_deluxe_layer_slideshow&view=slideshowsliders',
			$vName == 'slideshowsliders'
		);
	}
	public static function isJoomla3(){
		
		if(defined("JVERSION")){
				$version = JVERSION;
				$version = (int)$version;
				return($version == 3);
		}
		if(class_exists("JVersion")){
				$jversion = new JVersion;
				$version = $jversion->getShortVersion();
				$version = (int)$version;
				return($version == 3);
		}			
		return(!defined("DS"));
	}
	public static function addSubmenuDetail($vName = '',$id = '')
	{
		JSubMenuHelper::addEntry(
			JText::_('Global Setting'),
			'index.php?option=com_jm_deluxe_layer_slideshow&task=slideshowslider.globalsetting&id='.$id,
			$vName == 'globalsettings'
		);
		JSubMenuHelper::addEntry(
			JText::_('Slideshow'),
			'index.php?option=com_jm_deluxe_layer_slideshow&task=slideshowslider.layerslider&id='.$id,
			$vName == 'layerslider'
		);
	}
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;
		$assetName = 'com_jm_deluxe_layer_slideshow';
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);
		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}
		return $result;
	}
	
	public static function getData($id){
		$db = JFactory::getDbo();
		$query = 'SELECT data FROM #__jmparallax_slideshow_sliders WHERE id='.$id;
		$db->setQuery($query);
		$result = $db->LoadResult();
		return $result;
	}
	
	public static function getSetting($id){
		$db = JFactory::getDbo();
		$query = 'SELECT setting FROM #__jmparallax_slideshow_sliders WHERE id='.$id;
		$db->setQuery($query);
		$result = $db->LoadResult();
		return $result;
	}
	
	public static function showSlider($layers,$width, $height,$backgroundcolor,$fullwidth,$preview){
		if(!$layers) return;
		$exitPreview = $preview?'onclick="exitPreview();"':'';
		$html = null;
		$styles = null;
		$classcontainer = null;
		$classbanner = null;
		$data_slide = array();
		$class = array();
		$class['sft - Short from Top'] = 'sft';
		$class['sfb - Short from Bottom'] = 'sfb';
		$class['sfr - Short from Right'] = 'sfr';
		$class['sfl - Short from Left'] = 'sfl';
		$class['lft - Long from Top'] = 'lft';
		$class['lfb - Long from Bottom'] = 'lfb';
		$class['lfr - Long from Right'] = 'lfr';
		$class['lfl - Long from Left'] = 'lfl';
		$class['fade - fading'] = 'fade';
		$class['randomrotate'] = 'randomrotate';
		$class['skewfromleft - Skew from Left'] = 'skewfromleft';
		$class['skewfromright - Skew from Right'] = 'skewfromright';
		$class['skewfromleftshort - Skew Short from Left'] = 'skewfromleftshort';
		$class['skewfromrightshort - Skew Short from Right'] = 'skewfromrightshort';
		
		$class['stt - Short to Top'] = 'stt';
		$class['stb - Short to Bottom'] = 'stb';
		$class['str - Short to Right'] = 'str';
		$class['stl - Short to Left'] = 'stl';
		$class['ltt - Long to Top'] = 'ltt';
		$class['ltb - Long to Bottom'] = 'ltb';
		$class['ltr - Long to Right'] = 'ltr';
		$class['ltl - Long to Left'] = 'ltl';
		$class['fadeout - fading'] = 'fadeout';
		$class['randomrotateout'] = 'randomrotateout';
		$class['skewtoleft - Skew to Left'] = 'skewtoleft';
		$class['skewtoright - Skew to Right'] = 'skewtoright';
		$class['skewtoleftshort - Skew Short to Left'] = 'skewtoleftshort';
		$class['skewtorightshort - Skew Short to Right'] = 'skewtorightshort';
		$document = JFactory::getDocument();
		if($fullwidth == 'off'){
			$styles = ".bannercontainer{position: relative;width:{$width}px;}.banner{position: relative;width: 100%;}";
		}else{
			$styles = ".bannercontainer,.banner{position: relative;width: 100%;}";
		}
		$document->addStyleDeclaration( $styles );
		$html .='<div class="bannercontainer jm-deluxe-wrap" style="background-color:'.$backgroundcolor.';">';
		$html .='<div class="banner tp-parallax-container" data-parallaxlevel="50">';
		$html .='<ul>';
                if($layers){
                    foreach($layers as $i=>$layer){
                    $data_slide[] = !empty($layer->transition)?'data-transition="'.$layer->transition.'"':'';
                    $data_slide[] = !empty($layer->slotamount)?'data-slotamount="'.$layer->slotamount.'"':'';
                    $data_slide[] = !empty($layer->transition)?'data-masterspeed="'.$layer->masterspeed.'"':'';
                    $data_slide[] = !empty($layer->link)?'data-link="'.$layer->link.'"':'';
                    $data_slide[] = !empty($layer->target)?'data-target="'.$layer->target.'"':'';
                    $data_slide[] = !empty($layer->index)?'data-slideindex="'.$layer->index.'"':'';
                    $data_slide[] = !empty($layer->thumb)?'data-thumb="'.JURI::root().$layer->thumb.'"':'';
					$data_slide_str = @implode(' ',$data_slide);
                    $bgfit = !empty($layer->bgfit)?'data-bgfit="'.$layer->bgfit.'"':'';
                    $url_background = null;
                    if(is_file(JPATH_SITE.'/'.$layer->background)){
                        $url_background = JURI::root().$layer->background;
                    }else{
                        $url_background = !empty($layer->background)?$layer->background:'';
                    }
                        $html .='<li  '.$data_slide_str.'>';
                        $html .='<img '.$bgfit.' src="'.$url_background .'" />';
                        $slidesublayer = $layer->slidesublayer;
                        if($slidesublayer){
							$count = count($slidesublayer);  
                            foreach($slidesublayer as $i=>$sublayer){
								$data_layer = array();
								$customin = !empty($sublayer->customin)?'customin':'';
								$customout = !empty($sublayer->customout)?'customout':'';
								$type = !empty($sublayer->type)?$sublayer->type:'custom_html';
								$data_layer[] = !empty($sublayer->customin)?'data-customin="'.$sublayer->customin.'"':'';
								$data_layer[] = !empty($sublayer->customout)?'data-customout="'.$sublayer->customout.'"':'';
								$data_layer[] = !empty($sublayer->data_x)?'data-x="'.$sublayer->data_x.'"':'';
								$data_layer[] = !empty($sublayer->data_y)?'data-y="'.$sublayer->data_y.'"':'';
								$data_layer[] = !empty($sublayer->speed)?'data-speed="'.$sublayer->speed.'"':'';
								$data_layer[] = !empty($sublayer->start)?'data-start="'.$sublayer->start.'"':'';
								$style = !empty($sublayer->style)?'style="z-index:'.($count-$i).';'.$sublayer->style .'"':'style="z-index:'.($count-$i).';"';
								$data_layer[] = !empty($sublayer->captionhidden)?'data-captionhidden="'.$sublayer->captionhidden.'"':'';
								$data_layer[] = !empty($sublayer->endeasing)?'data-endeasing="'.$sublayer->endeasing.'"':'';
								$data_layer[] = !empty($sublayer->easing)?'data-easing="'.$sublayer->easing.'"':'';
								$data_layer[] = !empty($sublayer->autoplay)?'data-autoplay="'.$sublayer->autoplay.'"':'';
								$data_layer[] = !empty($sublayer->end)?'data-end='.$sublayer->end:'';
								$url_sublayer = !empty($sublayer->url_sublayer)?$sublayer->url_sublayer:'';
								$sl_target = !empty($sublayer->sl_target)?$sublayer->sl_target:'';
								$sl_content = !empty($sublayer->content)?$sublayer->content:'';
								$incoming = !empty($sublayer->incoming)?$class[$sublayer->incoming]:'';
								$outgoing = !empty($sublayer->outgoing)?$class[$sublayer->outgoing]:'';
								$content = null;
								$fullscreenvideo = null;
								if($type=='image'){
									$content = '<div class="item_wrap" '.$exitPreview.' '.$style.'><img src="'.JURI::root().$sl_content.'" ></div>'; 
								}else if($type=='youtube'){
									$data_layer[] = 'data-nextslideatend = "true" data-autoplayonlyfirsttime="false"';
									$content = '<div class="item_wrap" '.$exitPreview.'  '.$style.'><iframe src="http://www.youtube.com/embed/'.$sl_content.'?hd=1&wmode=opaque&controls=1&showinfo=0&enablejsapi=1" width="'.$sublayer->width_video.'px" height="'.$sublayer->height_video.'px"></iframe></div>';
								}else if($type=='html5'){
									$data_layer[] = 'data-aspectratio="16:9" data-forcecover="1" data-endelementdelay="0.1" data-elementdelay="0.01" data-endspeed="1500" data-forcerewind="on" data-nextslideatend = "true" data-autoplayonlyfirsttime="false"';
									$fullscreenvideo = 'fullscreenvideo';
									$content = '<div class="item_wrap" '.$exitPreview.'  '.$style.'><video class="fullscreenvideo video-js vjs-default-skin" preload="none" width="100%" height="100%" poster=""><source src="'.$sl_content.'"/></video></div>';
								}
								else if($type=='vimeo'){
									$data_layer[] = 'data-nextslideatend = "true" data-autoplayonlyfirsttime="false"';
									$content = '<div class="item_wrap" '.$exitPreview.'  '.$style.'><iframe src="http://player.vimeo.com/video/'.$sl_content.'?title=0&amp;byline=0&amp;portrait=0;api=1" width="'.$sublayer->width_video.'px" height="'.$sublayer->height_video.'px"></iframe></div>';
								}
								else{
									$content = $sl_content;
								}
								if($url_sublayer){
									$content = '<a href="'.$url_sublayer.'" target="'.$sl_target.'">'.$content.'</a>';
								}
								$data_layer_str = @implode(' ',$data_layer);
								$html .= '<div '.$data_layer_str.' '.$style.' class="tp-caption '.$fullscreenvideo.' '.$incoming.' '.$outgoing.' '.$customin.' '.$customout.'">'; 
								$html .= $content; 
								$html .= '</div>';	
                            }
                        }
                        $html .='</li>';
                    }
                }
		$html .= '</ul>';
		$html .='</div>';
		$html .='</div>';
		return $html;
	}
	function getEasing($selected=null){ 
		$db = JFactory::getDbo();
		$query = 'SELECT title FROM #__jmparallax_slideshow_category WHERE parent_id=2';
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		if(!$rows) return;
                $option = '';
		foreach($rows as $i=>$row){
			if($row->title==$selected){
				$option .='<option selected="selected" value="'.$row->title.'">'.$row->title.'</option>';
			}else{
				$option .='<option value="'.$row->title.'">'.$row->title.'</option>';
			}
		}
		return $option; 
	}
	public static function initString(){
		$str = new stdClass();
		$str->link_tab = "
		<li class='link-tab %2\$s'>
			<a data-tab='#tabs-%1\$s' href='javascript:void(0);' class='jmlink-tab' onclick='jmtab(this)'>Slide %1\$s</a>
			<span onclick='removeLayer(this);' class='btn-delete delete_layer'>x</span>
		</li>
		";
		$str->slide_setting = "
		<div class='jm_dl_st_inner'>
			<ul>
				<li class='background_wrap'>
					<label>Background image</label>
					<input type='text' id='background_layer_%1\$s' value='%2\$s' readonly='readonly' data='background' class='background_layer media-upload value_param' data-tabs='#tabs-%1\$s' onclick='showModal(this);' data-href='index.php?option=com_media&view=images&tmpl=component&asset=com_jm_deluxe_layer_slideshow&fieldid=background_layer_%1\$s'>
					<span class='btn-clear' onclick='clearBackground(this);' data-tab='#tabs-%1\$s'>x</span>
				</li>
				<li class='transition_wrap'>
					<label>Slide transition</label>
					<select class='slide_transition value_param' data='transition'>
						%3\$s
					</select>
				</li>
				<li class='slotamount_wrap'>
					<label>Slide slotamount</label>
					<input type='text' class='slide_slotamount value_param' data='slotamount' value='%4\$s'>
				</li>
				<div class='clr'></div>
				<li class='masterspeed_wrap'>
					<label>Slide masterspeed</label>
					<input type='text' class='slide_masterspeed value_param' data='masterspeed' value='%5\$s'>
				</li>
				<li class='link_wrap'>
					<label>Slide link</label>
					<input type='text' class='slide_masterspeed value_param' data='link' value='%6\$s'>
				</li>
				<li class='link_target_wrap'>
					<label>Link target</label>
					<select class='link_target value_param' data='target'>
						%7\$s
					</select>
				</li>
				<div class='clr'></div>
				<li class='index_wrap'>
					<label>Slide index</label>
					<input type='text' data='index' class='slide_index value_param' value='%8\$s'>
				</li>
				<li class='background_wrap'>
					<label>Thumbnail</label>
					<input type='text' id='thumb_layer_%1\$s' value='%9\$s' readonly='readonly' data='thumb' class='background_layer media-upload value_param' data-tabs='#tabs-%1\$s' onclick='showModal(this);' data-href='index.php?option=com_media&view=images&tmpl=component&asset=com_jm_deluxe_layer_slideshow&fieldid=background_layer_%1\$s'>
					<span class='btn-clear' onclick='clearBackground(this);' data-tab='#tabs-%1\$s'>x</span>
				</li>
				<li class='bgfit_wrap'>
					<label>Background Fit</label>
					<select onchange='changeBackgroundSize(this);' class='bgfit value_param' data='bgfit'>
						%10\$s
					</select>
				</li>
				<div class='clr'></div>
			</ul>
		</div>
		";
		$str->sublayer_video = "
			<div class='content_tpl_wrap' style='%1\$s'><div class='thumb_video' style='width:%2\$spx;height:%3\$spx;background-image:%4\$s'></div></div>
		";
		$str->sublayer_video_html5 = "
			<div class='content_tpl_wrap' style='%1\$s'>
				<video class='video-js vjs-default-skin' preload='none' width='%2\$s' height='%3\$s' poster=''><source src='%4\$s'/></video>
			</div>
		";
		$str->sublayer_img = "
			<div class='content_tpl_wrap' style='%1\$s'><img alt='' class='img_drag' src='%2\$s'/></div>
		";
		$str->sublayer_text = "
			<div class='content_tpl_wrap' style='%1\$s'>%2\$s</div>
		";
		$str->sublayer_detail = "
			<div class='sublayer_wrap'>
				<div onclick='showSublayer(this);' class='jm_title_group'>
					<input type='text' data='name_sublayer' value='%1\$s' class='name_sublayer value_option' onclick='event.cancelBubble=true;if (event.stopPropagation) event.stopPropagation();'>
					<span onclick='event.cancelBubble=true;if (event.stopPropagation) event.stopPropagation();' class='onofff_sublayer'><span onclick='toogleViewLayer(this);' class='icon_viewlayer'></span>View Layer|<span class='layer_on'>On</span>|<span class='layer_off'>Off</span>|</span>
					<span onclick='event.cancelBubble=true;if (event.stopPropagation) event.stopPropagation();' class='ordering_sublayer'>Change Layer Order<span onclick='orderDown(this);' class='order_down'>Down</span><span onclick='orderUp(this);' class='order_up'>Up</span></span>
					<span class='btn-delete delete_sublayer' data-tabs='#tabs-%2\$s' onclick='removeSublayer(this);' data-atl='%3\$s'>x</span>
				</div>
				<div class='jmsublayer_wrap'>
				<div class='jmsublayer_outer'>
					<ul>
						<li class='speed_wrap'>
							<label>Speed</label>
							<input type='text' class='speed_sublayer value_option' data='speed' value='%4\$s'>
						</li>
						<li class='start_wrap'>
							<label>Start</label>
							<input type='text' class='start_sublayer value_option' data='start' value='%5\$s'>
						</li>
						<li class='easing_wrap'>
							<label>Enter Easing</label>
							<select class='easing_sublayer value_option' data='easing'>
								%6\$s
							</select>
						</li>
						<div class='clr'></div>
						<li class='captionhidden_wrap'>
							<label>Captionhidden</label>
							<select class='captionhidden_sublayer value_option' data='captionhidden'>
								%7\$s
							</select>
						</li>
						<li class='end_wrap'>
							<label>End</label>
							<input type='text' class='end_sublayer value_option' data='end' value='%8\$s'>
						</li>
						<li class='endeasing_wrap'>
							<label>Exit Easing</label>
							<select class='endeasing_sublayer value_option' data='endeasing'>
								%9\$s
							</select>
						</li>
						<div class='clr'></div>
						<li class='incoming_wrap'>
							<label>Enter Class</label>
							<select class='incoming_sublayer value_option' data='incoming'>
								%10\$s
							</select>
						</li>
						<li class='outgoing_wrap'>
							<label>Exit Class</label>
							<select class='outgoing_sublayer value_option' data='outgoing'>
								%11\$s
							</select>
						</li>
						<div class='clr'></div>								
					</ul>
				</div>
				<div class='add_sublayer_wrap'>
					<ul class='jm_add_layer_tabs'>
						<li>
						  <input type='radio' %33\$s name='%2\$s_tabs_%3\$s' id='%2\$s_html_%3\$s' class='tab_html'>
						  <label for='%2\$s_html_%3\$s'><i></i>Add Layer: Text</label>
						  <div class='tab-content'>
								<div class='customhtml_sublayer_wrap content_outer'>
									<ul>
										<li class='customhtml_wrap'>
											<label>Custom HTML</label>
											<textarea rows='4' cols='113' placeholder='Enter custom HTML here...' class='html_sublayer' onkeyup='changeContent(this);'>%12\$s</textarea>
										</li>
										<li class='customstyle_wrap'>
											<label>Custom Style</label>
											<textarea rows='4' cols='113' placeholder='Enter custom Style here...' class='style_sublayer' onkeyup='changeContent(this);'>%13\$s</textarea>
										</li>
										<div class='clr'></div>										<li class='link_sublayer_wrap'>
											<label>Url</label>
											<input type='text' value='%14\$s' class='link_sublayer_value'>
											<select class='sl_link_target'>
												%15\$s
											</select>
										</li>
										<li class='class_style_wrap'>
											<label>Style</label>
											<select class='class_style' onchange='fiterStyle(this);'>
												%16\$s
											</select>
										</li>
										<div class='clr'></div>
										<li class='customin_wrap'>
											<label>Custom In</label>
											<textarea rows='4' cols='113' placeholder='Enter customin here...' class='customin_sublayer'>%17\$s</textarea>
										</li>
										<li class='customout_wrap'>
											<label>Custom Out</label>
											<textarea rows='4' cols='113' placeholder='Enter customout here...' class='customout_sublayer'>%18\$s</textarea>
										</li>
										<div class='clr'></div>	
									</ul>
								</div>
						  </div>
						</li>
						<li>
						  <input type='radio' %34\$s name='%2\$s_tabs_%3\$s' id='%2\$s_img_%3\$s' class='tab_img'>
						  <label for='%2\$s_img_%3\$s'><i></i>Add Layer: Image</label>
						  <div class='tab-content'>
								<div class='image_sublayer_wrap content_outer'>
									<ul>
										<li class='image_wrap'>
											<label>Image</label>
											<input onchange='changeContent(this);' type='text' onclick='showModal(this);' value='%19\$s' class='media-upload img_sublayer' readonly='readonly' id='img_sublayer-%2\$s-%3\$s' data-href='index.php?option=com_media&view=images&tmpl=component&asset=com_jm_deluxe_layer_slideshow&fieldid=img_sublayer-%2\$s-%3\$s'>
										</li>
										<li class='link_sublayer_wrap'>
											<label>Url</label>
											<input type='text' value='%20\$s' class='link_sublayer_value'>
											<select class='sl_link_target'>
												%21\$s
											</select>
										</li>
										<div class='clr'></div>	
										<li class='customstyle_wrap'>
											<label>Custom Style</label>
											<textarea onkeyup='changeContent(this);'  class='style_sublayer' placeholder='Enter custom Style here...' cols='113' rows='4'>%22\$s</textarea>
										</li>
										<div class='clr'></div>
										<li class='customin_wrap'>
											<label>Custom In</label>
											<textarea rows='4' cols='113' placeholder='Enter customin here...' class='customin_sublayer'>%23\$s</textarea>
										</li>
										<li class='customout_wrap'>
											<label>Custom Out</label>
											<textarea rows='4' cols='113' placeholder='Enter customout here...' class='customout_sublayer'>%24\$s</textarea>
										</li>
										<div class='clr'></div>	
									</ul>
								</div>
						  </div>
						</li>
						<li>
						  <input type='radio' %35\$s name='%2\$s_tabs_%3\$s' id='%2\$s_video_%3\$s' class='tab_video'>
						  <label for='%2\$s_video_%3\$s'><i></i>Add Layer: Video</label>
						  <div class='tab-content'>
								<div class='video_sublayer_wrap content_outer'>
									<ul>
										<li class='type_video_wrap'>
											<label>Type of video</label>
											<select class='typeofvideo' onchange='changeTypeVideo(this);'>
												%25\$s
											</select>
										</li>
										<li class='videoid_wrap'>
											<label>ID of video</label>
											<input type='text' onchange='changeContent(this);'  value='%26\$s' class='idvideo_sublayer'>
										</li>
										<div class='clr'></div>
										<li class='video_width_wrap'>
											<label>Width of video</label>
											<input type='text' value='%27\$s' class='width_video_sublayer value_option' data='width_video'>
										</li>
										<li class='video_height_wrap'>
											<label>Height of video</label>
											<input type='text' value='%28\$s' class='height_video_sublayer value_option' data='height_video'>
										</li>
										<div class='clr'></div>
										<li class='auto_play_wrap'>
											<label>Auto play video</label>
											<select class='autoplayvideo'>
												%29\$s
											</select>
										</li>
										<li class='customstyle_wrap'>
											<label>Custom Style</label>
											<textarea onkeyup='changeContent(this);' class='style_sublayer' placeholder='Enter custom Style here...' cols='113' rows='4'>%30\$s</textarea>
										</li>
										<div class='clr'></div>											<li class='customhtml_wrap'>
											<label>Custom In</label>
											<textarea rows='4' cols='113' placeholder='Enter customin here...' class='customin_sublayer'>%31\$s</textarea>
										</li>
										<li class='customout_wrap'>
											<label>Custom Out</label>
											<textarea rows='4' cols='113' placeholder='Enter customout here...' class='customout_sublayer'>%32\$s</textarea>
										</li>
										<div class='clr'></div>		
									</ul>
								</div>
						  </div>
						</li>
					</ul>
				</div>
				</div>
			</div>
		";
		return $str;
	}
}
 