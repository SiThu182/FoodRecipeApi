<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
     protected $fillable = ['type_id','meal_image','meal_name'];

    

     public function type($value='')
    {
    	return $this->belongsTo('App\type');
    }
}
