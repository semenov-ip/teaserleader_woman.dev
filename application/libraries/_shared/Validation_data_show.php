<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_show {
  public $ci, $status;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData($blockId, $referer){

    if( $this->httpRefererIsset() ){ return "show_referer"; }

    if( $this->blockIdAndRefererEmpty($blockId, $referer) ){ return "empty_blockid_referer"; }

    if( $this->remotePortEmpty() ){ return "emprt_remote_port"; }

    if( $this->httpUserAgentEmpty() ){ return "emprt_user_agen"; }

    if( $this->blockIdAndRefererEmptyDb($blockId, $referer) ){ return "empty_blockid_referer_db"; }

    if( $this->blockStatus() ){ return "block_status_off"; }

    return true;
  }

  function httpRefererIsset(){

    if(!isset($_SERVER['HTTP_REFERER'])){ return true; };

    return false;
  }

  function blockIdAndRefererEmpty($blockId, $referer){
    if(empty($blockId) || empty($referer)){ return true; }
  }

  function remotePortEmpty(){
    if( empty($_SERVER['REMOTE_PORT']) ){ return true; }

    return false;
  }

  function httpUserAgentEmpty(){
    if(empty($_SERVER['HTTP_USER_AGENT'])){ return true; }

    return false;
  }

  function blockIdAndRefererEmptyDb($blockId, $referer){
    $dataWhereArr = array( 'b.block_id' => $blockId, 's.url' => $referer);

    $blockDataObj = $this->ci->show_query->select_one_from_where_column_selectcolumn_join($dataWhereArr, 'b.block_id, s.status', 'blocks b');

    if( !$blockDataObj ){ return true; }

    $this->status = $blockDataObj->status;

    return false;
  }

  function blockStatus(){
    if($this->status === "0"){return true; }

    return false;
  }
}