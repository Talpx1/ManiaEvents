@props(['event'])

<x-filament::section headingTag="div" compact>
    <x-slot name="heading">
        <div class="aspect-video overflow-hidden">
            <img src="{{ Storage::disk(config()->string('event.featured_image.disk'))->url($event->featured_image_path) }}"
                alt="{{ $event->title }}" class="w-full h-full object-cover">
        </div>
    </x-slot>

    <div class="pb-4 flex flex-col gap-3">

        <div class="flex gap-2">
            <x-filament::badge size="sm" :color="$event->status->getColor()">
                {{ $event->status->getLabel() }}
            </x-filament::badge>

            <x-filament::badge size="sm" :color="$event->accepts_subscriptions
                ? \Filament\Support\Colors\Color::Green
                : \Filament\Support\Colors\Color::Red">
                {{ $event->accepts_subscriptions ? __('Subscriptions open') : __('Subscriptions closed') }}
            </x-filament::badge>

            @if ($event->has_leaderboard)
                <x-filament::badge :color="\Filament\Support\Colors\Color::Yellow" size="sm">
                    🏆 {{ __('Leaderboard') }}
                </x-filament::badge>
            @endif
        </div>

        <div class="flex flex-col gap-1">
            <h3 class="text-base font-semibold text-gray-900 truncate">
                {{ $event->title }}
            </h3>
            <span class="text-xs text-gray-500">
                {{ $event->creator->username }}
            </span>
        </div>


        <p class="text-gray-500">
            {{ Str::limit($event->short_description, 140) }}
        </p>

        <div class="text-sm text-gray-600 space-y-1">
            <div>
                🏁 <span class="font-medium">{{ __('Begins') }}:</span>
                {{ $event->begins_at->translatedFormat('d/m/Y H:i') }}
            </div>

            @if ($event->ends_at)
                <div>
                    🏆 <span class="font-medium">{{ __('Ends') }}:</span>
                    {{ $event->ends_at->translatedFormat('d/m/Y H:i') }}
                </div>
            @endif
        </div>


        <x-slot name="footer">
            <x-filament::button tag="a" size="sm" :color="\Filament\Support\Colors\Color::Blue" :href="route('event.show', $event->slug)">
                {{ __('View Event') }} →
            </x-filament::button>
        </x-slot>
</x-filament::section>
