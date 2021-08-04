<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student_class;
use App\Grade_spp;


class Payment extends Model
{
    protected $fillable = [
        'id_student_classes',
        'id_grade_spp',
        'image_payment',
        'status',
        // 'description',
        'date_payment',
        'month_payment',
        'year_payment'
    ];

    public function student_classes(){
        return $this->belongsTo(Student_class::class,'id_student_classes','id');
    }

    public function grade_spp(){
        return $this->belongsTo(Grade_spp::class);
    }
}
