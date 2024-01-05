<?php

namespace App\Http\Controllers;

use App\Models\attend;
use App\Models\event;
use App\Models\profile_user as ModelsProfile_user;
use Illuminate\Http\Request;

class attended extends Controller
{
    public function attend(Request $request)
    {
        $attend = attend::where('profile_user_id' , $request->profile_user_id)->where('event_id' ,$request->event_id )->value('id');
        if($attend == null)
        {

        $n = attended::pay($request->profile_user_id , $request->event_id);

        if($n == true)
        {

        attend::insert([
            'profile_user_id' => $request->profile_user_id,
            'event_id' => $request->event_id
        ]);
    }
    else{
        return response()->json(['you can not attend you dont have a budget equel price event']);
    }

    }
    else{
        return response()->json(['you are attended this event pleas try agine']);
    }
    }

    public function pay($profile_user_id , $event_id)
    {
       $budget = ModelsProfile_user::where('id' , $profile_user_id)->value('budget');
       $price_event = event::where('id' , $event_id)->value('price');

      if($budget > $price_event || $budget == $price_event)
      {
        
       $b = $budget - $price_event;

       $id = ModelsProfile_user::where('id' , $profile_user_id)->value('id');

       $profile_user_id = ModelsProfile_user::find($id);
       $profile_user_id->budget = $b;
       $profile_user_id->save();

       return true;
      }
      else{
        return false;
      }

    }
}
