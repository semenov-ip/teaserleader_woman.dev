<?php

function date2str($date){
  global $var;

  if($date != '0000-00-00 00:00:00'){
    $dt = strtotime($date);

    if(date("j.m.Y", $dt) == date("j.m.Y", strtotime($var['date']))){
      $txt = 'сегодня'.(date("H:i", $dt) != '00:00' ? '&nbsp;в&nbsp;'.date("H:i", $dt) : '');

    }elseif(date("j.m.Y", $dt) == date("j.m.Y", (strtotime($var['date']) - 86400))){
      $txt = 'вчера'.(date("H:i", $dt) != '00:00' ? '&nbsp;в&nbsp;'.date("H:i", $dt) : '');

      }else{
      $txt = date("j", $dt).' '.num2month3(date("m", $dt)).' '.date("Y", $dt);
    }

  }else{
    $txt = '&mdash;';
  }

  return $txt;
}
function num2month3($num){
  switch ($num){
    case 1: $txt="янв."; break;
    case 2: $txt="фев."; break;
    case 3: $txt="мар."; break;
    case 4: $txt="апр."; break;
    case 5: $txt="май"; break;
    case 6: $txt="июн."; break;
    case 7: $txt="июл."; break;
    case 8: $txt="авг."; break;
    case 9: $txt="сент."; break;
    case 10: $txt="окт."; break;
    case 11: $txt="нояб."; break;
    case 12: $txt="дек."; break;
  }

  return $txt;
}