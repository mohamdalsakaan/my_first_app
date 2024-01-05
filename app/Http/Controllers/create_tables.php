<?php

namespace App\Http\Controllers;

use App\Models\table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class create_tables extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table=table::all();

        return response()->json([
            'table' => $table

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
         'num_chairs'=>'required',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $table = table::create([
            'num_chairs'=>$request->num_chairs,
            're_mang_sys_id'=>$request->re_mang_sys_id,

        ]);

        return response()->json([
            'status'=> true,
            'table'=> $table
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $table = table::where('id', $request->id)->get();
        return response()->json([
            'table'=> $table
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $table = table::find($request->id);
        $table-> num_chairs= $request->num_chairs;

        $table->save();

        return response()->json([
            'status'=>true,
            'table'=>  $table
          ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $table = table::find($request->id);
        $table->delete();

        return response()->json([
            'status'=> true,
            'msg'=> 'deleted successfuly'
        ]);
    }
}
