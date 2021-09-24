<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable=[
        'name',
    ];
    public function batches(){
       return $this->hasMany(Batch::class,'dept_id');
    }


    public function users(){
        return $this->hasMany(User::class,'dept_id');
    }
}
