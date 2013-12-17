$(function() {
  $( ".datepicker" ).datepicker({
    showOn: "button",
    buttonImage: "/css/admin/images/calendar.gif",
    buttonImageOnly: true,
    dateFormat: "dd.mm.yy"
  });
});

$(document).ready(function($) {
  var tinyintData;

  tinyintData = Number($('input[name=notshow_top10_login]').val());

  if(tinyintData){ $('input[name=notshow_top10_login]').filter(':checkbox').prop('checked', true); }

  disabledInputForm(tinyintData);
});

$(document).ready(function($) {
  var  stat_login, stat_login_str, statLoginArr;

  stat_login = $('textarea[name=stat_login]');
  
  statLoginArr = stat_login.val().split("\\n");
  
  stat_login_str = statLoginArr.join("\n");
  
  stat_login.val( stat_login_str );
});

function onOff(thisEvent){
  
  var tinyintData = Number($(thisEvent).is(":checked"));

  $(thisEvent).val(tinyintData);

  disabledInputForm(tinyintData);
}

function disabledInputForm(tinyintData){
  if(tinyintData === 0){
    $('input[name=top10_login]').prop('disabled', false);
  }

  if(tinyintData === 1){
    $('input[name=top10_login]').prop('disabled', true);
  }
}