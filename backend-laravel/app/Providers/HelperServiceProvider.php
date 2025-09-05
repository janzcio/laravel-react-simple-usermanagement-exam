<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class HelperServiceProvider.
 */
class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Register bindings in the container.
     */
    public function boot(): void
    {
        $rdi = new RecursiveDirectoryIterator(app_path('Helpers'));
        $it = new RecursiveIteratorIterator($rdi);

        while ($it->valid()) {
            if (
                ! $it->isDot() &&
                $it->isFile() &&
                $it->isReadable() &&
                $it->current()->getExtension() === 'php' &&
                strpos($it->current()->getFilename(), 'Helper')
            ) {
                require $it->key();
            }
            $it->next();
        }
    }
}
