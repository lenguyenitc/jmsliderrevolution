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
$UniteFunctionsRev = new UniteFunctionsRev();
?>
<div class="wrap settings_wrap">
	<div class="clear_both"></div>
		<div class="title_line">
			<div id="icon-options-general" class="icon32"></div>
			<?php
			if($sliderTemplate){
				?>
				<div class="view_title"><i class="revicon-pencil-1"></i><?php echo "New Slider Template";?></div>
				<?php
				$template_value = 'true';
			}else{
				?>
				<div class="view_title"><i class="revicon-pencil-1"></i><?php echo "New Slider";?></div>
				<?php
				$template_value = 'false';
			}
			?>
			<input type="hidden" id="revslider_template" value="<?php echo $template_value; ?>"></input>

			<a href="<?php echo GlobalsRevSlider::LINK_HELP_SLIDER?>" class="button-primary float_right mtop_10 mleft_10" target="_blank"><?php echo "Help";?></a>

		</div>
		<div class="settings_panel">
			<div class="settings_panel_left">
				<div id="main_dlier_settings_wrapper" class="postbox unite-postbox ">
				  <h3 class="box-closed"><span><?php echo "Main Slider Settings"; ?></span></h3>
				  <div class="p10">
						<?php $settingsSliderMain->draw("form_slider_main",true)?>

						<div id="layout-preshow">
							<strong>Layout Example</strong><?php echo "(Can be different based on Theme Style)";?>
							<div class="divide20"></div>
							<div id="layout-preshow-page">
								<div class="layout-preshow-text">BROWSER</div>
								<div id="layout-preshow-theme">
										<div class="layout-preshow-text">PAGE</div>
								</div>
								<div id="layout-preshow-slider">
										<div class="layout-preshow-text">SLIDER</div>
								</div>
								<div id="layout-preshow-grid">
										<div class="layout-preshow-text">CAPTIONS GRID</div>										
								</div>
							</div>
						</div>
						
						<div class="divide20"></div>
						<a id="button_save_slider" class='button-primary revgreen' href='javascript:void(0)' ><i class="revicon-cog"></i><span id="create_slider_text"><?php echo "Create Slider";?></span></a>

						<span class="hor_sap"></span>
						<a id="button_cancel_save_slider" class='button-primary revred' href='<?php echo $UniteFunctionsRev::getViewUrl(); ?>' ><i class="revicon-cancel"></i><?php echo "Close";?> </a>
				  </div>
				</div>
			</div>
			<div class="settings_panel_right">
				<?php $settingsSliderParams->draw("form_slider_params",true); ?>
			</div>
			<div class="clear"></div>
		</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){

		RevSliderAdmin.initAddSliderView();
		
		<?php if($sliderTemplate){ ?>
		RevSliderAdmin.initSliderViewTemplate();
		<?php } ?>
	});
</script>

