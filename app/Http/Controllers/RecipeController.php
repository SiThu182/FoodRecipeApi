<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Meal;
use App\Category;
use App\MeasurementUnit;
use App\MeasurementQuantity;
use App\Ingredient;
class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();
        $categories = Category::all();
        $meal_units = MeasurementUnit::all();
        $meal_qtys = MeasurementQuantity::all(); 
        $meals = Meal::all();
        $ingredients = Ingredient::all();
        return view('recipe.index',compact('recipes','meals','meal_units','meal_qtys','ingredients','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->ingredient_array);
        $request->validate([
            'recipe_name' => 'required|min:2|max:100',
            'preparation' => 'required|min:2|max:100',
            'recipe_video'=> 'required|min:3|max:255',
            'meal'        => 'required',
            'recipe_image'=> 'required',
            'category'      => 'required',
         

        ]);


        if($request->hasfile('recipe_image')){
            $photo=$request->file('recipe_image');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/photos/',$name);
            $image='/storage/photos/'.$name;
             
         }

        
         
         // dd($request);
         $recipe = Recipe::create([
            'recipe_name'  => request('recipe_name'),
            'preparation'  => request('preparation'),
            'recipe_video' => request('recipe_video'),
            'meal_id'      => request('meal'),
            'recipe_image' => $image,
            'category_id'  => request('category') 
         ]);

          $rec_ing = json_decode($request->ingredient_array);
         $rec_ing_list = $rec_ing->ingredientlist;
         foreach ($rec_ing_list as $rec) {

        $recipe->ingredients()->attach($rec->ingredient,['measurement_unit_id' => $rec->unit,'measurement_quantity_id'=>$rec->qty]);
             
             
         }

        // $recipe->measurementUnits()->attach(request('measurement_unit'));
        // $recipe->measurementqtys()->attach(request('measurement_qty'));    

          
           return response()->json(['success'=>'Property saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);
        $ingredients = $recipe->ingredients;
        return response()->json([
            'ingredients' => $ingredients
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $recipe = Recipe::find($id);
        $categories = Category::all();
        $ingredients = Ingredient::all();
        $meal_units = MeasurementUnit::all();
        $meal_qtys =MeasurementQuantity::all();
        // dd($recipe->ingredients);
        $meals = Meal::all();
        return view('recipe.edit',compact('recipe','meals','categories','ingredients','meal_units','meal_qtys'));
    }

    /**
     * Update the specifi->ed resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'recipe_name' => 'required|min:2|max:100',
            'preparation' => 'required|min:2|max:100',
            'recipe_video'=> 'required|min:3|max:255',
            'meal'        => 'required'
        ]);

         
        if($request->hasfile('recipe_image')){
            $photo=$request->file('recipe_image');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/photos/',$name);
            $image='/storage/photos/'.$name;
             
         }else{
            $image = request('old_image');
         }

         $recipe = Recipe::find($id);
         $recipe->recipe_name = request('recipe_name');
         $recipe->preparation = request('preparation');
         $recipe->recipe_video = request('recipe_video');
        $recipe->meal_id = request('meal');
        $recipe->category_id = request('category');
        $recipe->recipe_image = $image;
        $recipe->save();

         $rec_ing = json_decode($request->ingredient_array);

         $rec_ing_list = $rec_ing->ingredientlist;
         

     
             
         if ($rec_ing_list != null) {
            $recipe->ingredients()->detach();
           foreach ($rec_ing_list as $rec) {
                if ($rec) {
                      $recipe->ingredients()->attach($rec->ingredient,['measurement_unit_id' => $rec->unit,'measurement_quantity_id'=>$rec->qty]);
                }else {
                     $recipe->ingredients()->detach(); 
                }
            }
        }


        return response()->json([
            'success' => "Update Successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // dd($id);
        $recipe = Recipe::find($id);
        $recipe->delete();
        return redirect()->route('recipe.index');
    }
}
