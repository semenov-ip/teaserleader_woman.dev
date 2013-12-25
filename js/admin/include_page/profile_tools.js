$(document).ready(function() {
  var tinyintData;

  tinyintData = Number($('input[name=notshow_top10_login]').val());

  if(tinyintData){ $('input[name=notshow_top10_login]').filter(':checkbox').prop('checked', true); }

  disabledInputForm(tinyintData);
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