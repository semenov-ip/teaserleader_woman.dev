<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  function return_word_end($num, $word, $end1, $end2, $end3){
    $len = (int) strlen($num);

    if($len === 2 && $num < 21){

      $end_word = $end3;
    
    } else {
      $num_second = substr($num, ($len-1));
      
      switch ($num_second){
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
    return $num.' '.$word.$end_word;
  }