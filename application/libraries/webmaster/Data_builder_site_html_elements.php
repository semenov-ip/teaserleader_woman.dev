<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_site_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){

  	$data['selectChange'] = select_define_builder(array($data['siteDataObj']->url_encoding), $this->getSiteUrlEncodingKeyIdValueName());

    return $data;
  }

  function getSiteUrlEncodingKeyIdValueName(){
    return array('utf8', 'cp1251', 'koi8r');
  }
}