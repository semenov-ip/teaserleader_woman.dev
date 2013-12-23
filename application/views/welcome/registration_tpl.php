<?php
  $this->load->view('/_shared/header');
?>
<body>
  <div class="form">
    <div class="wrap2">

      <a class="logo" href="/"></a>

      <div class="links">
        <a class="active" href="/welcome/registration/"><span><span>Зарегестрироваться</span></span></a>

        <a href="/welcome/authentication/"><span><span>Войти</span></span></a>
      </div>

      <?php if($error){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>

      <form class="authentication_form" role="form" method="post">

        <div class="input">
          <input type="text" name="name" value="" placeholder="Имя" />
        </div>

        <div class="input">
          <input type="email" name="email" value="" placeholder="Email">
        </div>

        <div class="input">
          <input type="password" name="password" value="" placeholder="Пароль">
        </div>

        <div class="input">
          <input type="password" name="password_confirm" value="" placeholder="Повторить пароль">
        </div>
        
        <div class="rules">
          <div class="checkbox checked"></div>
          <div class="txt">Регистрируясь в системе вы ознакомллены<br />с правилами работы с системой</div>
        </div>
        
        <div class="button_reg">
          <a  href="javascript:void(0);" onclick="formSubmit(this);"></a>
        </div>

      </form>
      
      <div class="link_return">
        <a href="/">Вернутся на главную</a>
      </div>
          
    </div>
      
    <div class="copyright2">Copyright 2013 Ladyads. All rights reserved.</div>
      
  </div> 
<?php $this->load->view('/_shared/footer'); ?>
</body>
</html>