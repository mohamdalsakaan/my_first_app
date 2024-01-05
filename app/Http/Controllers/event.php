<?php

namespace App\Http\Controllers;

use App\Models\event as ModelsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class event extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_event()
    {
        $event = ModelsEvent::all();
        return response()->json([
            'event'=> $event
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_event(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'date'=>'required',
            'num_attenders'=>'required',
            'price'=>'required',
            'artist'=>'required',
            'name'=> 'required',
            'description' => 'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }
        $event = ModelsEvent::create([
          'date'=>$request->date,
          'description' => $request->description,
          'name' => $request->name,
          'num_attenders'=>$request->num_attenders,
          'price'=>$request->price,
          'artist'=>$request->artist,
          're_mang_sys_id'=>$request->re_mang_sys_id,
        ]);


        return response()->json([
            'status'=> true,
            'event'=> $event
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
    public function show_event(Request $request)
    {
        $event = ModelsEvent::where('id',$request->id)->get();
        return response()->json([
            'event'=> $event
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
    public function update_event(Request $request)
    {
        $event = ModelsEvent::find($request->id);
        $event -> price= $request->price;
        $event -> artist= $request->artist;
        $event -> num_attenders= $request->num_attenders;
        $event -> date = $request->date;

        $event->save();

        return response()->json([
            'status'=>true,
            'event'=>  $event
          ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_event(Request $request)
    {
        $event = ModelsEvent::find($request->id);
        $event->delete();

        return response()->json([
            'status'=> true,
            'msg'=> 'deleted successfuly'
        ]);
    }


    public function searchbydate_event(Request $request)
    {
        $search = $request->date;
        $event = DB::table('event')->whereDate('date' , 'LIKE' , '%'.$search.'%')->get();
        return response()->json([$event]);
    }

    public function searchbyartist_event(Request $request)
    {
        $search = $request->artist;
        $event = DB::table('event')->where('artist' , 'LIKE' , '%'.$search.'%')->get();
        return response()->json([$event]);
    }
}
