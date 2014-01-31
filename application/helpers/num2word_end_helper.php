<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function num2word_end($num, $word, $end1, $end2, $end3){
  $len = strlen($num);
  if($len == 2 and $num < 21){
    $end_word = $end3;
  }else{
    $num = substr($num, ($len-1));
    switch ($num){
      case '0':{
        $end_word = $end3;
        break;
      }
      case '1':{
              $end_word = $end1;
        break;
      }
      case '2':{
              $end_word = $end2;
        break;
      }
      case '3':{
              $end_word = $end2;
        break;
      }
      case '4':{
              $end_word = $end2;
        break;
      }
      case '5':{
              $end_word = $end3;
        break;
      }
      case '6':{
              $end_word = $end3;
        break;
      }
      case '7':{
              $end_word = $end3;
        break;
      }
      case '8':{
              $end_word = $end3;
        break;
      }
      case '9':{
              $end_word = $end3;
        break;
      }
    }
  }
  return $word.$end_word;
}