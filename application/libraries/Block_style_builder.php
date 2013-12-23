<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class block_style_builder {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getStyle($blockDataObj){

    $style = '<style>#teaser_block_table{font-family: '.$blockDataObj->font_family.'; width: '.$blockDataObj->block_size_num.''.$blockDataObj->block_size_value.'; border-collapse: separate !important; border-spacing: '.$blockDataObj->cell_margin.'px; font-size: '.$blockDataObj->font_size.'; border: '.($blockDataObj->table_border_width == 'none' ? '0' : $blockDataObj->table_border_width).'px '.$blockDataObj->table_border_style.' '.$blockDataObj->table_border_color.'; background-color: '.$blockDataObj->background_color.';}
#teaser_block_table a{color: '.$blockDataObj->font_color.' !important;}
#teaser_block_table a:hover{color: '.$blockDataObj->font_color_hover.' !important;}
#teaser_block_td{border: '.$blockDataObj->cell_border_width.'px '.$blockDataObj->cell_border_color.' '.$blockDataObj->cell_border_style.'; background: '.$blockDataObj->cell_background.'; text-align: '.$blockDataObj->align.'; vertical-align: top; width: '.round(100 / $blockDataObj->hor).'%; padding: '.$blockDataObj->cell_padding.'px;}
#teaser_block_img{'.($blockDataObj->position != 'top' ? 'float: '.$blockDataObj->position.' !important; ' : '').'width:'.$blockDataObj->size.'px; height:'.$blockDataObj->size.'px; border: '.($blockDataObj->image_border_width == 'none' ? '0' : $blockDataObj->image_border_width).'px '.$blockDataObj->image_border_style.' '.$blockDataObj->image_border_color.'; '.($blockDataObj->position == 'left' ? 'margin: 0 '.$blockDataObj->cell_padding.'px 0 0' : ($blockDataObj->position == 'right' ? 'margin: 0 0 0 '.$blockDataObj->cell_padding.'px' : 'margin: 0 0 0 0')).';}
#teaser_block_partner_lnk{text-align: right;}
#teaser_block_partner_lnk a{color: inherit !important;}
#teaser_block_partner_lnk a:hover{color: inherit !important;}</style>';

    return $style;
  }

}