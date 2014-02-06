function checkLen(id_name, max_len){
  var obj = document.getElementById(id_name);
  var indicator = document.getElementById(id_name+'_indicator');
  var len = obj.value.length;

  if(len > max_len){
    val = obj.value.substr(0, max_len);
    obj.value = val;
    final_len = max_len - val.length;

  }else{
        final_len = max_len - len;
  }

  indicator.innerHTML = final_len;
}