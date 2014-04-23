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

    if(strpos('MSIE', $_SERVER['HTTP_USER_AGENT'])) return  $this->tableIETableBuilder($teaserDataObj, $blockDataObj, $id);

    return $this->tableStandartTableBuilder($teaserDataObj, $blockDataObj, $id);
  }

  function tableStandartTableBuilder($teaserDataObj, $blockDataObj, $id){
    $trColumnCount = 0;

    $teaserBlockTableHtml = '<table id="teaser_block_table'.$id.'" width="100%" cellspacing="5"><tr>';

    foreach ($teaserDataObj as $teaser) {

      if($trColumnCount >= $blockDataObj->hor){ $trColumnCount = 0; $teaserBlockTableHtml .= '</tr><tr>'; }
        
      $teaserBlockTableHtml .= $this->tdStandartTableBuilder($teaser, $blockDataObj, $id);

      $trColumnCount ++;
    }

    return $teaserBlockTableHtml .= '</table>';
  }

  function tdStandartTableBuilder($teaser, $blockDataObj, $id){
    $clickUrl = html_entity_decode($teaser->url);

    $teaserText = $this->cleanTextTeaser($teaser->text);

    $teaserBlockTableTd = '<td id="teaser_block_td'.$id.'"><p>';
    $teaserBlockTableTd .= '<a rel="nofollow" href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">';
    $teaserBlockTableTd .= '<img style="'.($blockDataObj->position != 'top' ? 'float: '.$blockDataObj->position.' !important; ' : '').'; '.($blockDataObj->position == 'left' ? 'margin: 0 '.$blockDataObj->cell_padding.'px 0 0' : ($blockDataObj->position == 'right' ? 'margin: 0 0 0 '.$blockDataObj->cell_padding.'px' : 'margin: 0 0 0 0')).'" width="'.$blockDataObj->size.'px" height="'.$blockDataObj->size.'px" id="teaser_block_img'.$id.'" src="http://'.$_SERVER['SERVER_NAME'].$teaser->image.'"></a>';
    $teaserBlockTableTd .= ($blockDataObj->position == 'top' ? '<br/>' : '');
    $teaserBlockTableTd .= '<a rel="nofollow" href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">'.$teaserText.'</a>';
    $teaserBlockTableTd .= ($blockDataObj->second_link) ? '<br><br><b><a href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">читать далее &raquo;</a></b>' : "";
    $teaserBlockTableTd .= '</p></td>';

    return $teaserBlockTableTd;
  }

  function tableIETableBuilder($teaserDataObj, $blockDataObj, $id){
    $trColumnCount = 0;

    $teaserBlockTableHtml = '<table style="font-family: '.$blockDataObj->font_family.'; width: '.$blockDataObj->block_size_num.''.$blockDataObj->block_size_value.'; border-collapse: separate !important; border-spacing: '.$blockDataObj->cell_margin.'px; font-size: '.$blockDataObj->font_size.' !important; border: '.($blockDataObj->table_border_width == 'none' ? '0' : $blockDataObj->table_border_width).'px '.$blockDataObj->table_border_style.' '.$blockDataObj->table_border_color.$backgroundColorTransparent.';" width="100%" cellspacing="5"><tr>';

    foreach ($teaserDataObj as $teaser) {

      if($trColumnCount >= $blockDataObj->hor){ $trColumnCount = 0; $teaserBlockTableHtml .= '</tr><tr>'; }

      $teaserBlockTableHtml .= $this->tdIETableBuilder($teaser, $blockDataObj, $id);

      $trColumnCount ++;
    }

    return $teaserBlockTableHtml .= '</table>';
  }

  function tdIETableBuilder($teaser, $blockDataObj, $id){
    $clickUrl = html_entity_decode($teaser->url);

    $teaserText = $this->cleanTextTeaser($teaser->text);

    $teaserBlockTableTd = '<td id="teaser_block_td'.$id.'" style="border: '.$blockDataObj->cell_border_width.'px '.$blockDataObj->cell_border_color.' '.$blockDataObj->cell_border_style.$cellBackgroundTransparent.'; text-align: '.$blockDataObj->align.'; vertical-align: top; width: '.round(100 / $blockDataObj->hor).'%; padding: '.$blockDataObj->cell_padding.'px;font-weight: '.$blockDataObj->textlink_font_weight.';font-style: '.$blockDataObj->textlink_font_style.';"><p>';
    $teaserBlockTableTd .= '<a  style="color: '.$blockDataObj->font_color.' !important; font-size: '.$blockDataObj->font_size.' !important;'.$blockDataObj->textlink_text_decoration.'" rel="nofollow" href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">';
    $teaserBlockTableTd .= '<img style="'.($blockDataObj->position != 'top' ? 'float: '.$blockDataObj->position.' !important; ' : '').'; '.($blockDataObj->position == 'left' ? 'margin: 0 '.$blockDataObj->cell_padding.'px 0 0' : ($blockDataObj->position == 'right' ? 'margin: 0 0 0 '.$blockDataObj->cell_padding.'px' : 'margin: 0 0 0 0')).'" width="'.$blockDataObj->size.'px" height="'.$blockDataObj->size.'px" id="teaser_block_img'.$id.'" src="http://'.$_SERVER['SERVER_NAME'].$teaser->image.'"></a>';
    $teaserBlockTableTd .= ($blockDataObj->position == 'top' ? '<br/>' : '');
    $teaserBlockTableTd .= '<a style="color: '.$blockDataObj->font_color.' !important; font-size: '.$blockDataObj->font_size.' !important;'.$blockDataObj->textlink_text_decoration.';" rel="nofollow" href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">'.$teaserText.'</a>';
    $teaserBlockTableTd .= ($blockDataObj->second_link) ? '<br><br><b><a style="color: '.$blockDataObj->font_color.' !important; font-size: '.$blockDataObj->font_size.' !important;'.$blockDataObj->textlink_text_decoration.';" href="'.$clickUrl.'" target="_blank" title="'.$teaserText.'">читать далее &raquo;</a></b>' : "";
    $teaserBlockTableTd .= '</p></td>';

    return $teaserBlockTableTd;
  }

  function cleanTextTeaser($teaserText){
    $teaserText = preg_replace("/\n|\r|\r\n|(\r\n)+/u", "", $teaserText);
    $teaserText = preg_replace('/[\s]{2,}/', ' ', $teaserText);

    return $teaserText;
  }
}