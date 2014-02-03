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
        <?php if($ticketDataObj){ ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="50%">Дата создания</th>
                <th width="30%">Заголовок</th>
                <th>Статус</th>
              </tr>
            </thead>
            <?php foreach ($ticketDataObj as $key => $currentTicketDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentTicketDataObj->dataadd; ?></td>
                  
                  <td><a href="/admin/tickets_edit_admin/index/<?php echo $currentTicketDataObj->ticket_id; ?>/"><?php echo $currentTicketDataObj->title; ?></a></td>

                  <td><span class="label <?php echo $currentTicketDataObj->status['class'] ?>"><?php echo $currentTicketDataObj->status['name'] ?></span></td>
                
                </tr>
              </tbody>

            <?php } ?>
          </table>
        <?php } ?>
        <?php if(!$ticketDataObj) { ?><div class="alert alert-warning">На данный момент нет сформированных тикетов.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>