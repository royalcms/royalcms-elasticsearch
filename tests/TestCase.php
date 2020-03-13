<?php

namespace Royalcms\Component\Elasticsearch\Tests;

use Royalcms\Component\Elasticsearch\Facades\Elasticsearch;
use Royalcms\Component\Elasticsearch\ElasticsearchServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;


/**
 * Class TestCase
 *
 * @package Tests
 */
abstract class TestCase extends Orchestra
{

    /**
     * @inheritdoc
     */
    protected function getPackageProviders($app)
    {
        return [
            ElasticsearchServiceProvider::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getPackageAliases($app)
    {
        return [
            'RC_Elasticsearch' => Elasticsearch::class,
        ];
    }
}
