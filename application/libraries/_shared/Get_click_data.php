<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Get_click_data {
  public $ci, $priceStatArr;

  function __construct(){
    $this->ci =& get_instance();
  }

  function clickData($hash){
    $logDataObj = $this->checkLogDataObj($this->getLogDataObj($hash));

    return array(
      'logDataObj' => $logDataObj,

      'teaserDataObj' => $this->getTeaserDataObj($logDataObj->teaser_id),

      'price' => $this->getPrice($logDataObj->site_id, $logDataObj->country),

      'money_stat' => $this->priceStatArr
    );
  }

  function getLogDataObj($hash){
    $dataWhereArr['hash'] = $hash;

    return $this->ci->select_models->select_one_row_where_column($dataWhereArr, 'logs_'.$this->ci->config->item('day'));
  }

  function checkLogDataObj($logDataObj){
    if( !is_object($logDataObj) ) { $this->userDistributor(); }

    return $logDataObj;
  }

  function userDistributor(){
    redirect( "/_shared/user_distributor/", 'location');
  }

  function getTeaserDataObj($teaserId){
    $dataWhereArr['teaser_id'] = $teaserId;

    return $this->ci->select_models->select_one_row_where_column_selectcolumn($dataWhereArr, 'url', 'teasers');
  }

  function getPrice($siteId, $country){
    $sitePrice = $this->ci->select_models->select_one_row_where_column_selectcolumn(array('site_id' => $siteId), 'price, price_sng', 'sites');

    if( $this->checkIndividualSitePrice($sitePrice) ){
      $sitePrice = $this->ci->ckick_query->select_one_from_where_column_selectcolumn_join( array('sit.site_id' => $siteId), 'sec.price, sec.price_sng', 'sites sit' );
    }

    return $this->geoBaseCountry($sitePrice, $country);
  }

  function checkIndividualSitePrice($sitePrice){
    if($sitePrice->price == 0 && $sitePrice->price_sng == 0){ return true; }

    return false;
  }

  function geoBaseCountry($sitePrice, $country){
    if( $country == "RU" ){
      $this->priceStatArr = array('money_ru' => $sitePrice->price);

      return $sitePrice->price; 
    }

    $this->priceStatArr = array('money_sng' => $sitePrice->price_sng);

    return $sitePrice->price_sng;
  }
}