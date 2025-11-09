<div>
    <div class="min-h-96 rounded-2xl bg-cover bg-no-repeat bg-center p-8 grid place-content-center text-center gap-6"
        style="background-image: url('{{ $event->featured_image_url }}');">
        <h1 class="text-4xl font-bold">{{ $event->title }}</h1>
        <div class="text-gray-800">
            <h2 class="text-lg">{{ $event->short_description }}</h2>
            <div class="text-sm">
                {{ __('by :creator_username', ['creator_username' => $event->creator->username]) }}
            </div>
        </div>
        <div class="flex gap-2 justify-self-center">
            <x-filament::badge :color="$event->status->getColor()">
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
    </div>

    <div class="grid grid-cols-[2fr_1fr] gap-8 mt-8">
        {{-- Description --}}
        <x-filament::section>
            <h3 class="font-bold text-2xl">{{ __('Description') }}</h3>
            <div class="fi-prose mt-4">
                {!! str($event->description)->sanitizeHtml() !!}
            </div>
        </x-filament::section>

        {{-- Info --}}
        <div class="flex flex-col gap-8">
            <x-filament::section>
                <div class="space-y-4">
                    <h3 class="font-bold text-2xl">📅 {{ __('Dates') }}:</h3>
                    <div>
                        <h4>
                            <span class="font-bold">🏁 {{ __('Begins') }}:</span>
                            {{ $event->begins_at->format('d/m/Y H:i') }}
                        </h4>
                        @if ($event->ends_at)
                            <h4>
                                <span class="font-bold">🏆 {{ __('Ends') }}:</span>
                                {{ $event->ends_at->format('d/m/Y H:i') }}
                            </h4>
                        @endif
                    </div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <div class="space-y-4">
                    <h3 class="font-bold text-2xl">🚀 {{ __('Subscriptions') }}:</h3>
                    <div>
                        <h4>
                            <span class="font-bold">🟢 {{ __('Opens') }}:</span>
                            {{ $event->open_subscriptions_at ? $event->open_subscriptions_at->format('d/m/Y H:i') : __('NOW!') }}
                        </h4>
                        <h4>
                            <span class="font-bold">🔴 {{ __('Closes') }}:</span>
                            {{ $event->close_subscriptions_at ? $event->close_subscriptions_at->format('d/m/Y H:i') : __('never (always open)') }}
                        </h4>
                    </div>
                    @if ($event->accepts_subscriptions)
                        <x-filament::button size="lg" class="w-full font-black text-lg" :color="\Filament\Support\Colors\Color::Blue"
                            wire:click="subscribe">
                            🔥 {{ __('Subscribe') }}
                        </x-filament::button>
                    @endif
                </div>
            </x-filament::section>
        </div>

        {{-- Leaderboard --}}
        @if ($event->has_leaderboard)
            <x-filament::section class="col-span-full">
                <h3 class="font-bold text-2xl">{{ __('Leaderboard') }}</h3>
                TODO
            </x-filament::section>
        @endif
    </div>
</div>
