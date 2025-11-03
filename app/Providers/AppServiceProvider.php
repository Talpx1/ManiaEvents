<?php

declare(strict_types=1);

namespace App\Providers;

use App\Filament\Macros\Field\CapitalizeFirstCharMacro;
use App\Filament\Macros\Field\CapitalizeWordsMacro;
use App\Filament\Macros\Field\LowercaseMacro;
use App\Filament\Macros\Field\UppercaseMacro;
use App\Macros\Str\ReplacePlaceholdersMacro;
use Carbon\CarbonImmutable;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Sleep;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Vite::useAggressivePrefetching();
        Sleep::fake();
        Date::use(CarbonImmutable::class);
        Model::shouldBeStrict();
        Model::unguard();
        Model::automaticallyEagerLoadRelationships();
        URL::forceHttps($this->app->environment(['staging', 'production']));
        DB::prohibitDestructiveCommands($this->app->environment('production'));
        Http::preventStrayRequests($this->app->runningUnitTests());

        Blade::anonymousComponentPath(resource_path('views/layouts'), 'layout');

        TextInput::configureUsing(fn (TextInput $component) => $component->telRegex('/^\+[0-9]{1,4}[0-9]*$/'));
        DateTimePicker::configureUsing(function (DateTimePicker $component) {
            if ($component->hasTime()) {
                $component->timezone(config()->string('app.actual_timezone'));
            }
        });

        collect([
            UppercaseMacro::class,
            LowercaseMacro::class,
            CapitalizeWordsMacro::class,
            CapitalizeFirstCharMacro::class,
        ])->each(
            /** @param class-string<\App\Macros\Concerns\Macro> $macro */
            fn (string $macro) => Field::macro(...$macro::register())
        );

        Str::macro(...ReplacePlaceholdersMacro::register());
    }
}
