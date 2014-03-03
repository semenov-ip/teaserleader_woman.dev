<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_site"></div> <?php echo $titleH4 ?></h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">
      <div class="awidget">
        <div class="awidget-head">
        </div>
        <div class="awidget-body">

          <div class="form profile">
            <!-- Edit profile form (not working)-->
            <form class="form-horizontal" role="form" method="post">
              <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>
              <div class="form-group">
                <label class="control-label col-lg-4">URL</label>
                <div class="col-lg-6 input-group">
                  <span class="input-group-addon">http://</span><input type="text" name="url" class="form-control" value="<?php echo $siteDataObj->url ?>" placeholder="URL" <?php echo $desabledUrl ?>>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-4">Алиасы</label>
                <div class="col-lg-6">
                  <textarea class="form-control" rows="3" name="aliases" ><?php echo $siteDataObj->aliases ?></textarea>
                  <small class="help-block font-size-85">По одному адресу с каждой новой строки.</small>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-4">Исключить показы тизеров, имеющих указанные идентификаторы (teaser_id)</label>
                <div class="col-lg-6">
                  <textarea class="form-control" rows="3" name="ban_teaser"><?php echo $siteDataObj->ban_teaser ?></textarea>
                  <small class="help-block font-size-85">По одному через запятую «,»</small>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-4">Кодировка сайта</label>
                <div class="col-lg-6">
                  <select name="url_encoding" class="form-control">
                    <?php echo $selectChange; ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-4">Данные для доступа к независимой статистике сайта</label>
                <div class="col-lg-6">
                  <textarea class="form-control" rows="3" name="stat_login"><?php echo is_null($siteDataObj->stat_login) ? "Адрес:\nЛогин:\nПароль:" : $siteDataObj->stat_login ?></textarea>
                  <small class="help-block font-size-85">Liveinternet, или другие..</small>
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
  </div>
</div>
<script src="/js/admin/include_page/site_add_update_tools.js"></script>