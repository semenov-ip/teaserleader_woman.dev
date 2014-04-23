<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  if(!function_exists('sort_arr_of_obj')){

    function sort_arr_of_obj($array, $sortby, $direction='asc') {

      $sortedArr = array();

      $tmp_Array = array();


      foreach($array as $k => $v) {

        $tmp_Array[] = strtolower($v->$sortby);

      }

      if($direction=='asc'){

        asort($tmp_Array);

      } else {

        arsort($tmp_Array);

      }

      foreach($tmp_Array as $k=>$tmp){

        $sortedArr[] = $array[$k];

      }

    return $sortedArr;
 
  }
}