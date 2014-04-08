<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Ip_geo_base {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function determineLocationSite(){
    return $this->setUpExtractUserLocationCookie();

    if( !isset($_COOKIE['user_country']) ){ return $this->setUpExtractUserLocationCookie(); }

    $location['country'] = $_COOKIE['user_country'];

    $location['region'] = $_COOKIE['user_region'];

    return $location;
  }

  function setUpExtractUserLocationCookie(){
    $userIpArr = $this->getUserIp();

    $longip = $this->getLongIp($userIpArr);

    $dataWhereArr['min_longip <='] = $longip;

    $dataWhereArr['max_longip >='] = $longip;

    $userLocationObj = $this->getUserLocationObj($dataWhereArr);

    $location = array('country' => $this->ci->config->item('other_countries'), 'region' => $this->ci->config->item('other_regions'));

    if( is_array($userLocationObj) ){
      if(!empty($userLocationObj[0]->country)) { $location['country'] = $userLocationObj[0]->country; }
    }

    if( is_array($userLocationObj) ){
      if(!empty($userLocationObj[0]->region)) { $location['region'] = $userLocationObj[0]->region; }
    }

    $this->setCookieLocation($location);

    return $location;
  }

  function getUserIp(){
    if(getenv('REMOTE_ADDR')){

      $user_ip = getenv('REMOTE_ADDR');
    } else {

      $user_ip = getenv('HTTP_X_FORWARDED_FOR');
    }

    return explode(".", $user_ip);
  }

  function getLongIp($iparr){
    return 16777216 * $iparr[0] + 65536 * $iparr[1] + 256 * $iparr[2] + $iparr[3];
  }

  function getUserLocationObj($dataWhereArr){
    return $this->ci->select_models->select_all_row_where_column_selectcolumn_orderby($dataWhereArr, 'max_longip', 'asc', 'country, region', 'ipgeobase');
  }

  function setCookieLocation($location){
    setcookie('user_country', $location['country'], time() + 2592000, '/');

    setcookie('user_region', $location['region'], time() + 2592000, '/');
  }
}