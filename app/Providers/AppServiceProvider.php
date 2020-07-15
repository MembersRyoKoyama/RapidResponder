<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('pushonce', function ($expression) {
            $var = '$__env->{"__pushonce_" . md5(__FILE__ . ":" . __LINE__)}';

            return "<?php if(!isset({$var})): {$var} = true; \$__env->startPush({$expression}); ?>";
        });

        \Blade::directive('endpushonce', function ($expression) {
            return '<?php $__env->stopPush(); endif; ?>';
        });
    }
}
