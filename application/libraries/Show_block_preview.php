<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Show_block_preview {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getBlockHtml($blockDataObj, $dataWhereIdTeaser = array()){

    $teaserDataObj = $this->getTeaserDataObj($blockDataObj->hor*$blockDataObj->ver, $dataWhereIdTeaser);

    return $this->builderTeserBlock($teaserDataObj, $blockDataObj);
  }

  function getTeaserDataObj($limit, $dataWhereIdTeaser){
    return $this->ci->select_models->select_from_where_in_limit_orderby('teaser_id', $dataWhereIdTeaser, $limit, "last_show", "asc", 'teasers');
  }

  function builderTeserBlock($teaserDataObj, $blockDataObj, $id = ""){
    if( !is_array($teaserDataObj) ){ return false; }
    $trColumnCount = 0;

    $teaserBlockTableHtml = '<table id="teaser_block_table'.$id.'" width="100%" cellspacing="5"><tr>';

    foreach ($teaserDataObj as $teaser) {

      if($trColumnCount >= $blockDataObj->hor){ $trColumnCount = 0; $teaserBlockTableHtml .= '</tr><tr>'; }

      $teaserBlockTableHtml .= $this->tdTableBuilder($teaser, $blockDataObj, $id);

      $trColumnCount ++;
    }

    return $teaserBlockTableHtml .= '</table>';
  }

  function tdTableBuilder($teaser, $blockDataObj, $id){
    $clickUrl = html_entity_decode($teaser->url);

    $teaserText = $this->cleanTextTeaser($teaser->text);

    $teaserBlockTableTd = '<td id="teaser_block_td'.$id.'">';
    $teaserBlockTableTd .= '<a rel="nofollow" href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">';
    $teaserBlockTableTd .= '<img width="'.$blockDataObj->size.'px" height="'.$blockDataObj->size.'px" id="teaser_block_img'.$id.'" src="http://'.$_SERVER['SERVER_NAME'].$teaser->image.'"></a>';
    $teaserBlockTableTd .= ($blockDataObj->position == 'top' ? '<br/>' : '');
    $teaserBlockTableTd .= '<a rel="nofollow" href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">'.$teaserText.'</a>';
    $teaserBlockTableTd .= ($blockDataObj->second_link) ? '<br><br><b><a href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">читать далее &raquo;</a></b>' : "";
    $teaserBlockTableTd .= '</td>';

    return $teaserBlockTableTd;
  }

  function cleanTextTeaser($teaserText){
    $teaserText = preg_replace("/\n|\r|\r\n|(\r\n)+/u", "", $teaserText);
    $teaserText = preg_replace('/[\s]{2,}/', ' ', $teaserText);

    return $teaserText;
  }
}