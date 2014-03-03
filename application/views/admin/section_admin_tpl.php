<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_ticket"></div> Тикеты</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">
        <div class="awidget-head"></div>
        <div class="awidget-body">
        <?php if($sectionDataObj){ ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="50%">Название</th>
                <th width="25%" class="text-align-center">Цена за клик РФ</th>
                <th width="25%" class="text-align-center">Цена за клик СНГ</th>
              </tr>
            </thead>
            <?php foreach ($sectionDataObj as $key => $currentSectionDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentSectionDataObj->section_name; ?></td>

                  <td class="text-align-center"><?php echo $currentSectionDataObj->price; ?></td>

                  <td class="text-align-center"><?php echo $currentSectionDataObj->price_sng; ?></td>

                </tr>
              </tbody>

            <?php } ?>
          </table>
        <?php } ?>
        <?php if(!$sectionDataObj) { ?><div class="alert alert-warning">На данный момент нет сформированных тикетов.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>