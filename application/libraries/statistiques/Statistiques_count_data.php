<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Statistiques_count_data {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getStatistiqCount($statistiqConfig, $searchData){
    return $this->getStatistiqData($statistiqConfig, $searchData);
  }

  function getStatistiqData($statistiqConfig, $searchData){
    $dataWhereArr[ $statistiqConfig['column_id'] ] = $searchData[$statistiqConfig['column_id']];

    $dataWhereArr['dataadd >='] = timestamp_of_date_formt($searchData['date_start']);

    $dataWhereArr['dataadd <='] = timestamp_of_date_formt($searchData['date_end']);

    return $this->statCountRurCtr($this->ci->statistiques_query->select_all_row_where_column_selectcolumn_count($dataWhereArr, $statistiqConfig['table_name']."_stat"));
  }

  function statCountRurCtr($statistiq){
    if( is_array($statistiq) ){
      $statistiq['ctr'] = str_replace(",", ".", @sprintf("%.2f", (100 / $statistiq['view']) * $statistiq['click']));

      $statistiq['count_money'] = number_format($statistiq['money'], 2, '.', '');

      return $statistiq;
    }
    return false;
  }
}