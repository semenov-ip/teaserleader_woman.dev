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
        <?php if($siteStatistiqDataArr){ ?>

          <?php $this->load->view('/_shared/admin_statistiq_tpl'); ?>

          <table class="table table-hover">
            <thead>
              <tr>
                <th width="50%">URL</th>
                <th>Показы</th>
                <th>Клики</th>
                <th>CTR</th>
                <th>Доход</th>
              </tr>
            </thead>
            <?php foreach ($siteStatistiqDataArr['current'] as $key => $currentSiteStatistiq) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentSiteStatistiq['url']; ?></td>
                  
                  <td><?php echo $currentSiteStatistiq['view']; ?></td>

                  <td><?php echo $currentSiteStatistiq['click']; ?></td>
                  
                  <td><?php echo $currentSiteStatistiq['ctr']; ?></td>

                  <td><?php echo $currentSiteStatistiq['count_rur']; ?></td>

                </tr>
              

            <?php } ?>
                <tr>
                  <td></td>
                  <td><?php echo $siteStatistiqDataArr['common']['view']; ?></td>
                  <td><?php echo $siteStatistiqDataArr['common']['click']; ?></td>
                  <td><?php echo $siteStatistiqDataArr['common']['ctr']; ?></td>
                  <td><?php echo $siteStatistiqDataArr['common']['count_rur']; ?></td>
                </tr>
              </tbody>
          </table>
        <?php } ?>
        <?php if(!$siteStatistiqDataArr) { ?><div class="alert alert-warning">На данный момент нет статистической информации.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>