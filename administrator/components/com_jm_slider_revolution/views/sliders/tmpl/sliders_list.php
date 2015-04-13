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
$limit = (@intval($_GET['limit']) > 0) ? @intval($_GET['limit']) : 10;
$otype = 'reg';
$total = 0;
if(!$no_sliders){
?>
	<table class='wp-list-table widefat fixed unite_table_items'>
		<thead>
			<tr>
				<th width='20px'><?php echo "ID";?></th>
				<th width='25%'><?php echo "Name";?> <a href="<?php echo JRoute::_('index.php?option=com_jm_slider_revolution&order=asc&ot=name&type='.$otype);?>" class="eg-icon-down-dir"></a> <a href="<?php echo JRoute::_('index.php?option=com_jm_slider_revolution&order=desc&ot=name&type='.$otype);?>" class="eg-icon-up-dir"></a></th>
				<?php
				if(!$outputTemplates){
				?>
				<th width='180px'><?php echo "Shortcode";?> <a href="<?php echo JRoute::_('index.php?option=com_jm_slider_revolution&order=asc&ot=alias&type='.$otype);?>" class="eg-icon-down-dir"></a> <a href="<?php echo JRoute::_('index.php?option=com_jm_slider_revolution&order=desc&ot=alias&type='.$otype);?>" class="eg-icon-up-dir"></a></th>
				<?php }else{
				?><th width='120px'></th><?php
				} ?>
				<th width='100'><?php echo "Source";?></th>
				<th width='70px'><?php echo "N. Slides";?></th>						
				<th width='50%'><?php echo "Actions";?> </th>
			</tr>
		</thead>
		<tbody>
			<?php
			$useSliders = $arrSliders;
			$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
			$offset = ( $pagenum - 1 ) * $limit;			
			$cur_offset = 0;
			foreach($useSliders as $slider){
				$total++;
				$cur_offset++;
				if($cur_offset <= $offset) continue; //if we are lower then the offset, continue;
				if($cur_offset > $limit + $offset) continue; // if we are higher then the limit + offset, continue
				
				try{
					
					$id = $slider->getID();
					$showTitle = $slider->getShowTitle();
					$title = $slider->getTitle();
					$alias = $slider->getAlias();
					$isFromPosts = $slider->isSlidesFromPosts();
					$strSource = "Gallery";
					$preicon = "revicon-picture-1";
					$linksEditSlides = $UniteFunctionsRev::getViewUrl($id,'default','slides');
					$editLink  = $UniteFunctionsRev::getViewUrl($id,'edit','slider');
					if($outputTemplates) $strSource = "Template";
					if ($strSource=="Template") $preicon ="templateicon";
					
					$rowClass = "";					
					if($isFromPosts == true){
						$strSource = "Posts";
						$preicon ="revicon-doc";
						$rowClass = "class='row_alt'";
					}					
					$showTitle = UniteFunctionsRev::getHtmlLink($editLink, $showTitle);
					
					$shortCode = $slider->getShortcode();
					$numSlides = $slider->getNumSlides();
					
					
				}catch(Exception $e){					
					$errorMessage = "ERROR: ".$e->getMessage();
					$strSource = "";
					$numSlides = "";
				}
				
				?>
				<tr <?php echo $rowClass?>>
					<td class="td-id"><?php echo $id?><span id="slider_title_<?php echo $id?>" class="hidden"><?php echo $title?></span></td>								
					<td class="td-title">
						<?php echo $showTitle?>
						<?php if(!empty($errorMessage)):?>
							<div class='error_message'><?php echo $errorMessage?></div>
						<?php endif?>
					</td>
					<?php
					if(!$outputTemplates){
					?>
					<td class="td-shortcode"><?php echo $shortCode?></td>
					<?php }else{ ?><td></td><?php } ?>
					<td class="td-source"><?php echo "<i class=".$preicon."></i>".$strSource?></td>
					<td class="td-numslide"><?php echo $numSlides?></td>
					<td class="td-action">
						<a class="button-primary revgreen" href='<?php echo $editLink;?>' title=""><i class="revicon-cog"></i><?php echo "Settings";?></a>
						<a class="button-primary revblue" href='<?php echo $linksEditSlides;?>' title=""><i class="revicon-pencil-1"></i><?php echo "Edit Slides";?></a>
						<a class="button-primary revcarrot export_slider_overview" id="export_slider_<?php echo $id?>" href="javascript:void(0);" title=""><i class="revicon-export"></i><?php echo "Export Slider";?></a>
						<?php
						$UniteBaseAdminClassRev = new UniteBaseAdminClassRev();
						$UniteBaseAdminClassRev::requireSettings("general_settings");
						$generalSettings = $UniteBaseAdminClassRev::getSettings("general");
						$show_dev_export = $generalSettings->getSettingValue("show_dev_export",'off');
						if($show_dev_export == 'on'){
							?>
							<a class="button-primary revpurple export_slider_standalone" id="export_slider_standalone_<?php echo $id?>" href="javascript:void(0);" title=""><i class="revicon-export"></i><?php echo "HTML &LT;/&GT;";?></a>
							<?php
						}
						?>
						<a class="button-primary revred button_delete_slider" id="button_delete_<?php echo $id?>" href='javascript:void(0)' title="<?php echo "Delete";?>"><i class="revicon-trash"></i></a>
						<a class="button-primary revyellow button_duplicate_slider" id="button_duplicate_<?php echo $id?>" href='javascript:void(0)' title="<?php echo "Duplicate";?>"><i class="revicon-picture"></i></a>
						<div id="button_preview_<?php echo $id?>" class="button_slider_preview button-primary revgray" title="<?php echo "Preview";?>"><i class="revicon-search-1"></i></div>
					</td>
	
				</tr>							
				<?php
			}
			?>
			
		</tbody>		 
	</table>
<?php } ?>
	<p>
		<div style="float: left;">		
			<a class='button-primary revblue' href='<?php echo JRoute::_('index.php?option=com_jm_slider_revolution&view=slider&layout=edit');?>'><?php echo "Create New Slider";?> </a>
		</div>
		<?php
		if(!$no_sliders){		
			$num_of_pages = ceil( $total / $limit );
			$param = 'pagenum';
				?>
				<form style="float:left; margin-left:10px" action="" method="GET">
					<input type="hidden" name="option" value="com_jm_slider_revolution" />
					<input type="hidden" name="view" value="sliders" />
					<select name="limit" onchange="this.form.submit()">
						<option <?php echo ($limit == 10) ? 'selected="selected"' : ''; ?> value="10">10</option>
						<option <?php echo ($limit == 25) ? 'selected="selected"' : ''; ?> value="25">25</option>
						<option <?php echo ($limit == 50) ? 'selected="selected"' : ''; ?> value="50">50</option>
						<option <?php echo ($limit == 9999) ? 'selected="selected"' : ''; ?> value="9999"><?php echo 'All'; ?></option>
					</select>
				</form>
				<?php
			
		}
		?>
		<div style="float: right;"><a id="button_import_slider" class='button-primary float_right revgreen' href='javascript:void(0)'><?php echo "Import Slider";?> </a></div>
		<div style="clear:both; height:10px"></div>
	</p>
	<?php require_once "dialog_preview_slider.php";?>


	