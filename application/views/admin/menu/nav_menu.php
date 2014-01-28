<li class="has_submenu">
  <a class="fierst-ellement" href="#">
    <i class="icon-list-alt"></i> Администратор
    <span class="caret pull-right"></span>
  </a>
  <ul>
    <li class="<?php echo $active_class === "sites_admin" ? "active" : "" ?>"><a href="/admin/sites_admin/">Площадки</a></li>
    <li class="<?php echo $active_class === "users_admin" ? "active" : "" ?>"><a href="/admin/users_admin/">Пользователи</a></li>
    <li class="<?php echo $active_class === "tickets_admin" ? "active" : "" ?>"><a href="/admin/tickets_admin/">Тикеты <?php echo $ticketCount ?></a></li>
    <li><a href="#">Заявки</a></li>
    <li><a href="#">Рассылка</a></li>
  </ul>
</li>

<li class="has_submenu">
  <a href="#">
    <i class="icon-list-alt"></i> Площадки
    <span class="caret pull-right"></span>
  </a>
  <ul>
    <li class="<?php echo $active_class === "sites" ? "active" : "" ?>"><a href="/webmaster/sites/">Площадки</a></li>
    <li class="<?php echo $active_class === "blocks" ? "active" : "" ?>"><a href="/webmaster/blocks/">Блоки</a></li>
  </ul>
</li>

<li class="has_submenu">
  <a href="#">
    <i class="icon-sitemap"></i> Кампании
    <span class="caret pull-right"></span>
  </a>
  <ul>
    <li class="<?php echo $active_class === "campaigns" ? "active" : "" ?>"><a href="/teaser/campaigns/">Рекламные кампании</a></li>
    <li class="<?php echo $active_class === "teasers" ? "active" : "" ?>"><a href="/teaser/teasers/">Объявления</a></li>
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
    <li class="<?php echo $active_class === "statistiques_teaser" ? "active" : "" ?>"><a href="/teaser/statistiques_teaser/">По объявлениям</a></li>
    <li class="<?php echo $active_class === "statistiques_geo" ? "active" : "" ?>"><a href="/webmaster/statistiques_geo/">По гео</a></li>
    <li class="<?php echo $active_class === "statistiques_referral" ? "active" : "" ?>"><a href="/webmaster/statistiques_referral/">По рефералам</a></li>
  </ul>
</li>