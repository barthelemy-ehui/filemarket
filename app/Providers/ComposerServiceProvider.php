<?php

namespace App\Providers;

use App\Http\ViewComposers\{
    AccountStatsComposer,
    AdminStatsComposer
};
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('account.layouts.partials._stats', AccountStatsComposer::class);
        View::composer('admin.layouts.partials._stats', AdminStatsComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
