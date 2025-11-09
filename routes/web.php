<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Pages\Home::class)->name('home');
Route::get('/events', fn () => 'events')->name('events');
Route::get('/event/{slug}', fn () => 'event')->name('event.show');
