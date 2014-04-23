<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_site_statistiques_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){
    $data['curentColumnSort'] = curent_sort_builder(array($data['statistiqData']['sorter_column']), $data['statistiqData']['sorter_by'], $this->getSortKeyValueData(), true);

    return $data;
  }

  function getSortKeyValueData(){
    return array('view' => 'Показов', 'click' => 'Кликов', 'ctr' => 'CTR', 'money' => 'Доход');
  }
}