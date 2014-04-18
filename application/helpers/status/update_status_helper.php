<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('update_status')){

  function update_status($dataUpdateArr, $dataWhereArr, $dbTableName){
    $ci =& get_instance();

    return $ci->update_models->update_set_one_where_column($dataUpdateArr, $dataWhereArr, $dbTableName);
  }
}