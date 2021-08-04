<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_class extends Model
{
    protected $fillable = [
        'id_class',
        'nisn'
    ];

    public function Student()
    {
        return $this->belongsTo(Student::class, 'nisn_student', 'nisn');
    }

    public function Classes()
    {
        return $this->belongsTo(Classes::class,'id_class','id');
    }
}
