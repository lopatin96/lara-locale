<?php

use Illuminate\Support\Facades\Route;
use Lopatin96\LaraLocale\Helpers\LocaleHelper;
use Lopatin96\LaraLocale\Http\Controllers\LaraLocaleController;

Route::get('/switch-locale/{locale}', LaraLocaleController::class)
    ->whereIn('locale', LocaleHelper::getAvailableLocales())
    ->name('switch-locale')
    ->middleware('web');
