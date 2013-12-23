<h4><?php echo $titleH4 ?></h4>
<?php if($error){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>

<form class="form-horizontal" role="form" method="post">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Название блока</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" value="<?php echo $blockDataObj->name ?>" placeholder="Название блока">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Ширина блока</label>
    <div class="col-sm-10 input-group">
      <input type="text" name="block_size_num" class="form-control" value="<?php echo $blockDataObj->block_size_num ?>" placeholder="Название блока">
      <div class="input-group-btn">
        <select style="width: 100px;" name="block_size_value" class="form-control">
          <?php echo $selectChangeBlockSizeValue ?>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Цвет фона блока</label>
    <div class="col-sm-10">
      <input type="text" name="background_color" class="form-control" value="<?php echo $blockDataObj->background_color ?>" placeholder="Название блока">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Размер, стиль и цвет рамки вокруг блока</label>
    <div class="col-sm-10">
      <div class="col-sm-10 input-group">
        <div class="input-group-btn">
          <select style="width: 100px;" name="table_border_width" class="form-control">
            <?php echo $selectChangeTableBorderWidth ?>
          </select>
          <select style="width: 100px;" name="table_border_style" class="form-control">
            <?php echo $selectChangeTableBorderStyle ?>
          </select>
          <input type="text" name="table_border_color" class="form-control" value="<?php echo $blockDataObj->table_border_color ?>" placeholder="Название блока">
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Объявлений по горизонтали</label>
    <div class="col-sm-10">
      <select style="width: 100px;" name="hor" class="form-control">
        <?php echo $selectChangeHor ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Объявлений по вертикали</label>
    <div class="col-sm-10">
      <select style="width: 100px;" name="ver" class="form-control">
        <?php echo $selectChangeVer ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Размер изображения</label>
    <div class="col-sm-10">
      <select style="width: 100px;" name="size" class="form-control">
        <?php echo $selectChangeSize ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Размер, стиль и цвет рамки вокруг изображения</label>
    <div class="col-sm-10">
      <div class="col-sm-10 input-group">
        <div class="input-group-btn">
          <select style="width: 100px;" name="image_border_width" class="form-control">
            <?php echo $selectChangeImageBorderWidth ?>
          </select>
          <select style="width: 100px;" name="image_border_style" class="form-control">
            <?php echo $selectChangeImageBorderStyle ?>
          </select>
          <input type="text" name="image_border_color" class="form-control" value="<?php echo $blockDataObj->image_border_color ?>" placeholder="Название блока">
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Положение изображения относительно текста</label>
    <div class="col-sm-10">
      <select style="width: 100px;" name="position" class="form-control">
        <?php echo $selectChangePosition ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Шрифт текста</label>
    <div class="col-sm-10">
      <select style="width: 100px;" name="font_family" class="form-control">
        <?php echo $selectChangeFontFamily ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Размер текста</label>
    <div class="col-sm-10">
      <select style="width: 100px;" name="font_size" class="form-control">
        <?php echo $selectChangeFontSize ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Цвет текста</label>
    <div class="col-sm-10">
      <input type="text" name="font_color" class="form-control" value="<?php echo $blockDataObj->font_color ?>" placeholder="Название блока">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Цвет текста при наведении курсора</label>
    <div class="col-sm-10">
      <input type="text" name="font_color_hover" class="form-control" value="<?php echo $blockDataObj->font_color_hover ?>" placeholder="Название блока">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Цвет подложки объявления</label>
    <div class="col-sm-10">
      <input type="text" name="cell_background" class="form-control" value="<?php echo $blockDataObj->cell_background ?>" placeholder="Название блока">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Размер отступа между объявлениями</label>
    <div class="col-sm-10">
      <input type="text" name="cell_margin" class="form-control" value="<?php echo $blockDataObj->cell_margin ?>" placeholder="Название блока">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Размер отступа внутри объявления</label>
    <div class="col-sm-10">
      <input type="text" name="cell_padding" class="form-control" value="<?php echo $blockDataObj->cell_padding ?>" placeholder="Название блока">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Размер, стиль и цвет рамки вокруг объявления</label>
    <div class="col-sm-10">
      <div class="col-sm-10 input-group">
        <div class="input-group-btn">
          <select style="width: 100px;" name="cell_border_width" class="form-control">
            <?php echo $selectChangeCellBorderWidth ?>
          </select>
          <select style="width: 100px;" name="cell_border_style" class="form-control">
            <?php echo $selectChangeCellBorderStyle ?>
          </select>
          <input type="text" name="cell_border_color" class="form-control" value="<?php echo $blockDataObj->cell_border_color ?>" placeholder="Название блока">
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Выравнивание объявления</label>
    <div class="col-sm-10">
      <select style="width: 100px;" name="align" class="form-control">
        <?php echo $selectChangeAlign ?>
      </select>
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Сохранить</button>
      <a href="" class="btn btn-default">Отменить</a>
    </div>
  </div>
</form>



<?php echo $style; ?>
<?php echo $teaserPreview; ?>

<textarea readonly=""><?php echo $referralCode; ?></textarea>