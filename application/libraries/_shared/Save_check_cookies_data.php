<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

  class Save_check_cookies_data {
    public $ci, $url;

    function __construct(){
      $this->ci =& get_instance();
    }

    function checkCookies($url){
      $this->getUrl($url);

      if( !isset($_COOKIE['ladyads_teaser']) ){ return $this->saveCookies(); }

      return false;
    }

    function getUrl($url){
      $this->url = $url;
    }

    function saveCookies(){
      return setcookie('ladyads_teaser', 'have', time() + 86400, '/');
    }
  }