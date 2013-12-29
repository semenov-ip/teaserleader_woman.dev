<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i> <?php echo $titleH4 ?></h2>
  <hr />
</div>
 
<div class="row">
       
  <div class="col-md-7">

    <div class="awidget">
      <div class="awidget-head">
        <h3>Формирование нового блока</h3>
      </div>


      <div class="awidget-body">

        <div class="form profile">
          <!-- Edit profile form (not working)-->
          <form class="form-horizontal" role="form" method="post">
            <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>
            
            <div class="form-group">
              <label class="control-label col-lg-4">Название блока</label>
              <div class="col-lg-7">
                <input type="text" name="name" class="form-control" value="<?php echo $blockDataObj->name ?>" placeholder="Название блока">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Ширина блока</label>
              <div class="col-lg-7">
                <div class="input-group">
                  <input type="text" name="block_size_num" class="form-control" value="<?php echo $blockDataObj->block_size_num ?>" placeholder="Название блока">
                  <span class="input-group-addon">
                    <select name="block_size_value" class="form-control width_50 height_20">
                      <?php echo $selectChangeBlockSizeValue ?>
                    </select>
                  </span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Цвет фона блока</label>
              <div class="col-lg-7">
                <input type="text" name="background_color" class="form-control" value="<?php echo $blockDataObj->background_color ?>" placeholder="Название блока">
              </div>
            </div>
          
            <div class="form-group">
              <label class="control-label col-lg-4">Размер, стиль и цвет рамки вокруг блока</label>
              <div class="col-lg-7 margin-top-14">
                <div class="input-group">
                  <span class="input-group-addon">
                    <select name="table_border_width" class="form-control width_50 height_20">
                      <?php echo $selectChangeTableBorderWidth ?>
                    </select>
                  </span>
                  <span class="input-group-addon border-right_0">
                    <select name="table_border_style" class="form-control width_94 height_20">
                      <?php echo $selectChangeTableBorderStyle ?>
                    </select>
                  </span>
                    <input type="text" name="table_border_color" class="form-control" value="<?php echo $blockDataObj->table_border_color ?>" placeholder="Название блока">
                </div>
              </div>
            </div>
            

            <div class="form-group">
              <label class="control-label col-lg-4">Объявлений по горизонтали</label>
              <div class="col-lg-7 margin-top-14">
                <select name="hor" class="form-control">
                  <?php echo $selectChangeHor ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Объявлений по вертикали</label>
              <div class="col-lg-7">
                <select name="ver" class="form-control">
                  <?php echo $selectChangeVer ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Размер изображения</label>
              <div class="col-lg-7">
                <select style="width: 100px;" name="size" class="form-control">
                  <?php echo $selectChangeSize ?>
                </select>
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-lg-4">Размер, стиль и цвет рамки вокруг изображения</label>
              <div class="col-lg-7 margin-top-26">
                <div class="input-group">
                  <span class="input-group-addon">
                    <select name="image_border_width" class="form-control width_50 height_20">
                      <?php echo $selectChangeImageBorderWidth ?>
                    </select>
                  </span>
                  <span class="input-group-addon border-right_0">
                    <select name="image_border_style" class="form-control width_94 height_20">
                      <?php echo $selectChangeImageBorderStyle ?>
                    </select>
                  </span>
                    <input type="text" name="image_border_color" class="form-control" value="<?php echo $blockDataObj->image_border_color ?>" placeholder="Название блока">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Положение изображения относительно текста</label>
              <div class="col-lg-7 margin-top-14">
                <select name="position" class="form-control">
                  <?php echo $selectChangePosition ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Шрифт текста</label>
              <div class="col-lg-7">
                <select name="font_family" class="form-control">
                  <?php echo $selectChangeFontFamily ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Размер текста</label>
              <div class="col-lg-7">
                <select name="font_size" class="form-control">
                  <?php echo $selectChangeFontSize ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Цвет текста</label>
              <div class="col-lg-7">
                <input type="text" name="font_color" class="form-control" value="<?php echo $blockDataObj->font_color ?>" placeholder="Название блока">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Цвет текста при наведении курсора</label>
              <div class="col-lg-7 margin-top-14">
                <input type="text" name="font_color_hover" class="form-control" value="<?php echo $blockDataObj->font_color_hover ?>" placeholder="Название блока">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Цвет подложки объявления</label>
              <div class="col-lg-7 margin-top-14">
                <input type="text" name="cell_background" class="form-control" value="<?php echo $blockDataObj->cell_background ?>" placeholder="Название блока">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Размер отступа между объявлениями</label>
              <div class="col-lg-7 margin-top-14">
                <input type="text" name="cell_margin" class="form-control" value="<?php echo $blockDataObj->cell_margin ?>" placeholder="Название блока">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Размер отступа внутри объявления</label>
              <div class="col-lg-7 margin-top-14">
                <input type="text" name="cell_padding" class="form-control" value="<?php echo $blockDataObj->cell_padding ?>" placeholder="Название блока">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Размер, стиль и цвет рамки вокруг объявления</label>
              <div class="col-lg-7 margin-top-14">
                <div class="input-group">
                  <span class="input-group-addon">
                    <select name="cell_border_width" class="form-control width_50 height_20">
                      <?php echo $selectChangeCellBorderWidth ?>
                    </select>
                  </span>
                  <span class="input-group-addon border-right_0">
                    <select name="cell_border_style" class="form-control width_94 height_20">
                      <?php echo $selectChangeCellBorderStyle ?>
                    </select>
                  </span>
                  <input type="text" name="cell_border_color" class="form-control" value="<?php echo $blockDataObj->cell_border_color ?>" placeholder="Название блока">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4">Выравнивание объявления</label>
              <div class="col-lg-7 margin-top-14">
                <select name="align" class="form-control">
                  <?php echo $selectChangeAlign ?>
                </select>
              </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-4 col-lg-6">
                  <button type="submit" class="btn btn-default">Сохранить</button>
                  <a href="/webmaster/sites/" class="btn btn-default">Отменить</a>
                </div>
              </div>
          </form>
        </div>

      </div>
    </div>   
  </div>

  <!-- post sidebar -->
  <div class="col-md-5">

    <div class="awidget">
      <div class="awidget-head">
        <h3><?php echo $titleMinor; ?></h3>
      </div>
      
      <div class="awidget-body">
        <?php if($leftBlockHtml){ ?>
          <textarea class="form-control" rows="12" readonly><?php echo $referralCode; ?></textarea>
        <?php } else {
          echo $style;
          echo $teaserPreview; } ?>
      </div>
    </div>  

  </div>

  <?php if($leftBlockHtml){ ?>
  <div class="col-md-7">

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
</div>