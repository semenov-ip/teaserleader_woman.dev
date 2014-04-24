<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i> Пользователи</h2>
  <hr />
</div>
<!-- Page title -->
  <div class="row">
    <div class="col-md-12">

      <div class="awidget">
        <div class="awidget-head"></div>

          <div class="awidget-body">

            <form class="form-horizontal" role="form" method="post">
              <div class="row">
                <div class="col-md-5">

                  <div class="col-lg-12 pading-left-0">

                    <div class="input-group">

                      <input type="text" name="search" class="form-control" placeholder="ID, mail">

                      <span class="input-group-btn">

                        <input type="submit" name="select" class="btn btn-default" value="Искать" />
                      </span>

                    </div>

                  </div>

                </div>
              </div>
            </form>

          </div>

          <div class="awidget-body">
          <?php if($userDataObj){ ?>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th width="5%">ID</th>
                  <th width="15%" class="text-align-center">Дата</th>
                  <th width="25%" class="text-align-center">E-mail</th>
                  <th width="15%" class="text-align-center">Имя</th>
                  <th width="15%" class="text-align-center">Баланс</th>
                  <th width="15%" class="text-align-center">Статус</th>
                  <th width="10%"></th>
                </tr>
              </thead>
              <?php foreach ($userDataObj as $key => $currentUserDataObj) {?>

                <tbody>
                  <tr>
                    <td><?php echo $currentUserDataObj->user_id; ?></td>

                    <td class="text-align-center"><?php echo $currentUserDataObj->dataadd; ?></td>

                    <td class="text-align-center"><a target="_blank" href="/admin/users_redirected_admin/index/<?php echo $currentUserDataObj->user_id; ?>/"><?php echo $currentUserDataObj->email; ?></a></td>

                    <td class="text-align-center"><?php echo $currentUserDataObj->name; ?></td>

                    <td class="text-align-center"><?php echo $currentUserDataObj->count_money; ?> руб.</td>

                    <td class="text-align-center"><span class="label <?php echo $currentUserDataObj->status['class'] ?>"><?php echo $currentUserDataObj->status['name'] ?></span></td>

                    <td class="text-align-center">
                      <div class="btn-group">

                        <button title='Принять' class='btn btn-default btn-xs' onclick="statusModerateBlock('<?php echo $currentUserDataObj->user_id; ?>', 'user_id', '1', 'users')"><i class='icon-ok'></i> </button>

                        <button title='Заблокировать' class='btn btn-default btn-xs' onclick="statusModerateBlock('<?php echo $currentUserDataObj->user_id; ?>', 'user_id', '3', 'users')"><i class='icon-minus-sign'></i> </button>

                        <a title="Написать в тикет" href="/admin/tickets_add_admin/index/<?php echo $currentUserDataObj->user_id; ?>/" class="btn btn-default btn-xs"><i class="icon-envelope-alt"></i> </a>
                      </div>
                    </td>
                  </tr>
                </tbody>

              <?php } ?>
            </table>
          <?php echo $this->pagination->create_links(); ?>
          <?php } ?>
          <?php if(!$userDataObj) { ?><div class="alert alert-warning">К сожалению на данный момент список площадок пуст, Вы еще не добавили ни одного сайта.</div><?php } ?>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/admin/include_page/play_pause_element.js"></script>