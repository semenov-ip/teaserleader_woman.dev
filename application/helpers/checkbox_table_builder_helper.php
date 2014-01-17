<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('checkbox_table_builder')){

  function checkbox_table_builder($valueCurrentArr, $valueAllDataArr, $trCount, $name, $includeKeyThisValBoolean = false){

    $checkboxStr = "<table>";

    $countDataOneRow = round(count($valueAllDataArr)/$trCount);

    $count = 1;

    foreach ($valueAllDataArr as $keyCommon => $valueCommon) {

      $selected = "";

      $selected = setUpChecked($valueCurrentArr, $valueCommon, $keyCommon, $includeKeyThisValBoolean);

      $value = $includeKeyThisValBoolean ? $keyCommon : $valueCommon;

      if( $count === $countDataOneRow ){ $checkboxStr .= "<tr>"; }

      $checkboxStr .= '<td><label><input name="'.$name.'[]" type="checkbox" value="'.trim($value).'" '.$selected.'>'.trim($valueCommon).'</label></td>';

      if( $count == $countDataOneRow ){ $checkboxStr .= "</tr>"; $count = 0; }

      $count++;
    }
    
    $checkboxStr .= "</table>"; 

    return $checkboxStr;
  }

  function setUpChecked($valueCurrentArr, $valueCommon, $keyCommon, $includeKeyThisValBoolean){
    if( $includeKeyThisValBoolean && in_array( $keyCommon, $valueCurrentArr )){ return 'checked'; }
    
    if(in_array( $valueCommon, $valueCurrentArr )){ return 'checked'; }

    return "";
  }
}