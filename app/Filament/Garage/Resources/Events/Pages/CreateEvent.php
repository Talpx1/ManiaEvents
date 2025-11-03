<?php

namespace App\Filament\Garage\Resources\Events\Pages;

use App\Filament\Garage\Resources\Events\EventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
}
