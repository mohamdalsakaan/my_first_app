<?php

namespace App\Http\Controllers;

use App\Models\sub_category as ModelsSub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class sub_category extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_sub_category()
    {
        $sub_category = ModelsSub_category::all();

        return response()->json([
            'sub_category' => $sub_category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_sub_category(Request $request)
    {
        $validate= Validator::make($request->all(),[
            'name'=>'required|string',
            'price'=>'required',
            'image'=>'required',
            'description'=>'required',

        ]);

        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }

      $image = $request->file('image');
      $newImage = time().$image->getClientOriginalName();
      $image->move(public_path('upload') , $newImage);
      $path = "public/upload/$newImage";

      $sub_category = ModelsSub_category::create([
        'name'=>$request->name,
        'price'=>$request->price,
        'image'=>$path,
        'description'=>$request->description,
        'main_category_id'=>$request->main_category_id,
      ]);


      return response()->json([
        'status'=> true,
        'sub_category'=> $sub_category
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
    public function show_sub_category(Request $request)
    {
        $sub_category = ModelsSub_category::where('id', $request->id)->get();
        return response()->json([
            'sub_category' => $sub_category
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
    public function update_sub_category(Request $request)
    {
        $image = $request->file('image');
        $newImage = time().$image->getClientOriginalName();
        $image->move(public_path('upload') , $newImage);
        $path = "public/upload/$newImage";

        $sub_category = ModelsSub_category::find($request->id);
        $sub_category->name = $request->name;
        $sub_category->image = $path;
        $sub_category->price = $request->price;
        $sub_category->description = $request->description;


        $sub_category->save();

        return response()->json([
            'status'=> true,
            'sub_category'=> $sub_category
        ]);




    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_sub_category(Request $request)
    {
        $sub_category = ModelsSub_category::find($request->id);
        $sub_category->delete();

        return response()->json([
            'status'=> true,
            'msg'=> 'deleted successfuly'
        ]);
    }





    public function searchbyname_sub_cat(Request $request)
    {
        $search = $request->name;
        $sub_category = DB::table('sub_category')->where('name' , 'LIKE' , '%'.$search.'%')->get();
        return response()->json([$sub_category]);
    }
}
