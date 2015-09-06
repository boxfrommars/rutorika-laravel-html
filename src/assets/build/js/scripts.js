$(document).ready(function () {
  ace.config.set("basePath", "/vendor/rutorika/form/vendor/ace/src-noconflict/");

  $('.js-code-field').each(function () {
    var $field = $(this);
    var editor = ace.edit($field.siblings('.js-code').get(0));

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
$(document).ready(function(){
  $('.js-color-field').each(function () {
    var $field = $(this);
    var settings = $field.data('minicolors');

    settings = $.extend({theme: 'bootstrap'}, settings);

    $field.minicolors(settings);
  });
});
$(function () {
  $('.js-datetimepicker').each(function () {
    var $field = $(this).find('input');
    var dateOptions = $field.data('datetime');

    $(this).datetimepicker(dateOptions);
  });
});
$(document).ready(function(){
  $('.js-upload-image-container .upload-result').magnificPopup({type: 'image'});

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
});
$(document).ready(function () {
  
  function parsePoint(value) {
    return value ? value.split(':') : null;
  }

  $('.js-geopoint-field').each(function () {

    var $field = $(this);
    var $map = $(this).siblings('.js-map');
    var pointMarker;

    var layerName = $field.data('layer') || 'osm';

    var options = $.extend({
      center: [51.476852, -0.000498],
      zoom: 12
    }, $field.data('map') || {});

    var point = parsePoint($field.val());

    if (point) {
      options.center = point;
    }

    var map = new L.Map($map.get(0), options);

    if (point) {
      setPointMarker(point);
    }

    var layer;
    var type;

    function setPointMarker(point) {
      if (!pointMarker) {
        pointMarker = L.marker(point, {draggable: true}).addTo(map);
        pointMarker.on('dragend', function (e) {
          var latLng = this.getLatLng();
          setPointMarker(latLng);
          $field.val(latLng.lat + ':' + latLng.lng);
        });
      } else {
        pointMarker.setLatLng(point);
      }
      map.panTo(point);
    }

    function removePointMarker() {
      if (pointMarker) {
        map.removeLayer(pointMarker);
        pointMarker = null;
      }
    }

    function getLayerType(layerName, variants, defaultType) {
      var type = $field.data('type') || defaultType;

      if (variants.indexOf(type) < 0) {
        console.warn(layerName + ' doesnt support `' + type + '` type. Only ' + variants.join(' | ') + '. Fallback to ' + defaultType);
        type = defaultType;
      }

      return type;
    }

    switch (layerName) {
      case 'yandex':
        // https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/map-docpage/#parameters
        // map | satellite | hybrid | publicMap | publicMapHybrid
        type = getLayerType('Yandex', ['map', 'satellite', 'hybrid', 'publicMap', 'publicMapHybrid'], 'publicMap');
        layer = new L.Yandex(type);
        break;
      case 'osm':
        // e. g. 'http://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.png'
        // some examples: http://leaflet-extras.github.io/leaflet-providers/preview/
        type = $field.data('type') || 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        if (!(type.indexOf('http') === 0 || type.indexOf('//') === 0)) {
          console.warn('OSM doesnt support `' + type + '` type. Fallback to http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
          type = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        }
        layer = new L.TileLayer(type);
        break;
      case 'google':
        // https://developers.google.com/maps/documentation/javascript/maptypes
        // ROADMAP | SATELLITE | HYBRID | TERRAIN
        type = getLayerType('Google', ['ROADMAP', 'SATELLITE', 'HYBRID', 'TERRAIN'], 'ROADMAP');
        layer = new L.Google('ROADMAP');
        break;
      case 'bing':
        // https://msdn.microsoft.com/en-us/library/ff701716.aspx
        // Road | Aerial | AerialWithLabels | Birdseye | BirdseyeWithLabels
        type = getLayerType('Bing', ['Road', 'Aerial', 'AerialWithLabels', 'Birdseye', 'BirdseyeWithLabels'], 'Road');
        layer = new L.BingLayer('AvoUren6Dm0PAAyhkqPcEQs3PtNsC_VHqb2Pxyac59fd-YME_3FZ_6No4BL5iEAe', {type: type});
        break;
      default:
        console.warn('Layer `' + layerName + '` doesn\'t supported, you should use one of yandex, google, osm or bing. Fallback to OSM layer');
        layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    }

    map.addLayer(layer);

    $field.on('change', function () {
      var val = $field.val();

      if (val) {
        var point = parsePoint(val);
        setPointMarker(point);
      } else {
        removePointMarker();
      }
    });

    map.on('click', function (e) {
      setPointMarker(e.latlng);
      $field.val(e.latlng.lat + ':' + e.latlng.lng);
    });
  });

});
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
