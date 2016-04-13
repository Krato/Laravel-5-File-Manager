<?php

namespace Infinety\FileManager;

use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        $this->loadViewsFrom(__DIR__.'/views/', 'filemanager');
        /**
         * Publishes Lang files
         */
        $this->publishes([
            realpath(__DIR__.'/resources/lang') => $this->app->basePath().'/resources/lang'
        ]);

        /**
         * Piblishes Public Assets
         */
        $this->publishes([
            __DIR__.'/public' => public_path('filemanager_assets'),
        ], 'public');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Infinety\FileManager\Controllers\FileManagerController');
//        \Route::group(['prefix' => 'admin/filemanager', 'middleware' => 'auth'], function() {
//            \Route::controller('/', 'Infinety\FileManager\Controllers\FileManagerController');
//        });

    }

}
