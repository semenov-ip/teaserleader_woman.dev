<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class data_builder_teaser_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){
    $data['selectChangeSection'] = select_define_builder($data['teaserDataObj']->section_id, $this->getSectionKeyIdValueName(), true);

    return $data;
  }

  function getSectionKeyIdValueName(){
    return $this->ci->select_models->select_all_row_selectcolumn_return_key_value('section_id, section_name', 'section_id', 'section_name', 'sections');
  }

}