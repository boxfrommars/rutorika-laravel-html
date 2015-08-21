<?php

namespace Rutorika\Html;

/**
 * Form builder, provides *Field methods for twitter bootstrap forms.
 *
 * @TODO [column|label|buttonOffset]Width options
 *
 * Class FormBuilder
 */
class FormBuilder extends \Collective\Html\FormBuilder
{
    public function textField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->text($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function passwordField($title, $name, $options = array(), $help = '')
    {
        $control = $this->password($name, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function checkboxField($title, $name, $value = 1, $checked = null, $options = [])
    {
        $control = '<div class="checkbox"><label>' . $this->checkbox($name, $value, $checked, $options) . '</label></div>';

        return $this->field($title, $name, $control, $options);
    }

    public function textareaField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->textarea($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function hiddenField($title, $name, $value = null, $options = [], $help = '')
    {
        $control = $this->hidden($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function numberField($title, $name, $value = null, $options = [], $help = '')
    {
        $control = $this->number($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function selectField($title, $name, $list = [], $selected = null, $options = [], $help = '')
    {
        $control = $this->select($name, $list, $selected, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    /**
     * Code textarea field (Ace redactor will be applied to this field).
     *
     * available options:
     * mode : 'php'
     * theme: 'monokai'
     *
     * @param $title
     * @param $name
     * @param null   $value
     * @param array  $options
     * @param string $help
     *
     * @return string
     */
    public function codeField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->code($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function colorField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->color($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function geopointField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->geopoint($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    public function staticField($title, $value, $help = '')
    {
        $name = 'static-' . uniqid();
        $control = '<p class="form-control-static">' . $value . '</p>';

        return $this->field($title, $name, $control, $help);
    }

    /* INPUTS */

    public function code($name, $value = null, $options = [])
    {
        $options = $this->appendClassToOptions('hidden', $options);
        $options = $this->appendClassToOptions('js-code-field', $options);
        $options = $this->provideOptionToHtml('mode', $options);
        $options = $this->provideOptionToHtml('theme', $options);

        return $this->textarea($name, $value, $options) . '<div class="js-code"></div>';
    }

    public function color($name, $value = null, $options = [])
    {
        $options = $this->appendClassToOptions('js-color-field', $options);
        $options = $this->provideOptionToHtml('minicolors', $options);

        return $this->text($name, $value, $options);
    }

    public function geopoint($name, $value = null, $options = [])
    {
        $options = $this->appendClassToOptions('js-geopoint-field', $options);
        $options = $this->provideOptionToHtml('map', $options);
        $options = $this->provideOptionToHtml('layer', $options);
        $options = $this->provideOptionToHtml('type', $options);

        return '<div class="js-map"></div>' . $this->text($name, $value, $options);
    }

    public function field($title, $name, $control = '', $help = '')
    {
        $errors = $this->session ? $this->session->get('errors') : null;

        $labelWidth = 3;
        $controlWidth = 9;

        $template = '
            <div class="form-group %s">
              %s
              <div class="%s">
                %s
                %s
                %s
              </div>
            </div>
        ';

        $formClass = !empty($errors) && $errors->has($name) ? 'has-error' : '';
        $label = $this->label($name, $title, ['class' => "col-md-{$labelWidth} control-label"]);
        $controlClass = 'col-md-' . $controlWidth;
        $error = empty($errors) ? '' : $errors->first($name, '<p class="help-block">:message</p>');
        $help = empty($help) ? '' : '<p class="help-block">' . $help . '</p>';

        return sprintf($template, $formClass, $label, $controlClass, $control, $error, $help);
    }

    public function submitField($title = 'Submit')
    {
        $offsetWidth = 3;
        $controlWidth = 9;

        $template = '
            <div class="form-group">
              <div class="%s %s">
                <button type="submit" class="btn btn-primary">%s</button>
              </div>
            </div>
        ';

        return sprintf($template, 'col-sm-offset-' . $offsetWidth, 'col-md-' . $controlWidth, $title);
    }

    protected function setDefaultOptions($options)
    {
        return $this->appendClassToOptions('form-control', $options);
    }

    protected function appendClassToOptions($class, array $options = [])
    {
        $options['class'] = isset($options['class']) ? $options['class'] . ' ' : '';
        $options['class'] .= $class;

        return $options;
    }

    /**
     * @param string $optionName
     * @param array  $options
     *
     * @return mixed
     */
    protected function provideOptionToHtml($optionName, $options)
    {
        if (isset($options[$optionName])) {
            $options['data-' . $optionName] = is_scalar($options[$optionName]) ? $options[$optionName] : json_encode($options[$optionName]);
            unset($options[$optionName]);
        }

        return $options;
    }
}
