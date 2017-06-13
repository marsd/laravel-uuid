# Laravel Uuid

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
<!-- [![Total Downloads][ico-downloads]][link-downloads] -->

A simple, automatic UUID generator for any model based on Laravel 5.4 , By using this package when each new entry you will get the following :

* Generates `uuid` from Ramsey's UUID v1
* Reorders the UUID from vend/mysqluuid according to https://www.percona.com/blog/2014/12/19/store-uuid-optimized-way/
* Assign it to `uuid` field in database automatically.
* easy find it based `uuid` method.


## Installation

To get started, require this package

- Via Composer

``` bash
 composer require emadadly/laravel-uuid
```

- Via composer.json file

Add the following to the `require` section of your projects `composer.json` file.
``` php
"emadadly/laravel-uuid": "1.*",
```

Run composer update to download the package

``` bash
 composer update
```

Finally, you'll also need to add the ServiceProvider in `config/app.php`

``` php
'providers' => [
   ...
   marsd\Uuid\LaravelUuidServiceProvider::class,
],
```

You could also publish the config file:

``` bash
php artisan vendor:publish --provider="marsd\Uuid\LaravelUuidServiceProvider"
```

and set your default_uuid_column setting, if you have an app-wide default. 

Our package assume the column is `uuid` by default.

## Usage

#### Migrations


When using the migration you should add `uuid` as column type, and set the name it the same name in the `config/uuid.php` file.

``` php
$table->uuid('uuid');
```
it's will create column uuin name and a char(36) inside of our database schema, To be ready to receive Uuids.



> Simply, the schema seems something like this.

``` php
Schema::create('users', function (Blueprint $table) {

  $table->increments('id');
  $table->uuid('uuid');
  ....
  ....
  $table->timestamps();
});
```


#### Models

Use this trait in any model.

To set up a model to using Uuid, simply use the Uuids trait:

``` php
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class ExampleModel extends Model
{
  use Uuids;
  ....
}
```

#### Controller

When you create a new instance of a model which uses Uuids, our package will automatically add Uuid.

``` php
// 'Uuid' will automatically generate and assign id field.
$model = ExampleModel::create(['name' => 'whatever']);
```

Also when use show, update or delete method inside the Controller, it very easy to implement through `ExampleModel::uuid()` scope method

``` php
public function show($uuid)
{
  $example = ExampleModel::uuid($uuid);
  return response()->json(['example' => $example]);
}
```
## Support

If you believe you have found an issue, please report it using the [GitHub issue tracker](https://github.com/EmadAdly/laravel-uuid/issues), or better yet, fork the repository and submit a pull request.

If you're using this package, I'd love to hear your thoughts. Thanks!



## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/emadadly/laravel-uuid.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/emadadly/laravel-uuid/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/emadadly/laravel-uuid.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/emadadly/laravel-uuid.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/emadadly/laravel-uuid.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/emadadly/laravel-uuid
[link-travis]: https://travis-ci.org/EmadAdly/laravel-uuid
[link-scrutinizer]: https://scrutinizer-ci.com/g/emadadly/laravel-uuid/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/emadadly/laravel-uuid
[link-downloads]: https://packagist.org/packages/emadadly/laravel-uuid
[link-author]: https://github.com/emadadly
[link-contributors]: ../../contributors
