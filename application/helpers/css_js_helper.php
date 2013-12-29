<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$GLOBALS['countEmptyDataThisCurrentDirectory'] = 2;

if(!function_exists('css_js')){

  function css_js( $typeFile, $directory, $sharedBoolean ){

    $fileArr['_shared'] = extractSharedHeader($typeFile, $sharedBoolean);

    $fileArr[$directory] = scanDirectory($typeFile, $directory);

    $fileGeneralArr =  array_merge($fileArr['_shared'], $fileArr[$directory]);

    if(count($fileGeneralArr) > $GLOBALS['countEmptyDataThisCurrentDirectory']){

      foreach ($fileGeneralArr as $key => $value) {

        if( preg_match("/\.$typeFile/si", $value) ){

          $cssHeaderArr[] = $value;
        }

      }

      return isset($cssHeaderArr) ? $cssHeaderArr : false;
    }

    return false;
  }
}

function extractSharedHeader($typeFile, $sharedBoolean){

  if($sharedBoolean){

    $GLOBALS['countEmptyDataThisCurrentDirectory'] = 4;

    return scanDirectory($typeFile, '_shared');

  }

  return array();
}

function scanDirectory($typeFile, $folderCurrent){

  $scaningFolder = scandir("$typeFile/$folderCurrent/");

  foreach ($scaningFolder as $key => $value) {

    $scaningFolderAndFile[] = "/".$typeFile."/".$folderCurrent."/".$value;

  }

  return $scaningFolderAndFile;
}