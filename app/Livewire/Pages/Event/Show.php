<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Event;

use App\Models\Event;
use Livewire\Component;

class Show extends Component {
    public Event $event;

    public function mount(Event $event) {
        $this->event = $event;
    }

    public function subscribe() {
        // Your subscription logic here
        session()->flash('message', __('You have successfully subscribed!'));
    }

    public function render() {
        return view('pages.event.show', [
            'event' => $this->event,
        ])
            ->title($this->event->title);
    }
}
