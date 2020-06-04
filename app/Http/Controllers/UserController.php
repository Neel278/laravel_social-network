<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Authenticated Login
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect('dashboard');
        } else {
            return redirect()->back();
        }
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    public function getDashboard()
    {
        return view('account', ['user' => Auth::user()]);
    }
    public function postSaveAccount(Request $request)
    {
        // validation
        $this->validate($request, [
            'first_name' => 'required|max:120'
        ]);
        // details fetch and update
        $user = Auth::user();
        $user->first_name = $request['first_name'];
        $user->update();
        // filename and file save
        $file = $request->file('image');
        $filename = $request['first_name'] . '-' . $user->id . '.jpg';
        // store image file
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        // redirect to account page
        return redirect()->route('account');
    }
}
