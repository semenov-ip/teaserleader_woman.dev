<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('curent_sort_builder')){

  function curent_sort_builder($sorterColumnArr, $sorterBy, $valueAllDataArr, $includeKeyThisValBoolean = false){
    $selectStr = "";

    foreach ($valueAllDataArr as $keyCommon => $valueCommon){
      $mark = setUpSort($sorterColumnArr, $sorterBy, $valueCommon, $keyCommon, $includeKeyThisValBoolean);

      $selectStr .= '<th class="text-align-center">'.$mark.'</a></th>';
    }

    return $selectStr;
  }

  function setUpSort($sorterColumnArr, $sorterBy, $valueCommon, $keyCommon, $includeKeyThisValBoolean){

    if(($includeKeyThisValBoolean && in_array( $keyCommon, $sorterColumnArr )) || in_array( $valueCommon, $sorterColumnArr )){

      $sorter = ($sorterBy == 'desc') ? 'asc' : 'desc';

      return '<div class="sortth"><a title="Кликнуть для сортировки" href="javascript:void(0);" onclick="setSorter(\''.trim($keyCommon).'\', \''.$sorter.'\');">'.trim($valueCommon).' <div class="display-inline-block content-icon icon-position '.$sorterBy.'"></div></a></div>'; 
    }

    return '<a title="Кликнуть для сортировки" href="javascript:void(0);" onclick="setSorter(\''.trim($keyCommon).'\', \'desc\');">'.trim($valueCommon).'</a>';
  }
}