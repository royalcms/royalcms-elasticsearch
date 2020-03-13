<?php

namespace Royalcms\Component\Elasticsearch;

use Elasticsearch\Client;
use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ElasticsearchServiceProvider
 *
 * @package Royalcms\Component\Elasticsearch
 */
class ElasticsearchServiceProvider extends BaseServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->setUpConfig();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->singleton('elasticsearch.factory', function($app) {
            return new Factory();
        });

        $app->singleton('elasticsearch', function($app) {
            return new Manager($app, $app['elasticsearch.factory']);
        });

        $app->alias('elasticsearch', Manager::class);

        $app->singleton(Client::class, function(Container $app) {
            return $app->make('elasticsearch')->connection();
        });
    }

    protected function setUpConfig()
    {
        $source = dirname(dirname(dirname(dirname(__DIR__)))) . '/config/elasticsearch.php';

        $this->publishes([$source => config_path('elasticsearch.php')], 'config');

        $this->mergeConfigFrom($source, 'elasticsearch');
    }
}
