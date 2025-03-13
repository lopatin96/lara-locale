<?php

namespace Lopatin96\LaraLocale\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Lopatin96\LaraLocale\Helpers\LocaleHelper;
use Lopatin96\LaraLocale\Services\LocaleService;

class SetLocale
{
    public function __construct(
        protected LocaleService $localeService
    ) {}

    public function handle(Request $request, Closure $next)
    {
        $locale = $this->localeService->determineLocale();

        if ($request->is('/') && $locale !== LocaleHelper::getDefaultLocale()) {
            return redirect("/$locale");
        }

        $firstSegment = $request->segment(1);

        if ($firstSegment !== $locale && strlen($firstSegment) === 2) {
            return redirect()->route('switch-locale', ['locale' => $firstSegment]);
        }

        $this->localeService->setLocale($locale);

        return $next($request);
    }
}