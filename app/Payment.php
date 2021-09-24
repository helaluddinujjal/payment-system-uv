<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id','student_id','batch_id','dept_id','status','transaction_id','currency','amount','status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function batch(){
        return $this->belongsTo(Batch::class);
    }
    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    protected $dates = ['created_at','updated_at'];


    function currency($currency){
        if($currency=="BDT"){
            echo "&#x9f3;";
        }elseif($currency=="USD"){
            echo "&#36;";
        }else{
            echo "&#163;";
        }
    }
}
