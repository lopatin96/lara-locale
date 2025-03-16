<?php

namespace Lopatin96\LaraLocale\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Lopatin96\LaraLocale\Helpers\LocaleHelper;
use Lopatin96\LaraLocale\Services\LocaleService;

class LaraLocaleController extends Controller
{
    public function __construct(
        protected LocaleService $localeService
    ) {}

    public function __invoke(string $locale): RedirectResponse
    {
        $locale = LocaleHelper::validateLocale($locale);

        if (auth()->guest()) {
            return $this->getBackRedirectResponse()->withCookie(cookie('locale', $locale, 60 * 24 * 30));
        }

        auth()->user()->forceFill(['locale' => $locale])->save();

        return $this->getBackRedirectResponse();
    }

    private function getBackRedirectResponse(): RedirectResponse
    {
        $firstSegment = str(parse_url(url()->previous(), PHP_URL_PATH))->explode('/')->get(1);

        if (in_array($firstSegment, LocaleHelper::getAvailableLocales(), true)) {
            return redirect('/');
        }

        return back();
    }
}