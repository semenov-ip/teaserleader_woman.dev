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

        <?php if($siteDataObj){ ?>

          <?php if( $siteDataObj ){ $this->load->view('/_shared/admin_statistiq_search_tpl'); }?>

          <div class="clearfix"></div>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th width="20%">Площадка</th>
                  <th width="15%">Пользователь</th>
                  <th>Показов</th>
                  <th>Кликов</th>
                  <th>CTR</th>
                  <th>Доход</th>
                </tr>
              </thead>
              <?php foreach ($siteDataObj as $key => $currentSiteStatistiq) {?>


                <tbody>
                  <tr>
                    <td><?php echo $currentSiteStatistiq->url; ?></td>

                    <td><?php echo $currentSiteStatistiq->email; ?></td>

                    <td><?php echo $currentSiteStatistiq->view; ?></td>

                    <td><?php echo $currentSiteStatistiq->click; ?></td>

                    <td><?php echo $currentSiteStatistiq->ctr; ?> %</td>

                    <td><?php echo $currentSiteStatistiq->count_money; ?> руб.</td>

                  </tr>


              <?php } ?>
                  <tr>
                    <td colspan="2"></td>
                    <td><?php echo $totalStatistiq['view']; ?></td>
                    <td><?php echo $totalStatistiq['click']; ?></td>
                    <td><?php echo $totalStatistiq['ctr']; ?> %</td>
                    <td><?php echo $totalStatistiq['count_money']; ?> руб.</td>
                  </tr>
                </tbody>
            </table>


          <?php } ?>
        <?php if(!$siteDataObj) { ?><div class="alert alert-warning">На данный момент нет статистической информации.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>