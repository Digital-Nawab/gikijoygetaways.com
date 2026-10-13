<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\MetaPage;

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
        View::composer('frontend.layout.master', function ($view) {
    
            $path = request()->path();          // "about"
            $fullUrl = request()->url();        // "https://gikijoygetaways.com/about"
    
            if ($path === '/') {
                $path = 'home';
            }
    
            $meta = MetaPage::where('page_url', $path)
                ->orWhere('page_url', $fullUrl)
                ->first();
    
            $view->with('meta', $meta);
        });
    }
}
