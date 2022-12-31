<?php

namespace App\Providers;

use App\Models\Translation;
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
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        // $ip = get_client_ip();

        // $translation = Translation::where('ip', $ip)->first();
        // if($translation){
        //     app()->setLocale($translation->locale);
        //     session()->put('locale', $translation->locale);
        // }

        view()->composer('partials.language_switcher', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
