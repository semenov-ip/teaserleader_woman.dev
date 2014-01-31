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
                <th width="50%">URL</th>
                <th>Рекламные блоки</th>
                <th width="15%">Статус</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach ($siteDataObj as $key => $currentSiteDataObj) {?>

              <tbody>
                <tr>
                  <th><?php echo $currentSiteDataObj->site_id; ?></th>
                  <td><?php echo $currentSiteDataObj->url; ?></td>
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