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
                <th width="40%">URL</th>
                <th width="20%" class="text-align-center">Рекламные блоки</th>
                <th width="16%" class="text-align-center">Статус</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach ($siteDataObj as $key => $currentSiteDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentSiteDataObj->url ?></td>
                  
                  <td class="text-align-center"><a href="/webmaster/blocks/index/<?php echo $currentSiteDataObj->site_id ?>/"><?php echo $currentSiteDataObj->countBlock ?></a></td>
                  
                  <td class="text-align-center"><span class="label <?php echo $currentSiteDataObj->status['class'] ?>"><?php echo $currentSiteDataObj->status['name'] ?></span></td>
                  
                  <td class="text-align-center">
                    <div class="btn-group">
                      <button class="btn btn-default btn-xs" <?php echo $currentSiteDataObj->playStatus; ?>><i class="<?php echo $currentSiteDataObj->status['icon']; ?>"></i> </button>

                      <a href="/webmaster/blocks_add/index/<?php echo $currentSiteDataObj->site_id; ?>/" title="Добавить блок" class="btn btn-default btn-xs"><i class="icon-plus"></i> </a>

                      <a title="Редактировать сайт" href="/webmaster/sites_edit/index/<?php echo $currentSiteDataObj->site_id; ?>/" class="btn btn-default btn-xs"><i class="icon-pencil"></i> </a>

                      <button title="Удалить сайт" class="btn btn-default btn-xs" onclick="deleteElement('<?php echo $currentSiteDataObj->site_id ?>', 'site_id', 'sites');"><i class="icon-remove"></i> </button>
                    </div>
                  </td>
                </tr>
              </tbody>

            <?php } ?>
          </table>
        <?php } ?>
        <?php if(!$siteDataObj) { ?><div class="alert alert-warning">К сожалению на данный момент список площадок пуст, Вы еще не добавили ни одного сайта.</div><?php } ?>
        <a href="/webmaster/sites_add/" class="btn btn-default float_right">Добавить площадку</a>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/admin/include_page/play_pause_element.js"></script>