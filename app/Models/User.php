<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Concerns\LogsAllDirtyChanges;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser {
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, LogsAllDirtyChanges, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'ubisoft_id',
        'ubisoft_access_token',
        'ubisoft_refresh_token',
        'ubisoft_token_expires_at',
        'ubisoft_token_scope',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'ubisoft_access_token' => 'hashed',
            'ubisoft_refresh_token' => 'hashed',
            'ubisoft_token_expires_at' => 'immutable_datetime',
        ];
    }

    public function canAccessPanel(Panel $panel): bool {
        return $this->hasVerifiedEmail();
    }
}
