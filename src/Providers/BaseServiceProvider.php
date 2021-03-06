<?php

namespace IlyasDeckers\BaseModule\Providers;

use Illuminate\Support\ServiceProvider;
use IlyasDeckers\BaseModule\Console\Commands\GenerateFactoriesCommand;
use IlyasDeckers\BaseModule\TransactionMiddleware;
use IlyasDeckers\BaseModule\ValidatorMiddleware;
use IlyasDeckers\BaseModule\Exceptions\BaseExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('transaction', TransactionMiddleware::class);
        $router->aliasMiddleware('validator', ValidatorMiddleware::class);

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->app->bind(
            ExceptionHandler::class,
            BaseExceptionHandler::class
        );  
    }
}
