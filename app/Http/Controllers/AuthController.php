<?php

namespace App\Http\Controllers;

use App\Models\favourity;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum',['except'=>['login','register']]);
    }

    public function register(Request $request)
    {
        try{
            $validate = Validator::make($request->all(),
            [
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6',
                'name' => 'required|string|max:20|min:2',
                'confirm_password' => 'required|required_with:password|same:password|min:6',
                'type' => 'required|string'
            ]);
            if($validate->fails()){
                return response()->json($validate->errors(),401);
            }
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'name' => $request->name,
                'type' => $request->type,
                'confirm_password' => $request->confirm_password
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ],200);
        }
        catch(\Throwable $th)
        {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => $validate->errors()
            ],500);
        }

    }

        public function login(Request $request)
        {
            try {
                $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);
                if($validateUser->fails()){
                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validateUser->errors()
                    ],401);
                }
                if(!Auth::attempt($request->only(['email', 'password']))){
                    return response()->json([
                        'status' => false,
                        'message' => 'Email an password dose not match with our record',
                    ], 401);

                }
                $user = User::where('email', $request->email)->first();

                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);

            }
            catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
    }



    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['the user logged out']);
    }
}
