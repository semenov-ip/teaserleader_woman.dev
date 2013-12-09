<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * check_user - проверяет пользователя
 * !сделать библиотеку
*/
if(!function_exists('css_js')){
  
  function css_js($typeFile, $directory){
    $cssFileArr['_shared'] = scanDirectory($typeFile, '_shared');

    $cssFileArr[$directory] = scanDirectory($typeFile, $directory);
    
    $cssFileGeneralArr =  array_merge($cssFileArr['_shared'], $cssFileArr[$directory]);
    
    if(count($cssFileGeneralArr) > 4){
      
      foreach ($cssFileGeneralArr as $key => $value) {
        
        if( preg_match("/\.$typeFile/si", $value) ){
          
          $cssHeaderArr[] = $value;
        }

      }

      return $cssHeaderArr;
    }
    
    return false;
  }
}

function scanDirectory($typeFile, $folderCurrent){
  
  $scaningFolder = scandir("$typeFile/$folderCurrent/");

  foreach ($scaningFolder as $key => $value) {
    
    $scaningFolderAndFile[] = "/".$typeFile."/".$folderCurrent."/".$value;
  
  }

  return $scaningFolderAndFile;
}