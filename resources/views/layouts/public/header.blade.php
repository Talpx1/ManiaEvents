<header
    class="flex justify-between items-center sticky top-0 z-999 h-[100px] min-h-[100px] max-h-[100px] bg-light border-b-2 border-dark">

    <a href="{{ route('home') }}" wire:navigate>
        <x-app-logo class="max-h-[90px]" />
    </a>

    <div class="flex items-center gap-2 lg:gap-8">
        <a href="{{ route('home') }}" wire:navigate>{{ __('Home') }}</a>
        <a href="{{ route('events') }}" wire:navigate>{{ __('Events') }}</a>
    </div>
</header>
