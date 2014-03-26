<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Click_count_statistiques {
  public $ci, $priceStatArr, $priceReferral, $priceStatGeoArr, $countryColumnName;

  function __construct(){
    $this->ci =& get_instance();
  }

  function prepareStatisticsData($clickData, $priceReferral){
    $this->getPriceStatArr($clickData['price']);

    $this->getPriceStatGeoArr($clickData['money_stat']);

    $this->getPriceReferral($priceReferral);

    $this->getCountryColumnName($clickData['logDataObj']->country);

    $this->countStatistics($clickData['logDataObj']->teaser_id, 'teaser_id', 'teasers_stat');

    $this->countStatistics($clickData['logDataObj']->campaign_id, 'campaign_id', 'campaigns_stat');

    $this->countStatistics($clickData['logDataObj']->block_id, 'block_id', 'blocks_stat');

    $this->countStatistics($clickData['logDataObj']->site_id, 'site_id', 'sites_stat');

    $this->countStatisticsGeo($clickData['logDataObj']->webmaster_id, 'geo_stat');
  }

  function getPriceStatArr($price){
    $this->priceStatArr['money'] = $price;
  }

  function getPriceStatGeoArr($priceStatArr){
    $this->priceStatGeoArr = $priceStatArr;
  }

  function getPriceReferral($priceReferral){
    $this->priceReferral = $priceReferral;
  }

  function getCountryColumnName($country){
    $this->countryColumnName = country_extratc_column_name_click($country);
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
    return $this->ci->select_models->select_limit_row_where_column_selectcolumn($dataWhereArr, 'click', 1, $dbTableName);
  }

  function updateCountStatistics($dataWhereArr, $dbTableName){
    $dataUpdateSetArr = $this->priceStatArr;

    $this->ci->ckick_query->update_set_several_where_column_plus_set_column($dataUpdateSetArr, $dataWhereArr, $dbTableName);
  }

  function saveCountStatistics($addDataArr, $dbTableName){
    $dataUpdateSetArr = $this->priceStatArr;
    $addDataArr['click'] = 1;

    $this->ci->insert_models->insert_data_return_id($addDataArr, $dbTableName);
  }

  function countStatisticsGeo($webmasterId, $dbTableName){
    $dataWhereArr['dataadd'] = $this->ci->config->item('day');
    $dataWhereArr['user_id'] = $webmasterId;

    $dataStatisticsGeoObj = $this->getDataStatisticsGeoObj($dataWhereArr, $dbTableName);

    is_object($dataStatisticsGeoObj) ? $this->updateCountStatisticsGeo($dataWhereArr, $dataStatisticsGeoObj, $dbTableName) : $this->saveCountStatisticsGeo($dataWhereArr, $dbTableName);
  }

  function getDataStatisticsGeoObj($dataWhereArr, $dbTableName){
    return $this->ci->select_models->select_limit_row_where_column_selectcolumn($dataWhereArr, $this->countryColumnName, 1, $dbTableName);
  }

  function updateCountStatisticsGeo($dataWhereArr, $dataStatisticsGeoObj, $dbTableName){
    $column = $this->countryColumnName;

    $dataUpdateArr = array($column => $dataStatisticsGeoObj->$column + 1);

    $this->ci->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, $dbTableName);
  }

  function saveCountStatisticsGeo($addDataArr, $dbTableName){
    $addDataArr[$this->countryColumnName] = 1;

    $this->ci->insert_models->insert_data_return_id($addDataArr, $dbTableName);
  }
}