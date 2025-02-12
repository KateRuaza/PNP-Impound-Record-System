<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'statis',
        'type',
        'color',
        'plate_number',
        'chasis_number',
        'impound_reason',
        'impound_date',
        'image',
        'owner_first_name',
        'owner_middle_name',
        'owner_last_name',
        'owner_nick_name',
        'owner_age',
        'owner_sex',
    ];
}
