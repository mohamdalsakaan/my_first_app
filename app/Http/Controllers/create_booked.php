<?php

namespace App\Http\Controllers;

use App\Models\booked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\date as ModelsDate;
use App\Models\table;
use App\Models\time_booked;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class create_booked extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booked=booked::all();

        return response()->json([
            'booked' => $booked

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $booked = booked::insert([
            'profile_user_id'=>$request->profile_user_id,
            'table_id'=>$request->table_id,
            'date' => $request->date,
            'time_booked' => $request->time_booked

        ]);

        return response()->json([
            'status'=> true,
            'booked'=> $booked
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */




    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $booked = booked::where('id', $request->id)->get();
        return response()->json([
            'booked'=> $booked
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
    public function update(Request $request)
    {
        $booked = booked::find($request->id);
        $booked ->table_id = $request->table_id;

        $booked->save();

        return response()->json([
            'status'=>true,
            'booked'=>  $booked
          ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $booked = booked::find($request->id);
        $booked->delete();

        return response()->json([
            'status'=> true,
            'msg'=> 'deleted successfuly'
        ]);
    }

    public function booked(Request $request)
    {
        $table = table::where('id' , $request->id)->value('id');

        $booked = booked::where('table_id' , $table)->where('date' , $request->date)->value('id');
        $time_booked = time_booked::where('table_id' , $table)->where('date' , $request->date)->value('id');


        if($booked == null && $time_booked == null )
        {

                 booked::insert([
                'table_id' => $request->id,
                'profile_user_id' => $request->profile_user_id,
                'time_booked' => $request->time_booked,
                'date' => $request->date,
                're_mang_sys_id' => $request->re_mang_sys_id

            ]);

            $time_booked = create_booked::time_booked($request->date , $request->time_booked , $request->id);

            return response()->json(['booked succesfully']);
        }
        else{
            return response()->json(['the table is booked try agine for another table or another time']);
        }
    }


static function time_booked($date , $time_booked , $id)
{

    $dt = Carbon::create($date);
    $dt->addHours($time_booked);

     time_booked::insert([
        'date' => $dt,
        'table_id' => $id

    ]);
         for($i = 1 ; $i <$time_booked ; $i++)
            {
                $dt->subHour(1);
                time_booked::insert([
                    'date' => $dt,
                    'table_id' => $id
                ]);
            }

}
}



