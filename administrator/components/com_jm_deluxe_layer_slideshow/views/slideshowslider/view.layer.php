<?php/** * @version     1.2.0 * @package     com_jm_deluxe_layer_slideshow * @copyright   Copyright (C) 2013 - joomlaman.com. * @license     http://www.gnu.org/copyleft/lgpl.html * @author      JoomlaMan <support@joomlaman.com> - http://joomlaman.com */// No direct accessdefined('_JEXEC') or die;jimport('joomla.application.component.view');/** * View to edit */class Jm_deluxe_layer_slideshowViewSlideshowslider extends JMasterViewDeluxeBaseJm {    /**     * Display the view     */    public function display() {        $data = $_POST['data'];        $slider_id = $_POST['slider_id'];        $title = $_POST['title'];        $id = $_POST['id'];        $setting = $_POST['setting'];        if ($slider_id) {            $this->UpdateSlider($slider_id, $title, $data);        }        if ($id) {            $this->UpdateSliderSetting($id, $setting);        }		die;    }    function UpdateSlider($slider_id, $title, $data) {        $db = JFactory::getDbo();        $query = "UPDATE #__jmparallax_slideshow_sliders SET title='{$title}', data = '{$data}' WHERE id={$slider_id}";        $db->setQuery($query);        $db->query();    }    function UpdateSliderSetting($slider_id, $setting) {        $db = JFactory::getDbo();        $query = "UPDATE #__jmparallax_slideshow_sliders SET setting = '{$setting}' WHERE id={$slider_id}";        $db->setQuery($query);        $db->query();    }}