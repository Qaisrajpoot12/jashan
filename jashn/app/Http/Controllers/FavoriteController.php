<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\Event;
use App\Models\favorite;
use App\Models\orgnizer;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class FavoriteController extends Controller
{
    public function add_fav(Request $request, $event_id)
    {
        $event = Event::Where('id', $event_id)->first();


        if ($event) {
            $user = User::Where('id', $request->user_id)->first();

            if ($user) {

                $fav = favorite::create([
                    'event_id'=> $event->id,
                    'user_id'=> $request->user_id,
                        'status' => 1
                ]);
                return response()->json(['success'=>'Event added to your favorite list']);

            }
        }
    }



    public function remove_fav(Request $request, $event_id)
    {


        $event = Event::Where('id', $event_id)->first();

        if ($event) {
            $user = User::Where('id', $request->user_id)->first();

            if ($user) {

                $fav = favorite::Where('user_id',$user->id,)->where('event_id',$event_id)->get();
if(count($fav) == 1){
    $fav->delete();
}

                return $fav;
                $fav->delete();
                return response()->json(['success'=>'success']);

            }
        }
    }
}
