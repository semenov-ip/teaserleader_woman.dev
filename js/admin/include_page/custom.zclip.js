$(document).ready(function() {
  
  $(".copy-link").zclip({
    path: "http://www.steamdev.com/zclip/js/ZeroClipboard.swf",

    copy: $('.copy-text').text(),

    afterCopy: function(){
      alert('Скопированная ссылка: \n ' + $('.copy-text').text());
    }
  });

});