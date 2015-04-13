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
$displ = "block";
$validated === 'true';
if($validated === 'true') {

		$displ = "block";
		
	?> 
	<div class="revgreen" style="left:0px;top:0px;position:absolute;height:100%;padding:30px 10px;"><i style="color:#fff;font-size:25px" class="eg-icon-check"></i></div>
	<?php 	
} else {				
		$displ = "none";
	?> 
	<div class="revcarrot"   style="left:0px;top:0px;position:absolute;height:100%;padding:22px 10px;"><i style="color:#fff;font-size:25px" class="revicon-cancel"></i></div>
	<?php 
}
?>

<div id="rs-validation-wrapper" style="display:<?php echo $displ; ?>">
	
	<div class="validation-label"><?php echo 'Username:'; ?></div> 
	<div class="validation-input"> 
		<input type="text" name="rs-validation-username" <?php echo ($validated === 'true') ? ' readonly="readonly"' : ''; ?> value="<?php echo $username; ?>" />
		<p class="validation-description"><?php echo 'Your Envato username.'; ?></p>
	</div>
	<div class="clear"></div>
	
	
	<div class="validation-label"><?php echo 'Envato API Key:'; ?> </div> 
	<div class="validation-input">
		<input type="text" name="rs-validation-api-key" value="<?php echo $api_key; ?>" <?php echo ($validated === 'true') ? ' readonly="readonly"' : ''; ?> style="width: 350px;" />
		<p class="validation-description"><?php echo 'You can find API key by visiting your Envato Account page, then clicking the My Settings tab. At the bottom of he page you will find your accounts API key.'; ?></p>
	</div>
	<div class="clear"></div>
	
	<div class="validation-label"><?php echo 'Purchase code:'; ?></div> 
	<div class="validation-input">
		<input type="text" name="rs-validation-token" value="<?php echo $code; ?>" <?php echo ($validated === 'true') ? ' readonly="readonly"' : ''; ?> style="width: 350px;" />
		<p class="validation-description"><?php echo 'Please enter your '; ?><strong style="color:#000"><?php echo 'CodeCanyon Slider Revolution purchase code / license key'; ?></strong><?php echo '. You can find your key by following the instructions on'; ?><a target="_blank" href="http://www.themepunch.com/home/plugins/wordpress-plugins/revolution-slider-wordpress/where-to-find-the-purchase-code/"><?php echo ' this page.'; ?></a></p>
	</div>
	<div style="height:15px" class="clear"></div>
	
	<span style="display:none" id="rs_purchase_validation" class="loader_round"><?php echo 'Please Wait...'; ?></span>

	<a href="javascript:void(0);" <?php echo ($validated !== 'true') ? '' : 'style="display: none;"'; ?> id="rs-validation-activate" class="button-primary revgreen"><?php echo 'Activate'; ?></a>
	
	<a href="javascript:void(0);" <?php echo ($validated === 'true') ? '' : 'style="display: none;"'; ?> id="rs-validation-deactivate" class="button-primary revred"><?php echo 'Deactivate'; ?></a>
	

	<?php
	if($validated === 'true'){
		?>
		<a href="update-core.php?checkforupdates=true" id="rs-check-updates" class="button-primary revpurple"><?php echo 'Search for Updates'; ?></a>
		<?php
	}
	?>
	
</div>

<!-- 
  CONTENT AFTER ACTIVATION, BASED OF VALIDATION 
-->
<?php if($validated === 'true') {
	?> 
	<h3> <?php echo "How to get Support ?"?>:</h3>				
	<p>
	<?php echo "Please feel free to contact us via our "?><a href='http://themepunch.ticksy.com'><?php echo "Support Forum "?></a><?php echo "and/or via the "?><a href='http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380/comments'><?php echo "Item Disscussion Forum"?></a><br />
	</p> 	
	<?php 	
} else {
	?> 
	<p style="margin-top:10px; margin-bottom:10px;" id="tp-before-validation">

	<?php echo "Click Here to get "; ?><strong><?php echo "Premium Support and Auto Updates"; ?></strong><br />

	</p> 
	<?php 
}
?>

