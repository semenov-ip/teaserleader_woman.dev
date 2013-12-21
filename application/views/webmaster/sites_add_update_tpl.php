<h4><?php echo $titleH4 ?></h4>
<?php if($error){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
<form class="form-horizontal" role="form" method="post">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">URL</label>
    <div class="col-sm-10">
      http://<input type="text" name="url" class="form-control" value="<?php echo $siteDataObj->url ?>" placeholder="URL">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Алиасы</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="aliases" ><?php echo $siteDataObj->aliases ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Исключить показы тизеров, имеющих указанные идентификаторы (teaser_id)</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="ban_teaser"><?php echo $siteDataObj->ban_teaser ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Кодировка сайта</label>
    <div class="col-sm-10">
      <select name="url_encoding" class="form-control">
        <?php echo $selectChange; ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Данные для доступа к независимой статистике сайта</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="stat_login"><?php echo is_null($siteDataObj->stat_login) ? "Адрес:\nЛогин:\nПароль:" : $siteDataObj->stat_login ?></textarea>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Сохранить</button>
      <a href="" class="btn btn-default">Отменить</a>
    </div>
  </div>

</form>