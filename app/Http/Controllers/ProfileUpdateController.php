<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function changeName(Request $request)
    {
        $request->validate([
            "name" => 'required'
        ]);
        $user = User::whereId($request->id)->first();
        $user->name = $request->name;
        $user->save();
        return $user;
    }
    public function changePassword(Request $request)
    {
        //validate the request
        $request->validate([
            'password' => 'required|confirmed'
        ]);


        if(!$user || !Hash::check($request->old_password, $user->password)){
            retrun response()->json(['old_password'=>"old password not matched"],422);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return true;
    }
}
