<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Meal;

use App\Http\Resources\MealResource;
class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Meal::all();
        $meals = MealResource::collection($meals);

        return response()->json([
            'meals' => $meals
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'meal_name' => 'required',
            'type' => 'required',
            'meal_image' =>'required'
        ]);


        if($request->hasfile('meal_image')){
            $photo=$request->file('meal_image');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/photos/',$name);
            $image='/storage/photos/'.$name;
             
         }

        Meal::create([
            'meal_name' => request('meal_name'),
            'type_id'   => request('type'),
            'meal_image'  => $image

        ]);



        return response()->json([
            'success' => "Meal Insert Successful" 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meal = Meal::find($id);
        $meal = MealResource::make($meal);
        return response()->json([
            'meal' => $meal
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([

            'meal_name' => 'required',
            'type' => 'required'
            
        ]);
   

        if($request->hasfile('meal_image')){
            $photo=$request->file('meal_image');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/photos/',$name);
            $image='/storage/photos/'.$name;
        }else{
            $image = request('old_meal_image');
        }

        $meal = Meal::find($id);
        $meal->meal_name = request('meal_name');
        $meal->type_id    = request('type');
        $meal->meal_image = $image; 
       
       return response()->json([
            'success' => "Meal Update Successful"
       ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meal = Meal::find($id);
        $meal->delete();
        return response()->json([
            'success' => "Meal Delete Successful"
        ],200);
    }
}
