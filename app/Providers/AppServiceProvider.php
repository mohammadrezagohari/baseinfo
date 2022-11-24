<?php

namespace App\Providers;

use App\Repositories\MongoDB\BaseInfoRepository\BaseInfoRepository;
use App\Repositories\MongoDB\BaseInfoRepository\IBaseInfoRepository;
use App\Repositories\MongoDB\BaseRepository;
use App\Repositories\MongoDB\IBaseRepository;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use App\Models\Sanctum\PersonalAccessToken;
use Illuminate\Foundation\AliasLoader;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
            $this->app->register(IdeHelperServiceProvider::class);
        }
        $this->app->bind(IBaseRepository::class,BaseRepository::class,);
        $this->app->bind(IBaseInfoRepository::class,BaseInfoRepository::class,);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Loader Alias
        $loader = AliasLoader::getInstance();

        // SANCTUM CUSTOM PERSONAL-ACCESS-TOKEN
        $loader->alias(\Laravel\Sanctum\PersonalAccessToken::class, \App\Models\PersonalAccessToken::class);

    }
}
