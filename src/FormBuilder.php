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

    public function colorField($title, $name, $value = null, $options = array(), $help = '')
    {
        $control = $this->color($name, $value, $this->setDefaultOptions($options));

        return $this->field($title, $name, $control, $help);
    }

    /**
     * Code textarea field (Ace redactor will be applied to this field)
     *
     * available options:
     * mode : 'language' @see
     * theme: 'monokai'
     *
     * @param $title
     * @param $name
     * @param null $value
     * @param array $options
     * @param string $help
     * @return string
     */
    public function codeField($title, $name, $value = null, $options = array(), $help = '')
    {
        $options = $this->appendClassToOptions('hidden', $this->setDefaultOptions($options));
        $control = $this->textarea($name, $value, $this->setDefaultOptions($options));

        $attributes = '';

        $mode = !empty($options['mode']) ? $options['mode'] : 'html';
        $theme = !empty($options['theme']) ? $options['theme'] : 'textmate';

        $attributes .= sprintf('data-mode="%s" data-theme="%s"', $mode, $theme);
        $control .= sprintf('<div class="ace-editor" %s></div>', $attributes);

        return $this->field($title, $name, $control, $help);
    }

    public function staticField($title, $value, $help = '')
    {
        $name = 'static-' . uniqid();
        $control = '<p class="form-control-static">' . $value . '</p>';

        return $this->field($title, $name, $control, $help);
    }


    /* INPUTS */

    public function color($name, $value = null, $options = [])
    {
        $options = $this->appendClassToOptions('js-color-field', $options);
        $minicolorsOptions = $options['minicolor'];
        $options['data-minicolor'] = json_encode($minicolorsOptions);

        return $this->text($name, $value, $options);
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
}
