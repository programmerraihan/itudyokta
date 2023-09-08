<?php

namespace App\Providers;

use App\Models\HomeSlide;
use App\Models\Notice;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Branch;

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
         view()->composer(['website.layouts.sidebar'], function ($view) {
            $branch = request()->branch ?? null;
            if($branch != 'main') {
                $branch = Branch::where('slug', $branch)->first();
            }
            $view->with('notices', Notice::where('status', 1)->where("branch_id", $branch->id ?? null)->limit(5)->get());
        });
        view()->composer(['website.layouts.slider'], function ($view) {
            $branch = request()->branch ?? null;
            if($branch != 'main') {
                $branch = Branch::where('slug', $branch)->first();
            }
            $view->with('sliders', HomeSlide::where('status', 1)->where("branch_id", $branch->id ?? null)->limit(3)->get());
        });
        Paginator::useBootstrapFour();
    }
}
