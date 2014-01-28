<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  if(!function_exists('get_clean_data_form')){
    
    function get_clean_data_form($dataForm){

      $dataForm = json_decode($dataForm);

      foreach ($dataForm as $key => $value) {
          
          $dataClearForm[$key] = trim($value);

      }
      
      return $dataClearForm;
    }

  }