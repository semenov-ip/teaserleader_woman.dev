<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_balans"></div> Заявки</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">
        <div class="awidget-head"></div>

         <div class="awidget-body">

          <form class="form-inline" role="form" method="post">
            <div class="row">
              <div class="col-md-5">

                <div class="col-lg-12 pading-left-0">

                  <div class="form-group">
                    <select name="status" class="form-control">
                      <?php echo $selectStatus; ?>
                    </select>
                  </div>
                    
                  <input type="submit" class="btn btn-default" value="Применить" />

                  </div>

                </div>

              </div>
          </form>

        </div>


        <div class="awidget-body">
          <form id="form" method="post">
            <?php if($balanceDataObj){ ?>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th width="5%" class="text-align-center"><input type="checkbox" onclick="selectChecks(this)"></th>
                    <th width="10%">Дата</th>
                    <th width="20%" class="text-align-center">Пользователь</th>
                    <th width="10%" class="text-align-center">Сумма</th>
                    <th width="15%" class="text-align-center">Статус операции</th>
                    <th width="25%">Комментарий</th>
                    <th width="7%"></th>
                  </tr>
                </thead>
                <?php foreach ($balanceDataObj as $key => $currentBalanceDataObj) {?>

                  <tbody>
                    <tr>
                      <td class="text-align-center"><input name="check[]" type="checkbox" value="<?php echo $currentBalanceDataObj->count_history_id; ?>"></td>
                      <td><?php echo $currentBalanceDataObj->dataadd; ?></td>

                      <td class="text-align-center"><a href="/admin/users_redirected_admin/index/<?php echo $currentBalanceDataObj->user_id; ?>/"><?php echo $currentBalanceDataObj->email; ?></a></td>

                      <td class="text-align-center"><?php echo $currentBalanceDataObj->summ; ?></td>

                      <td class="text-align-center"><span class="label <?php echo $currentBalanceDataObj->status['class'] ?>"><?php echo $currentBalanceDataObj->status['name'] ?></span></td>

                      <td><?php echo $currentBalanceDataObj->description; ?></td>

                      <td>
                        <div class="btn-group">

                          <button title='Завершить' class='btn btn-default btn-xs' onclick="statusModerateBlock('<?php echo $currentBalanceDataObj->count_history_id; ?>', 'count_history_id', '1', 'count_history')"><i class='icon-ok'></i> </button>

                          <button title='Отклонить' class='btn btn-default btn-xs' onclick="statusModerateBlock('<?php echo $currentBalanceDataObj->count_history_id; ?>', 'count_history_id', '2', 'count_history')"><i class='icon-minus-sign'></i> </button>

                        </div>
                      </td>
                    </tr>

                <?php } ?>
                  <tr>
                    <th>Итого: </th>
                    <th class="text-align-center"></th>
                    <th></th>
                    <th class="text-align-center"><?php echo $balanceDataTotal['summ']; ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tbody>
              </table>

            <input type="submit" name="move_treated" class="btn btn-default" value="Завершить" />

            <input type="submit" name="move_reject" class="btn btn-default" value="Отклонить" />

            <input type="submit" name="export_csv" class="btn btn-default" value="Экспорт в CSV" />

            <?php } ?>
            <?php if(!$balanceDataObj) { ?><div class="alert alert-warning">К сожалению на данный момент выплоты отсутствует.</div><?php } ?>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/admin/include_page/play_pause_element.js"></script>
<script src="/js/admin/include_page/select_checks.js"></script>