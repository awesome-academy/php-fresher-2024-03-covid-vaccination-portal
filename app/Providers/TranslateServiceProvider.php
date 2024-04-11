<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * The path to the current lang files.
     *
     * @var string
     */
    protected $langPath;

    /**
     * Create a new service provider instance.
     *
     * @return void
     */
    public function __construct()
    {
        $requestUri = request()->getPathInfo();
        if (preg_match('^\/lang\/.*^', $requestUri)) {
            $requestUri = str_replace('/', '\\', $requestUri);
        } else {
            $requestUri = '\lang\en';
        }

        $this->langPath = resource_path(substr($requestUri, 1));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('translation', collect(File::allFiles($this->langPath))->flatMap(function ($file) {
            return [
                ($translation = $file->getBasename('.php')) => trans($translation),
            ];
        })->toJson());
    }
}
