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
        <h3>Мои данные</h3>
      </div>
       <div class="awidget-body">
          <div class="row">
            <div class="col-md-9 col-sm-9">
              <table class="table">
                <tr>
                  <td>Имя</td>
                  <td>:</td>
                  <td><?php echo $userDataObj->name; ?></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>:</td>
                  <td><?php echo $email; ?></td>
                </tr>
                <tr>
                  <td>ICQ, Skype</td>
                  <td>:</td>
                  <td><?php echo $userDataObj->icq ?></td>
                </tr>
                <tr>
                  <td>WMR-кошелек</td>
                  <td>:</td>
                  <td><?php echo $userDataObj->curr_num ?></td>
                </tr>   
              </table>
            </div>
          </div>
       </div>
    </div>
    

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
                <label class="control-label col-lg-3">Логин для рейтинга*</label>
                <div class="col-lg-6">
                  <input type="text" class="form-control" name="top10_login" value="<?php echo $userDataObj->top10_login; ?>" placeholder="Логин для рейтинга">
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-6 col-lg-offset-3">

                  <label class="checkbox inline">
                    <input type="checkbox" name="notshow_top10_login" value="<?php echo $userDataObj->notshow_top10_login; ?>" onclick="onOff(this);"> Не участвовать в рейтинге мастеров.
                  </label>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">ICQ, Skype</label>
                <div class="col-lg-6">
                  <input type="text" name="icq" class="form-control" value="<?php echo $userDataObj->icq ?>" placeholder="ICQ, Skype">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">WMR-кошелек*</label>
                <div class="col-lg-6">
                  <input type="text" class="form-control" name="curr_num" value="<?php echo $userDataObj->curr_num ?>">
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