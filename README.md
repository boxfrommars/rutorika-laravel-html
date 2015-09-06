# Twitter Bootstrap Forms for Laravel 5

Simple way to create forms

Custom form controls and shorthand methods for form rows (both vertical and horizontal forms supported):

Form fields: [View demo]()

```php
{!! Form::open() !!}

{!! Form::textField('Form::textField', 'textField', null, [], 'Should contains letters and numbers') !!}
{!! Form::checkboxField('Form::checkboxField', 'checkboxField') !!}
{!! Form::numberField('Form::numberField', 'numberField') !!}
{!! Form::textField('Something', 'something') !!}
{!! Form::selectField('selectField', 'selectField', [4 => 'Something', 8 => 'Wicked', 15 => 'This', 16 => 'Way', 23 => 'Comes', 42 => '.']) !!}

{!! Form::geopointField('Place on map', 'geopoint', null, ['map' => ['center' => [45.04, 39], 'zoom' => 12]]) !!}

{!! Form::codeField('HTML, monokai theme', 'codeField', null, ['mode' => 'html', 'theme' => 'monokai']) !!}

{!! Form::imageField('Image', 'image', null, [], 'JPG or PNG') !!}
{!! Form::fileField('File', 'file', null, [], 'PDF, DOC, DOCX <= 3Mb') !!}

{!! Form::datetimeField('Date and Time', 'datetime') !!}
{!! Form::dateField('Date', 'date') !!}
{!! Form::timeField('Time', 'time') !!}

{!! Form::select2Field('Select2', 'select2', [4 => 'Something', 8 => 'Wicked', 15 => 'This', 16 => 'Way', 23 => 'Comes', 42 => '.']) !!}
{!! Form::select2Field('Select2 Multiple', 'select2-multiple', [4 => 'Something', 8 => 'Wicked', 15 => 'This', 16 => 'Way', 23 => 'Comes', 42 => '.'], [16, 23], ['multiple' => true]) !!}

{!! Form::select2Field('Select2 Async', 'select2-async', [], 2, ['select2' => ['ajax--url' => '/select2/data']]) !!}
{!! Form::select2Field('Select2 Async Multiple', 'select2-async-multiple', [], [2, 3], ['select2' => ['ajax--url' => '/select2/data'], 'multiple' => true]) !!}

{!! Form::submitField() !!}
{!! Form::close() !!}
```

Custom controls:

```php
{!! Form::open(['theme' => 'bootstrap-vertical']) !!}

{!! Form::geopoint('geopoint', null, ['map' => ['center' => [45.04, 39], 'zoom' => 12]]) !!}

{!! Form::code('codeField', null, ['mode' => 'html', 'theme' => 'monokai']) !!}

{!! Form::imageUpload('image') !!}
{!! Form::fileUpload('file') !!}

{!! Form::datetimePicker('datetime') !!}
{!! Form::datePicker('date') !!}
{!! Form::timePicker('time') !!}

{!! Form::select2('select2', [4 => 'Something', 8 => 'Wicked', 15 => 'This', 16 => 'Way', 23 => 'Comes', 42 => '.']) !!}
{!! Form::select2('select2-multiple', [4 => 'Something', 8 => 'Wicked', 15 => 'This', 16 => 'Way', 23 => 'Comes', 42 => '.'], [16, 23], ['multiple' => true]) !!}
{!! Form::select2('select2-async', [], 2, ['select2' => ['ajax--url' => '/select2/data']]) !!}
{!! Form::select2('select2-async-multiple', [], [2, 3], ['select2' => ['ajax--url' => '/select2/data'], 'multiple' => true]) !!}

{!! Form::submitField() !!}
{!! Form::close() !!}
```

Based on [LaravelCollective/html](https://github.com/LaravelCollective/html)

Tested with Twitter Bootstrap >= 3.3.0

## Install

Install package through composer

```bash
$ composer require rutorika/laravel-html
```

Add service provider and facades to your `config/app.php`

```php
'providers' => [
    // ... other providers

    Rutorika\Html\HtmlServiceProvider::class,
];

'aliases' => [
    // ... other facades

    'Form' => Rutorika\Html\FormFacade::class,
    'Html' => Rutorika\Html\HtmlFacade::class,
]
```

Publish packeage configuration and assets. This will add `/config/rutorika-form.php` configuration file and `public/vendor/rutorika-form/*` assets (js, css and few images)

```bash
$ php artisan vendor:publish --provider="Rutorika\Html\HtmlServiceProvider"
```

Add js and css:

```html
<!-- css part -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="/vendor/rutorika/form/build/css/vendor.min.css">
<link rel="stylesheet" href="/vendor/rutorika/form/build/css/style.min.css">

<!-- script part -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/vendor/rutorika/form/build/js/vendor.js"></script>
<script src="/vendor/rutorika/form/build/js/scripts.js"></script>
```
> Note: This scripts doesn't contain Jquery script or Bootstrap style, you should add them by yourself. (Note that Bootstrap js script doesn't required)

If you use map fields differ then osm or bing (google or yandex), you should add scripts for that map apis

```html
<script src="//maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
<!-- or -->
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
```

If you don't want to add all vendor styles and scripts you can add the needed ones manually. Choose from

```html
<!-- css part -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<link rel="stylesheet" href="/venfor/rutorika/form/vendor/jquery-minicolors-2.1.12/jquery.minicolors.css" />
<link rel="stylesheet" href="/venfor/rutorika/form/vendor/leaflet-0.7.5/leaflet.css" />
<link rel="stylesheet" href="/venfor/rutorika/form/vendor/jQuery-File-Upload-9.11.0/css/jquery.fileupload.css" />
<link rel="stylesheet" href="/venfor/rutorika/form/vendor/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="/venfor/rutorika/form/vendor/select2/css/select2.min.css" />
<link rel="stylesheet" href="/venfor/rutorika/form/vendor/select2/css/select2-bootstrap.min.css" />
<link rel="stylesheet" href="/venfor/rutorika/form/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />

<link rel="stylesheet" href="/venfor/rutorika/form/css/style.css" />

<!-- script part -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script src="/venfor/rutorika/form/vendor/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script> {{-- only core and sortable --}}
<script src="/venfor/rutorika/form/vendor/momentjs/moment-with-locales.min.js"></script>
<script src="/venfor/rutorika/form/vendor/ace/src-noconflict/ace.js"></script>
<script src="/venfor/rutorika/form/vendor/jquery-minicolors-2.1.12/jquery.minicolors.min.js"></script>
<script src="/venfor/rutorika/form/vendor/leaflet-0.7.5/leaflet.js"></script>
<script src="/venfor/rutorika/form/vendor/leaflet-plugins/layer/tile/Yandex.js"></script>
<script src="/venfor/rutorika/form/vendor/leaflet-plugins/layer/tile/Google.js"></script>
<script src="/venfor/rutorika/form/vendor/leaflet-plugins/layer/tile/Bing.js"></script>
<script src="/venfor/rutorika/form/vendor/jQuery-File-Upload-9.11.0/js/jquery.iframe-transport.js"></script>
<script src="/venfor/rutorika/form/vendor/jQuery-File-Upload-9.11.0/js/jquery.fileupload.js"></script>
<script src="/venfor/rutorika/form/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="/venfor/rutorika/form/vendor/select2/js/select2.full.js"></script>
<script src="/venfor/rutorika/form/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script src="/venfor/rutorika/form/js/code.js"></script>
<script src="/venfor/rutorika/form/js/color.js"></script>
<script src="/venfor/rutorika/form/js/date.js"></script>
<script src="/venfor/rutorika/form/js/image.js"></script>
<script src="/venfor/rutorika/form/js/map.js"></script>
<script src="/venfor/rutorika/form/js/select2.js"></script>
```


## Usage

### Form

```php
Form::open(['theme' => 'bootstrap-horizontal', 'label-width' => 4]);
// fields
Form::close();
```

#### Options

 - `theme`: *string*, `bootstrap-horizontal` or `bootstrap-vertical`. Default `bootstrap-horizontal`. Form theme
 - `label-width`: *integer* [1..11] only for `bootstrap-horizontal`. Default `3`. Label width (will be used in label class: `col-md-{$labelWith}`)
 - `control-width`: *integer* [1..11] only for `bootstrap-horizontal`. Default `12` - `label-width`. Control width (will be used in control class: `col-md-{$labelWith}`)

### Custom controls

 - [code](#code-field)
 - [color](#color-field)
 - [geopoint](#geopoint-field)
 - [imageUpload](#image--file-field)
 - [fileUpload](#image--file-field)
 - [select2](#select2-field)
 - [date](#date-datetime-and-time-fields)
 - [datetime](#date-datetime-and-time-fields)
 - [time](#date-datetime-and-time-fields)

Documentation for each of this controls see in Custom Form fields section

### Fields

Fields are wrappers to controls that provide shorthand methods to create form rows.
Field method looks like Form::{ControlName}Fields($title, [/* original control options */], $help = '').
First argument for this methods is `$title` which will be set as label of the field.
Next arguments are the same as arguments in original control method.
The last argument is `$help` which will be set as help text under the input.

For example:

```php
Form::textField($title,  $name, $value = null, $options = [], $help = '') // because Form::text($name, $value = null, $options = [])
```

so

```php
Form::textField('Field Title',  'title', 'Field Value')
```

will generate html:

```html
<div class="form-group">
    <label for="title" class="col-md-3 control-label">Filed Title</label>
    <div class="col-md-9">
        <input class="form-control" name="title" type="text" value="Field Value">
    </div>
</div>
```

Also all error messages and corresponding css-classes if errors exists will be appended to the field.

## Available Form Methods

### Wrappers for laravelcollective form inputs

 * `Form::textField($title, $name, $value = null, $options = [], $help = '')` text field
 * `Form::textareaField($title, $name, $value = null, $options = array(), $help = '')` textarea field
 * `Form::passwordField($title, $name, $options = array(), $help = '')`
 * `Form::checkboxField($title, $name, $value = 1, $checked = null, $options = [])`
 * `Form::hiddenField($title, $name, $value = null, $options = [], $help = '')` useless :)
 * `Form::numberField($title, $name, $value = null, $options = [], $help = '')`
 * `Form::selectField($title, $name, $list = [], $selected = null, $options = [], $help = '')`
 * `Form::staticField($title, $value, $help = '')` static text

### Custom Form fields

#### Code Field

[Ace](http://ace.c9.io/) code editor field

```php
// as control
Form::code($name, $value = null, $options = array('mode' => 'html', 'theme' => 'monokai'))
// as field
Form::codeField($title, $name, $value = null, $options = array('mode' => 'html', 'theme' => 'monokai'), $help = '')
```

##### Options
* `theme` -- code editor theme, default -- `textmate`. [See all themes](https://github.com/ajaxorg/ace/tree/master/lib/ace/theme)
* `mode` -- code language, default -- `html`. [See all modes](https://github.com/ajaxorg/ace/tree/master/lib/ace/mode)


#### Color Field

[Jquery Minicolors](http://labs.abeautifulsite.net/jquery-minicolors/) colorpicker field

```php
// as input
Form::color($name, $value = null, $options = ['minicolors' => ['control' => 'hue']])
// as field
Form::colorField($title, $name, $value = null, $options = ['minicolors' => ['control' => 'hue']], $help = '')
```

##### Options

* `'minicolors' => ['control' => 'hue', 'defaultValue' => '', /* ... */]`. All this settings will be passed to minicolors settings. [See all available settings](http://labs.abeautifulsite.net/jquery-minicolors/#settings).


#### Geopoint Field

Allows you to select a point on the map. OSM, Google, Bing and Yandex maps (and all their types) are supported (via [Leaflet](http://leafletjs.com/) and [leaflet-plugins](https://github.com/shramov/leaflet-plugins)).

```php
// as input
Form::geopoint($name, $value = null, $options = ['map' => ['center' => [10, 10], 'zoom' => 11], 'layer' => 'yandex', 'type' => 'publicMapHybrid'])
// as field
Form::geopointField($title, $name, $value = null, $options = ['map' => ['center' => [10, 10], 'zoom' => 11], 'layer' => 'yandex', 'type' => 'publicMapHybrid'], $help = '')
```

Field generates string value `latitude:longitude`, e.g. `45.060184073445356:38.96455764770508`

##### Options

- `map` *array* map options passed to Leaflet map constructor. In general you need set center (will be default center of map if no value) and zoom only. [See all available options](http://leafletjs.com/reference.html#map-options)
- `layer` *string* one of `yandex`, `osm`, `bing`, `google`. default `osm`. Which map provider will be used.
- `type` *string* type of map. Each provider has his own available map types
  - `osm`: default `http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png`. [Find more](http://leaflet-extras.github.io/leaflet-providers/preview/)
  - `google`: default `ROADMAP`, available: `ROADMAP`, `SATELLITE`, `HYBRID`, `TERRAIN`. [More info](https://developers.google.com/maps/documentation/javascript/maptypes)
  - `bing`: default `Road`, available: `Road`, `Aerial`, `AerialWithLabels`, `Birdseye`, `BirdseyeWithLabels`. [More info](https://msdn.microsoft.com/en-us/library/ff701716.aspx)
  - `yandex`: default `map`, available: `map`, `satellite`, `hybrid`, `publicMap`, `publicMapHybrid`. [More info](https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/map-docpage/#parameters)

##### Installation

If you use map fields differ then osm or bing (google or yandex), you should add scripts for that map apis

```html
<script src="//maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
<!-- or -->
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
```

#### Image && File Field

Allows you to upload files (with [Jquery File Upload](https://github.com/blueimp/jQuery-File-Upload))

```php
// Image upload
// as input (note, that this is not ->image() method, which already used as laravelcollective/html method to create img element)
Form::imageUpload($name, $value = null, $options = [])
// as field
Form::imageField($title, $name, $value = null, $options = [], $help = '')

// File upload
// as input (note, that this is not ->file() method, which already used as laravelcollective/html method to create file input element)
Form::fileUpload($name, $value = null, $options = [])
// as field
Form::fileField($title, $name, $value = null, $options = [], $help = '')

```

##### Options

- `url` url to upload file. Default: `/upload` (You can change default url in rutorika-form config). Should return `['path' => '/public/path/to/file.jpg', 'filename' => 'to/file.jpg']`
  Where `path` -- path from the public folder (will be setted as src of image) and `filename` -- path to the file from storage path (will be setted as a value of the field)
- `type` @TODO not used yet

##### Installation

You should implement saving of file on the server side or use `\Rutorika\Html\Http\UploadController`, which has simple implementaion of saving files:

```php
Route::group(['middleware' => 'auth'], function () {

    // ... other admin routes

    route('/upload', '\Rutorika\Html\Http\UploadController@upload')
});
```

Set path to the storage folder at `public_storage_path` in the rutorika-form config (the folder in which files are saved, default `storage`)

> @TODO: Note that `\Rutorika\Html\Http\UploadController` doesn't have any validation, you should implement it by yourself if you need.

#### Select2 Field

[Select2](https://select2.github.io/) field

```php
// as input
{!! Form::select2($name, $list = [], $selected = null, $options = []) !!}

// as field
{!! Form::select2Field($title, $name, $list = [], $selected = null, $options, $help) !!}
```

##### Options

- `select2`. default `[]` all items of this array will be prepended by data and will be passed to select element. All select params can be configured with `data-`
  attributes ([all available options](https://select2.github.io/options.html)). Some wide used `select2` options:
  - `ajax--url` switch select to ajax. data will be requested from this `url` with parameter `q` (query for search). Server should return array `{results: [{id: 1, text: 'Title'}, /* ... */]}`.
    You can use Trait provided with this package for this purpose.
- `multiple` attribute works as usual -- switch on multiselect mode

##### Examples
```php
// base
{!! Form::select2Field('Select2', 'select2', [4 => 'Something', 8 => 'Wicked', 15 => 'This', 16 => 'Way', 23 => 'Comes', 42 => '.']) !!}
// multiple
{!! Form::select2Field('Select2 Multiple', 'select2-multiple', [4 => 'Something', 8 => 'Wicked', 15 => 'This', 16 => 'Way', 23 => 'Comes', 42 => '.'], [16, 23], ['multiple' => true]) !!}

// async
{!! Form::select2Field('Select2 Async', 'select2-async', [], 2, ['select2' => ['ajax--url' => '/select2/data']]) !!}
// async multiple
{!! Form::select2Field('Select2 Async Multiple', 'select2-async-multiple', [], [2, 3], ['select2' => ['ajax--url' => '/select2/data'], 'multiple' => true]) !!}

// async without fetching selected value from server (already in $list)
{!! Form::select2Field('Select2 Async Without Init Call', 'select2-async-without-init-call', [5 => 'Speaking from Among the Bones'], 5, ['select2' => ['ajax--url' => '/select2/data']]) !!}
// async multiple without fetching selected value from server (already in $list)
{!! Form::select2Field('Select2 Async Multiple Without Init Call', 'select2-async-multiple-without-init-call', [5 => 'Speaking from Among the Bones', 8 => 'Wicked'], [5, 8], ['select2' => ['ajax--url' => '/select2/data'], 'multiple' => true]) !!}
```

##### Installation


If you use async select2, the backend should response on `/your-data-ajax--url?q=searchstring` request with the format:

```js
{"results":[
    {"id":"2","text":"Gayle Gislason"},
    {"id":"78","text":"Keegan Schinner"},
    {"id":"96","text":"Edgardo Walsh"}
]}
```

if you doesn't use asyck without prefetch, your backend should response on  `/your-data-ajax--url/init?ids[]=id1&ids[]=id2` and `/your-data-ajax--url/init?ids=id` requests with the format:

```js
{"results":[
    {"id":"id1","text":"Gayle Gislason"},
    {"id":"id2","text":"Keegan Schinner"},
]}
```

> Note! both `?ids[]=id1&ids[]=id2` and `?ids=id` requests should return array of entities!

For this purposes you can use `Select2ableTrait`

##### Select2ableTrait

This trait provide methods for search and prefetch select2 entities.

Add the trait to your controller. Add to your controller `getQuery()` method (see `Select2able` interface for signature).
This method will be used to get base query. For example if you have published scope, you should add it here.for example:

```php
/**
 * @return \Illuminate\Database\Eloquent\Builder
 */
protected function getQuery()
{
   return YourModel::query()->published();
}
```

> If you use rutorika/dashboard, all controllers already has `getQuery()` method

Set the title field of your entity (`title` by default)

```php
    protected $select2titleKey = 'titlefield';
```

And add routes to the `select2search` and `select2searchInit` methods

```php
Route::get('/your-ajax--url', 'Select2Controller@select2search');
Route::get('/your-ajax--url/init', 'Select2Controller@select2searchInit');
```

For more settings and overrides see [trait code](/src/Http/Select2ableTrait.php)


#### Date, Datetime and Time Fields

Datetime field. [Eonasdan Bootstrap 3 Datepicker](https://eonasdan.github.io/bootstrap-datetimepicker/) used.

```php
// as field
Form::datetimeField($title, $name, $value = null, $options = ['datetime' => []], $help = '')
Form::dateField($title, $name, $value = null, $options = ['datetime' => []], $help = '')
Form::timeField($title, $name, $value = null, $options = ['datetime' => []], $help = '')

// as input
Form::datePicker($title, $name, $value = null, $options = ['datetime' => []], $help = '')
```

##### Options

* `datetime`, []. All this settings will be passed to datetimepicker options. E.g.: `['datetime' => ['locale' => 'ru', 'sideBySide' => true]]`. [See all available options](https://eonasdan.github.io/bootstrap-datetimepicker/Options/).

> Note. You can set default datetimepicker options at `rutorika-form.php` config.


> Note. By default datetimepicker use locale from your app locale (see `config/app.php`).


### Helper methods

#### Submit button

```php
Form::submitField($title = 'Submit')
```

Generates submit button with proper offset:

```html
<div class="form-group">
    <div class="col-sm-offset-3 col-md-9">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
```

#### Field wrapper

```php
Form::field($title, $name, $control = '', $help = '')
```

Wraps `$control` html string with form group. It's helpful when you write your own field input and need to proper wrap it with form group (errors will be automatically appends to the field).

```html
<div class="form-group ">
    <label for="title" class="col-md-3 control-label">Filed Title</label>
    <div class="col-md-9">
        Control HTML
    </div>
</div>
```

## Helpers

#### delete_form

Returns form which will send pseudo DELETE request to `$url` url after submit (icon clicked). Styled as icon link. Useful in grids

```php
delete_form($url, $label = '<i class="glyphicon glyphicon-remove"></i>')
```

Generates:

```html
<form method="POST" action="/some/url" accept-charset="UTF-8">
    <input name="_method" type="hidden" value="DELETE">
    <input name="_token" type="hidden" value="SomeCSRFToken">
    <button type="submit" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></button>
</form>
```

Example:

![Grid with delete forms example](https://habrastorage.org/files/b2a/380/96b/b2a38096b6e648978a464430e1537673.png)

## Contributing

```bash
xu@calipso$ php-cs-fixer fix ./src/ --dry-run --diff --config-file=".php_cs" # show code style fixes fixes
xu@calipso$ php-cs-fixer fix ./src/ --config-file=".php_cs" # fix code style
xu@calipso$ ./vendor/phpunit/phpunit/phpunit tests/ # run tests
```
