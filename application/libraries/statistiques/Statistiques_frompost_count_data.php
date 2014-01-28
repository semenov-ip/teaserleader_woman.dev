<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Statistiques_frompost_count_data {
  public $ci, $commonStatistiqArr;

  function __construct(){
    $this->ci =& get_instance();

    $this->commonStatistiqArr = array('view' => 0, 'click' => 0, 'ctr' => 0, 'count_money' => 0);
  }

  function getStatistiqCount($statistiqConfig, $searchData){
    $curentDataStatistiqArr = $this->getCurentDataStatistiqArr($statistiqConfig, $searchData);

    if(!$curentDataStatistiqArr){ return false; }

    $statistiqCountRurCtr = $this->getStatistiqCountRurCtr($curentDataStatistiqArr);

    $this->getCommonStatistiqCtrRur();

    return array('current' => $statistiqCountRurCtr, 'common' => $this->commonStatistiqArr);
  }

  function getCurentDataStatistiqArr($statistiqConfig, $searchData){
    if(isset($statistiqConfig['keyformname'])) { $dataWhereArr[$statistiqConfig['column_id']] = $searchData[$statistiqConfig['keyformname']]; }

    $dataWhereArr['dataadd >='] = timestamp_of_date_formt($searchData['date_start']);

    $dataWhereArr['dataadd <='] = timestamp_of_date_formt($searchData['date_end']);

    return $this->setDataProcessing($this->ci->statistiques_query->select_all_row_where_and_where_or_column_selectcolumn($dataWhereArr, $statistiqConfig['select_column'], $statistiqConfig['table_name']."_stat"));
  }

  function setDataProcessing($curentDataStatistiqArr){
    if(is_array($curentDataStatistiqArr)){ return $curentDataStatistiqArr; }

    return false;
  }

  function getStatistiqCountRurCtr($curentDataStatistiqArr){
    if( is_array($curentDataStatistiqArr) ){

      foreach ($curentDataStatistiqArr as $key => $statistiq) {

        $statistiq['ctr'] = str_replace(",", ".", @sprintf("%.2f", (100 / $statistiq['view']) * $statistiq['click']));

        $statistiq['count_money'] = number_format($statistiq['money'], 2);

        $statistiq['dataadd'] = date('d-m-Y', $statistiq['dataadd']);

        $this->calculationTotalStatistiq($statistiq);

        $count[] = $statistiq;
      }
      
      return $count;
    }
    return false;
  }

  function calculationTotalStatistiq($statistiq){
    $this->commonStatistiqArr['view'] += $statistiq['view'];
    $this->commonStatistiqArr['click'] += $statistiq['click'];
    $this->commonStatistiqArr['count_money'] += $statistiq['count_money'];
  }

  function getCommonStatistiqCtrRur(){
    $this->commonStatistiqArr['ctr'] = str_replace(",", ".", @sprintf("%.2f", (100 / $this->commonStatistiqArr['view']) * $this->commonStatistiqArr['click']));

    $this->commonStatistiqArr['count_money'] = number_format($this->commonStatistiqArr['count_money'], 2);
  }
}