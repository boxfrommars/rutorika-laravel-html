<?php

class Base extends Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [Rutorika\Html\HtmlServiceProvider::class];
    }
    protected function getPackageAliases($app)
    {
        return ['Form' => Rutorika\Html\FormFacade::class];
    }
}
