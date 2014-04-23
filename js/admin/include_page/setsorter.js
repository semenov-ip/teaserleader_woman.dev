function setSorter(keySort, sortBy){

  $('input[name=sorter_by]').val(sortBy);

  $('input[name=sorter_column]').val(keySort);

  $('#statistiq').submit();
}