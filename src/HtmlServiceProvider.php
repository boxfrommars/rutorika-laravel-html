<?php

namespace Rutorika\Html;

class HtmlServiceProvider extends \Collective\Html\HtmlServiceProvider
{
    /**
     * Register the form builder instance.
     */
    protected function registerFormBuilder()
    {
        $this->app->bindShared('form', function ($app) {
            $form = new FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/rutorika-form.php' => config_path('rutorika-form.php'),
        ]);

        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/rutorika/form'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/rutorika-form.php', 'rutorika-form'
        );

        parent::register();
    }
}
