<?php

declare(strict_types=1);

namespace App\Filament\Garage\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventsTable {
    public static function configure(Table $table): Table {
        return $table
            ->columns([
                ImageColumn::make('featured_image_path')
                    ->disk(config()->string('event.featured_image.disk'))
                    ->visibility(config()->string('event.featured_image.visibility'))
                    ->label(__('Featured image')),

                TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->sortable(),

                TextColumn::make('begins_at')
                    ->label(__('Begins at'))
                    ->dateTime('l d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('ends_at')
                    ->label(__('Ends at'))
                    ->dateTime('l d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
