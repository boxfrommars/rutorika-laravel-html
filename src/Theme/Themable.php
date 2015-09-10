<?php

namespace Rutorika\Html\Theme;

use Illuminate\Contracts\Support\MessageBag;

interface Themable
{

    /**
     * @param            $title
     * @param            $name
     * @param string     $control
     * @param MessageBag $errors
     * @param string     $help
     *
     * @return string
     */
    public function field($title, $name, $control = '', $errors = null, $help = '');

    public function updateOptions($options);

    public function getUploadTemplate($previewTemplate);
    public function getUploadMultipleTemplate($previewTemplate);
}