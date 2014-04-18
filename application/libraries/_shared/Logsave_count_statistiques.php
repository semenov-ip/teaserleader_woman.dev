<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Logsave_count_statistiques {
  public $ci, $countryColumnName, $campaignIdCollection;

  function __construct(){
    $this->ci =& get_instance();

    $this->campaignIdCollection = array();
  }

  function saveDataLogAndStat($teaserDataObj, $blockDataObj){

    $this->createLogTable();

    $this->getCountryColumnName($blockDataObj->country);

    $this->saveLogDataObjAndTeaserStatCompaingStat($teaserDataObj, $blockDataObj);

    if( $this->booleanStatCount() ){ return false; }

    $this->countStatistics($this->getDataWhereArr($blockDataObj->block_id, 'block_id'), 'view', 'blocks_stat');

    $this->countStatistics($this->getDataWhereArr($blockDataObj->site_id, 'site_id'), 'view', 'sites_stat');

    foreach ($teaserDataObj as $key => $oneTeaserDataObj){
      $this->countStatistics($this->getDataWhereArr($oneTeaserDataObj->teaser_id, 'teaser_id'), 'view', 'teasers_stat');
    }

    foreach ($this->campaignIdCollection as $key => $campaignId) {
      $this->countStatistics($this->getDataWhereArr($campaignId, 'campaign_id'), 'view', 'campaigns_stat');
    }

    $this->countStatistics($this->getDataWhereArr( $blockDataObj->user_id, 'user_id'), $this->countryColumnName, 'geo_stat');
  }

  function createLogTable(){
    if( !$this->ci->select_models->database_exists_dbname('logs_'.$this->ci->config->item('day')) ){ $this->ci->show_query->create_table_log('logs_'.$this->ci->config->item('day')); }
  }

  function getCountryColumnName($country){
    $this->countryColumnName = country_extratc_column_name_view($country);
  }

  function saveLogDataObjAndTeaserStatCompaingStat($teaserDataObj, $blockDataObj){
    foreach ( $teaserDataObj as $key => $oneTeaserDataObj ){

      $addDataArr = array(
        'advertiser_id' => $oneTeaserDataObj->user_id,

        'webmaster_id' => $blockDataObj->user_id,

        'site_id' => $blockDataObj->site_id,

        'block_id' => $blockDataObj->block_id,

        'campaign_id' => $oneTeaserDataObj->campaign_id,

        'teaser_id' => $oneTeaserDataObj->teaser_id,

        'country' => $blockDataObj->country,

        'hash' => $oneTeaserDataObj->hash
      );

      $this->ci->insert_models->insert_data_return_id($addDataArr, 'logs_'.$this->ci->config->item('day'));

      $this->updateTeaserDataLastShow($oneTeaserDataObj->teaser_id);

      if(array_search($oneTeaserDataObj->campaign_id, $this->campaignIdCollection) === false){ $this->campaignIdCollection[] = $oneTeaserDataObj->campaign_id; }
    }
  }

  function updateTeaserDataLastShow($teaserId){
    return $this->ci->update_models->update_set_one_where_column(array('last_show' => $this->ci->config->item('date')), array('teaser_id' => $teaserId), 'teasers');
  }

  function booleanStatCount(){
    if( $this->countryColumnName == 'Other_view' ){ return true; }
    return false;
  }

  function getDataWhereArr($idCurentData, $columnName){
    return array( $columnName => $idCurentData, 'dataadd' => $this->ci->config->item('day') );
  }

  function countStatistics($dataWhereArr, $columnName, $dbTableName){
    $booleanDataStatisticsToday = $this->checkDataStatisticsToday($dataWhereArr, $dbTableName);

    $addDataArr = $dataWhereArr;
    $addDataArr[$columnName] = 1;

    $dataWhereArr['stat_id'] = $booleanDataStatisticsToday;

    $booleanDataStatisticsToday ? $this->updateCountStatistics($dataWhereArr, $columnName, $dbTableName) : $this->saveCountStatistics($addDataArr, $dbTableName);
  }

  function checkDataStatisticsToday($dataWhereArr, $dbTableName){
    return $this->ci->show_query->select_limit_row_where_column_selectcolumn_return_stat_id($dataWhereArr, $dbTableName);
  }

  function updateCountStatistics($dataWhereArr, $incrementColumn, $dbTableName){
    $this->ci->show_query->update_set_several_where_column_plus_set_column($dataWhereArr, $incrementColumn, $dbTableName);
  }

  function saveCountStatistics($addDataArr, $dbTableName){
    $this->ci->insert_models->insert_data_return_id($addDataArr, $dbTableName);
  }
}