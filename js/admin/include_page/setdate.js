function setdate(beginDate, endDate){
  $('input[name=date_start]').val(beginDate);
  $('input[name=date_end]').val(endDate);
  $('#statistiq').submit();
}
