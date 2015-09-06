$(document).ready(function(){
  $('.js-upload-image-container .upload-result').magnificPopup({type: 'image'});
});

$('.js-uploader-field').each(function () {
  var $field = $(this);
  var $container = $field.siblings('.js-upload-container');

  $container.find('input:file').fileupload({
    dataType: 'json',
    url: $field.data('url') || '/upload',
    paramName: 'file',
    formData: [{
      name: 'type',
      value: $field.data('type') || 'default'
    }],

    done: function (e, data) {
      var result = data.result;
      $field.val(result.filename);
      $container.find('.upload-result').attr('href', result.path);
      $container.trigger('uploaded', [result]);
    },

    fail: function (e, data) {
      console.error(data);
    }
  })
});

$('.js-upload-remove').on('click', function (e) {
  e.preventDefault();
  var $container = $(this).parents('.js-upload-container');

  $container.siblings('.js-uploader-field').val('');
  $container.find('.upload-result').attr('href', '');
  $container.trigger('removed', [$container]);
});

$('.js-upload-image-container')
  .on('uploaded', function (e, result) {
    $(this).find('.upload-result img').attr('src', result.path);
  })
  .on('removed', function () {
    $(this).find('.upload-result img').attr('src', '');
  });

$('.js-upload-file-container')
  .on('uploaded', function (e, result) {
    $(this).find('.upload-result').text(result.filename);
  })
  .on('removed', function () {
    $(this).find('.upload-result').text('');
  });