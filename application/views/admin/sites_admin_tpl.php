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
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th width="30%">URL</th>
                <th width="25%">Пользователь</th>
                <th>Рекламные блоки</th>
                <th width="15%">Статус</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach ($siteDataObj as $key => $currentSiteDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentSiteDataObj->site_id; ?></td>
                  <td><?php echo $currentSiteDataObj->url; ?></td>
                  <td><a href="/admin/users_redirected_admin/index/<?php echo $currentSiteDataObj->user_id; ?>/"><?php echo $currentSiteDataObj->email; ?></a></td>
                  <td></td>
                  <td><span class="label <?php echo $currentSiteDataObj->status['class'] ?>"><?php echo $currentSiteDataObj->status['name'] ?></span></td>
                  <td>
                    <div class="btn-group">
                      <?php echo $currentSiteDataObj->statusModerateBlock; ?>

                      <a title="Редактировать цену" href="/admin/sites_edit_rates/index/<?php echo $currentSiteDataObj->site_id; ?>/" class="btn btn-default btn-xs"><i class="icon-pencil"></i> </a>

                      <button title="Удалить сайт" class="btn btn-default btn-xs" onclick="deleteElement('<?php echo $currentSiteDataObj->site_id ?>', 'site_id', 'sites');"><i class="icon-remove"></i> </button>
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