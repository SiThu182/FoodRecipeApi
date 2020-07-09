<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['recipe_name','preparation','recipe_image','recipe_video','meal_id','category_id'];

     public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient')
        ->withPivot('measurement_unit_id','measurement_quantity_id')
        ->withTimestamps();
    }

      public function category($value='')
    {
        return $this->belongsTo('App\Category');
    }

      public function meal($value='')
    {
        return $this->belongsTo('App\Meal');
    }

    //  public function measurementUnits()
    // {
    //     return $this->belongsToMany('App\MeasurementUnit');
    // }

    //  public function measurementqtys()
    // {
    //     return $this->belongsToMany('App\MeasurementQuantity');
    // }

}
