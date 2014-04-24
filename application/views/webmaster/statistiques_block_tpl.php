<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_block_stat"></div> Статистика по блокам</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">
        <div class="awidget-head"></div>
        <div class="awidget-body">

        <?php if($urlError && $statistiqData) { ?><div class="alert alert-warning">Для того, чтобы воспользоватьс статистической информацией выберите блок</div><?php } ?>

        <?php if($statistiqData){ $this->load->view('/_shared/admin_statistiq_select_tpl'); }?>

        <?php if(!$urlError && $statistiqData && $blockStatistiqDataArr){ ?>

        <div class="clearfix"></div>

          <table class="table table-hover">
            <thead>
              <tr>
                <th width="50%">Дата</th>
                <th>Показов</th>
                <th>Кликов</th>
                <th>CTR</th>
                <th>Доход</th>
              </tr>
            </thead>
            <?php foreach ($blockStatistiqDataArr['current'] as $key => $currentBlockStatistiq) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentBlockStatistiq['dataadd']; ?></td>

                  <td><?php echo $currentBlockStatistiq['view']; ?></td>

                  <td><?php echo $currentBlockStatistiq['click']; ?></td>

                  <td><?php echo $currentBlockStatistiq['ctr']; ?> %</td>

                  <td><?php echo $currentBlockStatistiq['count_money']; ?> руб.</td>

                </tr>

            <?php } ?>
                <tr>
                  <td></td>
                  <td><?php echo $blockStatistiqDataArr['common']['view']; ?></td>
                  <td><?php echo $blockStatistiqDataArr['common']['click']; ?></td>
                  <td><?php echo $blockStatistiqDataArr['common']['ctr']; ?> %</td>
                  <td><?php echo $blockStatistiqDataArr['common']['count_money']; ?> руб.</td>
                </tr>
              </tbody>
          </table>
        <?php } ?>
        <?php if(!$blockStatistiqDataArr && !$urlError) { ?><div class="alert alert-warning">На данный момент нет статистической информации.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>