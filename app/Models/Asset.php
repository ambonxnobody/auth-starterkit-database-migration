<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Asset extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'owner_id',
        'owner_type',
        'name',
        'type',
        'access',
        'bucket_type',
        'path',
        'bytes',
        'file_metadata',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function owner(): MorphTo
    {
        return $this->morphTo();
    }
}
