 $(document).ready(function(){

  $( ".open" ).click(function(){

    $(this).next('.content').slideToggle("slow");

    $(this).children('.content-icon').toggleClass('down')

  });

  $( ".second_link" ).click(function(){

    $(this).next('.content').slideToggle("slow");

  });

  sliderRange('.slider-range-min-1', '.hor', 1, 8, '', '');

  sliderRange('.slider-range-min-2', '.ver', 1, 8, '', '');

  sliderRange('.slider-range-min-3', '.table_border_width', 0, 7, 'px', '');

  sliderRange('.slider-range-min-4', '.image_border_width', 0, 7, 'px', '');

  sliderRange('.slider-range-min-5', '.cell_border_width', 0, 7, 'px', '');

  sliderRange('.slider-range-min-6', '.cell_margin', 0, 10, '', '');

  sliderRange('.slider-range-min-7', '.cell_padding', 0, 10, '', '');

  sliderRange('.slider-range-min-8', '.font_size', 9, 20, 'px', 'px');

  colorPickerDeclare('.backgroundColor', 'background_color');

  colorPickerDeclare('.tableBorderColor', 'table_border_color');

  colorPickerDeclare('.imageBorderColor', 'image_border_color');

  colorPickerDeclare('.cellBackground', 'cell_background');

  colorPickerDeclare('.cellBorderColor', 'cell_border_color');

  colorPickerDeclare('.fontColor', 'font_color');

  colorPickerDeclare('.fontColorHover', 'font_color_hover');

  $(".prepared_block").change(function(){

    var preparedBlock = $(this).val();

    var preparedBlockArray = preparedBlock.split('_');

    var horVerArray = preparedBlockArray[0].split('x');

    var size = preparedBlockArray[1].split('x');

    $( ".size option:selected" ).text(preparedBlockArray[1]);

    $( ".size option:selected" ).val(size[0]);

    $('a', $('.slider-range-min-1')).html('<div class="tooltip_slider">' + horVerArray[0] + '</div>');

    $('.slider-range-min-1').slider( 'value', horVerArray[0] );

    $('.hor').val( horVerArray[0] );

    $('a', $('.slider-range-min-2')).html('<div class="tooltip_slider">' + horVerArray[1] + '</div>');

    $('.slider-range-min-2').slider( 'value', horVerArray[1] );

    $('.ver').val( horVerArray[1] );
  });
});


function sliderRange(sliderClass, inputNameClass, min, max, unitOfLength, unitOfSave){
  $(sliderClass).slider({
    range: "min",

    value: parseInt($(inputNameClass).val(), 10),

    min: min,

    max: max,

    slide: function( event, ui ) {
      $(inputNameClass).val( ui.value + unitOfSave );

      $(sliderClass + ' .ui-slider-handle').html('<div class="tooltip_slider">' + ui.value + unitOfLength +'</div>');
    }

  });

  $('a', $(sliderClass)).html('<div class="tooltip_slider">' + $(sliderClass).slider( "value" ) + unitOfLength + '</div>');
}


function colorPickerDeclare(colorClass, inputNameClass){
  $(colorClass).ColorPicker({

      color: $('input[name='+inputNameClass+']').val(),

      onShow: function (colpkr) {
        $(colpkr).fadeIn(500);
        return false;
      },

      onHide: function (colpkr) {
        $(colpkr).fadeOut(500);
        return false;
      },

      onChange: function (hsb, hex, rgb){
        $(colorClass + ' div').css('backgroundColor', '#' + hex);
        $('input[name='+inputNameClass+']').val('#' + hex);
      }

    });

    $('div', $(colorClass)).css('background-color', $('input[name='+inputNameClass+']').val());
}