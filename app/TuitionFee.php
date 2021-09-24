<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TuitionFee extends Model
{
    //

    protected $fillable=[
        'fee','dept_id','currency','batch_id','semester'
    ];

     public function batch(){
        return $this->belongsTo(Batch::class,'batch_id');
     }

     public function semester(){
        return $this->belongsTo(Semester::class);
     }

   public static function currency($currency){
        if($currency=="BDT"){
            echo "&#x9f3;";
        }elseif($currency=="USD"){
            echo "&#36;";
        }else{
            echo "&#163;";
        }
    }
}
