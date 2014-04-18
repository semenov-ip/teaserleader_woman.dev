<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_referal_stat"></div> Рефералы</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">
        <div class="awidget-head"></div>
        <div class="awidget-body">
        <div class="row">
          <div class="col-md-12">
            <p>Ссылка для привлечения рефералов: <a class="copy-text" href="<?php echo $referralUrl; ?>"><?php echo $referralUrl; ?></a> <a class="btn btn-default copy-link margin-top--4" href="javascript:void(0)">Копировать</a></p>
          </div>
        </div>

        <?php if($statistiqData){ $this->load->view('/_shared/admin_statistiq_select_data_tpl'); }?>

        <?php if(  $statistiqData && $referralStatistiqDataArr ){ ?>

        <div class="clearfix"></div>

          <table class="table table-hover">

            <thead>
              <tr>
                <th width="50%">Дата</th>
                <th class="text-align-center">Доход</th>
              </tr>
            </thead>

            <?php foreach ($referralStatistiqDataArr['current'] as $key => $currentReferralStatistiq) {?>

            <tbody>
              <tr>
                <td><?php echo $currentReferralStatistiq['dataadd']; ?></td>
                <td class="text-align-center"><?php echo $currentReferralStatistiq['money']; ?></td>
              </tr>
            <?php } ?>
              <tr>
                <th width="50%"></th>
                <th class="text-align-center"><?php echo $referralStatistiqDataArr['common']['count_money']; ?></th>
              </tr>
            </tbody>
          </table>

        <?php } ?>
        <?php if( !$referralStatistiqDataArr ) { ?><div class="alert alert-warning">Статистической информации.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/admin/include_page/jquery.zclip.min.js"></script>
<script src="/js/admin/include_page/custom.zclip.js"></script>