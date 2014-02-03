<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i><?php echo $ticketDataObj[0]->title; ?></h2>
  <hr />
</div>
 
<!-- Page title -->
<div class="row">
  <div class="col-md-12">

    <div class="awidget">
       <div class="awidget-head">
       </div>
       <div class="awidget-body">

       <!-- Profile form -->

          <div class="form profile">
             <table class="table table-hover">
              <thead>
                <tr>
                  <th width="40%">Дата создания</th>
                  <th width="30%" class="text-align-center">Автор</th>
                  <th width="30%">Текст</th>
                </tr>
              </thead>
                <tbody>

                <?php foreach ($ticketDataObj as $key => $currentTicketDataObj) { ?>                
                  <tr>
                    <td><?php echo $currentTicketDataObj->dataadd; ?></td>

                    <td class="text-align-center"><?php echo $currentTicketDataObj->author_name; ?></td>

                    <td><?php echo $currentTicketDataObj->text; ?></span></td>
                  </tr>
                <?php } ?>

                </tbody>
            </table>


            <div class="awidget-head"><h3>Добавление быстрого ответа</h3></div>
            <!-- Edit profile form (not working)-->
            <form class="form-horizontal" role="form" method="post">
              <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>

              <div class="form-group">
                <label class="control-label col-lg-1">Описание</label>
                <div class="col-lg-6">
                  <textarea class="form-control" rows="3" name="text" ></textarea>
                </div>
              </div>

              <div class="form-group">
                 <!-- Buttons -->
                  <div class="col-lg-6 col-lg-offset-1">
                    <input type="hidden" name="author_name" class="form-control" value="<?php echo $email; ?>">
                    <button type="submit" class="btn btn-default">Добавить</button>
                    <a href="/_shared/tickets/" type="reset" class="btn btn-default">Отменить</a>
                 </div>
              </div>
            </form>
          </div>
       </div>
    </div>

  </div>
</div>