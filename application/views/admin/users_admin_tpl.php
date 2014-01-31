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
        <?php if($userDataObj){ ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Дата</th>
                <th>E-mail</th>
                <th>Имя</th>
                <th>Skype</th>
                <th>Баланс</th>
              </tr>
            </thead>
            <?php foreach ($userDataObj as $key => $currentUserDataObj) {?>

              <tbody>
                <tr>
                  <td><?php echo $currentUserDataObj->user_id; ?></td>
                  <td><?php echo $currentUserDataObj->dataadd; ?></td>
                  <td><?php echo $currentUserDataObj->email; ?></td>
                  <td><?php echo $currentUserDataObj->name; ?></td>
                  <td><?php echo $currentUserDataObj->skype; ?></td>
                  <td><?php echo $currentUserDataObj->count_money; ?> руб.</td>
                </tr>
              </tbody>

            <?php } ?>
          </table>
        <?php } ?>
        <?php if(!$userDataObj) { ?><div class="alert alert-warning">К сожалению на данный момент список площадок пуст, Вы еще не добавили ни одного сайта.</div><?php } ?>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/admin/include_page/play_pause_element.js"></script>