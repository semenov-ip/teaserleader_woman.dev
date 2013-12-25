$(document).ready(function(){
  var  stat_login, stat_login_str, statLoginArr;

  stat_login = $('textarea[name=stat_login]');
  
  statLoginArr = stat_login.val().split("\\n");
  
  stat_login_str = statLoginArr.join("\n");
  
  stat_login.val( stat_login_str );
});