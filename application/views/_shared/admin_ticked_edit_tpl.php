<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_ticket"></div><?php echo $ticketDataObj[0]->title; ?></h2>
  <hr />
</div>
 
<!-- Page title -->
<div class="row">
  <div class="col-md-12">

    <div class="awidget">
      <div class="awidget-head"></div>
      <div class="awidget-body">

       <!-- Profile form -->
          <div class="form profile">

            <div class="awidget-body">
              <ul class="chats">
                <?php foreach ($ticketDataObj as $key => $currentTicketDataObj) { ?> 

                  <li class="<?php echo $currentTicketDataObj->user_roles['by']; ?>">
                    <div class="avatar <?php echo $currentTicketDataObj->user_roles['align_name']; ?>">
                      <img src="/images/<?php echo $currentTicketDataObj->user_roles['img']; ?>" alt="" class="img-responsive"/>
                    </div>

                    <div class="chat-content">
                      <div class="chat-meta"><?php echo $currentTicketDataObj->author_name; ?> <span class="<?php echo $currentTicketDataObj->user_roles['align_text']; ?>"><?php echo $currentTicketDataObj->dataadd; ?></span></div>
                      <?php echo $currentTicketDataObj->text; ?>

                      <div class="clearfix"></div>
                    </div>
                  </li>
                <?php } ?>

              </ul>
            </div>

            <?php if($close){ ?>
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
                    <a href="/_shared/ticket_close/index/<?php echo $currentTicketDataObj->ticket_id; ?>/" type="reset" class="btn btn-default">Закрыть тикет</a>
                 </div>
              </div>
            </form>
            <?php } ?>


          </div>
       </div>
    </div>

  </div>
</div>