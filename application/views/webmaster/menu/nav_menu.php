<li class="has_submenu">
  <a class="fierst-ellement" href="#">
    <i class="icon-sitemap"></i> Площадки
    <span class="caret pull-right"></span>
  </a>
  <!-- Sub menu -->
  <ul>
    <li class="<?php echo $active_class === "sites" ? "active" : "" ?>"><a href="/webmaster/sites/">Площадки</a></li>
    <li class="<?php echo $active_class === "blocks" ? "active" : "" ?>"><a href="/webmaster/blocks/">Блоки</a></li>
  </ul>
</li>

<li class="has_submenu">
  <a href="#">
    <i class="icon-signal"></i> Статистика
    <span class="caret pull-right"></span>
  </a>
  <ul>
    <li class="<?php echo $active_class === "statistiques_site" ? "active" : "" ?>"><a href="/webmaster/statistiques_site/">По площадкам</a></li>
    <li class="<?php echo $active_class === "statistiques_block" ? "active" : "" ?>"><a href="/webmaster/statistiques_block/">По блокам</a></li>
    <li class="<?php echo $active_class === "statistiques_geo" ? "active" : "" ?>"><a href="/webmaster/statistiques_geo/">По гео</a></li>
    <li class="<?php echo $active_class === "statistiques_referral" ? "active" : "" ?>"><a href="/webmaster/statistiques_referral/">По рефералам</a></li>
  </ul>
</li>

<li class="has_submenu">
  <a href="#">
    <div class="my-icon-money-menu"></div> <div class="margin-left-24 margin-top-2"> Выплаты <span class="caret pull-right"></span></div>
    
  </a>
  <ul>
    <li class="<?php echo $active_class === "balance_history" ? "active" : "" ?>"><a href="/balance/balance_history/">История баланса</a></li>
    <li class="<?php echo $active_class === "balance_payout" ? "active" : "" ?>"><a href="/balance/balance_payout/">Заказать выплату</a></li>
  </ul>
</li>
<li class="<?php echo $active_class === "tickets" ? "current" : "" ?>"><a href="/_shared/tickets/"><i class="icon-envelope-alt"></i> Тикеты <?php if($who != "admin"){ echo $ticketCount; } ?></a></li>