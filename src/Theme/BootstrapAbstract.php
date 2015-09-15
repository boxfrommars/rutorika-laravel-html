<?php

namespace Rutorika\Html\Theme;

abstract class BootstrapAbstract
{
    public function getUploadTemplate($previewTemplate)
    {
        return '
        <div class="rk-upload-container">
            <div class="rk-upload-preview">' . $previewTemplate . '</div>
            <p class="form-control-static"><!-- upload controls
                --><span class="btn btn-default btn-sm fileinput-button"><i class="glyphicon glyphicon-picture"></i>{fileField}</span><!--
                --><span class="btn btn-default btn-sm rk-upload-remove"><i class="glyphicon glyphicon-remove"></i></span><!--
                --><a href="{fileSrc}" target="_blank" class="rk-upload-link">{fileSrc}</a>
            </p>
        </div>';
    }
    public function getUploadMultipleTemplate($previewTemplate)
    {
        return '
        <div class="rk-upload-container">
            <div class="rk-upload-preview clearfix">' . $previewTemplate . '</div>
            <p class="form-control-static"><!-- upload controls
                --><span class="btn btn-default btn-sm fileinput-button"><i class="glyphicon glyphicon-plus"></i> Add image {fileField}</span>
            </p>
        </div>';
    }
}