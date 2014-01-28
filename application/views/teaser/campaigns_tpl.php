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
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th width="50%">Название</th>
                <th>Объявления</th>
                <th>Статус</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach ($campaignDataObj as $key => $currentCampaignDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentCampaignDataObj->campaign_id; ?></td>
                  <td><?php echo $currentCampaignDataObj->name ?></td>
                  <td></td>
                  <td><span class="label <?php echo $currentCampaignDataObj->status['class'] ?>"><?php echo $currentCampaignDataObj->status['name'] ?></span></td>
                  <td>
                    <div class="btn-group">
                      
                      <button class="btn btn-default btn-xs" <?php echo $currentCampaignDataObj->playStatus; ?>><i class="<?php echo $currentCampaignDataObj->status['icon']; ?>"></i> </button>
                      
                      <a href="/teaser/teasers_add/index/<?php echo $currentCampaignDataObj->campaign_id; ?>/" title="Добавить объявление" class="btn btn-default btn-xs"><i class="icon-plus"></i> </a>
                      
                      <button title="Удалить сайт" class="btn btn-default btn-xs" onclick="deleteElement('<?php echo $currentCampaignDataObj->campaign_id ?>', 'campaign_id', 'campaigns');"><i class="icon-remove"></i> </button>
                    <div>
                  </td>
                </tr>
              </tbody>

            <?php } ?>
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