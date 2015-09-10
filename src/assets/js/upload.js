
$(document).ready(function(){
  $('.rk-upload-container .rk-upload-preview a').magnificPopup({type: 'image'});

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
        var $preview = $container.find('.rk-upload-preview');
        $preview.find('a').attr('href', result.path);
        $preview.find('img,audio').attr('src', result.path);

        $container.find('.rk-upload-link')
          .text(result.filename)
          .attr('href', result.path);
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
    .on('removed', function () {
      $(this).find('.rk-upload-result img').attr('src', '');
    });

  $('.rk-upload-audio-container')
    .on('removed', function () {
      $(this).find('.rk-upload-result audio').attr('src', '');
    });

  $('.rk-upload-file-container')
    .on('removed', function () {
      $(this).find('.rk-upload-result').text('');
    });
});