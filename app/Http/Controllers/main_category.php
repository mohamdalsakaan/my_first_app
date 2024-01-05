<?php

namespace App\Http\Controllers;

use App\Models\main_category as ModelsMain_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class main_category extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_main_category()
    {
        $main_category = ModelsMain_category::all();
        return response()->json([
         'main_category' => $main_category
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_main_category(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=> 'required|string',
            'image'=>'required'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }

      $image = $request->file('image');
      $newImage = time().$image->getClientOriginalName();
      $image->move(public_path('upload') , $newImage);
      $path = "public/upload/$newImage";


    $main_category = ModelsMain_category::create([
    'name'=>$request->name,
    'image'=>$path,
    're_mang_sys_id'=>$request->re_mang_sys_id
    ]);

    return response()->json([
        'status'=> true,
        'main_category'=> $main_category
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
    public function show_main_category(Request $request)
    {
        $main_category = ModelsMain_category::where('id',$request->id)->get();

        return response()->json([
            'main_category' => $main_category
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
    public function update_main_category(Request $request)
    {
        $image = $request->file('image');
        $newImage = time().$image->getClientOriginalName();
        $image->move(public_path('upload') , $newImage);
        $path = "public/upload/$newImage";


        $main_category = ModelsMain_category::find($request->id);
        $main_category -> name= $request->name;
        $main_category -> image=$path;

        $main_category->save();

        return response()->json([
            'status'=>true,
            'main_category'=>  $main_category
          ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_main_category(Request $request)
    {
        $main_category = ModelsMain_category::find($request->id);
        $main_category->delete();

        return response()->json([
            'status'=>true,
            'main_category'=> 'deleted successfuly'
          ]);
    }
}
