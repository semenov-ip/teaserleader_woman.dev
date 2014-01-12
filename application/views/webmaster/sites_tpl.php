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
                <th width="50%">URL</th>
                <th>Рекламные блоки</th>
                <th>Статус</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach ($siteDataObj as $key => $currentSiteDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentSiteDataObj->url ?></td>
                  <td></td>
                  <td><span class="label <?php echo $currentSiteDataObj->status['class'] ?>"><?php echo $currentSiteDataObj->status['name'] ?></span></td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-default btn-xs"><i class="icon-play"></i> </button>
                      <a href="/webmaster/blocks_add/index/<?php echo $currentSiteDataObj->site_id; ?>/" title="Добавить блок" class="btn btn-default btn-xs"><i class="icon-plus"></i> </a>
                      <a title="Редактировать сайт" href="/webmaster/sites_edit/index/<?php echo $currentSiteDataObj->site_id; ?>/" class="btn btn-default btn-xs"><i class="icon-pencil"></i> </a>
                      <button title="Удалить сайт" class="btn btn-default btn-xs"><i class="icon-remove"></i> </button>
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