<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\orgnizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function create_event(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name'  => 'required',
            'description'     => 'required',
            'organizer_id'  => 'required',
            'event_start_date'  => 'required',
            'event_end_date'  => 'required',
            'country'  => 'required',
            'city'  => 'required',
            'event_slug' => 'required',
            'profile_img' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $check_event_name =   Event::Where('event_name', $request->event_name)->first();
            if (!$check_event_name) {


                $event = Event::create([
                    "event_name" => $request->event_name,
                    "cover_img" => $request->cover_img,
                    "profile_img" => $request->profile_img,
                    "banner_img" => $request->banner_img,
                    "description" => $request->description,
                    "organizer_id" => $request->organizer_id,
                    "event_slug" => $request->event_slug,
                    "country" => $request->country,
                    "city" => $request->city,
                    "event_start_date" => $request->event_start_date,
                    "event_end_date" => $request->event_end_date,
                    "fb_link" => $request->fb_link,
                    "tw_link" => $request->tw_link,
                    "sk_link" => $request->sk_link,
                    "what_link" => $request->what_link,
                    "linkedin_link" => $request->linkedin_link,
                    "other_link" => $request->other_link,
                ]);

                return $event;
            } else {
                return response()->json(['errors' => 'Plz change your event name ']);
            }
        }
    }



    public function edit_event(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'organizer_id'  => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $orgnizer = orgnizer::where('id', $request->organizer_id)->first();
            $event_check = Event::where('id', $request->id)->first();

            if ($orgnizer && $event_check && $orgnizer->id == $event_check->organizer_id) {



                $event_check->event_name = $request->event_name ? $request->event_name : $event_check->event_name;
                $event_check->cover_img = $request->cover_img ? $request->cover_img : $event_check->cover_img;
                $event_check->profile_img = $request->profile_img ? $request->profile_img : $event_check->profile_img;
                $event_check->banner_img = $request->banner_img ? $request->banner_img : $event_check->banner_img;
                $event_check->description = $request->description ? $request->description : $event_check->description;
                $event_check->organizer_id = $request->organizer_id ? $request->organizer_id : $event_check->organizer_id;
                $event_check->event_slug = $request->event_slug ? $request->event_slug : $event_check->event_slug;
                $event_check->country = $request->country ? $request->country : $event_check->country;
                $event_check->city = $request->city ? $request->city : $event_check->city;
                $event_check->event_start_date = $request->event_start_date ? $request->event_start_date : $event_check->event_start_date;
                $event_check->event_end_date = $request->event_end_date ? $request->event_end_date : $event_check->event_end_date;
                $event_check->fb_link = $request->fb_link ? $request->fb_link : $event_check->fb_link;
                $event_check->tw_link = $request->tw_link ? $request->tw_link : $event_check->tw_link;
                $event_check->sk_link = $request->sk_link ? $request->sk_link : $event_check->sk_link;
                $event_check->what_link = $request->what_link ? $request->what_link : $event_check->what_link;
                $event_check->linkedin_link = $request->linkedin_link ? $request->linkedin_link : $event_check->linkedin_link;
                $event_check->other_link = $request->other_link ? $request->other_link : $event_check->other_link;
                $event_check->update();



                return response()->json(['success' => 'event Successfully updated', 'result' => $event_check]);
            } else {
                return response()->json(['errors' => 'event not found']);
            }
        }
    }




    public function delete_event(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'organizer_id'  => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $orgnizer = orgnizer::where('id', $request->organizer_id)->first();
            $event_check = Event::where('id', $request->id)->first();

            if ($orgnizer && $event_check && $orgnizer->id == $event_check->organizer_id) {

                $event_check->delete();

                return response()->json(['success' => 'event Successfully deleted']);
            } else {
                return response()->json(['errors' => 'event not found']);
            }
        }
    }


    public function get_event(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'organizer_id'  => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $orgnizer = orgnizer::where('id', $request->organizer_id)->first();
            $event_check = Event::where('organizer_id', $request->organizer_id)->get();

            if ($event_check) {



                return response()->json(['success' => 'success','result'=> $event_check]);
            } else {
                return response()->json(['errors' => 'event not found']);
            }
        }
    }



    public function get_all_event(Request $request)
    {

        $event_check = Event::all();

        if ($event_check) {

            return response()->json(['success' => 'success','result'=> $event_check]);


        } else {
            return response()->json(['errors' => 'event not found']);
        }
    }


}
