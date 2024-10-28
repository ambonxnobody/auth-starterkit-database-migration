<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = false;

    public function teamInvitations(): HasMany
    {
        return $this->hasMany(TeamInvitation::class);
    }

    public function teamUsers(): HasMany
    {
        return $this->hasMany(TeamUser::class);
    }

    public function teams(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
