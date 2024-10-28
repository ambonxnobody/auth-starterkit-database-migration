<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamRole extends Pivot
{
    use HasUuids;

    public $timestamps = false;
}
