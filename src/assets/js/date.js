$(function () {
  $('.rk-datetimepicker').each(function () {
    var $field = $(this).find('input');
    var dateOptions = $field.data('datetime');

    $(this).datetimepicker(dateOptions);
  });
});