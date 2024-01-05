<?php

namespace App\Triste ;

trait Api_Response
{

   static function ResponseSucces($massge , $data)
 {
    return response()->json([
        'status' => true,
        'massge' => $massge,
        'data' => $data
    ]);
 }


}
