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
                <th width="20%">Название</th>
                <th width="7%" class="text-align-center">Объявления</th>
                <th width="13%" class="text-align-center">Статус</th>
                <th width="8%" class="text-align-center">Показы</th>
                <th width="8%" class="text-align-center">Клики</th>
                <th width="8%" class="text-align-center">CTR</th>
                <th width="8%" class="text-align-center">Расход</th>
                <th width="18%" class="text-align-center"></th>
              </tr>
            </thead>
            <?php foreach ($campaignDataObj as $key => $currentCampaignDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentCampaignDataObj->campaign_id; ?></td>
                  <td><?php echo $currentCampaignDataObj->name; ?></td>
                  <td  class="text-align-center"><a href="/teaser/teasers/index/<?php echo $currentCampaignDataObj->campaign_id; ?>/"><?php echo $currentCampaignDataObj->countTeaser; ?></a></td>
                  <td  class="text-align-center"><span class="label <?php echo $currentCampaignDataObj->status['class'] ?>"><?php echo $currentCampaignDataObj->status['name'] ?></span></td>

                  <td class="text-align-center"><?php echo $currentCampaignDataObj->view; ?></td>
                  <td class="text-align-center"><?php echo $currentCampaignDataObj->click; ?></td>
                  <td class="text-align-center"><?php echo $currentCampaignDataObj->ctr; ?> %</td>
                  <td class="text-align-center"><?php echo $currentCampaignDataObj->count_money; ?></td>

                  <td class="text-align-center">
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
                  <th colspan="4">Итого</th>
                  <th class="text-align-center"><?php echo $totalStatistiq['view']; ?></th>
                  <th class="text-align-center"><?php echo $totalStatistiq['click']; ?></th>
                  <th class="text-align-center"><?php echo $totalStatistiq['ctr']; ?> %</th>
                  <th class="text-align-center"><?php echo $totalStatistiq['count_money']; ?></th>
                  <th></td>
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