<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i>Мой профиля</h2>
  <hr />
</div>
 
<!-- Page title -->
<div class="row">
  <div class="col-md-12">

    <div class="awidget">
       <div class="awidget-head">
          <h3>Настройки профиля</h3>
       </div>
       <div class="awidget-body">
             
       <!-- Profile form -->

          <div class="form profile">
            <!-- Edit profile form (not working)-->
            <form class="form-horizontal" role="form" method="post">
              <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>
              <div class="form-group">
                <label class="control-label col-lg-3">Имя*</label>
                <div class="col-lg-6">
                  <input type="text" name="name" class="form-control" value="<?php echo $userDataObj->name; ?>" placeholder="Имя">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">ICQ</label>
                <div class="col-lg-6">
                  <input type="text" name="icq" class="form-control" value="<?php echo $userDataObj->icq; ?>" placeholder="ICQ">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Skype</label>
                <div class="col-lg-6">
                  <input type="text" name="skype" class="form-control" value="<?php echo $userDataObj->skype; ?>" placeholder="Skype">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">WMR-кошелек*</label>
                <div class="col-lg-6">
                  <input type="text" class="form-control" name="purse" value="<?php echo $userDataObj->purse ?>">
                </div>
              </div>
              
              <!-- Buttons -->
              <div class="form-group">
                 <!-- Buttons -->
                  <div class="col-lg-6 col-lg-offset-3">
                    <button type="submit" class="btn btn-default">Сохранить</button>
                    <a href="/webmaster/sites/" type="reset" class="btn btn-default">Отменить</a>
                 </div>
              </div>
            </form>
          </div>
             
       </div>
    </div>
                        
  </div>
</div>
<script src="/js/admin/include_page/profile_tools.js"></script>