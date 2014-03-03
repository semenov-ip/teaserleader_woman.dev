<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Search_id_url_mail {
  public $ci, $searchDataWhereArray, $commonStatistiqArr, $searchElementUrlArray, $searchElementIdArray, $searchElementEmailArray;

  function __construct(){
    $this->ci =& get_instance();

    $this->searchDataWhereArray = array();
  }

  function getSearchData($searchData){
    $searchDataArray = (strpos($searchData, ',')  === false) ? array($searchData) : explode( ',', $searchData );

    foreach ($searchDataArray as $key => $search) { $this->defineElement($search); }

    $this->getSearchDataWhere($this->searchElementIdArray, 'site_id', 'ls.site_id');

    $this->getSearchDataWhere($this->searchElementUrlArray, 'url', 'ls.url');

    if( !empty($this->searchElementEmailArray) ){
      foreach ($this->searchElementEmailArray as $key => $searchElementEmailArray) {
        $this->searchDataWhereArray[] = array('ls.user_id' => $this->getUserId($searchElementEmailArray['email']));
      }
    }

    return $this->searchDataWhereArray;
  }

  function defineElement($search){
    if( preg_match( "/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/", $search) ){ $this->searchElementEmailArray[]['email'] = trim($search); return true; }

    if( strpos($search, '.') ){ $this->searchElementUrlArray[]['url'] = trim($search); return true; }

    if( is_numeric($search) ){ $this->searchElementIdArray[]['site_id'] = trim($search); ; return true; }
  }

  function getSearchDataWhere($searchElement, $keySearchElement, $elementDbWhere){
    if( !empty($searchElement) ){

      foreach ( $searchElement as $key => $searchElementUrlArray) {

        $this->searchDataWhereArray[] = array( $elementDbWhere => $searchElementUrlArray[$keySearchElement]); 

      }
    }
  }

  function getUserId($email){
    return extract_key_this_object($this->ci->select_models->select_one_row_where_column_selectcolumn(array('email' => $email), 'user_id', 'users'), 'user_id' );
  }
}