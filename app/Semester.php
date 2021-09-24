<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable=['name'];

    public function tuition_fee(){
        return $this->hasOne(TuitionFee::class);
     }
     public function payments(){
        return $this->hasMany(Payment::class);
     }
}
