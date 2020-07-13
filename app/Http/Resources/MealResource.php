<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Type;
class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [ 
        'meal_id' => $this->id,
        'meal_name' => $this->meal_name,
        'meal_image'=> $this->meal_image,    
        'type'  => new TypeResource(Type::find($this->type_id))
    ];
           
    }
}
