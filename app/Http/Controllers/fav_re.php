<?php

namespace App\Http\Controllers;

use App\Models\fav_re as ModelsFav_re;
use App\Models\favourity as ModelsFavourity;
use App\Models\re_mang_sys;
use Illuminate\Http\Request;

class fav_re extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function insert(Request $request)
    {
       ModelsFav_re::insert([
        'favourity_id' => $request->favourity_id,
        're_mang_sys_id' => $request->re_mang_sys_id
       ]);
    }



    public function show(Request $request)
    {
        $fav = ModelsFavourity::where('id' , $request->id)->get('id');
        $favv = ModelsFav_re::whereIn('favourity_id' , $fav)->get('re_mang_sys_id');
        $re_mang_sys = re_mang_sys::whereIn('id' , $favv)->get();
        return response()->json(['re_mang_sys' => $re_mang_sys]);
    }

}
