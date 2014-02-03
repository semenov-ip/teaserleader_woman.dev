<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_balans"></div> Заказать выплату</h2>
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
                <label class="control-label col-lg-3">Сумма, руб.</label>
                <div class="col-lg-6">
                  <input type="text" name="summ" class="form-control" value="<?php echo $payoutDataObj->summ; ?>">
                </div>
              </div>

              <div class="form-group">
                 <!-- Buttons -->
                  <div class="col-lg-6 col-lg-offset-3">
                    <button type="submit" class="btn btn-default">Заказать</button>
                    <a href="/balance/balance_history/" type="reset" class="btn btn-default">Отменить</a>
                 </div>
              </div>
            </form>
          </div>
       </div>
    </div>

  </div>
</div>