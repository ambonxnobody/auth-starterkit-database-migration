<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use MongoDB\Laravel\Relations\HasMany;

class User extends Authenticatable
{
    public $timestamps = false;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'email_verified_at',
        'phone',
        'phone_verified_at',
        'username',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'is_active',
        'role',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_user', 'user_id', 'team_id')
            ->using(TeamUser::class)
            ->withPivot('role_id', 'metadata')
            ->as('membership');
    }

    public function ownTeams(): HasMany
    {
        return $this->hasMany(Team::class, 'owner_id');
    }

    public function profiles(): HasMany
    {
        return $this->hasMany(UserProfile::class);
    }

    public function userSettings(): HasMany
    {
        return $this->hasMany(UserSetting::class);
    }
}
