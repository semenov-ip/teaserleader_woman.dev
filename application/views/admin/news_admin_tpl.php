<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_ticket"></div>Создание новости</h2>
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
                <label class="control-label col-lg-3">Заголовок</label>
                <div class="col-lg-6">
                  <input type="text" name="title" class="form-control" value="<?php echo $newsDataObj->title; ?>" placeholder="Заголовок">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Описание</label>
                <div class="col-lg-6">
                  <textarea class="form-control" rows="3" name="text" ><?php echo $newsDataObj->text; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Дата</label>
                <div class="col-lg-6">
                  
                  <div class="datetimepicker input-append display-inline-block margin-right-10">
                    <input data-format="dd-MM-yyyy" name="dataadd" class="picker" type="text" value="<?php echo $newsDataObj->dataadd; ?>" />
                    <span class="add-on">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </span>
                  </div>

                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3"></label>
                <div class="col-lg-6">
                  <input type="checkbox" name="mailsend" checked="checked"> Отправить по почте
                </div>
              </div>

              <div class="form-group">
                 <!-- Buttons -->
                  <div class="col-lg-6 col-lg-offset-3">
                    <button type="submit" class="btn btn-default">Сохранить</button>
                    <a href="/_shared/news/" type="reset" class="btn btn-default">Отменить</a>
                 </div>
              </div>
            </form>
          </div>
       </div>
    </div>

  </div>
</div>