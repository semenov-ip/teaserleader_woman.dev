<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Search_id_mail {
  public $ci, $searchDataWhereArray, $searchElementIdArray, $searchElementEmailArray;

  function __construct(){
    $this->ci =& get_instance();

    $this->searchDataWhereArray = array();
  }

  function getSearchData($searchData){
    $searchDataArray = (strpos($searchData, ',')  === false) ? array($searchData) : explode( ',', $searchData );

    foreach ($searchDataArray as $search) { $this->defineElement($search); }

    $this->getSearchDataWhere($this->searchElementIdArray, 'user_id', 'user_id');

    $this->getSearchDataWhere($this->searchElementEmailArray, 'email', 'email');

    return $this->searchDataWhereArray;
  }

  function defineElement($search){
    if( preg_match( "/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/", $search) ){ $this->searchElementEmailArray[]['email'] = trim($search); return true; }

    if( is_numeric($search) ){ $this->searchElementIdArray[]['user_id'] = trim($search); ; return true; }
  }

  function getSearchDataWhere($searchElement, $keySearchElement, $elementDbWhere){
    if( !empty($searchElement) ){

      foreach ( $searchElement as $key => $searchElementArray) {

        $this->searchDataWhereArray[] = array( $elementDbWhere => $searchElementArray[$keySearchElement]); 

      }
    }
  }
}