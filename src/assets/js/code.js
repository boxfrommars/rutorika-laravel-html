$(document).ready(function () {
  $('.js-code-field').each(function () {

    var $field = $(this);
    var editor = ace.edit($field.siblings('.js-code').get(0));

    var mode = $field.data('mode') || 'html';
    var theme = $field.data('theme') || 'textmate';

    editor.setTheme('ace/theme/' + theme);
    editor.getSession().setMode('ace/mode/' + mode);

    editor.getSession().setValue($field.val());

    editor.getSession().on('change', function () {
      $field.val(editor.getSession().getValue());
    });
  });
});