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

        <?php // if($statistiqData){ $this->load->view('/_shared/admin_statistiq_select_data_tpl'); }?>

        <?php if(  false/*$statistiqData && $referralStatistiqDataArr*/  ){ ?>

        <div class="clearfix"></div>

          <table class="table table-hover">
            <thead>
              <tr>

                <th width="50%">Дата</th>

                <th>Показов</th>

              </tr>
            </thead>
            <?php foreach ($referralStatistiqDataArr as $key => $currentReferralStatistiq) {?>
              <tbody>
                <tr>
                  <td><?php echo $currentReferralStatistiq['dataadd']; ?></td>

                  <td><?php echo $currentReferralStatistiq['money_referral']; ?></td>

                </tr>

            <?php } ?>
              </tbody>
          </table>
        <?php } ?>
        <?php if( true /*!$referralStatistiqDataArr */ ) { ?><div class="alert alert-warning">Данный раздел находится в стадии разработки.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>