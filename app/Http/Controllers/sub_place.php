<?php

namespace App\Http\Controllers;

use App\Models\re_mang_sys;
use App\Models\sub_place as ModelsSub_place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class sub_place extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_sub_place()
    {
        $sub_place = ModelsSub_place::all();

        return response()->json([
            'sub_place' => $sub_place
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_sub_place(Request $request)
    {
        $validate = Validator::make($request->all(),[
        'name_country'=>'required|string',
        'name_city'=>'required|string',
        'name_region'=>'required|string',
        'name_street'=>'required|string',
        'description'=> 'required'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }

        $sub_place = ModelsSub_place::create([

            'name_country' => $request->name_country,
            'name_city' => $request->name_city,
            'name_region' => $request->name_region,
            'name_street' => $request->name_street,
            'description' => $request->description,
            're_mang_sys_id' => $request->re_mang_sys_id
        ]);
        return response()->json([
            'sub_place' => $sub_place
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
    public function show_sub_place(Request $request)
    {
        $sub_place = ModelsSub_place::where('id',$request->id)->get();
        return response()->json([
            'sub_place'=>$sub_place
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
    public function update_sub_place(Request $request)
    {
        $sub_place = ModelsSub_place::find($request->id);
        $sub_place -> description = $request->description;
        $sub_place->save();
        return response()->json([
            'status' => true,
            'sub_place'=> $sub_place
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_sub_place(Request $request)
    {
        $sub_place = ModelsSub_place::find($request->id);
        $sub_place->delete();
        return response()->json([
            'status' => true,
            'msg'=> 'deleted successfuly'
        ]);

    }


    public function searchbyname_sub_place(Request $request)
    {
        $search = $request->name;
        $sub_place = DB::table('sub_place')->where('name_city' , 'LIKE' , '%'.$search.'%')->get('re_mang_sys_id');
        $re = re_mang_sys::whereIn('id' , $sub_place)->get();
        return response()->json([$re]);

    }

}
