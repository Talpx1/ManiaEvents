<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EventStatuses;
use App\Models\Concerns\LogsAllDirtyChanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory, LogsAllDirtyChanges;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'begins_at' => 'immutable_datetime',
            'ends_at' => 'immutable_datetime',
            'open_subscriptions_at' => 'immutable_datetime',
            'close_subscriptions_at' => 'immutable_datetime',
            'status' => EventStatuses::class,
            'has_leaderboard' => 'boolean',
        ];
    }
}
