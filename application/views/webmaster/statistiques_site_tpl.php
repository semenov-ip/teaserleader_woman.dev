<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_site_stat"></div> Статистика по площадкам</h2>
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
                <th width="40%">Дата</th>
                <th class="text-align-center">Показов</th>
                <th class="text-align-center">Кликов</th>
                <th class="text-align-center">CTR</th>
                <th class="text-align-center">Доход</th>
              </tr>
            </thead>
            <?php foreach ($siteStatistiqDataArr['current'] as $key => $currentSiteStatistiq) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentSiteStatistiq['dataadd']; ?></td>

                  <td class="text-align-center"><?php echo $currentSiteStatistiq['view']; ?></td>

                  <td class="text-align-center"><?php echo $currentSiteStatistiq['click']; ?></td>

                  <td class="text-align-center"><?php echo $currentSiteStatistiq['ctr']; ?> %</td>

                  <td class="text-align-center"><?php echo $currentSiteStatistiq['count_money']; ?> руб.</td>

                </tr>

            <?php } ?>
                <tr>
                  <td></td>
                  <td class="text-align-center"><?php echo $siteStatistiqDataArr['common']['view']; ?></td>
                  <td class="text-align-center"><?php echo $siteStatistiqDataArr['common']['click']; ?></td>
                  <td class="text-align-center"><?php echo $siteStatistiqDataArr['common']['ctr']; ?> %</td>
                  <td class="text-align-center"><?php echo $siteStatistiqDataArr['common']['count_money']; ?> руб.</td>
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