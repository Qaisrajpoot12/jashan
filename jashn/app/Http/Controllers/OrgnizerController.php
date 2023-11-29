<?php

namespace App\Http\Controllers;


use App\Models\orgnizer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class OrgnizerController extends Controller
{

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            'username'  => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $api_token =  base64_encode('api_key_secret_for_app');

            $user_check = orgnizer::where('email', $request->email)->first();
            $username_check = orgnizer::where('username', $request->username)->first();
            // dd($user_check->username);
            if ($user_check && $user_check->email == $request->email) {

                return response()->json(['errors' => 'User already exist with this email ']);
            } elseif ($username_check) {

                return response()->json(['errors' => 'User already exist with this username']);
            } else {

                $user = orgnizer::create([
                    'name'              => $request->name,
                    'username'           => $request->username,
                    'slug'           => $request->username,
                    'email'              => $request->email,
                    'password'           => Hash::make($request->password),
                    'api_token'          => $api_token,
                ]);
                return response()->json(['success' => 'User successfully created', 'result' => $user]);
            }
        }
    }

    public function edit(Request $request)
    {

        $api_token =  base64_encode('api_key_secret_for_app');


        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            'api_token'  => 'required',
            'login_token'  => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $api_token =  base64_encode('api_key_secret_for_app');
            $edit_user = orgnizer::where('email', $request->email)->first();

            if ($edit_user) {
                $edit_user->name = $request->name ? $request->name : $edit_user->name;
                $edit_user->email = $request->email ? $request->email : $edit_user->email;
                $edit_user->password = $request->password ? Hash::make($request->password) : $edit_user->password;
                $edit_user->username = $request->username ? $request->username : $edit_user->username;
                $edit_user->slug = $request->username ? $request->username : $edit_user->slug;
                $edit_user->update();
                return $edit_user;
            } else {
                return response()->json(['errors' => 'organizer not found']);
            }
        }
    }

    public function login(Request $request)
    {

        $api_token =  base64_encode('api_key_secret_for_app');


        $validator = Validator::make($request->all(), [
            // 'username'  => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            'api_token'  => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $api_token =  base64_encode('api_key_secret_for_app');
            $loginUser = orgnizer::where('email', $request->email)->first();

            if ($loginUser && $request->email == $loginUser->email && Hash::check($request->password, $loginUser->password)) {

                $loginUser->login_token = Hash::make($request->password);
                $loginUser->update();

                return response()->json(['success' => 'organizer successfully login', 'result' => $loginUser]);
            } else {
                return response()->json(['errors' => 'user not found']);
            }
        }
    }
}
