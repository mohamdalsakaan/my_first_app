<?php

namespace App\Http\Controllers;

use App\Models\contract as ModelsContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class contract extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_contract()
    {
        $contract = ModelsContract::all();
        return response()->json([
            'contract'=> $contract
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_contract(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'date_contract'=>'required',
            'sallary'=>'required',
            'opening_date'=>'required',

        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }
        $contract = ModelsContract::create([
          'date_contract'=>$request->date_contract,
          'sallary'=>$request->sallary,
          'opening_date'=>$request->opening_date,
          'profile_owner_id'=>$request->profile_owner_id,
        ]);


        return response()->json([
            'status'=> true,
            'contract'=> $contract
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
    public function show_contract(Request $request)
    {
        $contract = ModelsContract::where('id',$request->id)->get();
        return response()->json([
            'contract'=> $contract
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
    public function update_contract(Request $request)
    {
        $contract = ModelsContract::find($request->id);
        $contract -> sallary= $request->sallary;
        $contract -> opening_date= $request->opening_date;

        $contract->save();

        return response()->json([
            'status'=>true,
            'contract'=>  $contract
          ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_contract(Request $request)
    {
        $contract = ModelsContract::find($request->id);
        $contract->delete();

        return response()->json([
            'status'=> true,
            'msg'=> 'deleted successfuly'
        ]);
    }
}
