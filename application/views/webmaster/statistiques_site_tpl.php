<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i> Площадки</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">
        <div class="awidget-head"></div>
        <div class="awidget-body">

        <?php if($urlError && $statistiqData) { ?><div class="alert alert-warning">Для того, чтобы воспользоватьс статистической информацией выберите сайт</div><?php } ?>

        <?php if($statistiqData){ $this->load->view('/_shared/admin_statistiq_select_tpl'); }?>

        <?php if(!$urlError && $statistiqData && $siteStatistiqDataArr){ ?>

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
            <?php foreach ($siteStatistiqDataArr['current'] as $key => $currentSiteStatistiq) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentSiteStatistiq['dataadd']; ?></td>

                  <td><?php echo $currentSiteStatistiq['view']; ?></td>

                  <td><?php echo $currentSiteStatistiq['click']; ?></td>

                  <td><?php echo $currentSiteStatistiq['ctr']; ?> %</td>

                  <td><?php echo $currentSiteStatistiq['count_rur']; ?> руб.</td>

                </tr>

            <?php } ?>
                <tr>
                  <td></td>
                  <td><?php echo $siteStatistiqDataArr['common']['view']; ?></td>
                  <td><?php echo $siteStatistiqDataArr['common']['click']; ?></td>
                  <td><?php echo $siteStatistiqDataArr['common']['ctr']; ?> %</td>
                  <td><?php echo $siteStatistiqDataArr['common']['count_rur']; ?> руб.</td>
                </tr>
              </tbody>
          </table>
        <?php } ?>
        <?php if(!$siteStatistiqDataArr && !$urlError) { ?><div class="alert alert-warning">На данный момент нет статистической информации.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>