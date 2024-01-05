<?php

namespace App\Http\Controllers;

use App\Models\re_mang_sys as ModelsRe_mang_sys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class re_mang_sys extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $re_mang_sys= ModelsRe_mang_sys::all();
        return response()->json([
            're_mang_sys'=>$re_mang_sys
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       $validate=Validator::make($request->all(),[
         'name'=>'required|string',
         'description'=>'required',
         'date'=>'required',
       ]);
       if($validate->fails()){
        return response()->json($validate->errors(),400);
    }
    $re_mang_sys=ModelsRe_mang_sys::create([
       'name'=> $request->name,
       'description'=> $request->description,
       'date'=>$request->date,
       'owner_id'=>$request->owner_id
    ]);
     return response()->json([
        $re_mang_sys
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
      $re_mang_sys=ModelsRe_mang_sys::where('id',$request->id)->get();
      return response()->json([
        $re_mang_sys
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
        $re_mang_sys = ModelsRe_mang_sys::find($request->id);
        $re_mang_sys->name = $request->name;
        $re_mang_sys->description =$request->description;

        $re_mang_sys->save();
        return response()->json([
            'status'=>true,
            're_mang_sys'=>$re_mang_sys
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $re_mang_sys=ModelsRe_mang_sys::find($request->id);
        $re_mang_sys->delete();
            return response()->json([
                'msg'=>'deleted successfully'
            ]);
    }

    public function searchbyname_res(Request $request)
    {
        $search = $request->name;
        $re_mang_sys = DB::table('re_mang_sys')->where('name' , 'LIKE' , '%'.$search.'%')->get();
        return response()->json([$re_mang_sys]);
    }


}
