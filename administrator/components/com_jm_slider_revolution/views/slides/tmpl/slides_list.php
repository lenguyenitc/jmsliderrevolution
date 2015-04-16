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
?>
<div class="postbox box-slideslist">
	<input type="hidden" id="sliderid" value="<?php echo $sliderID?>"></input>
	<h3>
		<span class='slideslist-title'><?php echo "Slides List";?></span>
		<span id="saving_indicator" class='slideslist-loading'><?php echo "Saving Order";?>...</span>
	</h3>
	<div class="inside">
		<?php if(empty($arrSlides)):?>
		<?php echo "No Slides Found";?>
		<?php endif?>
		
		<?php
		$useStaticLayers = $slider->getParam("enable_static_layers","off");
		?>
		<ul id="list_slides" class="list_slides ui-sortable">
		
			<?php
				$counter = 0; 
				foreach($arrSlides as $slide):
					
					$counter++;
					
					$bgType = $slide->getParam("background_type","image");
					
					$bgFit = $slide->getParam("bg_fit","cover");
					$bgFitX = intval($slide->getParam("bg_fit_x","100"));
					$bgFitY = intval($slide->getParam("bg_fit_y","100"));
					
					$bgPosition = $slide->getParam("bg_position","center top");
					$bgPositionX = intval($slide->getParam("bg_position_x","0"));
					$bgPositionY = intval($slide->getParam("bg_position_y","0"));
					
					$bgRepeat = $slide->getParam("bg_repeat","no-repeat");
					
					$bgStyle = ' ';
					if($bgFit == 'percentage'){
						$bgStyle .= "background-size: ".$bgFitX.'% '.$bgFitY.'%;';
					}else{
						$bgStyle .= "background-size: ".$bgFit.";";
					}
					if($bgPosition == 'percentage'){
						$bgStyle .= "background-position: ".$bgPositionX.'% '.$bgPositionY.'%;';
					}else{
						$bgStyle .= "background-position: ".$bgPosition.";";
					}
					$bgStyle .= "background-repeat: ".$bgRepeat.";";
										
					$imageFilepath = $slide->getImageFilepath();									
					$urlImageForView = $slide->getThumbUrl();
					
					$slideTitle = $slide->getParam("title","Slide");
					$title = $slideTitle;
					$filename = $slide->getImageFilename();
					
					$imageAlt = stripslashes($slideTitle);
					if(empty($imageAlt))
						$imageAlt = "slide";
					
					if($bgType == "image")
						$title .= " (".$filename.")";
					
					$slideid = $slide->getID();
					
					$urlEditSlide = $UniteFunctionsRev::getViewUrl($slideid,'edit','slide');
					$linkEdit = UniteFunctionsRev::getHtmlLink($urlEditSlide, $title);
					
					$state = $slide->getParam("state","published");
				
			?>
				<li id="slidelist_item_<?php echo $slideid?>" class="ui-state-default">
					
					<span class="slide-col col-order">
						<span class="order-text"><?php echo $counter?></span>
						<div class="state_loader" style="display:none;"></div>
						<?php if($state == "published"):?>
						<div class="icon_state state_published" data-slideid="<?php echo $slideid?>" title="<?php echo "Unpublish Slide";?>"></div>
						<?php else:?>
						<div class="icon_state state_unpublished" data-slideid="<?php echo $slideid?>" title="<?php echo "Publish Slide";?>"></div>
						<?php endif?>
						
						<div class="icon_slide_preview" title="Preview Slide" data-slideid="<?php echo $slideid?>"></div>
						
					</span>
					
					<span class="slide-col col-name">
						<div class="slide-title-in-list"><?php echo $linkEdit?></div>
						<a class='button-primary revgreen' href='<?php echo $urlEditSlide?>' style="width:120px; "><i class="revicon-pencil-1"></i><?php echo "Edit Slide";?></a>
					</span>
					<span class="slide-col col-image">
						<?php switch($bgType):
								default:
								case "image":
									?>
									<div id="slide_image_<?php echo $slideid?>" style="background-image:url('<?php echo $urlImageForView?>');<?php echo $bgStyle; ?>" class="slide_image" title="Slide Image - Click to change"></div>
									<?php 
								break;
								case "solid":
									$bgColor = $slide->getParam("slide_bg_color","#d0d0d0");
									?>
									<div class="slide_color_preview" style="background-color:<?php echo $bgColor?>"></div>
									<?php 
								break;
								case "trans":
									?>
									<div class="slide_color_preview_trans"></div>
									<?php 
								break;
								endswitch;  ?>
					</span>
					
					<span class="slide-col col-operations">
						<a id="" class='button-primary revred button_delete_slide ' style="width:120px; margin-top:8px !important" data-slideid="<?php echo $slideid?>" href='javascript:void(0)'><i class="revicon-trash"></i><?php echo "Delete";?></a>
						<span class="loader_round loader_delete" style="display:none;"><?php echo "Deleting Slide...";?></span>
						<a id="button_duplicate_slide_<?php echo $slideid?>" style="width:120px; " class='button-primary revyellow button_duplicate_slide' href='javascript:void(0)'><i class="revicon-picture"></i><?php echo "Duplicate";?></a>
						<?php
							$copyButtonClass = "button-primary revblue  button_copy_slide";
							$copyButtonTitle = "Open copy / move dialog";
							
							 if($numSliders == 0){
								$copyButtonClass .= " button-disabled";
								$copyButtonTitle = "Copy / move disabled, no more sliders found";
							}
						?>
						<a id="button_copy_slide_<?php echo $slideid?>" class='<?php echo $copyButtonClass?>' title="<?php echo $copyButtonTitle?>" style="width:120px; " href='javascript:void(0)'><i class="revicon-picture"></i><?php echo "Copy / Move";?></a>							
						<span class="loader_round loader_copy mtop_10 mleft_20 display_block" style="display:none;"><?php echo "Working...";?></span>
					</span>
					
					<span class="slide-col col-handle">
						<div class="col-handle-inside">
							<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
						</div>
					</span>	
					<div class="clear"></div>
				</li>
			<?php endforeach;?>
		</ul>
		
	</div>
</div>