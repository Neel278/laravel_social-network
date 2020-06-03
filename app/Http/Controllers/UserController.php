<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function postSignUp(Request $request)
    {
        // validation

        // fetching info from signup form
        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']);

        // saving data in user table
        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $password;
        $user->save();
        return redirect()->route('home');
    }
}
