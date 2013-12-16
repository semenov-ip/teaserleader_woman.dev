<?php
  $this->load->view('/_shared/header');
?>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="logo" href="/"></a>
        </div>

        <div class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav">
            <?php $this->load->view($menu); ?>
            <li><a href="#contact">ТОП10</a></li>
          </ul>

          <div class="float_right margin_top_10">
            <a href="" class="btn btn-sm btn-info">Выход</a>
          </div>
          
          <?php if(!isset($statistics)){ $this->load->view("/_shared/admin_user_left_info"); } ?>
        
        </div>

      </div>
    </div>

    <div class="container theme-showcase">
      <?php if(isset($statistics)){ $this->load->view($statistics); } ?>


      <div class="row well margin-top_-10">
        <?php if(isset($body)){ $this->load->view($body); } ?>
      </div>

      <?php $this->load->view('/_shared/admin_footer'); ?>

    </div>
  </body>
</html>