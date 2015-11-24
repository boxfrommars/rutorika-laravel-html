<?php

function delete_form($url, $label = '<i class="fa fa-close"></i>')
{
    $form = Form::open(['method' => 'DELETE', 'url' => $url, 'class' => 'destroy-form']);
    $form .= '<button type="submit" class="btn btn-link">' . $label . '</button>';
    $form .= Form::close();

    return $form;
}

function stored_file_src($filename)
{
    if (empty($filename)) {
        return '';
    } elseif (preg_match('/^https?:\/\//', $filename)) {
        return $filename;
    } else {
        $pathToStorage = config('rutorika-form.public_storage_path');
        return "/{$pathToStorage}/{$filename}";
    }
}