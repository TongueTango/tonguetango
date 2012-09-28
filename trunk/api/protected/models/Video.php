<?php
class Video extends CFormModel
{
    public $file;
    public $savePath;
    public $fullPath;
    public $name;
    
 
    public function rules()
    {
        return array(
            array('image', 'file', 'types'=>'mp4, mp3'),
        );
    }

    public function beforeSave() {
    	$this->name	= microtime(true).'-'.$this->file['name'];
    	$this->fullPath = $this->savePath . DIRECTORY_SEPARATOR . $this->name;
    	$this->file->saveAs( $this->fullPath );

    	return true;
    }
}
?>