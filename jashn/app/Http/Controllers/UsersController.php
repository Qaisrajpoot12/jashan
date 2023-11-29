<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        return 'working...';
    }


    public function create(Request $request)
    {
        // dd($request->username);
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email'     => 'required|email',
            'password'  => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $api_token =  base64_encode('api_key_secret_for_app');

            $user = User::create([
                'name'              => $request->name,
                'username'           => $request->username,
                'email'              => $request->email,
                'password'           => Hash::make($request->password),
                'api_token'          => $api_token,
            ]);

            return $user;
        }
    }

    public function edit(Request $request)
    {

        $api_token =  base64_encode('api_key_secret_for_app');


        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            // 'api_token'  => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $api_token =  base64_encode('api_key_secret_for_app');
            $edit_user = User::where('email', $request->email)->first();

            if ($edit_user) {
                $edit_user->name = $request->name ? $request->name : $edit_user->name;
                $edit_user->email = $request->email ? $request->email : $edit_user->email;
                $edit_user->password = $request->password ? Hash::make($request->password) : $edit_user->password;
                $edit_user->username = $request->username ? $request->username : $edit_user->username;
                $edit_user->update();
                return $edit_user;
            } else {
                return response()->json(['errors' => 'user not found']);
            }
        }
    }

    public function login(Request $request)
    {

        $api_token =  base64_encode('api_key_secret_for_app');


        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            'api_token'  => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $api_token =  base64_encode('api_key_secret_for_app');
            $loginUser = User::where('email', $request->email)->first();

            if ($loginUser && $request->email == $loginUser->email && Hash::check($request->password, $loginUser->password)) {

                $loginUser->login_token = Hash::make($request->password);
                $loginUser->update();

                return response()->json(['success' => 'user successfully login','result'=>$loginUser]);

            } else {
                return response()->json(['errors' => 'user not found']);
            }
        }
    }
}
