<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i> Редактировать цену площадки</h2>
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
                <label class="control-label col-lg-4">Вознаграждение за клик (Россия)</label>
                <div class="col-lg-6">
                  <input type="text" name="price" class="form-control" value="<?php echo $siteDataObj->price; ?>" placeholder="Название блока">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-4">Вознаграждение за клик (СНГ)</label>
                <div class="col-lg-6">
                  <input type="text" name="price_sng" class="form-control" value="<?php echo $siteDataObj->price_sng; ?>" placeholder="Название блока">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-4 col-lg-6">
                  <button type="submit" class="btn btn-default">Сохранить</button>
                  <a href="/admin/sites_admin/" class="btn btn-default">Отменить</a>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>