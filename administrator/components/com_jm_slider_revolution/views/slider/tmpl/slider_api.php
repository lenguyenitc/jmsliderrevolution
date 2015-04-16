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
$api =  "revapi".$sliderID;
?>
	
<div id="api_wrapper" class="api_wrapper postbox unite-postbox ">
		<h3 class="box_closed tp-accordion tpa-closed"><div class="postbox-arrow"></div><i style="float:left;margin-top:4px;font-size:14px;" class="eg-icon-tools"></i><span><?php echo "API Functions";?></span></h3>
		<div class="toggled-content tp-closedatstart p20">
				<div class="api-caption"><?php echo "API Methods";?>:</div>
				<div class="divide20"></div>
				<div class="api-desc"><?php echo "Please copy / paste those functions into your functions js file";?>. </div>
				
				<table class="api-table">
					<tr>
						<td class="api-cell1"><?php echo "Pause Slider";?>:</td>
						<td class="api-cell2"><input type="text" readonly  class="api-input" value="<?php echo $api?>.revpause();"></td>
					</tr>
					<tr>
						<td class="api-cell1"><?php echo "Resume Slider";?>:</td>
						<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.revresume();"></td>
					</tr>
					<tr>
						<td class="api-cell1"><?php echo "Previous Slide";?>:</td>
						<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.revprev();"></td>
					</tr>
					<tr>
						<td class="api-cell1"><?php echo "Next Slide";?>:</td>
						<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.revnext();"></td>
					</tr>
					<tr>
						<td class="api-cell1"><?php echo "Go To Slide";?>:</td>
						<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.revshowslide(2);"></td>
					</tr>
					<tr>
						<td class="api-cell1"><?php echo "Get Num Slides";?>:</td>
						<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.revmaxslide();"></td>
					</tr>
					<tr>
						<td class="api-cell1"><?php echo "Get Current Slide Number";?>:</td>
						<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.revcurrentslide();"></td>
					</tr>
					<tr>
						<td class="api-cell1"><?php echo "Get Last Playing Slide Number";?>:</td>
						<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.revlastslide();"></td>
					</tr>
					<tr>
						<td class="api-cell1"><?php echo "External Scroll";?>:</td>
						<td class="api-cell2"><input type="text" readonly class="api-input" value="<?php echo $api?>.revscroll(offset);"></td>
					</tr>
					<tr>
						<td class="api-cell1"><?php echo "Redraw Slider";?>:</td>
						<td class="api-cell2"><input type="text" readonly  class="api-input" value="<?php echo $api?>.revredraw();"></td>
					</tr>
						<tr>
							<td class="api-cell1"><?php echo"Kill and Remove Slider";?>:</td>
							<td class="api-cell2"><input type="text" readonly  class="api-input" value="<?php echo $api?>.revkill();"></td>
						</tr>
					
				</table>
				<div class="divide20"></div>
				<hr>
				<div class="divide20"></div>					
				<div class="api-caption"><?php echo "API Events";?>:</div>
				<div class="divide20"></div>
				<div class="api-desc"><?php echo "Copy and Paste the Below listed API Functions into your jQuery Functions for Revslider Event Listening";?>.</div>
				<textarea id="api_area" readonly>			
					<?php echo $api?>.bind("revolution.slide.onloaded",function (e) {
						//alert("slider loaded");
					});
							
					<?php echo $api?>.bind("revolution.slide.onchange",function (e,data) {
						//alert("slide changed to: "+data.slideIndex);
						//data.slideIndex <?php _e('is the index of the li container in this Slider', REVSLIDER_TEXTDOMAIN); ?>
						
						//data.slide <?php _e('is the current slide jQuery object (the li element)', REVSLIDER_TEXTDOMAIN); ?>
						
					});

					<?php echo $api?>.bind("revolution.slide.onpause",function (e,data) {
						//alert("timer paused");
					});

					<?php echo $api?>.bind("revolution.slide.onresume",function (e,data) {
						//alert("timer resume");
					});

					<?php echo $api?>.bind("revolution.slide.onvideoplay",function (e,data) {
						//alert("video play");
					});

					<?php echo $api?>.bind("revolution.slide.onvideostop",function (e,data) {
						//alert("video stopped");
					});

					<?php echo $api?>.bind("revolution.slide.onstop",function (e,data) {
						//alert("slider stopped");
					});

					<?php echo $api?>.bind("revolution.slide.onbeforeswap",function (e) {
						//alert("before swap");
					});

					<?php echo $api?>.bind("revolution.slide.onafterswap",function (e) {
						//alert("after swap");
					});

					<?php echo $api?>.bind("revolution.slide.slideatend",function (e) {
						//alert("slide at end");
					});			
			</textarea>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){
		
		RevSliderAdmin.initEditSlideView();
	});
</script>
