<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Team extends Model
{
    public $timestamps = false;

    use HasUuids;

    protected $fillable = [
        'owner_id',
        'name',
//        'personal_team',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
//            'personal_team' => 'boolean',
            'is_active' => 'boolean',
            'metadata' => 'array',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user')->using(TeamUser::class);
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(TeamInvitation::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function teamProfile(): HasOne
    {
        return $this->hasOne(TeamProfile::class);
    }

    public function teamSetting(): HasOne
    {
        return $this->hasOne(TeamSetting::class);
    }

    public function assets(): MorphMany
    {
        return $this->morphMany(Asset::class, 'owner');
    }
}
