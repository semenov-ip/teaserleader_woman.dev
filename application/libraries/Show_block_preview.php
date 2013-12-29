<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Show_block_preview {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getBlockHtml($blockDataObj){

    $teaserDataObj = $this->getTeaserDataObj($blockDataObj->hor*$blockDataObj->ver);

    return $this->builderTeserBlock($teaserDataObj, $blockDataObj);
  }

  function getTeaserDataObj($limit){
    return $this->ci->select_models->select_from_all_limit_orderby($limit, "last_show", "asc", 'teasers');
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
    $teaserBlockTableTd .= '<a href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">';
    $teaserBlockTableTd .= '<img id="teaser_block_img'.$id.'" src="http://'.$_SERVER['SERVER_NAME'].$teaser->image.'"></a>';
    $teaserBlockTableTd .= ($blockDataObj->position == 'top' ? '<br/>' : '');
    $teaserBlockTableTd .= '<a href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">'.$teaserText.'</a>';
    $teaserBlockTableTd .= '</td>';

    return $teaserBlockTableTd;
  }

  function cleanTextTeaser($teaserText){
    $teaserText = preg_replace("/\n|\r|\r\n|(\r\n)+/u", "", $teaserText);
    $teaserText = preg_replace('/[\s]{2,}/', ' ', $teaserText);

    return $teaserText;
  }
}






