<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Referral_code_builder {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getReferralCode($blockId){
    $referralCode = '<div id="teaser_'.$blockId.'"><img src="http://'.$_SERVER['SERVER_NAME'].'/images/preolader.gif" /></div><script async type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].'/_shared/show/index/'.$blockId.'"></script>';

    return $referralCode;
  }
}