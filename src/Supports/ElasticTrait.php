<?php namespace EloquentEs\Supports;

/**
 * Trait ElasticTrait
 * @package EloquentEs\Supports
 */
trait ElasticTrait
{
    use ElasticModelTrait, ElasticCollectionTrait;

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }
}