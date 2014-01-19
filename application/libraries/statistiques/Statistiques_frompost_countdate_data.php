<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Statistiques_frompost_countdate_data {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getStatistiqCount($statistiqConfig, $searchData){

    return $this->getCurentDataStatistiqArr($statistiqConfig, $searchData);
  }

  function getCurentDataStatistiqArr($statistiqConfig, $searchData){
    $dataWhereArr['dataadd >='] = timestamp_of_date_formt($searchData['date_start']);

    $dataWhereArr['dataadd <='] = timestamp_of_date_formt($searchData['date_end']);

    return $this->setDataProcessing($this->ci->statistiques_query->select_all_row_where_and_where_or_column_selectcolumn($dataWhereArr, $statistiqConfig['select_column'], $statistiqConfig['table_name']."_stat"));
  }

  function setDataProcessing($curentDataStatistiqArr){
    if(is_array($curentDataStatistiqArr)){ return $this->getStatistiqDataDefinition($curentDataStatistiqArr); }

    return false;
  }

  function getStatistiqDataDefinition($curentDataStatistiqArr){

    foreach ($curentDataStatistiqArr as $key => $statistiq) {

      $curentDataStatistiqArr[$key]['dataadd'] = date('d-m-Y', $statistiq['dataadd']);
    }

    return $curentDataStatistiqArr;
  }
}