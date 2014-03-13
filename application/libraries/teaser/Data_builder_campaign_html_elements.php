<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_campaign_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){
    $data['selectChangeBanCountrys'] = select_define_builder($data['campaignDataObj']->ban_country, $this->getBanCountrysKeyIdValueName(), true);

    $data['selectChangeBanRegions'] = select_define_builder($data['campaignDataObj']->ban_region, $this->getBanRegionsKeyIdValueName());

    $data['checkboxCheckedBanHour'] = checkbox_table_builder($data['campaignDataObj']->ban_hour, $this->getBanHourKeyIdValueName(), 3, 'ban_hour');

    $data['checkboxCheckedBanWeekDay'] = checkbox_table_builder($data['campaignDataObj']->ban_week_day, $this->getBanWeekDayKeyIdValueName(), 2, 'ban_week_day', true);

    $data['selectChangeLabels'] = select_define_builder(array($data['campaignDataObj']->labels), $this->getLabelsKeyIdValueName(), true);

    return $data;
  }

  function getBanCountrysKeyIdValueName(){
    return $this->ci->select_models->select_all_row_selectcolumn_return_key_value_orderby('country, country_name', 'country', 'country_name', 'asc', 'ipgeobase');
  }

  function getBanRegionsKeyIdValueName(){
    $dataWhereArr['country'] = "RU";

    return $this->ci->select_models->select_all_row_where_column_selectcolumn_orderby_groupby($dataWhereArr, 'region', 'asc', 'ipgeobase');
  }

  function getBanHourKeyIdValueName(){
    for($i=0; $i < 24; $i++){
      $banHour[] = $i;
    }

    return $banHour;
  }

  function getBanWeekDayKeyIdValueName(){
    return $this->ci->config->item('daysWeek');
  }

  function getLabelsKeyIdValueName(){
    return array( '_utm'=> 'Utm', '_openstat' => 'Openstat', '_from' => 'From', '_subid' => 'SubID', '_subid_utm' => 'SubID + UTM' );
  }
}