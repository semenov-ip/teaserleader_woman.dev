<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_statistiq_geo_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){

    $data['selectDataValue'] = select_define_builder( array($data['statistiqData']['country']), $this->getSiteDataAll(), true);

    return $data;
  }

  function getSiteDataAll(){
    return array(
      '-1' => "Выберите страну", 'RU' => "Россия", 'UA' => "Украина", 'BY' => "Белоруссия", 'KZ' => "Казахстан", 'Other' => "Другие страны"
    );
  }
}