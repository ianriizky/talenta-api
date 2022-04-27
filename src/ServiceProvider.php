<?php

namespace Ianriizky\TalentaApi;

use Ianriizky\TalentaApi\Services\TalentaApi;
use Illuminate\Contracts\Container\Container as ContainerContract;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/talenta.php' => $this->app->configPath('talenta.php'),
        ], 'config');
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/talenta.php', 'talenta');

        $this->app->singleton(TalentaApi::class, function (ContainerContract $app) {
            /**
             * Disable the SSL certificate verification behavior because
             * the local environment (especially on Laravel Valet)
             * SSL certificate is self-signed.
             *
             * @see https://docs.guzzlephp.org/en/stable/request-options.html#verify
             * @see https://curl.se/libcurl/c/libcurl-errors.html
             */
            $sslVerify = $app['config']->get('talenta.ssl_verify') ?? (! $app->isProduction() ? false : null);

            return new TalentaApi(
                Arr::except($app['config']['talenta'], 'ssl_verify'),
                $sslVerify
            );
        });
    }
}
