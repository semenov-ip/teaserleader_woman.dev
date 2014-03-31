<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i><?php echo $titleH4 ?></h2>
  <hr />
</div>
 
<!-- Page title -->
<div class="row">
  <div class="col-md-12">

    <div class="awidget">
       <div class="awidget-head">
       </div>
       <div class="awidget-body">

       <!-- Profile form -->

          <div class="form profile">
            <!-- Edit profile form (not working)-->
            <form class="form-horizontal" role="form" method="post">
              <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>

              <div class="form-group">
                <label class="control-label col-lg-3">Название</label>
                <div class="col-lg-6">
                  <input type="text" name="name" class="form-control" value="<?php echo $campaignDataObj->name ?>" placeholder="Название">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Исключить показы на сайтах</label>
                <div class="col-lg-6">
                  <textarea class="form-control" rows="3" name="ban_site" ><?php echo $campaignDataObj->ban_site ?></textarea>
                  <small class="help-block font-size-85">По одному адресу с каждой новой строки, через "Enter"</small>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Исключить показы жителям выбранных стран</label>
                <div class="col-lg-6">
                  <select name="ban_country[]" class="form-control" size="8" multiple>
                    <?php echo $selectChangeBanCountrys; ?>
                  </select>
                  <small class="help-block font-size-85">Вы можете указать несколько стран, удерживая клавишу Ctrl</small>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Исключить показы жителям выбранных регионов России</label>
                <div class="col-lg-6">
                  <select name="ban_region[]" class="form-control" size="8" multiple>
                    <?php echo $selectChangeBanRegions; ?>
                  </select>
                  <small class="help-block font-size-85">Вы можете указать несколько стран, удерживая клавишу Ctrl</small>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Исключить показы в указанные часы</label>
                <div class="col-lg-6">
                  <?php echo $checkboxCheckedBanHour; ?>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Исключить показы в указанные дни недели</label>
                <div class="col-lg-6">
                  <?php echo $checkboxCheckedBanWeekDay; ?>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Добавлять метку в URL объявлений</label>
                <div class="col-lg-6">
                  <select name="labels" class="form-control">
                    <?php echo $selectChangeLabels; ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Метка для SubID {tiz_id} - id тизера {source} - id источника</label>
                <div class="col-lg-6">
                  <input type="text" name="subid" class="form-control margin-top-14" value="<?php echo $campaignDataObj->subid ?>" placeholder="Название">
                </div>
              </div>
              
              <div class="form-group">
                 <!-- Buttons -->
                  <div class="col-lg-6 col-lg-offset-3">
                    <button type="submit" class="btn btn-default">Сохранить</button>
                    <a href="/teaser/campaigns/" type="reset" class="btn btn-default">Отменить</a>
                 </div>
              </div>
            </form>
          </div>
       </div>
    </div>

  </div>
</div>