<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable=[
        'batch','dept_id'
    ];
    public function department(){
       return $this->belongsTo(Department::class,'dept_id');
    }
    public function users(){
       return $this->hasMany(User::class,'batch_id');
    }
    public function tuition_fee(){
        return $this->hasOne(TuitionFee::class);
     }
}
