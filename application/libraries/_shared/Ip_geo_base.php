<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Ip_geo_base {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function determineLocationSite(){

    if( !isset($_COOKIE['user_city']) ){ return $this->setUpExtractUserLocationCookie(); }

    $location['country'] = $_COOKIE['user_country'];
    $location['region'] = $_COOKIE['user_country'];
    $location['city'] = $_COOKIE['user_city'];

    return $location;
  }

  function setUpExtractUserLocationCookie(){
    $userIpArr = $this->getUserIp();

    $longip = $this->getLongIp($userIpArr);

    $dataWhereArr['min_longip <='] = $longip;
    $dataWhereArr['max_longip >='] = $longip;

    $userLocationObj = $this->getUserLocationObj($dataWhereArr);

    $location['country'] = is_array($userLocationObj) ? $userLocationObj[0]->country : 'Прочие регионы';
    $location['region'] = is_array($userLocationObj) ? $userLocationObj[0]->region : 'Прочие регионы';
    $location['city'] = is_array($userLocationObj) ? $userLocationObj[0]->city : 'Прочие регионы';

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
    return $this->ci->select_models->select_all_row_where_column_selectcolumn_orderby($dataWhereArr, 'max_longip', 'asc', 'country, city, region', 'ipgeobase');
  }

  function setCookieLocation($location){
    @setcookie('user_city', $location['city'], time() + 2592000, '/');
    @setcookie('user_region', $location['region'], time() + 2592000, '/');
    @setcookie('user_country', $location['country'], time() + 2592000, '/');
  }
}