<?php

namespace Lopatin96\LaraLocale\Services;

use Illuminate\Http\Request;
use Lopatin96\LaraLocale\Helpers\LocaleHelper;

class LocaleService
{
    public function determineLocale(): string
    {
        if (auth()->check()) {
            return LocaleHelper::validateLocale(auth()->user()->locale);
        }

        if (request()->hasCookie('locale')) {
            return LocaleHelper::validateLocale(request()->cookie('locale'));
        }

        return LocaleHelper::detectLocaleFromBrowser(request());
    }

    public function setLocale(string $locale): void
    {
        app()->setLocale(LocaleHelper::validateLocale($locale));
    }
}