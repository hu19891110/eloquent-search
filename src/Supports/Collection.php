<?php namespace EloquentEs\Supports;

use Illuminate\Support\Collection as BaseCollection;

/**
 * Class Collection
 * @package EloquentEs\Supports
 */
class Collection extends BaseCollection
{
    use ElasticCollectionTrait;
}