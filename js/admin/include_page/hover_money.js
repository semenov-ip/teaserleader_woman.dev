$(document).ready(function() {
    
    $( ".money_hover" ).hover(
      
      function() {

        $( ".my-icon-money-menu" ).css('background-image', 'url(/css/admin/font/money.png)');

      }, function() {

        if( !$(".money_hover_activ").hasClass('current') ){

          $(".my-icon-money-menu").css('background-image', 'url(/css/admin/font/money_b.png)');

        }

      }

    );
});