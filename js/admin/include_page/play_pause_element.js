function playPauseElement(element_id, column, current_status, bd_table_name){
  var data = {
    element_id : element_id,

    column : column,

    'status' : determineStatus(current_status),

    'dbTableName' : bd_table_name
  }

  ajax_record_play_pause( data, '/_shared/play_pause_delet_js/' );
}

function deleteElement(element_id, column, bd_table_name){

  if (confirm("Вы действительно хотите выполнить УДАЛЕНИЕ текущего элемента?")) {
    var data = {
      element_id : element_id,

      column : column,

      'dbTableName' : bd_table_name
    }

    ajax_record_play_pause( data, '/_shared/play_pause_delet_js/deleteelement/' );
  }
}

function statusModerateBlock(element_id, column, current_status, bd_table_name){
  var data = {
    element_id : element_id,

    column : column,

    'status' : current_status,

    'dbTableName' : bd_table_name
  }

  ajax_record_play_pause( data, '/_shared/play_pause_delet_js/' );
}

function determineStatus(current_status){
  if(current_status == 1) { return 2; }

  if(current_status == 2) { return 1; }
}

function ajax_record_play_pause(data, url_request){
  $.ajax({
    type: "POST",

    url: url_request,

    data: 'data=' + $.toJSON(data),

    success : function(data){

      location.reload();

    }
  });
}