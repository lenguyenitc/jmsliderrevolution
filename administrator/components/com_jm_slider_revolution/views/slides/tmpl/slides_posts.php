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
<div class="wrap settings_wrap">
    <div class="title_line">
        <div id="icon-options-general" class="icon32"></div>
        <div class="view_title"><?php echo "Edit Slides"; ?>: <?php echo $slider->getTitle() ?></div>	
    </div>
    <div class="vert_sap"></div>
    <?php echo "The slides are posts that taken from multiple sources."; ?>
    <?php if ($showSortBy == true): ?>
        <?php echo "Sort by"; ?>: <?php echo $selectSortBy ?> 
        <span class="hor_sap"></span>
    <?php endif ?>
    <?php echo $linkNewPost ?>
    <span id="slides_top_loader" class="slides_posts_loader" style="display:none;"><?php echo "Updating Sorting..."; ?></span>
    <div class="vert_sap"></div>
    <div class="sliders_list_container">
	<?php require
	("slides_list_posts.php"); ?>
	</div>
    <div class="vert_sap_medium"></div>
    <div class="list_slides_bottom">
        <?php echo $linkNewPost ?>
        <a class="button-primary revyellow" href='<?php echo $UniteFunctionsRev::getViewUrl(); ?>' ><i class="revicon-cancel"></i><?php echo "Close"; ?></a>
        <a href="<?php echo $linksSliderSettings ?>" class="button-primary revgreen"><i class="revicon-cog"></i><?php echo "Slider Settings"; ?></a>
    </div>
</div>
<script type="text/javascript">
    var g_messageDeleteSlide = "<?php echo "Warning! Removing this entry will cause the original wordpress post to be deleted."; ?>";
    var g_messageChangeImage = "<?php echo "Select Slide Image"; ?>";
    jQuery(document).ready(function() {
        RevSliderAdmin.initSlidesListViewPosts("<?php echo $sliderID ?>");
    });
</script>