[![Latest Stable Version](https://poser.pugx.org/vendocrat/laravel-translatable/v/stable)](https://packagist.org/packages/vendocrat/laravel-translatable)
[![Total Downloads](https://poser.pugx.org/vendocrat/laravel-translatable/downloads)](https://packagist.org/packages/vendocrat/laravel-translatable)
[![License](https://poser.pugx.org/vendocrat/laravel-translatable/license)](https://packagist.org/packages/vendocrat/laravel-translatable)

# Laravel Translatable

A simple Package for multi-lingual Models in Laravel 5.

## Installation

Require the package from your `composer.json` file

```php
"require": {
	"vendocrat/laravel-translatable": "dev-master"
}
```

and run `$ composer update` or both in one with `$ composer require vendocrat/laravel-translatable`.

Next register the service provider and (optional) facade to your `config/app.php` file

```php
'providers' => [
    // Illuminate Providers ...
    // App Providers ...
    vendocrat\Translatable\TranslatableServiceProvider::class
];
```

```php
'providers' => [
	// Illuminate Facades ...
    'Translation' => vendocrat\Translatable\Facades\Translation::class
];
```

## Configuration & Migration

```bash
$ php artisan vendor:publish --provider="vendocrat\Translatable\TranslatableServiceProvider"
```

This will create a `config/translatable.php` and a migration file. In the config file you can customize the table names, finally you'll have to run migration like so:

```bash
$ php artisan migrate
```

## License

Licensed under [MIT license](http://opensource.org/licenses/MIT).

## Author

**Handcrafted with love by [Alexander Manfred Poellmann](http://twitter.com/AMPoellmann) for [vendocrat](https://vendocr.at) in Vienna &amp; Rome.**