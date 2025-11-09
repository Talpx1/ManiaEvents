<div>
    <section>
        <h2 class="text-3xl font-bold mb-2">{{ __('Featured Events') }}</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($featured_events as $event)
                <x-event-card :$event />
            @endforeach
        </div>
    </section>
</div>
