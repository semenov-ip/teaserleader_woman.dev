<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_block"></div> Блоки</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">
        <div class="awidget-head"></div>
        <div class="awidget-body">
        <?php if($blockDataObj){ ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="30%">Название</th>
                <th width="30%" class="text-align-center">Количество объявлений</th>
                <th width="16%" class="text-align-center">Статус</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach ($blockDataObj as $key => $currentBlockDataObj) {?>

              <tbody>
                <tr>
                  <td><a title="<?php echo $currentBlockDataObj->name; ?>" href="/webmaster/blocks_edit/index/<?php echo $currentBlockDataObj->block_id; ?>/"><?php echo $currentBlockDataObj->name; ?></a></td>

                  <td class="text-align-center"><?php echo $currentBlockDataObj->itemsNumber; ?></td>

                  <td class="text-align-center"><span class="label <?php echo $currentBlockDataObj->status['class'] ?>"><?php echo $currentBlockDataObj->status['name'] ?></span></td>

                  <td class="text-align-center">
                    <div class="btn-group">
                      <button class="btn btn-default btn-xs" <?php echo $currentBlockDataObj->playStatus; ?>><i class="<?php echo $currentBlockDataObj->status['icon']; ?>"></i> </button>

                      <a title="Редактировать блок" href="/webmaster/blocks_edit/index/<?php echo $currentBlockDataObj->block_id; ?>/" class="btn btn-default btn-xs"><i class="icon-pencil"></i> </a>

                      <button title="Удалить сайт" class="btn btn-default btn-xs" onclick="deleteElement('<?php echo $currentBlockDataObj->block_id ?>', 'block_id', 'blocks');"><i class="icon-remove"></i> </button>
                    </div>
                  </td>

                </tr>
              </tbody>

            <?php } ?>
          </table>
        <?php } ?>

        <?php if(!$blockDataObj) { ?><div class="alert alert-warning">К сожалению на данный момент Вы еще не добавили ни одного блока.</div><?php } ?>

        <?php if($addBlockButtonSiteId){ ?><a href="/webmaster/blocks_add/index/<?php echo $addBlockButtonSiteId; ?>/" class="btn btn-default float_right">Добавить блок</a><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/admin/include_page/play_pause_element.js"></script>