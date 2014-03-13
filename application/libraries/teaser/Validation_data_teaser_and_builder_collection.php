<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_teaser_and_builder_collection {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData($campaignId, $booleanImageValidation = true, $image = true){

    $_POST = setup_array_noisset_data($_POST, array('section_id'));

    if( !execute_trim_empty_form( $_POST, array('image', 'section_id', 'image_name') ) ) return "empty_data";

    if( $booleanImageValidation ){

      $statusImageUpload = $this->ci->image_upload->getCorrectImageUpload($campaignId, 'image', '/images_teaser/');

      if( $statusImageUpload !== true && $image ){
        return $statusImageUpload;
      }
    }

    $this->urlBuilder();

    if( $this->checkTextSize() ){ return "more_text_size"; }

    if( $this->checkEmptySection() ){ return "check_empty_section"; }

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

  function checkEmptySection(){
    if( empty($_POST['section_id']) ){ return true; }

    return false;
  }
}