$(document).ready(function(){
  $('.rk-color-field').each(function () {
    var $field = $(this);
    var settings = $field.data('minicolors');

    settings = $.extend({theme: 'bootstrap'}, settings);

    $field.minicolors(settings);
  });
});