<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Click_count_statistiques {
  public $ci, $priceStatArr, $priceReferral;

  function __construct(){
    $this->ci =& get_instance();
  }

  function prepareStatisticsData($clickData, $priceReferral){

    $this->getPriceStatArr($clickData['money_stat']);

    $this->getPriceReferral($priceReferral);

    $this->countStatistics($clickData['logDataObj']->teaser_id, 'teaser_id', 'teasers_stat');

    $this->countStatistics($clickData['logDataObj']->campaign_id, 'campaign_id', 'campaigns_stat');

    $this->countStatistics($clickData['logDataObj']->block_id, 'block_id', 'blocks_stat');

    $this->countStatistics($clickData['logDataObj']->site_id, 'site_id', 'sites_stat');

  }

  function getPriceStatArr($priceStatArr){
    $this->priceStatArr = $priceStatArr;
  }

  function getPriceReferral($priceReferral){
    $this->priceReferral = $priceReferral;
  }

  function countStatistics($idCurentData, $columnName, $dbTableName){
    $dataWhereArr = $this->getDataWhereArr($idCurentData, $columnName);

    $dataStatisticsObj = $this->getDataStatisticsObj($dataWhereArr, $dbTableName);

    is_object($dataStatisticsObj) ? $this->updateCountStatistics($dataWhereArr, $dbTableName) : $this->saveCountStatistics($dataWhereArr, $dbTableName);
  }

  function getDataWhereArr($idCurentData, $columnName){
    return array( $columnName => $idCurentData, 'dataadd' => $this->ci->config->item('day') );
  }

  function getDataStatisticsObj($dataWhereArr, $dbTableName){
    return $this->ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'click', $dbTableName);
  }

  function updateCountStatistics($dataWhereArr, $dbTableName){
    $dataUpdateSetArr = $this->priceStatArr;
    $dataUpdateSetArr['money_referral'] = $this->priceReferral;

    $this->ci->ckick_query->update_set_several_where_column_plus_set_column($dataUpdateSetArr, $dataWhereArr, $dbTableName);
  }

  function saveCountStatistics($addDataArr, $dbTableName){
    $dataUpdateSetArr = $this->priceStatArr;
    $dataUpdateSetArr['money_referral'] = $this->priceReferral;
    $addDataArr['click'] = 1;

    $this->ci->insert_models->insert_data_return_id($addDataArr, $dbTableName);
  }
}