$('.select2').each(function () {
  var $select = $(this);

  var currentValue = $select.val();
  var value = $select.data('value');
  var url = $select.data('ajax--url');

  // if async, selected, and no option with selected value exists -- then prefetching selected item from server
  // and add fetched option to select.
  if (url && value && !currentValue) {
    var request = $.ajax({
      url: url + '/init',
      data: {
        ids: value
      }
    });

    request.then(function (response) {
      response.results.forEach(function (result) {
        var $option = $('<option>')
          .text(result.text)
          .attr('value', result.id)
          .prop('selected', true);

        $select.prepend($option);
      });

      initSelect2($select);
    });

  } else {
    initSelect2($select);
  }

  function initSelect2($select) {
    $select.select2({
      theme: 'bootstrap'
    });
  }
});
