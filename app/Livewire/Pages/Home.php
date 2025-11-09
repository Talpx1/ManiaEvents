<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Enums\EventStatuses;
use App\Models\Event;
use Illuminate\View\View;
use Livewire\Component;

class Home extends Component {
    public function render(): View {
        return view('pages.home')
            ->layout('layouts.public.public', [
                'title' => config()->string('app.name'),
                'suffix' => false,
            ])
            ->with([
                'featured_events' => Event::query()->with('creator')->whereIn('status', [EventStatuses::PLANNED, EventStatuses::STARTED])->latest()->limit(6)->get(),
            ]);
    }
}
