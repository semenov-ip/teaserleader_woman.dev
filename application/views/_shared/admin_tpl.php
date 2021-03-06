<?php
  $this->load->view('/_shared/header_tpl');
?>
  <body>
      <!-- Logo & Navigation starts -->
      <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                <a href="/_shared/user_distributor/"><div class="logodiv"></div></a>
               </div>
               <div class="col-md-8">
                  <div class="navbar navbar-inverse" role="banner">
                      <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                          <span>Menu</span>
                        </button>
                      </div>
                      <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">

                          <li class="dropdown">
                            <a class="margin-right-10" href="/_shared/settings/"><i class="icon-user font-size-20"> </i><?php echo $email; ?></a>
                          </li>

                          <li class="dropdown">
                            <a href="/balance/balance_history/"><div class="my-icon-money"></div> <div class="margin-top-2">Баланс: <?php echo $count_money; ?> Р</div></a>
                          </li>

                          <?php
                            if($userRedirected) { $this->load->view($userRedirected); }
                          ?>

                          <li class="dropdown logout">
                            <a href="/_shared/log_out/"><span><span>Выйти</span></span></a>
                          </li>
                        </ul>
                      </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Logo & Navigation ends -->

      <!-- Page content -->
      <div class="page-content blocky">
         <div class="container">
            <div class="sidebar-dropdown"><a href="#">MENU</a></div>
            <div class="sidey">
               <div class="side-cont">
                  <ul class="nav">
                      <?php $this->load->view($menu); ?>
                      <!-- Main menu -->
                      <li class="<?php echo $active_class === "news" ? "current" : "" ?>"><a href="/_shared/news/"><i class="icon-volume-down"></i> Новости <?php echo $newsCount ?></a></li>
                      <li class="<?php echo $active_class === "settings" ? "current" : "" ?>"><a href="/_shared/settings/"><i class="icon-user"></i> Профиль</a></li>
                      <li class="<?php echo $active_class === "faq" ? "current" : "" ?>"><a class="last-ellement" href="/_shared/faq/"><i class="icon-book"></i> FAQ</a></li>
                  </ul>
               </div>
            </div>
            <div class="mainy">
              <?php if(isset($body)){ $this->load->view($body); } ?>
            </div>

            <div class="clearfix"></div>

         </div>
      </div>

      <!-- Footer starts -->
      <?php $this->load->view('/_shared/admin_footer_details_tpl'); ?>
      <!-- Footer ends -->

      <!-- Scroll to top -->
      <span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 

      <?php $this->load->view('/_shared/admin_footer_tpl'); ?>

  </body> 
</html>