<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Validation_data_settings {
  public $ci, $top10Login, $curr_num;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getCorrectData($top10Login, $curr_num){

    $this->getTop10Login($top10Login);

    $this->getCurrNum($curr_num);

    $_POST = $this->top10LoginPartyNoDelenKey($_POST);

    if( !execute_trim_empty_form( $_POST, array('notshow_top10_login') ) ) return "empty_data";

    if( !$this->webmoneyDoubleSaveError($_POST['curr_num']) ) return "webmoney_double_save";

    if( !$this->webmoneyInputError($_POST['curr_num']) ) return "webmoney_input_error";

    return true;
  }

  function getTop10Login($top10Login){
    $this->top10Login = $top10Login;
  }

  function getCurrNum($curr_num){
    $this->curr_num = $curr_num;
  }

  function top10LoginPartyNoDelenKey($post){

    if( !isset($_POST['notshow_top10_login']) ){

      $post['notshow_top10_login'] = 0;

      $post['top10_login'] = empty($post['top10_login']) ? $post['name'] : $post['top10_login'];
      
      return $post;
    }

    $post['top10_login'] = empty($this->top10Login) ? $post['name'] : $this->top10Login;

    return $post;
  }

  function webmoneyDoubleSaveError($wmr){
    if( !is_null($this->curr_num) && $this->curr_num != $wmr ){
      $_POST['curr_num'] = $this->curr_num;
      return false;
    }
    return true;
  }

  function webmoneyInputError($wmr){
    if(substr($wmr, 0, 1) != 'R' || strlen($wmr) != 13){
      return false;
    }
    return true;
  }

}