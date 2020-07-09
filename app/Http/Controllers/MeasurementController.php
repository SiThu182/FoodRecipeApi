<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MeasurementUnit;
use App\MeasurementQuantity;
class MeasurementController extends Controller
{
    public function get_unit()
    {
    	$measurement_units = MeasurementUnit::all();
    	return view('unit.index',compact('measurement_units'));
    }

    public function set_unit(Request $request)
    {
    	$request->validate([
    		'measurement_unit' => 'required|max:30'
    	]);

    	MeasurementUnit::create([
    		'measurement_unit' => request('measurement_unit')
    	]);

    	return redirect()->route('get_unit');
    }

    public function delete_unit($id)
    {
    	$measurement_unit = MeasurementUnit::find($id);
    	$measurement_unit->delete();
    	return redirect()->route('get_unit');
    }
    public function get_qty()
    {
    	$measurement_qtys = MeasurementQuantity::all();
    	return view('qty.index',compact('measurement_qtys'));
    }

    public function set_qty(Request $request)
    {
    	$request->validate([
    		'measurement_qty' => 'required|max:30'
    	]);

    	MeasurementQuantity::create([
    		'measurement_qty' => request('measurement_qty')
    	]);

    	return redirect()->route('get_qty');
    }

    public function delete_qty($id)
    {
    	$measurement_qty = MeasurementQuantity::find($id);
    	$measurement_qty->delete();
    	return redirect()->route('get_qty');
    }
}
