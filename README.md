# Laravel-lang

This packages add a translations pubisher for the languages files for Laravel 5 application based on [caouecs/Laravel-lang](https://github.com/caouecs/Laravel-lang).

# Install

```shell
$ composer require "equipc/laravel-lang"
```

After completion of the above, add the following service provider in the `config/app.php` file

```php
EquiPC\LaravelLang\TranslationPublisherServiceProvider::class,
```

# Usage

You can publish the language files to your project `resources/lang/` directory with the following Artisan command:

```shell
$ php artisan lang:publish LOCALES {--force}
```

examples:

```shell
$ php artisan lang:publish fr,nl
```

# License

MIT