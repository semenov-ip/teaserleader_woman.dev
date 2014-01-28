<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_statistiq_teaser_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){

    $data['selectDataValue'] = select_define_builder( array($data['statistiqData']['url']), $this->getTeaserDataAll($data['teaserDataAllArrObj']), true );

    return $data;
  }

  function getTeaserDataAll($teaserDataAllArrObj){

    $getTeaserDataAllKeyValue['-1'] = "Выберите объявление";
    
    foreach ($teaserDataAllArrObj as $key => $teaserDataCurentObj) {

      $getTeaserDataAllKeyValue[$teaserDataCurentObj->teaser_id] = $teaserDataCurentObj->url;

    }

    return $getTeaserDataAllKeyValue;
  }
}