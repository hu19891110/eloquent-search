eloquent-search
===============

[![Latest Stable Version](https://poser.pugx.org/thaoha/eloquent-search/v/stable)](https://packagist.org/packages/thaoha/eloquent-search)
[![License](https://poser.pugx.org/thaoha/eloquent-search/license)](https://packagist.org/packages/thaoha/eloquent-search)

Index Eloquent models to Elasticsearch. Eloquent-search use [Official low-level client for Elasticsearch](https://github.com/elastic/elasticsearch-php).
You should read more about Elasticsearch at [https://www.elastic.co](https://www.elastic.co) to get basic knowledge.

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

Index
-----

Create index to store your data first. Use `esCreateIndex()` function from you model class:

```php
App\Models\Company::esCreateIndex();
```

`esCreateIndex()` function use property `$esIndexMapping` in `Company` model to set mapping settings. Elastic will auto detect if `$esIndexMapping` empty:

```php
/**
     * Index mapping
     *
     * @var array
     */
    private $esIndexMapping = [
        'id'            => ['type' => 'long'],
        'name'          => ['type' => 'string'],
        'company'       => ['type' => 'string']
    ];
```

If you want to update mapping settings you can use (use `esReset()` function when conflict error):

```php
App\Models\Company::esPutMapping();
```

Delete index:

```php
App\Models\Company::esDeleteIndex();
```

Reset index. Just use this function (this function will delete all your index include your data and create new one with mapping settings):

```php
App\Models\Company::esReset();
```


Get and Index model
-------------------

With each model object already use `ElasticModelTrait` you can index to Elasticsearch with `esIndex()` function:

```php
$company = App\Models\Company::find(1);
$company->esIndex();
```

With default it will be use `$company->toArray()` to get data. Very easy to override with `esSerialize()` function:

```php
/**
     * Get eloquent model data
     *
     * @return array
     */
    public function esSerialize()
    {
        $data = $this->toArray();
        $data['user_id'] = 1;
        
        return $data;
    }
```

Delete model
------------

```php
$company = App\Models\Company::find(1);
$company->esDelete();
```

Update model
------------

```php
$company = App\Models\Company::find(1);
$company->esReindex();
```

a Model or a Collection you can do with same way.

Search
------

```php
$params = [
    'match' => ['name' => 'keyword']
];
$hits = App\Models\Company::esSearch($params);
```

You should read more at [https://www.elastic.co/](https://www.elastic.co/) to build you params search