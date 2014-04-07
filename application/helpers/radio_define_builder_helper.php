<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('radio_define_builder')){

  function radio_define_builder($valueCurrentArr, $valueAllDataArr, $inputName, $includeKeyThisValBoolean = false){
    $selectStr = "";

    foreach ($valueAllDataArr as $keyCommon => $valueCommon) {
      $selected = "";

      $selected = setUpRadio($valueCurrentArr, $valueCommon, $keyCommon, $includeKeyThisValBoolean);

      $value = $includeKeyThisValBoolean ? $keyCommon : $valueCommon;

      $selectStr .=  '<label class="radio border-'.trim($value).'"><input type="radio" name="'.$inputName.'" value="'.trim($value).'" '.$selected.' />'.trim($valueCommon).'</label>';
    }

    return $selectStr;
  }

  function setUpRadio($valueCurrentArr, $valueCommon, $keyCommon, $includeKeyThisValBoolean){
    if( $includeKeyThisValBoolean && in_array( $keyCommon, $valueCurrentArr )){ return 'checked="checked"'; }

    if(in_array( $valueCommon, $valueCurrentArr )){ return 'checked="checked"'; }

    return "";
  }
}