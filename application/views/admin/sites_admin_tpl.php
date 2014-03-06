<script>
  $( document ).ready(function() {
    console.log($('.stat_login').html());
  });
</script>

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

          <form class="form-horizontal" role="form" method="post">
            <div class="row">
              <div class="col-md-5">

                <div class="col-lg-12 pading-left-0">

                  <div class="input-group">

                    <input type="text" name="search" class="form-control" placeholder="ID, URL, mail">

                    <span class="input-group-btn">

                      <input type="submit" name="select" class="btn btn-default" value="Искать" />
                    </span>

                  </div>

                </div>

              </div>
            </div>
          </form>

        </div>

        <div class="awidget-body">

          <?php if($siteDataObj){ ?>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th width="15%">URL</th>
                  <th width="20%" class="text-align-center">Пользователь</th>
                  <th width="30%">Доступ к статистике</th>
                  <th width="15%" class="text-align-center">Статус</th>
                  <th width="20%" class="text-align-center"></th>
                </tr>
              </thead>
              <?php foreach ($siteDataObj as $key => $currentSiteDataObj) {?>

                <tbody>
                  <tr>
                    <td><?php echo $currentSiteDataObj->site_id; ?></td>

                    <td><a href="http://<?php echo $currentSiteDataObj->url; ?>"><?php echo $currentSiteDataObj->url; ?></a></td>

                    <td class="text-align-center"><a href="/admin/users_redirected_admin/index/<?php echo $currentSiteDataObj->user_id; ?>/"><?php echo $currentSiteDataObj->email; ?></a></td>

                    <td class="stat_login"><?php echo $currentSiteDataObj->stat_login; ?></td>

                    <td class="text-align-center"><span class="label <?php echo $currentSiteDataObj->status['class'] ?>"><?php echo $currentSiteDataObj->status['name'] ?></span></td>

                    <td class="text-align-center">
                      <div class="btn-group">

                        <a title="Принять" href="/admin/sites_take_block_admin/index/<?php echo $currentSiteDataObj->site_id; ?>/1/" class="btn btn-default btn-xs"><i class="icon-ok"></i></a>

                        <a title="Отклонить" href="/admin/sites_take_block_admin/index/<?php echo $currentSiteDataObj->site_id; ?>/3/" class="btn btn-default btn-xs"><i class="icon-minus-sign"></i></a>

                        <a title="Редактировать цену" href="/admin/sites_edit_rates/index/<?php echo $currentSiteDataObj->site_id; ?>/" class="btn btn-default btn-xs"><i class="icon-pencil"></i> </a>

                        <button title="Удалить площадку" class="btn btn-default btn-xs" onclick="deleteElement('<?php echo $currentSiteDataObj->site_id ?>', 'site_id', 'sites');"><i class="icon-remove"></i> </button>
                      </div>
                    </td>
                  </tr>
                </tbody>

              <?php } ?>
            </table>
          <?php } ?>
          <?php if(!$siteDataObj) { ?><div class="alert alert-warning">На данный момент список площадок пуст</div><?php } ?>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/admin/include_page/play_pause_element.js"></script>