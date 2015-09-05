<?php

namespace Rutorika\Html\Theme;

interface Themable {
    public function field($title, $name, $control = '', $errors = null, $help = '');
    public function updateOptions($options);
}