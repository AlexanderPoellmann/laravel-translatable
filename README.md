[![Latest Stable Version](https://poser.pugx.org/lecturize/laravel-translatable/v/stable)](https://packagist.org/packages/lecturize/laravel-translatable)
[![Total Downloads](https://poser.pugx.org/lecturize/laravel-translatable/downloads)](https://packagist.org/packages/lecturize/laravel-translatable)
[![License](https://poser.pugx.org/lecturize/laravel-translatable/license)](https://packagist.org/packages/lecturize/laravel-translatable)

# Laravel Translatable

A simple Package for multi-lingual Models in Laravel 5.

## Important Notice

**This package is a work in progress**, please use with care and feel free to report any issues or ideas you may have!

We've transferred this package to a new owner and therefor updated the namespaces to **Lecturize\Addresses**. The config file is now `config/lecturize.php`.

## Installation

Require the package from your `composer.json` file

```php
"require": {
	"lecturize/laravel-translatable": "dev-master"
}
```

and run `$ composer update` or both in one with `$ composer require lecturize/laravel-translatable`.

Next register the service provider and (optional) facade to your `config/app.php` file

```php
'providers' => [
    // Illuminate Providers ...
    // App Providers ...
    Lecturize\Translatable\TranslatableServiceProvider::class
];
```

## Configuration & Migration

```bash
$ php artisan vendor:publish --provider="Lecturize\Translatable\TranslatableServiceProvider"
```

This will create a `config/lecturize.php` and a migration file. In the config file you can customize the table names, finally you'll have to run migration like so:

```bash
$ php artisan migrate
```

## License

Licensed under [MIT license](http://opensource.org/licenses/MIT).

## Author

**Handcrafted with love by [Alexander Manfred Poellmann](http://twitter.com/AMPoellmann) for [Lecturize](https://lecturize.com) in Vienna &amp; Rome.**