<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class block_style_builder {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function getStyle($blockDataObj, $id=""){

    $cellBackgroundTransparent = ($blockDataObj->cell_background_transparent) ? '' : '; background: '.$blockDataObj->cell_background;

    $backgroundColorTransparent = ($blockDataObj->background_color_transparent) ? '' : '; background-color: '.$blockDataObj->background_color;

    $blockDataObj->textlink_text_decoration = (empty($blockDataObj->textlink_text_decoration)) ? '' : 'text-decoration: '.$blockDataObj->textlink_text_decoration.';';

    $style = '<style>#teaser_block_table'.$id.'{font-family: '.$blockDataObj->font_family.'; width: '.$blockDataObj->block_size_num.''.$blockDataObj->block_size_value.'; border-collapse: separate !important; border-spacing: '.$blockDataObj->cell_margin.'px; font-size: '.$blockDataObj->font_size.' !important; border: '.($blockDataObj->table_border_width == 'none' ? '0' : $blockDataObj->table_border_width).'px '.$blockDataObj->table_border_style.' '.$blockDataObj->table_border_color.$backgroundColorTransparent.';}#teaser_block_table'.$id.' a{color: '.$blockDataObj->font_color.' !important; font-size: '.$blockDataObj->font_size.' !important;'.$blockDataObj->textlink_text_decoration.'}#teaser_block_table'.$id.' a:hover{color: '.$blockDataObj->font_color_hover.' !important;}#teaser_block_td'.$id.'{border: '.$blockDataObj->cell_border_width.'px '.$blockDataObj->cell_border_color.' '.$blockDataObj->cell_border_style.$cellBackgroundTransparent.'; text-align: '.$blockDataObj->align.'; vertical-align: top; width: '.round(100 / $blockDataObj->hor).'%; padding: '.$blockDataObj->cell_padding.'px;font-weight: '.$blockDataObj->textlink_font_weight.';font-style: '.$blockDataObj->textlink_font_style.';}#teaser_block_img'.$id.'{'.($blockDataObj->position != 'top' ? 'float: '.$blockDataObj->position.' !important; ' : '').'width:'.$blockDataObj->size.'px !important; height:'.$blockDataObj->size.'px !important; border: '.($blockDataObj->image_border_width == 'none' ? '0' : $blockDataObj->image_border_width).'px '.$blockDataObj->image_border_style.' '.$blockDataObj->image_border_color.'; '.($blockDataObj->position == 'left' ? 'margin: 0 '.$blockDataObj->cell_padding.'px 0 0' : ($blockDataObj->position == 'right' ? 'margin: 0 0 0 '.$blockDataObj->cell_padding.'px' : 'margin: 0 0 0 0')).';}#teaser_block_partner_lnk'.$id.'{text-align: right;}#teaser_block_partner_lnk'.$id.' a{color: inherit !important;}#teaser_block_partner_lnk'.$id.' a:hover{color: inherit !important;}</style>';

    return $style;
  }

}