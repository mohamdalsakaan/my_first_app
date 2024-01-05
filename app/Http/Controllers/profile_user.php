<?php

namespace App\Http\Controllers;

use App\Models\favourity;
use App\Models\profile_owner;
use Illuminate\Http\Request;
use App\Models\profile_user as ModelsProfile_user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class profile_user extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum',['except'=>['login','register']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index_profile_user()
    {
        $profile_user = Modelsprofile_user::all();
        return response()->json([
            'profile_user'=> $profile_user
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_profile_user(Request $requset)
    {
        $user = ModelsProfile_user::where('user_id' , Auth::user()->id)->value('user_id');
        if($user != null)
        {

            return response()->json(['have a profile']);
        }
        else{

    $validate=Validator::make($requset->all(),[
        'name'=>'required|string',
        'email'=>'required',
        'password'=>'required',
        'image'=>'required',
        'budget'=> 'required|min:6'
      ]);
      if($validate->fails()){
          return response()->json($validate->errors(),400);
      }

      $image = $requset->file('image');
      $newImage = time().$image->getClientOriginalName();
      $image->move(public_path('upload') , $newImage);
      $path = "public/upload/$newImage";

      $profile_user= ModelsProfile_user::create([
        'user_id'=> Auth::user()->id,
        'image' => $path,
        'email' => $requset->email,
        'password' => $requset->password,
        'budget' => $requset->budget,
        'name' => $requset->name

    ]);

    // profile_user::create(Auth::user()->id);

    return response()->json([
      'status'=>true,
      'profile_user'=>  $profile_user
    ]);
}

    }

    // static function create($request)
    // {
    //      $fav = favourity::insert(
    //         [
    //             'profile_user_id' => $request
    //         ]
    //         );
    //         return $fav;
    // }


    public function update_profile_user(Request $request)
    {

      $image = $request->file('image');
      $newImage = time().$image->getClientOriginalName();
      $image->move(public_path('upload') , $newImage);
      $path = "public/upload/$newImage";

      $profile_user = ModelsProfile_user::find($request->id);
      $profile_user->name = $request->name;
      $profile_user->image = $path;
      $profile_user->email = $request->email;
      $profile_user->password = $request->password;
      $profile_user->budget = $request->budget;


      $profile_user->save();


    return response()->json([
      'status'=>true,
      'profile_user'=>  $profile_user
    ]);

    }

    public function delete_profile_user(Request $request)
    {

    $profile_user = ModelsProfile_user::find($request->id);
    $profile_user->delete();

    return response()->json([
      'status'=>true,
      'profile_user'=>  'delete'
    ]);
}



    ///////////////////////////////////////
    public function create_profile_owner(Request $requset)
    {

    $validate=Validator::make($requset->all(),[
        'name'=>'required|string',
        'email'=>'required',
        'password'=>'required',
        'image'=>'required',
        // 'budget'=> 'required'
      ]);
      if($validate->fails()){
          return response()->json($validate->errors(),400);
      }

      $image = $requset->file('image');
      $newImage = time().$image->getClientOriginalName();
      $image->move(public_path('upload') , $newImage);
      $path = "public/upload/$newImage";

      $profile_user= new profile_owner();
      $profile_user->owner_id =  Auth::user()->id;
          $profile_user->name=$requset->name;
          $profile_user->$image=$path;
          $profile_user->email = $requset->email;
          $profile_user->password=$requset->password;
          $profile_user->save();

    return response()->json([
      'status'=>true,
      'profile_user'=>  $profile_user
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
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
