<?php

namespace App\Http\Controllers;

use App\Models\profile_owner as AppModelsProfile_owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Triste\Api_Response;

class profile_owner extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum',['except'=>['login','register']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile_owner = AppModelsProfile_owner::all();
        return response()->json([
            'profile_owner' => $profile_owner
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_profile_owner(Request $request)
    {
        $validate=Validator::make($request->all(),[
        'name'=>'required|string',
        'email'=>'required',
        'password'=>'required',
        'image'=>'required',
      ]);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }

      $image = $request->file('image');
      $newImage = time().$image->getClientOriginalName();
      $image->move(public_path('upload') , $newImage);
      $path = "public/upload/$newImage";

      $profile_owner= AppModelsProfile_owner::create([
        'owner_id'=> Auth::user()->id,
        'image' => $path,
        'email' => $request->email,
        'password' => $request->password,
        'name' => $request->name

      ]);

    // return Api_Response::ResponseSucces('create succefuly' , $profile_owner);
    return response()->json([
       'status' => true,
       'data' => $profile_owner
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
    public function show( Request $request)
    {
        $profile_owner = AppModelsProfile_owner::where('id',$request->id)->get();
        return response()->json([
            'profile_owner' => $profile_owner
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
    public function update_profile_owner(Request $request)
    {

        $image = $request->file('image');
        $newImage = time().$image->getClientOriginalName();
        $image->move(public_path('upload') , $newImage);
        $path = "public/upload/$newImage";

      $profile_owner = AppModelsProfile_owner::find($request->id);
      $profile_owner->name = $request->name;
      $profile_owner->image = $path;
      $profile_owner->email = $request->email;
      $profile_owner->password = $request->password;


      $profile_owner->save();


    return response()->json([
      'status'=>true,
      'profile_owner'=>  $profile_owner
    ]);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete_profile_owner(Request $request)
    {
        $profile_owner = AppModelsProfile_owner::find($request->id);
        $profile_owner->delete();


        return response()->json([
            'status'=>true,
            'profile_owner'=> 'deleted successfuly'
          ]);
    }
}
