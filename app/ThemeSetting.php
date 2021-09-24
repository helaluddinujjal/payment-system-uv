<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    protected $fillable = ['id','logo','url','currency'];

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
