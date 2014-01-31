<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_define_day')){

  function get_define_day(){
    $ci =& get_instance();

    $week_day = array(0=>6, 1=>0, 2=>1, 3=>2, 4=>3, 5=>4, 6=>5);

    $day = $ci->config->item('day');

    return array(
      'today' => '\''.date( "d-m-Y" , $day).'\', \''.date( "d-m-Y", $day ).'\'',

      'yesterday' => '\''.date( "d-m-Y" , ($day - 86400) ).'\', \''.date( "d-m-Y" , $day - 60*60*24 ).'\'',

      'current_week' => '\''.date( "d-m-Y" , ($day - (86400 * $week_day[date("w", $day)]))).'\', \''.date( "d-m-Y" , $day ).'\'',

      'current_month' => '\''.date( "d-m-Y" , ($day - (86400 * (date("j", $day) - 1)))).'\', \''.date( "d-m-Y" , $day).'\'',

      'last_week' => '\''.date( "d-m-Y" , ($day - (86400 * ($week_day[date("w", $day)] + 7)))).'\', \''.date( "d-m-Y" , ($day - (86400 * ($week_day[date("w", $day)])) - 86400 )).'\'',

      'last_month' => '\''.date( "d-m-Y", (strtotime(date("Y", $day).'-'.(date("m", $day) - 1).'-01'))).'\', \''.date( "d-m-Y" , ($day - (86400 * (date("j", $day))))).'\''
    );

  }
}