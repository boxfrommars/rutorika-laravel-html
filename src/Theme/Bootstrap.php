<?php

namespace Rutorika\Html\Theme;

use Illuminate\Support\MessageBag;
use Rutorika\Html\FormBuilder;

class Bootstrap extends BootstrapAbstract implements Themable
{
    /**
     * @var FormBuilder
     */
    protected $builder;

    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function updateOptions($options = [])
    {
        return $options;
    }


    /**
     * @inheritdoc
     */
    public function field($title, $name, $control = '', $errors = null, $help = '')
    {
        $template = '
        <div class="form-group %s">
            %s
            %s
            %s
            %s
          </div>
        ';

        $formClass = !empty($errors) && $errors->has($name) ? 'has-error' : '';
        $label = !is_null($title) ? $this->builder->label($name, $title) : '';
        $error = empty($errors) ? '' : $errors->first($name, '<p class="help-block">:message</p>');
        $help = empty($help) ? '' : '<p class="help-block">' . $help . '</p>';

        return sprintf($template, $formClass, $label, $control, $error, $help);
    }
}