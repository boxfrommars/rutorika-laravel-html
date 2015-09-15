$(document).ready(function(){
  $('.rk-upload-container .rk-upload-preview').magnificPopup({delegate: 'a', type: 'image'});

  $('.rk-uploader-field').each(function () {
    var $field = $(this);
    var isMultiple = $field.hasClass('rk-uploader-multiple-field');
    var $container = $field.siblings('.rk-upload-container');
    var $preview = $container.find('.rk-upload-preview');

    var setValue = function (filename, filepath) {
      if (!isMultiple) {
        $field.val(filename);
        $container.find('.rk-upload-link').text(filename).attr('href', filepath);

        $preview.find('a').attr('href', filepath);
        $preview.find('img,audio').attr('src', filepath);
      } else {

        var template = $('#rk-item-template').html();
        var currentValue = $field.val();

        currentValue += (currentValue ? ':' : '') + filename;
        $field.val(currentValue);

        var itemHtml = template.replace(/\{fileSrc}/g, filepath).replace(/\{filename}/g, filename);
        $preview.append(itemHtml);
      }
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

    $preview.on('click', '.rk-upload-remove', function (e) {
      e.preventDefault();
      if (!isMultiple) {
        setValue('', '');
      } else {
        $(this).parents('.rk-upload-item').remove();
        updateImages();
      }

    });

    function updateImages () {
      var files = [];

      $preview.find('.rk-upload-item').each(function(){
        files.push($(this).data('filename'));
      });

      $field.val(files.join(':'));
    }

    if (isMultiple) {
      $preview.sortable({
        handle: '.sortable-handle',
        update: function(a, b){
          updateImages();
        },
        cursor: "move"
      });
    }
  });

});