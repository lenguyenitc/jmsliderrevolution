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
jimport('joomla.application.component.controllerform');
jimport( 'joomla.filesystem.file' );
jimport( 'joomla.filesystem.archive' );
jimport( 'joomla.filesystem.archive.zip' );
if(!class_exists('JArchiveZip')){
    include JPATH_SITE.'/libraries/joomla/filesystem/archive/zip.php';
}
/**
 * Slideshowslider controller class.
 */
class Jm_deluxe_layer_slideshowControllerSlideshowslider extends JControllerForm {
    function __construct() {
        $this->view_list = 'slideshowsliders';
        parent::__construct();
    }
	
	/* function cancel($key = null, $urlVar = null){
		 parent::cancel();
	} */

    function layerslider($key = null, $urlVar = null) {
        // Initialise variables.
        $app = JFactory::getApplication();
        $model = $this->getModel();
        $table = $model->getTable();
        $cid = JRequest::getVar('cid', array(), 'post', 'array');
        $id = JRequest::getVar('id');
        $context = "$this->option.edit.$this->context";
        // Determine the name of the primary key for the data.
        if (empty($key)) {
            $key = $table->getKeyName();
        }

        // To avoid data collisions the urlVar may be different from the primary key.
        if (empty($urlVar)) {
            $urlVar = $key;
        }

        // Get the previous record id (if any) and the current record id.
        $recordId = (int) (count($cid) ? $cid[0] : JRequest::getInt($urlVar));
        $checkin = property_exists($table, 'checked_out');

        // Access check.
        if (!$this->allowEdit(array($key => $recordId), $key)) {
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_EDIT_NOT_PERMITTED'));
            $this->setMessage($this->getError(), 'error');

            $this->setRedirect(
                    JRoute::_(
                            'index.php?option=' . $this->option . '&view=' . $this->view_list
                            . $this->getRedirectToListAppend(), false
                    )
            );
            return false;
        }

        // Attempt to check-out the new record for editing and redirect.
        if ($checkin && !$model->checkout($recordId)) {
            // Check-out failed, display a notice but allow the user to see the record.
            $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_CHECKOUT_FAILED', $model->getError()));
            $this->setMessage($this->getError(), 'error');

            $this->setRedirect(
                    JRoute::_(
                            'index.php?option=' . $this->option . '&view=' . $this->view_item
                            . $this->getRedirectToItemAppend($recordId, $urlVar), false
                    )
            );
            return false;
        } else {
            // Check-out succeeded, push the new record id into the session.
            $this->holdEditId($context, $recordId);
            $app->setUserState($context . '.data', null);

            $this->setRedirect(
                    JRoute::_(
                            'index.php?option=' . $this->option . '&view=slideshowslider&layout=layerslider&id=' . $id, false
                    )
            );
            return true;
        }
    }

    function globalsetting($key = null, $urlVar = null) {
        // Initialise variables.
        $app = JFactory::getApplication();
        $model = $this->getModel();
        $table = $model->getTable();
        $cid = JRequest::getVar('cid', array(), 'post', 'array');
        $id = JRequest::getVar('id');
        $context = "$this->option.edit.$this->context";
        // Determine the name of the primary key for the data.
        if (empty($key)) {
            $key = $table->getKeyName();
        }

        // To avoid data collisions the urlVar may be different from the primary key.
        if (empty($urlVar)) {
            $urlVar = $key;
        }

        // Get the previous record id (if any) and the current record id.
        $recordId = (int) (count($cid) ? $cid[0] : JRequest::getInt($urlVar));
        $checkin = property_exists($table, 'checked_out');

        // Access check.
        if (!$this->allowEdit(array($key => $recordId), $key)) {
            $this->setError(JText::_('JLIB_APPLICATION_ERROR_EDIT_NOT_PERMITTED'));
            $this->setMessage($this->getError(), 'error');

            $this->setRedirect(
                    JRoute::_(
                            'index.php?option=' . $this->option . '&view=' . $this->view_list
                            . $this->getRedirectToListAppend(), false
                    )
            );
            return false;
        }

        // Attempt to check-out the new record for editing and redirect.
        if ($checkin && !$model->checkout($recordId)) {
            // Check-out failed, display a notice but allow the user to see the record.
            $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_CHECKOUT_FAILED', $model->getError()));
            $this->setMessage($this->getError(), 'error');

            $this->setRedirect(
                    JRoute::_(
                            'index.php?option=' . $this->option . '&view=' . $this->view_item
                            . $this->getRedirectToItemAppend($recordId, $urlVar), false
                    )
            );
            return false;
        } else {
            // Check-out succeeded, push the new record id into the session.
            $this->holdEditId($context, $recordId);
            $app->setUserState($context . '.data', null);

            $this->setRedirect(
                    JRoute::_(
                            'index.php?option=' . $this->option . '&view=slideshowslider&layout=globalsettings&id=' . $id, false
                    )
            );
            return true;
        }
    }
    
    
    function import(){
        $zip = new JArchiveZip();
        $app = JFactory::getApplication();
        $filename = 'import-'.rand(0,99999).date('YmdHsi');
        $filepath = JPATH_SITE.'/import/'.$filename;
        if($_FILES){
            $tmp_name = $_FILES['data_import']['tmp_name'];
            $name = $_FILES['data_import']['name'];
            if(!file_exists(JPATH_SITE.'/import')) {
                mkdir(JPATH_SITE.'/import', 0777, true);
            }
            $tmpl = explode(".", $name);
            $dest = $filepath.'.'.end($tmpl);
            JFile::upload($tmp_name, $dest);
            if(!file_exists($filepath)) {
                mkdir($filepath, 0777, true);  
            }
            $zip->extract($dest,$filepath);
        }else{
            $zip->extract(JPATH_COMPONENT_ADMINISTRATOR.'/data/data_import.zip',$filepath);
        }
        $files = JFolder::files($filepath); 
        $file = is_file($filepath.'/'.$files[0])?file_get_contents ($filepath.'/'.$files[0]):'Failed';
        $slider = json_decode(base64_decode($file)); 
        $db = JFactory::getDbo();
        $user = JFactory::getUser();
        $background = null;  
        foreach($slider->layers as $layer){
            $background = $this->createFile($layer->background);
            $layer->background = $background;
            $slidesublayer = $layer->slidesublayer; 
            if($slidesublayer){
                $image = null;
                foreach($slidesublayer as $sublayer){
                    if($sublayer->type=="image"){
                        $image = $this->createFile($sublayer->content);
                        $sublayer->content = $image;
                    }
                }
            }
        }
        $backgroundimage = $this->createFile($slider->setting->backgroundimage);
        $slider->setting->backgroundimage = $backgroundimage;
        $data = (base64_encode(json_encode($slider->layers)));
        $setting = (base64_encode(json_encode($slider->setting)));
        $title = $slider->title;
        $query = 'INSERT INTO `#__jmparallax_slideshow_sliders`(`created_by`,`title`,`data`,`setting`) VALUES ("'.$user->id.'","'.$title.'","'.$data.'","'.$setting.'")';
        $db->setQuery($query);
        $db->query(); 
        $app->redirect('index.php?option=' . $this->option . '&view=' . $this->view_list. $this->getRedirectToListAppend(),'Success!');
    }
    function save($key = NULL, $urlVar = NULL){
        $model = $this->getModel('slideshowslider');
        $data = JRequest::getVar('jform');
        $results = $model->save($data);
        if($results){
        $app = JFactory::getApplication();
        $app->redirect('index.php?option=com_jm_deluxe_layer_slideshow&view=slideshowslider&layout=layerslider&id=' .$results,'Saved!');
        }else{
            return false;
        }
    }
    function createFile($data){
        $ext = array('image/gif'=>'.gif','image/jpeg'=>'.jpg','image/png'=>'.png');
        $content = file_get_contents($data);
        $info = getimagesize($data);
        $image = 'images/report-'.rand(0,99999).date('YmdHsi').$ext[$info['mime']];
        $fp = fopen(JPATH_SITE.'/'.$image,'wb');
        fwrite($fp,$content);
        fclose($fp);
        return $image;
    }
    
    
    function getDataURI($image, $mime = '') {
        //echo $image;die;
        $info = pathinfo(JPATH_SITE.'/'.$image);
        if(is_file(JPATH_SITE.'/'.$image)){
            return 'data: image/'.$info['extension'].';base64,'.base64_encode(file_get_contents(JPATH_SITE.'/'.$image));
        }else{
            return $image;
        }
    }
    
    function getDataSlider($id){
        $db = JFactory::getDbo();
        $query = 'SELECT * FROM #__jmparallax_slideshow_sliders WHERE id='.$id;
        $db->setQuery($query);
        return $db->loadObject();
    }
    
    function exportData(){
        //ob_start();
        $id = JRequest::getVar('id');
        $slider = $this->getDataSlider($id);
        $layers = (json_decode(base64_decode($slider->data)));
        $setting = (json_decode(base64_decode($slider->setting)));
        $backgroundimage = $this->getDataURI($setting->backgroundimage);
        $setting->backgroundimage = $backgroundimage;
        if($layers){
            foreach($layers as $layer){
                $background = $layer->background;
                $layer->background = $this->getDataURI($background);
                $slidesublayer = $layer->slidesublayer;
                if($slidesublayer){
                    foreach($slidesublayer as $sublayer){
                        if($sublayer->type=="image"){
                            $image = $sublayer->content;
                            $sublayer->content = $this->getDataURI($image);
                        }
                    }
                }
            }
        }
        $_slider = new stdClass();
        $_slider->title = $slider->title;
        $_slider->layers = $layers;
        $_slider->setting = $setting; 
        $content = (base64_encode(json_encode($_slider)));
        $file = 'export-'.rand(0,99999).date('YmdHsi');
        $filename = $file.'.zip';
        if (!file_exists(JPATH_SITE.'/export')) {
            mkdir(JPATH_SITE.'/export', 0777, true);
        }
        $fp = fopen(JPATH_SITE.'/export/'.$file.'.txt','wb');
        fwrite($fp,$content);
        fclose($fp);
        $data = JFile::read(JPATH_SITE.'/export/'.$file.'.txt');
        $zipFilesArray = array(array('name'=>$file.'.txt','data'=>$data));
        $zip = new JArchiveZip();
        if (!$zip->create( JPATH_SITE.'/export/'.$filename, $zipFilesArray, array() )) {
            global $mainframe;
            $mainframe->enqueueMessage('Error creating zip file.', 'message');
        }
        $file_path = JPATH_SITE.'/export/'.$filename;
        $file = @fopen($file_path,"rb");
        //print_r($file);die;
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Length: ". filesize(JPATH_SITE.'/export/'.$filename).";");
        header("Content-Disposition: attachment; filename=$filename");
        header('Content-Type: application/zip');
        header("Content-Transfer-Encoding: binary");
        //od_end_clean();
        readfile(JPATH_SITE.'/export/'.$filename);
        //flush();
        die;
    }
}