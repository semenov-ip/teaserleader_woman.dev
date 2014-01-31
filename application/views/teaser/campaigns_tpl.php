<div class="page-title">
  <h2><i class="icon-desktop color"></i> Рекламные кампании</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">
        <div class="awidget-head"></div>
        <div class="awidget-body">
        <?php if($campaignDataObj){ ?>
          <?php if($statistiqData){ $this->load->view('/_shared/admin_statistiq_tpl'); } ?>

          <table class="table table-hover">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th width="30%">Название</th>
                <th>Объявления</th>
                <th>Статус</th>
                <th width="8%">Показы</th>
                <th width="8%">Клики</th>
                <th width="8%">CTR</th>
                <th width="8%">Расход</th>
                <th width="18%"></th>
              </tr>
            </thead>
            <?php foreach ($campaignDataObj as $key => $currentCampaignDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentCampaignDataObj->campaign_id; ?></td>
                  <td><?php echo $currentCampaignDataObj->name; ?></td>
                  <td><a href="/teaser/teasers/index/<?php echo $currentCampaignDataObj->campaign_id; ?>/"><?php echo $currentCampaignDataObj->countTeaser; ?></a></td>
                  <td><span class="label <?php echo $currentCampaignDataObj->status['class'] ?>"><?php echo $currentCampaignDataObj->status['name'] ?></span></td>

                  <td><?php echo $currentCampaignDataObj->view; ?></td>
                  <td><?php echo $currentCampaignDataObj->click; ?></td>
                  <td><?php echo $currentCampaignDataObj->ctr; ?> %</td>
                  <td><?php echo $currentCampaignDataObj->count_money; ?></td>

                  <td>
                    <div class="btn-group">
                      <button class="btn btn-default btn-xs" <?php echo $currentCampaignDataObj->playStatus; ?>><i class="<?php echo $currentCampaignDataObj->status['icon']; ?>"></i> </button>

                     <a href="/teaser/teasers_add/index/<?php echo $currentCampaignDataObj->campaign_id; ?>/" title="Добавить объявление" class="btn btn-default btn-xs"><i class="icon-plus"></i> </a>

                      <a href="/teaser/campaigns_edit/index/<?php echo $currentCampaignDataObj->campaign_id; ?>/" title="Редактировать компанию" class="btn btn-default btn-xs"><i class="icon-pencil"></i> </a>

                      <button title="Удалить компанию" class="btn btn-default btn-xs" onclick="deleteElement('<?php echo $currentCampaignDataObj->campaign_id ?>', 'campaign_id', 'campaigns');"><i class="icon-remove"></i> </button>
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
        <?php if(!$campaignDataObj) { ?><div class="alert alert-warning">К сожалению на данный момент нет ни одной добавленной компании.</div><?php } ?>
        <a href="/teaser/campaigns_add/" class="btn btn-default float_right">Добавить компанию</a>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/admin/include_page/play_pause_element.js"></script>
<script src="/js/admin/include_page/setdate.js"></script>