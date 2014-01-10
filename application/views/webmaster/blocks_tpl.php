<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i> Блоки</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">
        <div class="awidget-head">
          <h3>Блоки /</h3>
        </div>
        <div class="awidget-body">
        <?php if($blockDataObj){ ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="30%">Название</th>
                <th width="30%">Количество объявлений</th>
                <th>Статус</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach ($blockDataObj as $key => $currentBlockDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentBlockDataObj->name; ?></td>
                  
                  <td><?php echo $currentBlockDataObj->itemsNumber; ?></td>
                  
                  <td><span class="label <?php echo $currentBlockDataObj->status['class'] ?>"><?php echo $currentBlockDataObj->status['name'] ?></span></td>
                  
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-default btn-xs"><i class="icon-play"></i> </button>
                      
                      <a title="Редактировать блок" href="/webmaster/blocks_edit/index/<?php echo $currentBlockDataObj->block_id; ?>/" class="btn btn-default btn-xs"><i class="icon-pencil"></i> </a>
                      
                      <button title="Удалить блок" class="btn btn-default btn-xs"><i class="icon-remove"></i> </button>
                    </div>
                  </td>
                
                </tr>
              </tbody>

            <?php } ?>
          </table>
        <?php } ?>
        <?php if(!$blockDataObj) { ?><div class="alert alert-warning">К сожалению на данный момент список площадок пуст, Вы еще не добавили ни одного сайта.</div><?php } ?>
        <a href="/webmaster/sites_add/" class="btn btn-default float_right">Добавить блок</a>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>