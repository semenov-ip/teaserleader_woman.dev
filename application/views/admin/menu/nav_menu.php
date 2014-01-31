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
    <li class="<?php echo $active_class === "sending_mail_admin" ? "active" : "" ?>"><a href="/admin/sending_mail_admin/">Рассылка</a></li>
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
  </ul>
</li>