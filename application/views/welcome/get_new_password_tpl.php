<?php
  $this->load->view('/_shared/header_tpl');
?>
<body>
<div class="form">
  <div class="wrap2">

    <a class="logo" href="/"></a>

    <div class="forgot">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</div>

    <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>

    <form class="authentication_form" role="form" method="post">

      <div class="input">
        <input type="text" name="email" placeholder="E-mail" value="<?php echo $userDataObj->email; ?>" />
      </div>

      <div class="button_send">
        <a href="javascript:void(0);" onclick="formSubmit(this);"></a>
      </div>

      <div class="link_return">
        <a href="/">Вернутся на главную</a>
      </div>

    </form>

  </div>

  <?php $this->load->view('/_shared/welcome_copyright_tpl'); ?>

</div>
<?php $this->load->view('/_shared/welcome_footer_details_tpl'); ?>
</body>
</html>