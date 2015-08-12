<?php

function delete_form($url, $label = '<i class="glyphicon glyphicon-remove"></i>')
{
    $form = Form::open(['method' => 'DELETE', 'url' => $url]);
    $form .= '<button type="submit" class="btn btn-link">'.$label.'</button>';
    $form .= Form::close();

    return $form;
}
