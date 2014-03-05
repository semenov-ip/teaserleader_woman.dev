function selectChecks(obj){
  var check = obj.checked;
  var form = document.getElementById('form');
  var arr = form.getElementsByTagName('input', 'checkbox');
  if(check == true){flag = true;}else{flag = false;}
  for(i = 0; i < arr.length; i++){if(arr[i] != obj)arr[i].checked = flag;}
}