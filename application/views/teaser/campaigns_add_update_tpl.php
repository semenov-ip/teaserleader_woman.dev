<h4><?php echo $titleH4 ?></h4>
<?php if($error){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
<form class="form-horizontal" role="form" method="post">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Название</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" value="<?php echo $campaignDataObj->name ?>" placeholder="Название">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Тематика</label>
    <div class="col-sm-10">
      <select name="section_id" class="form-control">
        <?php echo $selectChangeSection; ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Исключить показы на сайтах</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="ban_site" ><?php echo $campaignDataObj->ban_site ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Исключить показы жителям выбранных стран</label>
    <div class="col-sm-10">
      <select name="ban_country[]" class="form-control" size="8" multiple>
        <?php echo $selectChangeBanCountrys; ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Исключить показы жителям выбранных регионов России</label>
    <div class="col-sm-10">
      <select name="ban_region[]" class="form-control" size="8" multiple>
        <?php echo $selectChangeBanRegions; ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Исключить показы в указанные часы</label>
    <div class="col-sm-10">
      <?php echo $checkboxCheckedBanHour; ?>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Исключить показы в указанные дни недели</label>
    <div class="col-sm-10">
      <?php echo $checkboxCheckedBanWeekDay; ?>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Добавлять метку в URL объявлений</label>
    <div class="col-sm-10">
      <select name="labels" class="form-control">
        <?php echo $selectChangeLabels; ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Метка для SubID {tiz_id} - id тизера {source} - id источника</label>
    <div class="col-sm-10">
      <input type="text" name="subid" class="form-control" value="<?php echo $campaignDataObj->subid ?>" placeholder="Название">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Сохранить</button>
      <a href="" class="btn btn-default">Отменить</a>
    </div>
  </div>

</form>