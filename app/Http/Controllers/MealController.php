<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Type;
use App\Meal;
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
      
        $types = Type::all();
        return view('meal.index',compact('meals','types'));
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

          $request->validate([

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
           
            'type_id'   => request('type'),
            'meal_image'  => $image

        ]);

        return redirect()->route('meal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meal = Meal::find($id);
       
        $types = Type::all();
        return view('meal.edit',compact('meal','categories','types'));
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
        $meal->type_id    = request('type');
        $meal->meal_image = $image; 
        
        return redirect()->route('meal.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
