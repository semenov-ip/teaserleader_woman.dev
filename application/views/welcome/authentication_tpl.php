<?php
  $this->load->view('/_shared/header_tpl');
?>
<script>
  $( document ).ready(function() {
    if (event.keyCode == 13) document.authform.submit();
  });
  

  
</script>

<body>
  <div class="form">
    <div class="wrap2">
        
        <a class="logo" href="/"></a>
        
        <div class="links">
          
          <a href="/welcome/registration/"><span><span>Зарегистрироваться</span></span></a>
          
          <a class="active" href="/welcome/authentication/"><span><span>Войти</span></span></a>
        </div>

        <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>

        <form action="/welcome/authentication/" id="authform" class="form-horizontal" role="form" method="post">
          
          <div class="input">
            <input type="email" name="email" value="" placeholder="Email">
          </div>
          
          <div class="input">
            <input type="password" name="password" placeholder="Пароль">
          </div>
          
          <div class="link_forgot">
            <a href="/welcome/get_new_password/">Забыли пароль?</a>
          </div>
          
          <div class="button_login">
            <a type="submit" href="javascript:void(0);" onclick="formSubmit(this);"></a>
          </div>

        </form>
        
        <div class="link_return">
          <a href="/">Вернутся на главную</a>
        </div>
        
    </div>

    <?php $this->load->view('/_shared/welcome_copyright_tpl'); ?>

  </div>
<?php $this->load->view('/_shared/welcome_footer_details_tpl'); ?>
</body></html>