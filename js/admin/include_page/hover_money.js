$( ".money_hover" ).hover(
  function() {
    $( ".my-icon-money-menu" ).css('background-image', 'url(/css/admin/font/money.png)');
  }, function() {
  	$(".my-icon-money-menu").css('background-image', 'url(/css/admin/font/money_b.png)');
  }
);