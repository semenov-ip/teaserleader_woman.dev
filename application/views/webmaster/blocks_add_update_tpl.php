<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_block"></div> <?php echo $titleH4 ?></h2>
  <hr />
</div>
 
<div class="row">

  <div class="col-md-12">

    <div class="awidget">

      <div class="awidget-body">

        <div class="form profile">
          <!-- Edit profile form (not working)-->
          <form class="form-horizontal" role="form" method="post">

          <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>

          <div class="form-group">
            <label class="control-label col-lg-3 width_auto b">Выбрать готовый блок:</label>
            <div class="col-lg-7">
              <select class="form-control width_120 display-inline-block prepared_block">
                <?php echo $selectChangePreparedBlock; ?>
              </select>
            </div>
          </div>

          <div class="panel panel-default">

            <div class="panel-heading open pointer">
              <div class="display-inline-block content-icon up"></div>
              <h2 class="panel-title display-inline-block">Основная информация</h2>
            </div>

            <div class="panel-body content">
              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Название блока:</label>
                <div class="col-lg-3">
                  <input type="text" name="name" class="nameblock" value="<?php echo $blockDataObj->name ?>" placeholder="Название блока">
                </div>
              </div>

              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Ширина блока:</label>
                <div class="col-lg-2 padding-l-r-0">
                  <input type="text" name="block_size_num" class="form-control display-inline-block width_80" value="<?php echo $blockDataObj->block_size_num ?>" placeholder="Название блока">
                  <select name="block_size_value" class="form-control width_50 display-inline-block">
                    <?php echo $selectChangeBlockSizeValue ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
              <label class="control-label col-lg-2 width_auto b">Количество тизеров:</label>
                <label class="control-label col-lg-3 width_auto">по вертикали</label>
                <div class="col-lg-2 slider-size width_18 padding-right-12">
                  <input type="hidden" class="hor" name="hor" value="<?php echo $blockDataObj->hor; ?>" />
                  <div class="slider-green margin-top-15 slider-range-min-1"></div>
                </div>
                <label class="control-label col-lg-3 width_auto">по горизонтали</label>
                <div class="col-lg-2 slider-size width_18 padding-right-12">
                  <input type="hidden" class="ver" name="ver" value="<?php echo $blockDataObj->ver; ?>" />
                  <div class="slider-green margin-top-15 slider-range-min-2"></div>
                </div>
              </div>
            </div>

          </div>

          <div class="panel panel-default">

            <div class="panel-heading open pointer">
              <div class="display-inline-block content-icon up"></div>
              <h2 class="panel-title display-inline-block">Внешний вид блока</h2>
            </div>

            <div class="panel-body content">

              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Цвет фона:</label>
                <div class="col-lg-3 padding-l-r-0">
                  <input type="text" name="background_color" class="form-control display-inline-block width_80" value="<?php echo $blockDataObj->background_color ?>" />
                  <div id="colorSelector" class="backgroundColor"><div></div></div>
                  <label class="label-bottom"><input name="background_color_transparent" type="checkbox" <?php echo $checkboxBackgroundColorTransparent; ?> /> Прозрачный</label>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3 width_auto b">Рамка вокруг блока:</label>
                <div class="col-lg-4 padding-l-r-0 width_31">
                  <?php echo $radioChangeTableBorderStyle ?>
                </div>
                <div class="col-lg-2 slider-size width_15">
                  <input type="hidden" class="table_border_width" name="table_border_width" value="<?php echo $blockDataObj->table_border_width; ?>" />
                  <div class="slider-green margin-top-15 slider-range-min-3"></div>
                </div>
                <div class="col-lg-3">
                  <input type="text" name="table_border_color" class="form-control display-inline-block width_80" value="<?php echo $blockDataObj->table_border_color ?>" />
                  <div id="colorSelector" class="tableBorderColor"><div></div></div>
                </div>
              </div>

            </div>

          </div>

          <div class="panel panel-default">

            <div class="panel-heading open pointer">
              <div class="display-inline-block content-icon up"></div>
              <h2 class="panel-title display-inline-block">Внешний вид тизера</h2>
            </div>

            <div class="panel-body content">

              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Цвет фона:</label>
                <div сclass="col-lg-3 padding-l-r-0">
                  <input type="text" name="cell_background" class="form-control display-inline-block width_80" value="<?php echo $blockDataObj->cell_background ?>" />
                  <div id="colorSelector" class="cellBackground"><div></div></div>
                  <label class="label-bottom"><input name="cell_background_transparent" type="checkbox" <?php echo $checkboxCellBackgroundTransparent; ?> /> Прозрачный</label>
                </div>
              </div>

              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Рамка вокруг объявления:</label>
                <div class="col-lg-4 padding-l-r-0 width_31">
                  <?php echo $radioChangeCellBorderStyle ?>
                </div>
                <div class="col-lg-2 slider-size width_15">
                  <input type="hidden" class="cell_border_width" name="cell_border_width" value="<?php echo $blockDataObj->cell_border_width; ?>" />
                  <div class="slider-green margin-top-15 slider-range-min-5"></div>
                </div>
                <div class="col-lg-3 margin-left-10">
                  <input type="text" name="cell_border_color" class="form-control display-inline-block width_80" value="<?php echo $blockDataObj->cell_border_color ?>" />
                  <div id="colorSelector" class="cellBorderColor"><div></div></div>
                </div>
              </div>

              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Отступ между объявлениями:</label>
                <div class="col-lg-2 slider-size width_18 padding-right-12">
                  <input type="hidden" class="cell_margin" name="cell_margin" value="<?php echo $blockDataObj->cell_margin; ?>" />
                  <div class="slider-green margin-top-15 slider-range-min-6"></div>
                </div>
                <label class="control-label col-lg-3 width_auto b">Отступ внутри объявления:</label>
                <div class="col-lg-2 slider-size width_18 padding-right-12">
                  <input type="hidden" class="cell_padding" name="cell_padding" value="<?php echo $blockDataObj->cell_padding; ?>" />
                  <div class="slider-green margin-top-15 slider-range-min-7"></div>
                </div>
              </div>

              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Положение объявления: </label>
                <div class="col-lg-6 padding-l-r-0 inside-inlian">
                  <?php echo $radioChangeAlign; ?>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3 width_auto title-b">Изображение:</label>
              </div>

              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Размер изображения:</label>
                <div class="col-lg-2 padding-l-r-0">
                  <select style="width: 100px;" name="size" class="form-control size">
                    <?php echo $selectChangeSize ?>
                  </select>
                </div>
              </div>

              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Рамка вокруг изображения:</label>
                <div class="col-lg-4 padding-l-r-0 width_31">
                  <?php echo $radioChangeImageBorderStyle ?>
                </div>
                <div class="col-lg-2 slider-size width_15">
                  <input type="hidden" class="image_border_width" name="image_border_width" value="<?php echo $blockDataObj->image_border_width; ?>" />
                  <div class="slider-green margin-top-15 slider-range-min-4"></div>
                </div>
                <div class="col-lg-3">
                  <input type="text" name="image_border_color" class="form-control display-inline-block width_80 margin-left-10" value="<?php echo $blockDataObj->image_border_color ?>" />
                  <div id="colorSelector" class="imageBorderColor"><div></div></div>
                </div>
              </div>

              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Положение изображения: </label>
                <div class="col-lg-6 padding-l-r-0 inside-inlian">
                  <?php echo $radioChangePosition; ?>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3 width_auto title-b">Шрифт:</label>
              </div>


              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Шрифт текста: </label>
                <div class="col-lg-6 padding-l-r-0 inside-inlian">
                  <?php echo $radioChangeFontFamily; ?>
                </div>
                <label class="control-label col-lg-3 width_auto b">Размер: </label>
                <div class="col-lg-2 slider-size width_15">
                  <input type="hidden" class="font_size" name="font_size" value="<?php echo $blockDataObj->font_size; ?>" />
                  <div class="slider-green margin-top-15 slider-range-min-8"></div>
                </div>
              </div>

              <div class="form-group bottom-line">
                <label class="control-label col-lg-3 width_auto b">Цвет текста:</label>
                <div class="col-lg-2 padding-l-r-0">
                  <input type="text" name="font_color" class="form-control display-inline-block width_80" value="<?php echo $blockDataObj->font_color ?>" />
                  <div id="colorSelector" class="fontColor"><div></div></div>
                </div>

                <label class="control-label col-lg-3 width_auto b">Цвет текста при наведении:</label>
                <div class="col-lg-2 padding-l-r-0">
                  <input type="text" name="font_color_hover" class="form-control display-inline-block width_80" value="<?php echo $blockDataObj->font_color_hover ?>" />
                  <div id="colorSelector" class="fontColorHover"><div></div></div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-4 padding-l-r-0">
                  <label class="control-label col-lg-3 width_auto b display-inline-block second_link"><input name="second_link" type="checkbox" <?php echo $checkboxChangeSecondLink; ?> /> Показывать ссылку "Читать далее"</label>
                </div>
              </div>

            </div>

          </div>
          <div class="form-group">
            <div class="col-lg-6">
              <button type="submit" class="btn btn-default">Сохранить</button>
              <a href="/webmaster/blocks/" class="btn btn-default">Отменить</a>
            </div>
          </div>
          </form>
        </div>

      </div>
    </div>   
  </div>

  <?php if($leftBlockHtml){ ?>
  <div class="col-md-12">

    <div class="awidget">
      <div class="awidget-head">
        <h3>Предпросмотр</h3>
      </div>

      <div class="awidget-body">
        <?php echo $style; ?>
        <?php echo $teaserPreview; ?>
      </div>
    </div>
  </div>
  <?php } ?>

    <!-- post sidebar -->
  <div class="col-md-12">

    <div class="awidget">
      <div class="awidget-head">
        <h3><?php echo $titleMinor; ?></h3>
      </div>

      <div class="awidget-body">
        <?php if($leftBlockHtml){ ?>
          <textarea class="form-control textarea-html-height" rows="12"><?php echo $referralCode; ?></textarea>
        <?php } else {
          echo $style;
          echo $teaserPreview; } ?>
      </div>
    </div>  

  </div>

</div>
<script src="/js/admin/include_page/block.js"></script>