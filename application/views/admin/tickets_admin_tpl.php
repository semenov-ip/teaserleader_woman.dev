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

          <form class="form-inline" role="form" method="post">
            <div class="row">
              <div class="col-md-5">

                <div class="col-lg-12 pading-left-0">

                  <div class="form-group">
                    <select name="status" class="form-control">
                      <?php echo $selectStatus; ?>
                    </select>
                  </div>
                    
                  <input type="submit" class="btn btn-default" value="Применить" />

                  </div>

                </div>

              </div>
          </form>

        </div>

        <div class="awidget-body">
        <?php if($ticketDataObj){ ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="15%">Дата создания</th>
                <th width="35%" class="text-align-center">Пользователь</th>
                <th width="35%">Заголовок</th>
                <th width="15%" class="text-align-center">Статус</th>
              </tr>
            </thead>
            <?php foreach ($ticketDataObj as $key => $currentTicketDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentTicketDataObj->dataadd; ?></td>

                  <th class="text-align-center"><a target="_blank" href="/admin/users_redirected_admin/index/<?php echo $currentTicketDataObj->user_id; ?>/"><?php echo $currentTicketDataObj->email; ?></a></th>

                  <td><a href="/admin/tickets_edit_admin/index/<?php echo $currentTicketDataObj->ticket_id; ?>/"><?php echo $currentTicketDataObj->title; ?></a></td>

                  <td class="text-align-center"><span class="label <?php echo $currentTicketDataObj->status['class'] ?>"><?php echo $currentTicketDataObj->status['name'] ?></span></td>

                </tr>
              </tbody>

            <?php } ?>
          </table>
        <?php echo $this->pagination->create_links(); ?>
        <?php } ?>
        <?php if(!$ticketDataObj) { ?><div class="alert alert-warning">На данный момент нет сформированных тикетов.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>