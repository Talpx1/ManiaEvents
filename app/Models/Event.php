<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EventStatuses;
use App\Models\Concerns\LogsAllDirtyChanges;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * @return BelongsTo<User, $this>
     */
    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

    protected function acceptsSubscriptions(): Attribute {
        return Attribute::get(function () {
            if (! $this->status->allowSubscriptions()) {
                return false;
            }

            return ($this->open_subscriptions_at?->isPast() ?? true) && ($this->close_subscriptions_at?->isFuture() ?? true);
        });
    }
}
