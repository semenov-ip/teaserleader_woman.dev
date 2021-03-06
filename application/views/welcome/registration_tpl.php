<?php
  $this->load->view('/_shared/header_tpl');
?>
<body>
  <div class="form">
    <div class="wrap2">

      <a class="logo" href="/"></a>

      <div class="links">
        <a class="active" href="/welcome/registration/"><span><span>Зарегистрироваться</span></span></a>

        <a href="/welcome/authentication/"><span><span>Войти</span></span></a>
      </div>

      <form class="authentication_form" role="form" method="post">

        <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>

        <div class="input">
          <input type="text" name="name" placeholder="Имя" value="<?php echo $userDataObj->name; ?>" />
        </div>

        <div class="input">
          <input type="email" name="email" placeholder="Email" value="<?php echo $userDataObj->email; ?>" />
        </div>

        <div class="input">
          <input type="text" name="purse" placeholder="WMR" value="<?php echo $userDataObj->purse; ?>" onfocus="$(this).val('R');" />
        </div>

        <div class="input">
          <input type="password" name="password" placeholder="Пароль" />
        </div>

        <div class="input">
          <input type="password" name="password_confirm" placeholder="Повторить пароль" />
        </div>

        <div class="rules">
          <div class="checkbox checked"></div>
          <div class="txt"><a href="/welcome/regulations/">Регистрируясь в системе вы ознакомллены<br />с правилами работы с системой</a></div>
        </div>

        <div class="button_reg">
          <a  href="javascript:void(0);" onclick="validationFormSubmit(event, this);"></a>
        </div>

      </form>

      <div class="link_return">
        <a href="/">Вернутся на главную</a>
      </div>

    </div>

    <?php $this->load->view('/_shared/welcome_copyright_tpl'); ?>

  </div>
  <?php $this->load->view('/_shared/welcome_footer_details_tpl'); ?>
</body>
</html>