function formSubmit(thisLink){
  
  form = $(thisLink).closest('form')[0];

  form.submit();
}