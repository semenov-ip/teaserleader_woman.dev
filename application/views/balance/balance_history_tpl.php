<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_balans"></div> История баланса</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">

        <div class="awidget-body">
          <div class="awidget-head"><h3>Заказать выплату</h3></div>
          <div class="form profile">
            <!-- Edit profile form (not working)-->
            <form class="form-inline" role="form" method="post">
              <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>

              <div class="form-group">
                <label class="control-label col-lg-4 summ_order">Сумма, руб.</label>
                <div class="col-lg-8">
                  <input type="text" name="summ" class="form-control" value="<?php echo $payoutDataObj->summ; ?>">
                </div>
              </div>

              <div class="form-group">
                 <!-- Buttons -->
                  <div class="col-lg-3">
                    <button type="submit" class="btn btn-default">Заказать</button>
                 </div>
              </div>
            </form>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="awidget">
        <div class="awidget-head"></div>
        <div class="awidget-body">

        <?php if($balanceDataObj){ ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="20%">Дата</th>
                <th width="15%" class="text-align-center">Приход</th>
                <th width="15%" class="text-align-center">Расход</th>
                <th width="15%" class="text-align-center">Статус операции</th>
                <th width="35%">Комментарий</th>
              </tr>
            </thead>
            <?php foreach ($balanceDataObj as $key => $currentBalanceDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentBalanceDataObj->dataadd; ?></td>
                  <td class="text-align-center"><?php echo $currentBalanceDataObj->incoming; ?></td>
                  <td class="text-align-center"><?php echo $currentBalanceDataObj->expenditure; ?></td>
                  <td class="text-align-center vertical-align-middle"><span class="label <?php echo $currentBalanceDataObj->status['class'] ?>"><?php echo $currentBalanceDataObj->status['name'] ?></span></td>
                  <td><?php echo $currentBalanceDataObj->description; ?></td>
                </tr>

            <?php } ?>
              <tr>
                <th>Итого: </th>
                <th class="text-align-center"><?php echo $balanceDataTotal['incoming']; ?></th>
                <th class="text-align-center"><?php echo $balanceDataTotal['expenditure']; ?></th>
                <th></th>
                <th></th>
              </tr>

            </tbody>
          </table>
        <?php } ?>

        <?php if(!$balanceDataObj) { ?><div class="alert alert-warning">К сожалению на данный момент истории по выплотам отсутствуют.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/admin/include_page/play_pause_element.js"></script>