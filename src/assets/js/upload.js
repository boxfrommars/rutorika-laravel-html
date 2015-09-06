$(document).ready(function(){
  $('.rk-upload-image-container .rk-upload-result').magnificPopup({type: 'image'});

  $('.rk-uploader-field').each(function () {
    var $field = $(this);
    var $container = $field.siblings('.rk-upload-container');

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
        $container.find('.rk-upload-result').attr('href', result.path);
        $container.trigger('uploaded', [result]);
      },

      fail: function (e, data) {
        console.error('Whooooops', e, data);
      }
    })
  });

  $('.rk-upload-remove').on('click', function (e) {
    e.preventDefault();
    var $container = $(this).parents('.rk-upload-container');

    $container.siblings('.rk-uploader-field').val('');
    $container.find('.rk-upload-result').attr('href', '');
    $container.trigger('removed', [$container]);
  });

  $('.rk-upload-image-container')
    .on('uploaded', function (e, result) {
      $(this).find('.rk-upload-result img').attr('src', result.path);
    })
    .on('removed', function () {
      $(this).find('.rk-upload-result img').attr('src', '');
    });

  $('.rk-upload-audio-container')
    .on('uploaded', function (e, result) {
      $(this).find('.rk-upload-result audio').attr('src', result.path);
    })
    .on('removed', function () {
      $(this).find('.rk-upload-result audio').attr('src', '');
    });

  $('.rk-upload-file-container')
    .on('uploaded', function (e, result) {
      $(this).find('.rk-upload-result').text(result.filename);
    })
    .on('removed', function () {
      $(this).find('.rk-upload-result').text('');
    });
});