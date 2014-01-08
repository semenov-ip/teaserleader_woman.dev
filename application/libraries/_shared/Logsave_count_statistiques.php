<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Logsave_count_statistiques {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function saveDataLogAndStat($teaserDataObj, $blockDataObj){

    $this->createLogTable();

    $this->saveLogDataObj($teaserDataObj, $blockDataObj);

    $countBlockOnSite = $this->countBlockOnSite($blockDataObj->site_id);

    $countBlockOnSite == 1 ? $this->countStatistics() : $this->countStatisticsOnID();
  }

  function createLogTable(){

    if( !$this->ci->select_models->database_exists_dbname('logs_'.$this->ci->config->item('day')) ){ $this->ci->show_query->create_table_log('logs_'.$this->ci->config->item('day')); }

  }

  function saveLogDataObj($teaserDataObj, $blockDataObj){
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

      $this->countStatistics( $oneTeaserDataObj->teaser_id, 'teaser_id', country_extratc_column_name($blockDataObj->country), 'teasers_stat' );
    }
  }

  function countBlockOnSite($siteId){
    $dataWhereArr['site_id'] = $siteId;
    $dataWhereArr['status'] = 1;

    return $this->ci->select_models->select_from_where_column_selectcolumn_return_num_rows($dataWhereArr, 'block_id', 'blocks');
  }

  function countStatistics( $idCurentData, $columnName, $countryColumnName, $dbTableName ){
    
    $this->checkCurentData($idCurentData, $columnName, $dbTableName) == 0 ? $this->saveCountStatistics($idCurentData, $columnName, $countryColumnName, $dbTableName) : $this->updateCountStatistics($idCurentData, $columnName, $dbTableName);

  }

  function checkCurentData($idCurentData, $columnName, $dbTableName){
    $dataWhereArr[$columnName] = $idCurentData;
    $dataWhereArr['dataadd'] = $this->ci->config->item('day');

    return $this->ci->select_models->select_from_where_column_selectcolumn_return_num_rows($dataWhereArr, $columnName, $dbTableName);
  }

  function saveCountStatistics($idCurentData, $columnName, $countryColumnName, $dbTableName){
    $addDataArr = array($columnName => $idCurentData,  'dataadd' => $this->ci->config->item('day'), 'view' => 1);

    if($countryColumnName !== false) { $addDataArr[$countryColumnName] = 1; }

    $this->ci->insert_models->insert_data_return_id($addDataArr, $dbTableName);
  }

  function updateCountStatistics(){

  }










  function countStatisticsOnID(){
    
  }
}