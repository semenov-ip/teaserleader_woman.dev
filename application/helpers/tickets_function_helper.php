<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  if(!function_exists('linkUserCallOn')){
    function linkUserCallOn($userId, $authorName){
      return '<a href="/admin/users_redirected_admin/index/'.$userId.'/">'.$authorName.'</a>';
    }
  }

  if(!function_exists('linkUserCallOff')){
    function linkUserCallOff($authorName){
      return $authorName;
    }
  }

  if(!function_exists('byUserRoles')){
    function byUserRoles(){
      return array( "by" => "by-me", "img" => "question.png", "align_name" => "pull-left", "align_text" => "pull-right");
    }
  }

  if(!function_exists('byAdminRoles')){
    function byAdminRoles(){
      return array( "by" => "by-other", "img" => "user_admin.php", "align_name" => "pull-right", "align_text" => "pull-right");
    }
  }