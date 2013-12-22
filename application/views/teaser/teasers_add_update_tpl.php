<h4><?php echo $titleH4 ?></h4>
<?php if($error){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Изображение</label>
    <div class="col-sm-10">
      <img src="<?php echo $teaserDataObj->image; ?>" />
      <input type="file" name="image" />
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Ссылка</label>
    <div class="col-sm-10">
      <input type="text" name="url" class="form-control" value="<?php echo $teaserDataObj->url ?>" placeholder="Ссылка">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Текст</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="text" ><?php echo $teaserDataObj->text ?></textarea>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Сохранить</button>
      <a href="" class="btn btn-default">Отменить</a>
    </div>
  </div>

</form>