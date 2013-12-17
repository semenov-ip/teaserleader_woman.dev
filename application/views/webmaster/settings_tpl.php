<h4>Настройки профиля</h4>
<?php if($error){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
<form class="form-horizontal" role="form" method="post">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Имя*</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" value="<?php echo $userDataObj->name; ?>" placeholder="Имя">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Логин для рейтинга*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="top10_login" value="<?php echo $userDataObj->top10_login; ?>" placeholder="Логин для рейтинга">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="notshow_top10_login" value="<?php echo $userDataObj->notshow_top10_login; ?>" onclick="onOff(this);"> Не участвовать в рейтинге мастеров.
        </label>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">ICQ, Skype</label>
    <div class="col-sm-10">
      <input type="text" name="icq" class="form-control" value="<?php echo $userDataObj->icq ?>" placeholder="ICQ, Skype">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">WMR-кошелек*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="curr_num" value="<?php echo $userDataObj->curr_num ?>">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Сохранить</button>
    </div>
  </div>

</form>