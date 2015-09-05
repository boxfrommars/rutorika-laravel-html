<?php

namespace Rutorika\Html\Theme;

use Illuminate\Support\Collection;

interface Themable {
    /**
     * @param            $title
     * @param            $name
     * @param string     $control
     * @param Collection $errors
     * @param string     $help
     *
     * @return string
     */
    public function field($title, $name, $control = '', $errors = null, $help = '');
    public function updateOptions($options);
}