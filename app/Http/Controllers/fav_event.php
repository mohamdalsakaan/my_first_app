<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Models\fav_event as ModelsFav_event;
use App\Models\favourity;
use Illuminate\Http\Request;

class fav_event extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fav_event = ModelsFav_event::all();
        return response()->json([$fav_event]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function insert(Request $request)
    {
        ModelsFav_event::insert([
            'favourity_id'=>$request->favourity_id,
            'event_id'=>$request->event_id,
        ]);
    }


    public function show(Request $request)
    {
        $favv=ModelsFav_event::where('favourity_id' , $request->id)->get('event_id');
        $event = event::whereIn('id' , $favv)->get();
        return response()->json([$event]);
    }


}
