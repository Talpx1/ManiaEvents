<?php

declare(strict_types=1);

namespace App\Filament\Garage\Resources\Events\Pages;

use App\Filament\Garage\Resources\Events\EventResource;
use App\Models\Event;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreateEvent extends CreateRecord {
    protected static string $resource = EventResource::class;

    protected function handleRecordCreation(array $data): Model {
        return static::getModel()::create([
            ...$data,
            'slug' => $this->makeSlug($data['title']),
            'creator_id' => auth()->user()->id,
        ]);
    }

    private function makeSlug(string $title): string {
        $slug = Str::slug($title);

        while (Event::query()->where('slug', $slug)->exists()) {
            $slug = Str::slug($title).'-'.uniqid();
        }

        return $slug;
    }
}
