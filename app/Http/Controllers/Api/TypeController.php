<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;
use App\Http\Resources\TypeResource;
class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $types = Type::all();
         $types =  TypeResource::collection($types);

        return response()->json([
            'types' => $types,
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
            'type_name' => 'required|min:3|max:30'
             
        ]);


     

        type::create([
            'type_name'   => request('type_name')
        ]);

        return response()->json([
            'success' => "Type Insert Successful"
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
        $type = Type::find($id);
        $type =  TypeResource::make($type);

        return response()->json([
            'type' => $type,
          
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
            'type_name'     => 'required|min:3|max:30',
             
        ]);


            $type = type::find($id);
            $type->type_name = $request->type_name;
            $type->save();
       

        return response()->json([
            'success' => "Type Update Successful"
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
         $type = Type::find($id);
        $type->delete();
        return response()->json([
            'success' => "Type Delete Successful"
        ],200);
    }
}
