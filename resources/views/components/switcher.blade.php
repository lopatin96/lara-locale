<div>
    <span class="dark:text-[#A1A09A]">{{ __('main.message') }}</span>

    @foreach(config('lara-locale.available_locales') as $locale)
        <a
            href="{{ route('switch-locale', ['locale' => $locale])}}"
            class="dark:text-[#A1A09A]"
        >
            {{ $locale }}
        </a>
    @endforeach
</div>
