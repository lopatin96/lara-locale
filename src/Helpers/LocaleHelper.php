<?php

namespace Lopatin96\LaraLocale\Helpers;

class LocaleHelper
{
    public static function getDefaultLocale(): string
    {
        return config('app.locale');
    }

    public static function getAvailableLocales(): array
    {
        return config('lara-locale.available_locales');
    }

    public static function validateLocale(?string $locale): string
    {
        return in_array($locale, self::getAvailableLocales(), true) ? $locale : self::getDefaultLocale();
    }

    public static function detectLocaleFromBrowser($request): string
    {
        return self::validateLocale(substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2));
    }
}