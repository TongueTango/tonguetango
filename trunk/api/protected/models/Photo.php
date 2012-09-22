<?php
class Photo extends CFormModel
{
    public $image;
    public $savePath;
    public $fullPath;
    public $name;
    
 
    public function rules()
    {
        return array(
            array('image', 'file', 'types'=>'jpg, gif, png'),
        );
    }

    public function beforeSave() {
    	$this->name	= microtime(true).'-'.$file['name'];
    	$this->fullPath = $this->savePath . DIRECTORY_SEPARATOR . $this->name;
    	$this->image->saveAs( $this->fullPath );

    	return true;
    }
}
?>