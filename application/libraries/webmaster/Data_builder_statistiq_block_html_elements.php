<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_statistiq_block_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){

  	$data['selectDataValue'] = select_define_builder( array($data['statistiqData']['name']), $this->getBlockDataAll($data['blockDataAllArrObj']), true );

    return $data;
  }

  function getBlockDataAll($blockDataAllArrObj){

    $getBlockDataAllKeyValue['-1'] = "Выберите блок";
    
    foreach ($blockDataAllArrObj as $key => $blockDataCurentObj) {

      $getBlockDataAllKeyValue[$blockDataCurentObj->block_id] = $blockDataCurentObj->name;

    }

    return $getBlockDataAllKeyValue;
  }
}