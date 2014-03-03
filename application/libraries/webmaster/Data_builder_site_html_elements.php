<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_site_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){

    $data['selectChange'] = select_define_builder(array($data['siteDataObj']->url_encoding), $this->getSiteUrlEncodingKeyIdValueName());

    $data['selectSectionIdChange'] = select_define_builder( array($data['siteDataObj']->section_id ), $this->getSiteSectionIdKeyIdValueName(), true );

    return $data;
  }

  function getSiteUrlEncodingKeyIdValueName(){
    return array('utf8', 'cp1251', 'koi8r');
  }

  function getSiteSectionIdKeyIdValueName(){
    return $this->ci->select_models->select_all_row_selectcolumn_return_key_value('section_id, section_name', 'section_id', 'section_name', 'sections');
  }
}