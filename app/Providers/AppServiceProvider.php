<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    
        Blade::directive('image', function ($path) {
            return "<?php echo asset(\"images/$path\"); ?>";
        });
    
        Blade::directive('firstLetters', function ($string) {
            return "<?php echo App\Helpers\StringManipulator::firstLetters($string); ?>";
        });
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
}
