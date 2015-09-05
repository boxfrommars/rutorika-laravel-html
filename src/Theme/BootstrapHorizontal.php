<?php

namespace Rutorika\Html\Theme;

use Illuminate\Support\Collection;
use Rutorika\Html\FormBuilder;

class BootstrapHorizontal implements Themable
{
    /**
     * @var FormBuilder
     */
    protected $builder;

    protected $reserved = ['label-width', 'control-width'];

    protected $labelWidth;
    protected $controlWidth;

    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function updateOptions($options = [])
    {
        $this->labelWidth = array_get($options, 'label-width', 3);
        $this->controlWidth = array_get($options, 'label-width', 12 - $this->labelWidth);

        $currentClass = array_get($options, 'class', '');
        $options['class'] = trim($currentClass . ' form-horizontal');

        return array_except($options, $this->reserved);
    }

    /**
     * @param            $title
     * @param            $name
     * @param string     $control
     * @param Collection $errors
     * @param string     $help
     *
     * @return string
     */
    public function field($title, $name, $control = '', $errors = null, $help = '')
    {
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
        $label = $this->builder->label($name, $title, ['class' => "col-md-{$this->labelWidth} control-label"]);
        $controlClass = "col-md-{$this->controlWidth}";
        $error = empty($errors) ? '' : $errors->first($name, '<p class="help-block">:message</p>');
        $help = empty($help) ? '' : '<p class="help-block">' . $help . '</p>';

        return sprintf($template, $formClass, $label, $controlClass, $control, $error, $help);
    }
}