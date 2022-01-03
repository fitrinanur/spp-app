<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable =[
        'id',
        'year',
        'status',
        'cost_level_7',
        'cost_level_8',
        'cost_level_9',
        'semester'
    ];
}
