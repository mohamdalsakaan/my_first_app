<?php

namespace App\Http\Controllers;

use App\Models\order as ModelsOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\profile_user as ModelsProfile_user;

class order extends Controller
{
    public function index()
    {
        $order=ModelsOrder::all();

        return response()->json([
            'order' => $order

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
         'date'=>'required',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }

        $order = ModelsOrder::create([
            'date'=>$request->date,
            'profile_user_id'=>$request->profile_user_id,
            'table_id' => $request->table_id,
            're_mang_sys_id' => $request->re_mang_sys_id

        ]);

        return response()->json([
            'status'=> true,
            'order'=> $order
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
    public function show(Request $request)
    {
        $order = ModelsOrder::where('id',$request->id)->get();
        return response()->json([
            'order'=> $order
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
        $order = ModelsOrder::find($request->id);
        $order -> date= $request->date;

        $order->save();

        return response()->json([
            'status'=>true,
            'order'=>  $order
          ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $order = ModelsOrder::find($request->id);
        $order->delete();

        return response()->json([
            'status'=> true,
            'msg'=> 'deleted successfuly'
        ]);
    }




    /////////////////////////////////////////////

    public function review(Request $request)
    {

        $re_mang_sys = DB::table('re_mang_sys')->where('id' , $request->id)->value('id');



       $bookedd =  DB::table('bookedd')->whereDate('date',$request->date)->where('re_mang_sys_id' , $re_mang_sys)->get(['profile_user_id']);
        $orderr =  DB::table('order')->whereDate('date', $request->date)->where('re_mang_sys_id' , $re_mang_sys)->get(['profile_user_id']);
        /////////////////////////////////////////////////
        $order = DB::table('order')->whereDate('date', $request->date)->where('re_mang_sys_id' , $re_mang_sys)
        ->join('profile_user','profile_user.id','order.profile_user_id')->get('name');
        $booked = DB::table('bookedd')->whereDate('date' , $request->date)->where('re_mang_sys_id' , $re_mang_sys)
        ->join('profile_user','profile_user.id','bookedd.profile_user_id')->get('name');
          ///////////////////////////////////////////////
        $table_booked = DB::table('bookedd')->whereDate('date' , $request->date)->where('re_mang_sys_id' , $re_mang_sys)
        ->join('tables','tables.id','bookedd.table_id')->get(['table_id','time_booked']);

        $table_order = DB::table('order')->whereDate('date' , $request->date)->where('re_mang_sys_id' , $re_mang_sys)
        ->join('tables','tables.id','order.table_id')->get('table_id');
        /////////////////////////////////
        $owner = DB::table('re_mang_sys')->where('id' , $re_mang_sys)->value('owner_id');
        $co = DB::table('contract')->where('profile_owner_id' , $owner)->value('id');
        $emp = DB::table('emplyee')->where('contract_id' , $co)->get();



         return response()->json([
            'order' => $order,
            'booked' => $booked ,
            'table_booked'=> $table_booked,
            'table_order'=> $table_order,
            'num user have order' => count($orderr),
            'num user have booked' => count($bookedd),
            'emp' => $emp
        ]);




    }


    public function review_emp(Request $request)
    {

        $re_mang_sys = DB::table('re_mang_sys')->where('id' , $request->id)->value('id');



        $owner = DB::table('re_mang_sys')->where('id' , $re_mang_sys)->value('owner_id');
        $co = DB::table('contract')->where('profile_owner_id' , $owner)->value('id');
        $emp = DB::table('emplyee')->where('contract_id' , $co)->get();
        /////////////////////////////////////////////////
        $co = DB::table('contract')->where('profile_owner_id' , $owner)->get();


         return response()->json([

            'emp_contract' => [
              'emp' =>  $emp , 'contract' => $co
            ],


             ]);




    }




}
