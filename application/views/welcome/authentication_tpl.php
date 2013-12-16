<?php
  $this->load->view('/_shared/header');
?>
<body>
  <div class="form">
    <div class="wrap2">
        
        <a class="logo" href="/"></a>
        
        <div class="links">
          
          <a href="/welcome/registration/"><span><span>Зарегестрироваться</span></span></a>
          
          <a class="active" href="/welcome/authentication/"><span><span>Войти</span></span></a>
        </div>

        <?php if($error){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>

        <form class="form-horizontal" role="form" method="post">
          
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
            <a href="javascript:void(0);" onclick="formSubmit(this);"></a>
          </div>

        </form>
        
        <div class="link_return">
          <a href="/">Вернутся на главную</a>
        </div>
        
    </div>
      
    <div class="copyright2">Copyright 2013 Ladyads. All rights reserved.</div>
      
  </div>

</body></html>