<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\HasLocalizedDescription;
use App\Enums\Concerns\HasLocalizedLabel;
use App\Enums\Concerns\HasRandomPicker;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum EventStatuses: string implements HasColor, HasDescription, HasLabel {
    use HasLocalizedDescription, HasLocalizedLabel, HasRandomPicker;

    case DRAFT = 'draft';
    case PLANNED = 'planned';
    case STARTED = 'started';
    case ENDED = 'ended';
    case ARCHIVED = 'archived';

    /**
     * @return array<int, string>
     */
    public function getColor(): array {
        return match ($this) {
            self::DRAFT => Color::Slate,
            self::PLANNED => Color::Teal,
            self::STARTED => Color::Green,
            self::ENDED => Color::Purple,
            self::ARCHIVED => Color::Gray,
        };
    }

    public function allowSubscriptions(): bool {
        return match ($this) {
            self::DRAFT, self::ENDED, self::ARCHIVED => false,
            self::PLANNED, self::STARTED => true,
        };
    }
}
