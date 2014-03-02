<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_teaser_and_builder_collection {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData($campaignId, $booleanImageValidation = true, $image = true){

    if( !execute_trim_empty_form( $_POST, array('image') ) ) return "empty_data";

    $this->urlBuilder();

    if( $this->checkTextSize() ){ return "more_text_size"; }

    if( $booleanImageValidation ){

      $statusImageUpload = $this->ci->image_upload->getCorrectImageUpload($campaignId, 'image', '/images_teaser/');

      if( $statusImageUpload !== true && $image ){
        return $statusImageUpload;
      }
    }

    return true;
  }

  function urlBuilder(){
    if(substr($_POST['url'], 0, 7) != 'http://'){ $_POST['url'] = 'http://'.$_POST['url']; }
  }

  function checkTextSize(){
    if(strlen(utf8_decode($_POST['text'])) > 100){
      
      $_POST['text'] = substr(utf8_decode($_POST['text']), 0, 100);
      
      return true;
    }

    return false;
  }
}