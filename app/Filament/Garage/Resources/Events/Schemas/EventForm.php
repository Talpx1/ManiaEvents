<?php

declare(strict_types=1);

namespace App\Filament\Garage\Resources\Events\Schemas;

use App\Enums\EventStatuses;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Contracts\HasDescription;

class EventForm {
    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                TextInput::make('title')
                    ->columnSpanFull()
                    ->label(__('Title'))
                    ->required()
                    ->string()
                    ->unique()
                    ->maxLength(255),

                FileUpload::make('featured_image_path')
                    ->columnSpanFull()
                    ->label(__('Featured image'))
                    ->disk(config()->string('event.featured_image.disk'))
                    ->visibility(config()->string('event.featured_image.visibility'))
                    ->directory(config()->string('event.featured_image.path'))
                    ->image()
                    ->maxSize(config()->integer('event.featured_image.max_file_size_kb'))
                    ->imageEditor()
                    ->imageEditorAspectRatios([null, '16:9', '4:3', '1:1'])
                    ->downloadable()
                    ->openable()
                    ->required(),

                Textarea::make('short_description')
                    ->label(__('Short description'))
                    ->required(),

                RichEditor::make('description')
                    ->label(__('Description'))
                    ->required()
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'blockquote'],
                        ['undo', 'redo'],
                    ]),

                DateTimePicker::make('begins_at')
                    ->label(__('Begins at'))
                    ->native(false)
                    ->required()
                    ->displayFormat('l d/m/Y H:i'),

                DateTimePicker::make('ends_at')
                    ->label(__('Ends at'))
                    ->native(false)
                    ->nullable()
                    ->displayFormat('l d/m/Y H:i'),

                Select::make('status')
                    ->label(__('Status'))
                    ->live()
                    ->partiallyRenderAfterStateUpdated()
                    ->options(EventStatuses::class)
                    ->enum(EventStatuses::class)
                    ->belowContent(fn ((EventStatuses&HasDescription)|null $state) => $state?->getDescription())
                    ->required(),

                Checkbox::make('has_leaderboard')
                    ->label(__('Enable leaderboard')),

                DateTimePicker::make('open_subscriptions_at')
                    ->label(__('Open subscriptions at'))
                    ->native(false)
                    ->nullable()
                    ->displayFormat('l d/m/Y H:i'),

                DateTimePicker::make('close_subscriptions_at')
                    ->label(__('Close subscriptions at'))
                    ->native(false)
                    ->nullable()
                    ->displayFormat('l d/m/Y H:i'),
            ]);
    }
}
