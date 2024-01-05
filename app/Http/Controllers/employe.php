<?php

namespace App\Http\Controllers;

use App\Models\emplyee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class employe extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_employe()
    {
        $employe = emplyee::all();

        return response()->json([
            'employe'=>$employe
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_employe(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=>'required|string',
            'gender'=>'required|string',
            'age'=>'required',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }

        $employe = emplyee::create([
            'name'=>$request->name,
            'gender'=>$request->gender,
            'age'=>$request->age,
            'contract_id'=>$request->contract_id
        ]);

        return response()->json([
            'status'=> true,
            'employe'=> $employe
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
    public function show_employe(Request $request)
    {
        $employe = emplyee::where('id', $request->id)->get();

        return response()->json([
            'employe'=> $employe
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
    public function update_employe(Request $request)
    {
        $employe = emplyee::find($request->id);
        $employe -> name= $request->name;
        $employe -> gender= $request->gender;
        $employe -> age= $request->age;

        $employe->save();

        return response()->json([
            'status'=>true,
            'employe'=>  $employe
          ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_employe(Request $request)
    {
        $employe = emplyee::find($request->id);
        $employe->delete();

        return response()->json([
            'status'=> true,
            'msg'=> 'deleted successfuly'
        ]);
    }
}
