<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Student;
use App\Classes;

class Student extends Model
{
    protected $primaryKey = 'nisn';
    // use SoftDeletes;
    protected $fillable = [
        'nisn',
        'name',
        'address',
        'wali_name',
        'wali_number',
        'religion',
        'wali_profession',
    ];

}
