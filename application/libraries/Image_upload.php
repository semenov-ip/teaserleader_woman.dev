<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Image_upload {
  public $ci, $typeOptions, $currentImageType;

  function __construct(){
    $this->ci =& get_instance();

    $this->typeOptions = array(
      'image/gif'=>'.gif',
      'image/jpg'=>'.jpg',
      'image/jpeg'=>'.jpeg',
      'image/png'=>'.png'
    );
  }

  function getCorrectImageUpload($prefixesIdImageName, $nameInput, $newSrcImageUrl){

    $standardSrcSave = $_FILES[$nameInput]['tmp_name'];

    $this->currentImageType = $_FILES[$nameInput]['type'];

    $prefixesDataImageName = substr(md5($this->ci->config->item('datetime')), 0, 6);

    if( $this->emptyImage($standardSrcSave) ) { return "empty_image"; }
    
    if( $this->checkTypeImage() ) { return "error_image_type"; }

    if( !empty($this->currentImageType) ){
      $_POST[$nameInput] = $newSrcImageUrl.$prefixesIdImageName.'_'.$prefixesDataImageName.''.$this->typeOptions[$this->currentImageType];
    }

    if( $this->checkFileSizeImage($standardSrcSave) ) { return "more_image_file_size"; }

    if( $this->copyImage($standardSrcSave) && $booleanImageValidation ) { return "image_not_upload"; }

    return true;
  }

  function emptyImage($standardSrcSave){
    if( !$standardSrcSave ) { return true; }

    return false;
  }

  function checkTypeImage(){
    if(!strstr($this->currentImageType, 'gif') && !strstr($this->currentImageType, 'jpeg') && !strstr($this->currentImageType, 'jpg') && !strstr($this->currentImageType, 'png')){
      return true;
    }

    return false;
  }

  function checkFileSizeImage($standardSrcSave){
    if(filesize($standardSrcSave) > $this->ci->config->item('max_image_file_size') * 1024){
      return true;
    }

    return false;
  }

  function copyImage($standardSrcSave){
    if(!@copy($standardSrcSave, '.'.$_POST['image'])){
      return true;
    }

    return false;
  }
}