<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

//this line is added
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //this was empty
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $notificationCount = Note::where([
                    ['status', 'pending'],
                    ['user', Auth::id()]
                ])->count();
                $view->with('notificationCount', $notificationCount);
            }
        });
    }
}
