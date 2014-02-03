<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_ticket"></div>Создание тикета</h2>
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
                  <input type="text" name="title" class="form-control" value="<?php echo $ticketDataObj->title; ?>" placeholder="Заголовок">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Описание</label>
                <div class="col-lg-6">
                  <textarea class="form-control" rows="3" name="text" ><?php echo $ticketDataObj->text; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                 <!-- Buttons -->
                  <div class="col-lg-6 col-lg-offset-3">
                    <input type="hidden" name="author_name" class="form-control" value="<?php echo $email; ?>">
                    <button type="submit" class="btn btn-default">Сохранить</button>
                    <a href="/_shared/tickets/" type="reset" class="btn btn-default">Отменить</a>
                 </div>
              </div>
            </form>
          </div>
       </div>
    </div>

  </div>
</div>