<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_geo_stat"></div> Статистика по Гео</h2>
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

        <?php if(!$urlError && $statistiqData && $geoStatistiqDataArr){ ?>

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
            <?php foreach ($geoStatistiqDataArr['current'] as $key => $currentGeoStatistiq) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentGeoStatistiq['dataadd']; ?></td>

                  <td><?php echo $currentGeoStatistiq['view']; ?></td>

                  <td><?php echo $currentGeoStatistiq['click']; ?></td>

                  <td><?php echo $currentGeoStatistiq['ctr']; ?> %</td>

                  <td><?php echo $currentGeoStatistiq['count_money']; ?> руб.</td>

                </tr>

            <?php } ?>
                <tr>
                  <td></td>
                  <td><?php echo $geoStatistiqDataArr['common']['view']; ?></td>
                  <td><?php echo $geoStatistiqDataArr['common']['click']; ?></td>
                  <td><?php echo $geoStatistiqDataArr['common']['ctr']; ?> %</td>
                  <td><?php echo $geoStatistiqDataArr['common']['count_money']; ?> руб.</td>
                </tr>
              </tbody>
          </table>
        <?php } ?>
        <?php if(!$geoStatistiqDataArr && !$urlError) { ?><div class="alert alert-warning">На данный момент нет статистической информации.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>