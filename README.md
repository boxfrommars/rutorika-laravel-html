# Twitter Bootstrap Forms for Laravel 5

Based on [LaravelCollective/html](https://github.com/LaravelCollective/html)

Tested with Twitter Bootstrap >= 3.3.0

## Install

Install package through composer

```bash
composer require rutorika/laravel-html
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

## Usage

This package provides Form::*Fields methods.
First argument for this methods is `$title` which wil be set as label of the field.
Next arguments are the same as arguments in original * method.
The last argument is `$help` which will be set as help text under the input.

For example:

```php
Form::textField($title,  $name, $value = null, $options = [], $help = '') // because Form::title($name, $value = null, $options = [])
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
Form::codeField($title, $name, $value = null, $options = array(), $help = '')
```

You should [embed Ace to your site](http://ace.c9.io/#nav=embedding) and apply it to textareas with `ace-editor` css class. For example:

```js
  $('.ace-editor').each(function(){
    var editor = ace.edit(this);
    var $textarea = $(this).siblings('textarea');

    editor.getSession().setValue($textarea.val());

    //editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/html");

    editor.getSession().on('change', function(){
      $textarea.val(editor.getSession().getValue());
    });
  });
```

#### Color Field
*@TODO move from rutorika/dashboard*
#### Geopoint Field
*@TODO move from rutorika/dashboard*
#### Image Field
*@TODO move from rutorika/dashboard*
#### Image Multiple Field
*@TODO move from rutorika/dashboard*
#### File Field
*@TODO move from rutorika/dashboard*
#### File Multiple Field
*@TODO move from rutorika/dashboard*
#### Select2 Field
*@TODO move from rutorika/dashboard*
#### Date Field
*@TODO move from rutorika/dashboard*
#### Datetime Field
*@TODO move from rutorika/dashboard*
#### Time Field
*@TODO move from rutorika/dashboard*

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
