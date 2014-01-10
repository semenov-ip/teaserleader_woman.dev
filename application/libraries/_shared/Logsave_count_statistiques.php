<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Logsave_count_statistiques {
  public $ci, $countryColumnName;

  function __construct(){
    $this->ci =& get_instance();
  }

  function saveDataLogAndStat($teaserDataObj, $blockDataObj){

    $this->createLogTable();

    $this->getCountryColumnName($blockDataObj->country);

    $this->blocksStat($blockDataObj->block_id);

    $this->siteStat($blockDataObj->site_id, $blockDataObj->block_id);

    $this->saveLogDataObjAndTeaserStatCompaingStat($teaserDataObj, $blockDataObj);
  }

  function createLogTable(){
    if( !$this->ci->select_models->database_exists_dbname('logs_'.$this->ci->config->item('day')) ){ $this->ci->show_query->create_table_log('logs_'.$this->ci->config->item('day')); }
  }

  function getCountryColumnName($country){
    $this->countryColumnName = country_extratc_column_name($country);
  }

  function blocksStat($blockId){
    $this->countStatistics($blockId, 'block_id', 'blocks_stat');
  }

  function siteStat($siteId, $blockId){
    $countIdBlockOnSite = $this->getCountBlockOnSite($siteId);

    if( count($countIdBlockOnSite) !== 1 && $countIdBlockOnSite[0]->block_id == $blockId ){ $this->countStatistics($siteId, 'site_id', 'sites_stat'); }

    if( count($countIdBlockOnSite) === 1 ){ $this->countStatistics($siteId, 'site_id', 'sites_stat'); }
  }

  function getCountBlockOnSite($siteId){
    $dataWhereArr = array('site_id' => $siteId, 'status'=> 1);

    return $this->ci->select_models->select_all_row_where_column_selectcolumn($dataWhereArr, 'block_id', 'blocks');
  }

  function saveLogDataObjAndTeaserStatCompaingStat($teaserDataObj, $blockDataObj){
    $campaignIdCollectionArr = array();

    foreach ( $teaserDataObj as $key => $oneTeaserDataObj ){

      $addDataArr = array(
        'advertiser_id' => $oneTeaserDataObj->user_id,

        'webmaster_id' => $oneTeaserDataObj->user_id,

        'site_id' => $blockDataObj->site_id,

        'block_id' => $blockDataObj->block_id,

        'campaign_id' => $oneTeaserDataObj->campaign_id,

        'teaser_id' => $oneTeaserDataObj->teaser_id,

        'country' => $blockDataObj->country,

        'hash' => $oneTeaserDataObj->hash
      );

      $this->ci->insert_models->insert_data_return_id($addDataArr, 'logs_'.$this->ci->config->item('day'));

      $this->countStatistics( $oneTeaserDataObj->teaser_id, 'teaser_id', 'teasers_stat' );

      if(array_search($oneTeaserDataObj->campaign_id, $campaignIdCollectionArr) === false){ $campaignIdCollectionArr[] = $oneTeaserDataObj->campaign_id; }
    }

    $this->campaignStat($campaignIdCollectionArr);
  }

  function campaignStat($campaignIdCollectionArr){
    foreach ($campaignIdCollectionArr as $key => $campaignId) {
      $this->countStatistics($campaignId, 'campaign_id', 'campaigns_stat');
    }
  }

  function countStatistics($idCurentData, $columnName, $dbTableName){
    $dataWhereArr = $this->getDataWhereArr($idCurentData, $columnName);

    $dataStatisticsObj = $this->getDataStatisticsObj($dataWhereArr, $dbTableName);

    is_object($dataStatisticsObj) ? $this->updateCountStatistics($dataWhereArr, $dataStatisticsObj, $dbTableName) : $this->saveCountStatistics($dataWhereArr, $dbTableName);
  }

  function getDataWhereArr($idCurentData, $columnName){
    return array( $columnName => $idCurentData, 'dataadd' => $this->ci->config->item('day') );
  }

  function getDataStatisticsObj($dataWhereArr, $dbTableName){
    return $this->ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'view, '.$this->countryColumnName, $dbTableName);
  }

  function saveCountStatistics($addDataArr, $dbTableName){
    $addDataArr['view'] = 1;

    if( !empty($this->countryColumnName) ) { $addDataArr[$this->countryColumnName] = 1; }

    $this->ci->insert_models->insert_data_return_id($addDataArr, $dbTableName);
  }

  function updateCountStatistics($dataWhereArr, $dataStatisticsObj, $dbTableName){
    $dataUpdateArr = array('view' => $dataStatisticsObj->view + 1);

    $countryColumnName = $this->countryColumnName;

    if( !empty($countryColumnName) ) { $dataUpdateArr[$countryColumnName] = $dataStatisticsObj->$countryColumnName + 1; }

    $this->ci->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, $dbTableName);
  }
}