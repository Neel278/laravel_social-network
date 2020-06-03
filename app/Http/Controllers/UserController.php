<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function postSignUp(Request $request)
    {
        // validation
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:120',
            'password' => 'required|min:4'
        ]);
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

        // Authenticating user
        Auth::login($user);

        return redirect()->route('dashboard');
    }
    public function postSignIn(Request $request)
    {
        //validation

        // Authenticated Login
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect('dashboard');
        } else {
            return redirect()->back();
        }
    }
}
