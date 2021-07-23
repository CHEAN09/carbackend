<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Exception;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function show(Cars $cars) {
        return response()->json($cars,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $cars = Cars::where('name','like',"%$request->key%")
            ->orWhere('description','like',"%$request->key%")->get();

        return response()->json($cars, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'brand' => 'string|required',
            'acquired_on' => 'date|required'
        ]);

        try {  
            
            $cars = Cars::create([
                'name' => $request->name,
                'description' => $request->description,
                'brand' => $request->brand,
                'acquired_on' => $request->acquired_on,
                'user_id' => auth()->user()->id

            ]);
            return response()->json($cars, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Cars $cars) {
        try {
            $cars->update($request->all());
            return response()->json($cars, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Cars $cars) {
        $cars->delete();
        return response()->json(['message'=>'Car deleted.'],202);
    }

    public function index() {
        $cars = Cars::where('user_id',auth()->user()->id)->orderBy('name')->get();
        return response()->json($cars, 200);
    }
}
