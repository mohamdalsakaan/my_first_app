<?php

namespace App\Http\Controllers;

use App\Models\invoice as ModelsInvoice;
use App\Models\order_sub;
use App\Models\sub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\profile_user as ModelsProfile_user;

class invoice extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_invoice()
    {
        $invoice = ModelsInvoice::all();

        return response()->json([
            'invoice' => $invoice

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */


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
    public function show_invoice(Request $request)
    {
        $invoice = ModelsInvoice::where('id',$request->id)->get();
        return response()->json([
            'invoice'=> $invoice
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
    public function update_invoice(Request $request)
    {
        $invoice = ModelsInvoice::find($request->id);
        $invoice -> price_all= $request->price_all;
        $invoice -> date = $request->date;

        $invoice->save();

        return response()->json([
            'status'=>true,
            'invoice'=>  $invoice
          ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_invoice(Request $request)
    {
        $invoice = ModelsInvoice::find($request->id);
        $invoice->delete();

        return response()->json([
            'status'=> true,
            'msg'=> 'deleted successfuly'
        ]);
    }

    public function invoice(Request $request)
    {

           $price_all = 0;
          for($i = 0 ; $i < count($request->sub_category) ; $i++)
          {
            $price[$i] = sub_category::where('id' , $request->sub_category[$i])->value('price');
            $amount[$i] = order_sub::where('sub_cate_id' , $request->sub_category[$i])->value('amount');
            $price_al[$i] = $price[$i] * $amount[$i];

            $price_all = $price_all + $price_al[$i];
          }
          ModelsInvoice::insert([
        'order_id'=>$request->order_id,
        'price_all'=>$price_all,
        'date' => $request->date
          ]);
          return response()->json([$price_all]);

    }

    public function date(Request $request)
    {


      $date =ModelsInvoice::whereBetween('date' , [$request->start_date , $request->end_date])->get(['order_sub_id' , 'price_all' , 'date']);
      return response()->json([$date]);


    }

    public function pay_order(Request $request)
    {
       $budget = ModelsProfile_user::where('id' , $request->profile_user_id)->value('budget');
       $price_all = 0;
       for($i = 0 ; $i < count($request->sub_category) ; $i++)
       {
         $price[$i] = sub_category::where('id' , $request->sub_category[$i])->value('price');
         $amount[$i] = order_sub::where('sub_cate_id' , $request->sub_category[$i])->value('amount');
         $price_al[$i] = $price[$i] * $amount[$i];

         $price_all = $price_all + $price_al[$i];
       }
       if($budget > $price_all || $budget == $price_all)
       {
        $budget = $budget -$price_all ;
        $profile_user = ModelsProfile_user::find($request->profile_user_id);
        $profile_user->budget = $budget;
        $profile_user->save();

        return response()->json([true]);
       }
       else{
        return response()->json([false]);
       }


    }
}
