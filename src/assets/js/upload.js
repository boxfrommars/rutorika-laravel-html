$(document).ready(function(){
  $('.rk-upload-container .rk-upload-preview a').magnificPopup({type: 'image'});

  $('.rk-uploader-field').each(function () {
    var $field = $(this);
    var $container = $field.siblings('.rk-upload-container');
    var $preview = $container.find('.rk-upload-preview');

    var setValue = function (filename, filepath) {
      $field.val(filename);
      $container.find('.rk-upload-link').text(filename).attr('href', filepath);

      $preview.find('a').attr('href', filepath);
      $preview.find('img,audio').attr('src', filepath);
    };

    $container.find('input:file').fileupload({
      dataType: 'json',
      url: $field.data('url') || '/upload',
      paramName: 'file',
      formData: [{
        name: 'type',
        value: $field.data('type') || 'default'
      }],

      done: function (e, data) {
        setValue(data.result.filename, data.result.path);
      },

      fail: function (e, data) {
        console.error('Whooooops', e, data);
      }
    });

    $container.find('.rk-upload-remove').on('click', function (e) {
      e.preventDefault();
      setValue('', '');
    });

  });

  var $sortableTable = $('.rk-upload-preview');
  if ($sortableTable.length > 0) {
    $sortableTable.sortable({
      handle: '.sortable-handle',
      //axis: 'y',
      update: function(a, b){
        console.log('done');
      },
      cursor: "move"
    });
  }
});