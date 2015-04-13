<?php
/**
 * @version     1.0.0
 * @package     com_jm_slider_revolution
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      JoomlaMan <support@joomlaman.com> - http://JoomlaMan.com
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHTML::_('script', 'system/multiselect.js', false, true);
jimport('joomla.form.form');
JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
$form = JForm::getInstance('com_jm_slider_revolution.slider', 'slider');
?>
<?php
	$orders = false;
	$orderst = false;
	if(isset($_GET['ot']) && isset($_GET['order']) && isset($_GET['type'])){
		$order = array();
		switch($_GET['ot']){
			case 'alias':
				$order['alias'] = ($_GET['order'] == 'asc') ? 'ASC' : 'DESC';
			break;
			case 'name':
			default:
				$order['title'] = ($_GET['order'] == 'asc') ? 'ASC' : 'DESC';
			break;
		}
		
		if($_GET['type'] != 'reg')
			$orderst = $order;
		else
			$orders = $order;
	}
	
	
	$slider = new RevSlider();
	$UniteFunctionsRev = new UniteFunctionsRev();
	$arrSliders = $slider->getArrSliders(false, $orders);
	$arrSlidersTemplates = $slider->getArrSliders(true, $orderst);
	require ("sliders.php");
	
	
?>


	