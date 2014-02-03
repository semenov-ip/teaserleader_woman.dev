<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Redirect_click_url {
  public $ci, $clickUrl, $labelUrlStart;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getLabelsRedirectUrl($clickData){

    $this->getClickUrl($clickData['teaserDataObj']->url); $this->getLabelUrlStart();

    $campaignDataObj = $this->getCampaignDataObj($clickData['logDataObj']->campaign_id);

    $labelFunction = $campaignDataObj->labels;

    $labelUrl = $this->$labelFunction($clickData, $campaignDataObj);

    return $this->redirectPages($labelFunction, $labelUrl);
  }

  function getClickUrl($url){
    $this->clickUrl = html_entity_decode($url);
  }

  function getLabelUrlStart(){
    $this->labelUrlStart = strstr($this->clickUrl, '?') ? '&' : '?';
  }

  function getCampaignDataObj($campaignId){
    return $this->ci->select_models->select_one_row_where_column_selectcolumn(array('campaign_id' => $campaignId), 'labels, subid', 'campaigns');
  }

  function _utm($clickData){
    return 'utm_source='.$this->ci->config->item('paytitle').'&utm_medium='.$clickData['logDataObj']->site_id.'&utm_campaign='.$clickData['logDataObj']->campaign_id.'&utm_content='.$clickData['logDataObj']->teaser_id.'';
  }

  function _openstat($clickData){
    return '_openstat='.base64_encode(''.$this->ci->config->item('paytitle').';'.$clickData['logDataObj']->campaign_id.';'.$clickData['logDataObj']->teaser_id.';'.$clickData['logDataObj']->site_id.'');
  }

  function _from(){
    return 'from='.$this->ci->config->item('paytitle').'';
  }

  function _subid($clickData, $campaignDataObj){
    if(!empty($campaignDataObj->subid)){
      return $this->subidDesigner( $campaignDataObj->subid, $clickData['logDataObj']->teaser_id, $clickData['logDataObj']->site_id );
    }

    return 'sub1='.$clickData['logDataObj']->teaser_id.'&sub2='.$clickData['logDataObj']->site_id.'';
  }

  function subidDesigner($subid, $teaser_id, $site_id){
    $subid_rename = str_replace("{tiz_id}", $teaser_id, $subid);

    $subid_rename = str_replace("{source}", $site_id, $subid_rename);
  
    return $subid_rename;
  }

  function redirectPages($labelFunction, $labelUrl){
    if( $labelFunction == '_subid' ){ redirect( $this->clickUrl.$labelUrl, 'location'); } 

    redirect( $this->clickUrl.$this->labelUrlStart.$labelUrl, 'location');
  }
}