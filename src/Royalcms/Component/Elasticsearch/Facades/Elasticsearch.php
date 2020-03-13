<?php

namespace Royalcms\Component\Elasticsearch\Facades;

use Royalcms\Component\Support\Facades\Facade;


/**
 * Class Elasticsearch
 *
 * @package Royalcms\Component\Elasticsearch
 */
class Elasticsearch extends Facade
{

    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor()
    {
        return 'elasticsearch';
    }
}
