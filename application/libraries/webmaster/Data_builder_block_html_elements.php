<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Data_builder_block_html_elements {
  public $ci;

  function __construct(){
    $this->ci =& get_instance();
  }

  function data($data){

    $data['selectChangePreparedBlock'] = select_define_builder(array(), $this->getPreparedBlockKeyIdValueName(), true);

    $data['selectChangeBlockSizeValue'] = select_define_builder(array($data['blockDataObj']->block_size_value), $this->getBlockSizeValueKeyIdValueName());

    $data['selectChangeTableBorderWidth'] = select_define_builder(array($data['blockDataObj']->table_border_width), $this->getBorderWidthKeyIdValueName(), true);

    $data['radioChangeTableBorderStyle'] = radio_define_builder(array($data['blockDataObj']->table_border_style), $this->getBorderStyleKeyIdValueName(), 'table_border_style', true);

    $data['selectChangeHor'] = select_define_builder(array($data['blockDataObj']->hor), $this->getHorKeyIdValueName());

    $data['selectChangeVer'] = select_define_builder(array($data['blockDataObj']->ver), $this->getVerKeyIdValueName());

    $data['selectChangeSize'] = select_define_builder(array($data['blockDataObj']->size), $this->getSizeKeyIdValueName() ,true);

    $data['selectChangeImageBorderWidth'] = select_define_builder(array($data['blockDataObj']->image_border_width), $this->getBorderWidthKeyIdValueName(), true);
    
    $data['radioChangeImageBorderStyle'] = radio_define_builder(array($data['blockDataObj']->image_border_style), $this->getBorderStyleKeyIdValueName(), 'image_border_style', true);

    $data['radioChangePosition'] = radio_define_builder(array($data['blockDataObj']->position), $this->getPositionKeyIdValueName(), 'position', true);

    $data['radioChangeFontFamily'] = radio_define_builder(array($data['blockDataObj']->font_family), $this->getFontFamilyKeyIdValueName(), 'font_family', true);

    $data['selectChangeFontSize'] = select_define_builder(array($data['blockDataObj']->font_size), $this->getFontSizeKeyIdValueName(), true);

    $data['selectChangeCellBorderWidth'] = select_define_builder(array($data['blockDataObj']->cell_border_width), $this->getBorderWidthKeyIdValueName(), true);

    $data['radioChangeCellBorderStyle'] = radio_define_builder(array($data['blockDataObj']->cell_border_style), $this->getBorderStyleKeyIdValueName(), 'cell_border_style', true);

    $data['radioChangeAlign'] = radio_define_builder(array($data['blockDataObj']->align), $this->getAlignKeyIdValueName(), 'align', true);

    $data['checkboxChangeSecondLink'] = $this->getSecondLinkDataChecked($data['blockDataObj']->second_link);

    $data['checkboxCellBackgroundTransparent'] = $this->getSecondLinkDataChecked($data['blockDataObj']->cell_background_transparent);

    $data['checkboxBackgroundColorTransparent'] = $this->getSecondLinkDataChecked($data['blockDataObj']->background_color_transparent);

    $data['blockDataObj']->font_size = ($data['blockDataObj']->font_size == 'inherit') ? '12px' : $data['blockDataObj']->font_size;

    $data['style'] = $this->ci->block_style_builder->getStyle($data['blockDataObj']);

    $data['teaserPreview'] = $this->ci->show_block_preview->getBlockHtml( $data['blockDataObj'] );

    return $data;
  }

  function getPreparedBlockKeyIdValueName(){
    return array('4x1_50x50' => '4x1, 50x50', '2x1_50x50' => '2x1, 50x50', '1x1_50x50' => '1x1, 50x50', '1x4_50x50' => '1x4, 50x50', '1x4_70x70' => '1x4, 70x70', '2x2_100x100' => '2x2, 100x100', '4x1_100x100' => '4x1, 100x100', '6x1_100x100' => '6x1, 100x100');
  }

  function getBlockSizeValueKeyIdValueName(){
    return array( 'px', '%' );
  }

  function getBorderWidthKeyIdValueName(){
    return array( '0' => '0 px', '1' => '1 px', '2' => '2 px', '3' => '3 px', '4' => '4 px', '5' => '5 px', '6' => '6 px', '7' => '7 px' );
  }

  function getBorderStyleKeyIdValueName(){
    return array( "solid" => "Сплошная", "dashed" => "Пунктир", "dotted" => "Точки" );
  }

  function getHorKeyIdValueName(){
    return array(1,2,3,4,5,6,7,8);
  }

  function getVerKeyIdValueName(){
    return array(1,2,3,4,5,6,7,8);
  }

  function getSizeKeyIdValueName(){
    return array('50'=>'50x50 px', '60'=>'60x60 px', '70'=>'70x70 px', '80'=>'80x80 px', '90'=>'90x90 px', '100'=>'100x100 px', '110'=>'110x110 px', '120'=>'120x120 px', '130'=>'130x130 px', '140'=>'140x140 px', '150'=>'150x150 px', '200'=>'200x200 px');
  }

  function getPositionKeyIdValueName(){
    return array("left" => "Cлева от текста", "right" => "Cправа от текста", "top" => "Над текстом");
  }

  function getFontFamilyKeyIdValueName(){
    return array("inherit" => "Как на сайте", "Arial" => "Arial", "Times" => "Times", "Verdana" => "Verdana", "Tahoma" => "Tahoma");
  }

  function getFontSizeKeyIdValueName(){
    return array("inherit" => "Как на сайте", "9px" => "9 px", "10px" => "10 px", "11px" => "11 px", "12px" => "12 px", "13px" => "13 px", "14px" => "14 px", "14px" => "14 px", "15px" => "15 px", "16px" => "16 px", "17px" => "17 px", "18px" => "18 px", "19px" => "19 px", "20px" => "20 px");
  }

  function getAlignKeyIdValueName(){
    return array("center" => "По центру", "left" => "По левому краю", "right" => "По правому краю");
  }

  function getSecondLinkDataChecked($secondLink){
    if($secondLink){ return "checked='checked'"; }
  }
}