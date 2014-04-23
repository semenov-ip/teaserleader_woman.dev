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
                  <th>ID</th>

                  <th width="20%">Площадка</th>

                  <th width="20%" class="text-align-center">Пользователь</th>

                  <?php echo $curentColumnSort; ?>
                </tr>
              </thead>
              <?php foreach ($siteDataObj as $key => $currentSiteStatistiq) {?>

                <tbody>
                  <tr>
                    <td><?php echo $currentSiteStatistiq->site_id; ?></td>

                    <td><a target="_blank" href="http://<?php echo $currentSiteStatistiq->url; ?>"><?php echo $currentSiteStatistiq->url; ?></a></td>

                    <td class="text-align-center"><a href="/admin/users_redirected_admin/index/<?php echo $currentSiteStatistiq->user_id; ?>/"><?php echo $currentSiteStatistiq->email; ?></a></td>

                    <td class="text-align-center"><?php echo $currentSiteStatistiq->view; ?></td>

                    <td class="text-align-center"><?php echo $currentSiteStatistiq->click; ?></td>

                    <td class="text-align-center"><?php echo $currentSiteStatistiq->ctr; ?>%</td>

                    <td class="text-align-center"><?php echo $currentSiteStatistiq->count_money; ?> руб.</td>

                  </tr>

              <?php } ?>
                  <tr>
                    <td colspan="3"></td>

                    <td class="text-align-center"><?php echo $totalStatistiq['view']; ?></td>

                    <td class="text-align-center"><?php echo $totalStatistiq['click']; ?></td>

                    <td class="text-align-center"><?php echo $totalStatistiq['ctr']; ?>%</td>

                    <td class="text-align-center"><?php echo $totalStatistiq['count_money']; ?> руб.</td>
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
<script src="/js/admin/include_page/setdate.js"></script>
<script src="/js/admin/include_page/setsorter.js"></script>