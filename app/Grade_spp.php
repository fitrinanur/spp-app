<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade_spp extends Model
{
    protected $fillable =[
        'id_class',
        'total'
    ];

    public function classes(){
        return $this->belongsTo(Classes::class);
    }
}
