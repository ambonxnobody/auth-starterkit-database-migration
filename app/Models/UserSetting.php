<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class UserSetting extends Model
{
    protected $connection = 'mongodb';

    public $timestamps = false;
}
