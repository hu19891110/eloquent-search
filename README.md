eloquent-search
===============

Index Eloquent models to Elasticsearch. Eloquent-search use [Official low-level client for Elasticsearch](https://github.com/elastic/elasticsearch-php).

Installation via Composer
-------------------------
The recommended method to install `eloquent-search` is through [Composer](http://getcomposer.org).

```
composer require thaoha/eloquent-search
```

Once you've run a `composer update`, you need to register Laravel service provider, in your `config/app.php`:

```php
'providers' => [
    ...
    EloquentEs\EloquentEsServiceProvider::class,
],
```

Or with **Lumen**, you need add to `bootstrap/app.php`:

```php
$app->register(EloquentEs\EloquentEsServiceProvider::class);
```

And now you can add `ElasticModelTrait` to any Eloquent model you want to index to Elasticsearch:

```php
use EloquentEs\Supports\ElasticModelTrait;

/**
 * Class Company
 * @package App\Models
 */
class Company extends Model
{
    use ElasticModelTrait;
    ...
}
```


Config
------
Laravel 5:

```shell
$ php artisan vendor:publish --provider="EloquentEs\EloquentEsServiceProvider"
```

Or you can copy `config.php` file to your config folder and change the filename to `elastic.php`. With Lumen you need add new config file to `bootstrap/app`:

```php
$app->configure('elastic');
```