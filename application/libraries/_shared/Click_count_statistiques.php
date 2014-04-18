<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Click_count_statistiques {
  public $ci, $priceStatArr, $priceReferral, $countryColumnName;

  function __construct(){
    $this->ci =& get_instance();
  }

  function prepareStatisticsData($clickData, $priceReferral){
    $this->getPriceStatArr($clickData['price']);

    $this->getPriceReferral($priceReferral);

    $this->getCountryColumnName($clickData['logDataObj']->country);

    $this->countStatistics($this->getDataWhereArr($clickData['logDataObj']->teaser_id, 'teaser_id'), $this->priceStatArr, 'click', 'teasers_stat');

    $this->countStatistics($this->getDataWhereArr($clickData['logDataObj']->campaign_id, 'campaign_id'), $this->priceStatArr, 'click', 'campaigns_stat');

    $this->countStatistics($this->getDataWhereArr($clickData['logDataObj']->block_id, 'block_id'), $this->priceStatArr, 'click', 'blocks_stat');

    $this->countStatistics($this->getDataWhereArr($clickData['logDataObj']->site_id, 'site_id'), $this->priceStatArr, 'click', 'sites_stat');

    $this->countStatistics($this->getDataWhereArr( $clickData['logDataObj']->webmaster_id, 'user_id'), $this->priceStatArr, $this->countryColumnName, 'geo_stat');

    $this->countStatistics($this->getDataWhereArr($clickData['logDataObj']->webmaster_id, 'user_id'), $this->priceReferral
      , 'click', 'referral_stat');
  }

  function getPriceStatArr($price){
    $this->priceStatArr['money'] = $price;
  }

  function getPriceReferral($priceReferral){
    $this->priceReferral['money'] = $priceReferral;
  }

  function getCountryColumnName($country){
    $this->countryColumnName = country_extratc_column_name_click($country);
  }

  function getDataWhereArr($idCurentData, $columnName){
    return array( $columnName => $idCurentData, 'dataadd' => $this->ci->config->item('day') );
  }

  function countStatistics($dataWhereArr, $priceArray, $columnName, $dbTableName){
    $booleanDataStatisticsToday = $this->checkDataStatisticsToday($dataWhereArr, $dbTableName);

    $addDataArr = array_merge($priceArray, $dataWhereArr);
    $addDataArr[$columnName] = 1;

    $dataWhereArr['stat_id'] = $booleanDataStatisticsToday;

    $booleanDataStatisticsToday ? $this->updateCountStatistics($priceArray, $dataWhereArr, $columnName, $dbTableName) : $this->saveCountStatistics($addDataArr, $dbTableName);
  }

  function checkDataStatisticsToday($dataWhereArr, $dbTableName){
    return $this->ci->ckick_query->select_limit_row_where_column_selectcolumn_return_stat_id($dataWhereArr, $dbTableName);
  }

  function updateCountStatistics($dataUpdateSetArr, $dataWhereArr, $incrementColumn, $dbTableName){
    $this->ci->ckick_query->update_set_several_where_column_plus_set_column($dataUpdateSetArr, $dataWhereArr, $incrementColumn, $dbTableName);
  }

  function saveCountStatistics($addDataArr, $dbTableName){
    $this->ci->insert_models->insert_data_return_id($addDataArr, $dbTableName);
  }
}