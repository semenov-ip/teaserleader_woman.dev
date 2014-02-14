<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i> Блокировка сайта <a href="http://<?php echo $siteDataObj->url; ?>"><?php echo $siteDataObj->url; ?></a></h2>
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
                  <span class="input-group-addon">http://</span><input type="text" class="form-control" value="<?php echo $siteDataObj->url; ?>" placeholder="URL" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-4">Причина блокировки</label>
                <div class="col-lg-6">
                	<textarea name="text" class="form-control" rows="3">Ваш сайт <?php echo $siteDataObj->url; ?> заблокирован по причине</textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-4 col-lg-6">
                	<input type="hidden" name="author_name" value="Администратор">

                	<input type="hidden" name="title" value="Блокировка сайта <?php echo $siteDataObj->url; ?>">

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




<!-- <button title="Заблокировать" class="btn btn-default btn-xs" onclick="statusModerateBlock('<?php //echo$currentSiteDataObj->site_id; ?>', 'site_id', '3', 'sites')"><i class='icon-minus-sign'></i> </button> -->
