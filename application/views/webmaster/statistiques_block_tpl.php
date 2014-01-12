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
        <?php if($blockStatistiqDataArr){ ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="50%">URL</th>
                <th>Показы</th>
                <th>Клики</th>
                <th>CTR</th>
                <th>Доход</th>
              </tr>
            </thead>
            <?php foreach ($blockStatistiqDataArr['current'] as $key => $currentBlockStatistiq) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentBlockStatistiq['name']; ?></td>
                  
                  <td><?php echo $currentBlockStatistiq['view']; ?></td>

                  <td><?php echo $currentBlockStatistiq['click']; ?></td>
                  
                  <td><?php echo $currentBlockStatistiq['ctr']; ?></td>

                  <td><?php echo $currentBlockStatistiq['count_rur']; ?></td>

                </tr>
              

            <?php } ?>
                <tr>
                  <td></td>
                  <td><?php echo $blockStatistiqDataArr['common']['view']; ?></td>
                  <td><?php echo $blockStatistiqDataArr['common']['click']; ?></td>
                  <td><?php echo $blockStatistiqDataArr['common']['ctr']; ?></td>
                  <td><?php echo $blockStatistiqDataArr['common']['count_rur']; ?></td>
                </tr>
              </tbody>
          </table>
        <?php } ?>
        <?php if(!$blockStatistiqDataArr) { ?><div class="alert alert-warning">На данный момент нет статистической информации.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>