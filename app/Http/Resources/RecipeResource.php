<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
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
            'recipe_name' => $this->recipe_name,
            'preparation' => $this->preparation,
            'recipe_image'=> $this->recipe_image,
            'recipe_video'=> $this->recipe_video,
            'meal_id'     => new MealResource(Meal::find($this->id)),
            'category_id' => new CategoryResource(Category::find($this->id)),
             'ingredients' =>  RecipeResource::collection($this->ingredients),
        ];
    }
}
