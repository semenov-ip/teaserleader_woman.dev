<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('split_string')){

  function split_string($statLogin, $numberWord){
    $statLogin = preg_replace("/\n|\r|\r\n|(\r\n)+/u", "<br />", $statLogin);

    $statLoginArray = explode("<br />", $statLogin);

    foreach ($statLoginArray as $key => $statData) {
      $statLoginArray[$key] = wordwrap2($statData, $numberWord);
    }

    return implode("<br />", $statLoginArray);
  }

}