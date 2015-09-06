$(document).ready(function () {

  function parsePoint(value) {
    return value ? value.split(':') : null;
  }

  $('.rk-geopoint-field').each(function () {

    var $field = $(this);
    var $map = $(this).siblings('.rk-map');
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