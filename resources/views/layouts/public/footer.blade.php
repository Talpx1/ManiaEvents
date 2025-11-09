<footer class="py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 items-center gap-16 lg:gap-0">
        <p class="text-center lg:text-left order-2 lg:order-0">
            Copyright © {{ date('Y') }}
            {{ config('company.name') }}&nbsp;&nbsp;|&nbsp;&nbsp;{{ __('All rights reserved') }}
        </p>

        <x-app-logo class="order-0 lg:order-1 text-center" class="max-h-[75px] justify-self-center" />

        <div class="order-1 lg:order-2 flex flex-col lg:flex-row gap-4 items-center lg:justify-end">
            <a href="#">{{ __('Privacy Policy') }}</a>
            <a href="#">{{ __('Cookie Policy') }}</a>
        </div>
    </div>
    <div class="text-center mt-8">
        <a href="https://simonecerruti.com">
            {!! __('Made by :website_author', [
                'website_author' => '<span class="underline underline-offset-2 decoration-2">Simone Cerruti (Talp1 in game)</span>',
            ]) !!}
        </a>

        {{-- donations here --}}
    </div>
</footer>
