<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i> Объявления</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">
        <div class="awidget-head"></div>
        <div class="awidget-body">
        <?php if($teaserDataObj){ ?>
          <?php if($statistiqData){ $this->load->view('/_shared/admin_statistiq_tpl'); } ?>

          <table class="table table-hover">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th width="20%">Изображение</th>
                <th width="30%">Текст</th>
                <th>Статус</th>
                <th width="8%">Показы</th>
                <th width="8%">Клики</th>
                <th width="8%">CTR</th>
                <th width="8%">Расход</th>
                <th width="18%"></th>
              </tr>
            </thead>
            <?php foreach ($teaserDataObj as $key => $currentTeaserDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentTeaserDataObj->teaser_id; ?></td>

                  <td><a href="<?php echo $currentTeaserDataObj->url; ?>" target="_blank"><img id="teaser_block_img_1" src="<?php echo $currentTeaserDataObj->image; ?>" width="70" height="70"></a></td>

                  <td><?php echo $currentTeaserDataObj->text; ?></td>

                  <td><span class="label <?php echo $currentTeaserDataObj->status['class'] ?>"><?php echo $currentTeaserDataObj->status['name'] ?></span></td>
                  
                  <td><?php echo $currentTeaserDataObj->view; ?></td>
                  <td><?php echo $currentTeaserDataObj->click; ?></td>
                  <td><?php echo $currentTeaserDataObj->ctr; ?> %</td>
                  <td><?php echo $currentTeaserDataObj->count_money; ?></td>

                  <td>

                    <div class="btn-group">

                      <button class="btn btn-default btn-xs" <?php echo $currentTeaserDataObj->playStatus; ?>><i class="<?php echo $currentTeaserDataObj->status['icon']; ?>"></i> </button>

                      <a title="Редактировать объявления" href="/teaser/teasers_edit/index/<?php echo $currentTeaserDataObj->teaser_id; ?>/" class="btn btn-default btn-xs"><i class="icon-pencil"></i></a>

                      <button title="Удалить сайт" class="btn btn-default btn-xs" onclick="deleteElement('<?php echo $currentTeaserDataObj->teaser_id ?>', 'teaser_id', 'teasers');"><i class="icon-remove"></i> </button>
                    </div>
                  </td>

                </tr>

            <?php } ?>

              <tr>
                <td colspan="4">Итого</td>
                <td><?php echo $totalStatistiq['view']; ?></td>
                <td><?php echo $totalStatistiq['click']; ?></td>
                <td><?php echo $totalStatistiq['ctr']; ?> %</td>
                <td><?php echo $totalStatistiq['count_money']; ?></td>
                <td></td>
              </tr>

            </tbody>
          </table>
        <?php } ?>
        <?php if(!$teaserDataObj) { ?><div class="alert alert-warning">К сожалению на данный момент нет добавленных объявлений.</div><?php } ?>
        <?php if($addTeaserButtonCampaignId){ ?><a href="/teaser/teasers_add/index/<?php echo $addTeaserButtonCampaignId; ?>/" class="btn btn-default float_right">Добавить объявление</a><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/admin/include_page/play_pause_element.js"></script>
<script src="/js/admin/include_page/setdate.js"></script>