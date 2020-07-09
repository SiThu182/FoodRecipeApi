<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('ingredient.index',compact('ingredients'));
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
            'ingredient_name' => 'required|min:3|max:30',
            'ingredient_image' =>'required'
        ]);


        if($request->hasfile('ingredient_image')){
            $photo=$request->file('ingredient_image');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/photos/',$name);
            $image='/storage/photos/'.$name;
             
         }

        Ingredient::create([
            'ingredient_name'   => request('ingredient_name'),
            'ingredient_image'  => $image

        ]);

        return redirect()->route('ingredient.index');
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
        $ingredient = ingredient::find($id);
        return view('ingredient.edit',compact('ingredient'));
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
            'ingredient_name'     => 'required|min:3|max:30',

             
        ]);


        if($request->hasfile('Ingredient_image')){
            $photo=$request->file('Ingredient_image');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/photos/',$name);
            $image='/storage/photos/'.$name;
             
         }else{
            $image = $request->old_image;
         }

            $ingredient = Ingredient::find($id);
            $ingredient->Ingredient_name = $request->ingredient_name;
            $ingredient->Ingredient_image = $image;
            $ingredient->save();
       

        return redirect()->route('Ingredient.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $ingredient = Ingredient::find($id);
        $ingredient->delete();
        return redirect()->route('Ingredient.index');
    }
}
