<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
         $categories =  CategoryResource::collection($categories);

        return response()->json([
            'categories' => $categories,
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
            'category_name' => 'required|min:3|max:30',
            'category_image' =>'required'
        ]);


        if($request->hasfile('category_image')){
            $photo=$request->file('category_image');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/photos/',$name);
            $image='/storage/photos/'.$name;
             
         }

        $category = Category::create([
            'category_name'   => request('category_name'),
            'category_image'  => $image

        ]);

        $category =  CategoryResource::collection($category);

        return response()->json([
            'category' => $category,
            'message' => 'Insert Successful!!'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $category =  CategoryResource::make($category);

        return response()->json([
            'category' => $category,
          
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
            'category_name'     => 'required|min:3|max:30',
             
        ]);


        if($request->hasfile('category_image')){
            $photo=$request->file('category_image');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/photos/',$name);
            $image='/storage/photos/'.$name;
             
         }else{
            $image = $request->old_image;
         }

            $category = Category::find($id);
            $category->category_name = $request->category_name;
            $category->category_image = $image;
            $category->save();

            return response()->json([
                'category' = $category
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
         $category = Category::find($id);
        $category->delete();
        return response()->json([
            'success' => "Category Delete Successful"
        ],200);
    }
}
