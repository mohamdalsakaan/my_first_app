<?php

namespace App\Http\Controllers;

use App\Models\fav_sub;
use App\Models\favourity as ModelsFavourity;
use App\Models\profile_user;
use App\Models\sub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class favourity extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function insert_fav_sub(Request $request)
    {
        $fav = fav_sub::insert([
            'sub_category_id' => $request->sub_category_id,
            'favourity_id' => $request->favourity_id
        ]);
        return response()->json([$fav]);
    }

    public function insert()
    {
         $fav = ModelsFavourity::insert(
            [
                'profile_user_id' => Auth::user()->id
            ]
            );
            return response()->json([$fav]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function index_favourity()
    {
        $fav = fav_sub::all();
        return response()->json([$fav]);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function show(Request $request)
    {
        $fav = ModelsFavourity::where('id' , $request->id)->get('id');
        $favv = fav_sub::whereIn('favourity_id' , $fav)->get('sub_category_id');
        $sub_cat = sub_category::whereIn('id' , $favv)->get();
        return response()->json(['sub_cat' => $sub_cat]);
    }


}
