<?php

namespace App\Http\Controllers;

use App\Models\evaluation as ModelsEvaluation;
use App\Models\evaluation_re;
use App\Models\fav_re;
use App\Models\re_mang_sys;
use Illuminate\Http\Request;

class evaluation extends Controller
{
    public function evaluation(Request $request)
    {
       $res = re_mang_sys::where('id' , $request->id)->value('id');
       $fav_re = fav_re::where('re_mang_sys_id' , $res)->get('favourity_id');

       for($i = 1 ; $i <= count($fav_re) ; $i++)
       {
        if(count($fav_re) <= 5 && count($fav_re) != 0)
        {
            ModelsEvaluation::insert([
                'love' => 1
            ]);
        }
       else if(count($fav_re) <= 10 && count($fav_re) > 5)
        {
            ModelsEvaluation::insert([
                'love' => 2
            ]);
        }
       else if(count($fav_re) <= 15 && count($fav_re) >10)
        {
            ModelsEvaluation::insert([
                'love' => 3
            ]);
        }

       }
    }


    public function evaluation_user(Request $request)
    {
       $res = re_mang_sys::where('id' , $request->id)->value('id');
       $eva = evaluation_re::insert([
        're_mang_sys_id' => $request->id,
        'love' => $request->love
       ]);
    }

    // static function evaluation_a(Request $request)
    // {

    //  $res = re_mang_sys::where('id' , $request->id)->value('id');
    //  $eva = evaluation_re::where('re_mang_sys_id' , $request->id)->get('love');

    // }




}
