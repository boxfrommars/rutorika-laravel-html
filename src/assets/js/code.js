$(document).ready(function () {
  ace.config.set("basePath", "/vendor/rutorika/form/vendor/ace/src-noconflict/");

  $('.rk-code-field').each(function () {
    var $field = $(this);
    var editor = ace.edit($field.siblings('.rk-code').get(0));

    editor.$blockScrolling = Infinity; // @see https://github.com/angular-ui/ui-ace/issues/104

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