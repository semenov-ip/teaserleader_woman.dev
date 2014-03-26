  var errorMessage = {
    'name'        : 'Имя должно быть заполнено, и не должно содержать цифры!',

    'email'       : 'Укажите корретный email адрес',

    'purse'       : 'Номер WMR кошелька должен начинатся с заглавной буквы "R", и содержать 12 цифр'
  }

  function validationFormSubmit(event, thisLink){
    var form, inputDataCount;

    event.preventDefault();

    var dataForm = {};

    form = $(thisLink).closest('form')[0];

    inputDataCount = $('input, textarea', $(form) ).length;

    for(var i=0; i < inputDataCount; i++){
        
        input = $('input, textarea', $(form))[i];

        if(!validationData(input)){
          return false;
        }
    }

    form.submit();
    return true;
  }

  function validationData(inputData){

    var validateAttrName = $(inputData).attr('name');

    var dataVal = $(inputData).val();

    var validate = {
      
      name    : function (){
        if( (dataVal.length < 1) || issetNumber(dataVal) ){
          alert(errorMessage[validateAttrName]);
          return false;
        }
        return true;
      },

      email   : function (){
        if( validateRegEx( /^[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/, dataVal) ){
          alert(errorMessage[validateAttrName]);
          return false;
        }
        return true;
      },

      purse  : function (){
        if( validateRegEx(/R[0-9]{12}/, dataVal) ){
          alert(errorMessage[validateAttrName]);
          return false;
        }
        return true;
      },

    };

    if( validate.hasOwnProperty(validateAttrName) ){
      return validate[validateAttrName]();
    }

    return true;
  }

  function issetNumber(text){
    for(i=0; i<text.length; i++){
      if(!isNaN(text[i]) && (text[i] !== " ") ) {
        return true;
      }
    }
    return false;
  }

  function validateRegEx(regex, Str){
    if( !regex.test(Str) ){
      return true;
    }
    return false;
  }

  function formSubmit(thisLink){

    form = $(thisLink).closest('form')[0];

    form.submit();
  }