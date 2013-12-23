<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Referral_code_builder {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getReferralCode($blockId){

    $referralCode = "<div id=\"teaser_".$blockId."\"><a href=\"http://".$_SERVER['SERVER_NAME']."/\">".$this->ci->config->item('title_to_code')."</a></div>
<script type=\"text/javascript\">document.write('<scr'+'ipt type=\"text/jav'+'ascript\" src=\"http://".$_SERVER['SERVER_NAME']."/show/?block_id=".$blockId."&r='+escape(document.referrer)+'&'+Math.round(Math.random()*100000)+'\"></scr'+'ipt>');</script>";

    return $referralCode;
  }

}