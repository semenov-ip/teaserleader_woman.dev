<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_define_day')){

  function get_define_day(){
    $ci =& get_instance();

    $week_day = array(0=>6, 1=>0, 2=>1, 3=>2, 4=>3, 5=>4, 6=>5);

    $day = $ci->config->item('day');

    return array(
      'today' => '\''.$day.'\', \''.($day+86400).'\'',

      'yesterday' => '\''.($day - 86400).'\', \''.$day.'\'',

      'current_week' => '\''.($day - (86400 * $week_day[date("w", $day)])).'\', \''.$day.'\'',

      'current_month' => '\''.($day - (86400 * (date("j", $day) - 1))).'\', \''.$day.'\'',

      'last_week' => '\''.($day - (86400 * ($week_day[date("w", $day)] + 7))).'\', \''.($day - (86400 * ($week_day[date("w", $day)]))).'\'',

      'last_month' => '\''.(strtotime(date("Y", $day).'-'.(date("m", $day) - 1).'-01')).'\', \''.($day - (86400 * (date("j", $day)))).'\''
    );

  }
}