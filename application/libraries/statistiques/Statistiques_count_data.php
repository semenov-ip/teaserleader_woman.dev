<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Statistiques_count_data {
  public $ci, $commonStatistiqArr;

  function __construct(){
    $this->ci =& get_instance();

    $this->commonStatistiqArr = array('view' => 0, 'click' => 0, 'ctr' => 0, 'count_rur' => 0);
  }

  function getStatistiqCount($statistiqConfig){
    $curentDataArr = $this->getCurentDataArr($statistiqConfig);

    if(!$curentDataArr){ return false; }

    $addStatistiqData = $this->getStatistiqData($curentDataArr, $statistiqConfig);
    
    if( !$addStatistiqData ){ return false; }

    return array('current' => $addStatistiqData, 'common' => $this->commonStatistiqArr);
  }

  function getCurentDataArr($statistiqConfig){
    $dataWhereArr['user_id'] = extract_key_this_array($this->ci->session->userdata('user'), 'user_id');

    return $this->setDataProcessing($this->ci->select_models->select_all_row_where_column_selectcolumn_return_arr($dataWhereArr, $statistiqConfig['select_column'], $statistiqConfig['table_name']));
  }

  function setDataProcessing($curentDataArr){
    if(is_array($curentDataArr)){ return $curentDataArr; }

    return false;
  }

  function getStatistiqData($curentDataArr, $statistiqConfig){
    foreach ($curentDataArr as $key => $oneDataObj) {

      $dataWhereArr[ $statistiqConfig['column_id'] ] = $oneDataObj[$statistiqConfig['column_id']];

      $statistiq = $this->statCountRurCtr($this->ci->statistiques_query->select_all_row_where_column_selectcolumn_count($dataWhereArr, $statistiqConfig['table_name']."_stat"));

      if( !$statistiq ){ return false; }

      $curentStatistiqDataArr[] = array_merge($curentDataArr[$key], $statistiq);
    }

    return $curentStatistiqDataArr;
  }

  function statCountRurCtr($statistiq){
    if( is_array($statistiq) ){
      $statistiq['ctr'] = str_replace(",", ".", @sprintf("%.2f", (100 / $statistiq['view']) * $statistiq['click']));

      $statistiq['count_rur'] = number_format($statistiq['money_ru'] + $statistiq['money_sng'], 2);

      $this->commonStatistiqArr['view'] += $statistiq['view'];
      $this->commonStatistiqArr['click'] += $statistiq['click'];
      $this->commonStatistiqArr['ctr'] += $statistiq['ctr'];
      $this->commonStatistiqArr['count_rur'] += $statistiq['count_rur'];

      return $statistiq;
    }
    return false;
  }
}