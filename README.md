# lara-locale

## Installation
You can install this package via composer:
```bash
composer require lopatin96/lara-locale
```

Add middleware to `bootstrap/app.php`
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->appendToGroup('web', [
        SetLocale::class,
    ]);
})
```

Fix your route
```php
use Lopatin96\LaraLocale\Helpers\LocaleHelper;

Route::get('/{locale?}', static function () {
    return view('welcome');
})
    ->name('home')
    ->whereIn('locale', LocaleHelper::getAvailableLocales());
```
