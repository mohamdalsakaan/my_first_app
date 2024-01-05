<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\order_sub as ModelsOrder_sub;
use App\Models\sub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class order_sub extends Controller
{
    public function index()
    {
        $order_sub = ModelsOrder_sub::all();

        return response()->json([
            'order_sub' => $order_sub

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
            for($i = 0 ; $i < count($request->sub_cate_id) ; $i++)
            {
              $sub_cate_id[$i] = sub_category::where('id' , $request->sub_cate_id[$i])->value('id');
              $amount[$i] = $request->amount[$i];

            ModelsOrder_sub::insert([
          'sub_cate_id'=> $sub_cate_id[$i],
          'amount'=> $amount[$i],
          'order_id' => $request->order_id
            ]);
        }

            return response()->json(['succes']);
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
        $order_sub = ModelsOrder_sub::where('id',$request->id)->get();
        return response()->json([
            'order_sub'=> $order_sub
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
        $order_sub = ModelsOrder_sub::find($request->id);
        $order_sub -> amount= $request->amount;

        $order_sub->save();

        return response()->json([
            'status'=>true,
            'order_sub'=>  $order_sub
          ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $order_sub = ModelsOrder_sub::find($request->id);
        $order_sub->delete();

        return response()->json([
            'status'=> true,
            'msg'=> 'deleted successfuly'
        ]);
    }
}
