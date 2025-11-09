<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Pages\Home::class)->name('home');
Route::get('/events', fn () => 'events')->name('events');
Route::get('/event/{event:slug}', \App\Livewire\Pages\Event\Show::class)->name('event.show');
