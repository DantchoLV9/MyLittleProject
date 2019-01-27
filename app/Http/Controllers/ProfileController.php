<?php

namespace App\Http\Controllers;

use App\Rules\SameNewPasswordValidationRule;
use App\Rules\PasswordCheckValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\User;
use Auth;

class ProfileController extends Controller
{

    function saveProfileDetails () {

        Auth::user()->save();

    }
    
    function updateProfile (Request $request) {

    if (Auth::user()) {

        if ($request["username"] != Auth::user()->username) {
            $this->validate($request,[
                'username'=>'required|string|max:255|unique:users'
            ]);
            Auth::user()->username = $request["username"];
        }

        if ($request["email"] != Auth::user()->email) {
            $this->validate($request, [
                'email'=>'required|string|email|max:255|unique:users'
            ]);
            Auth::user()->email = $request['email'];
        }

        if (!empty($request["password"])) {

            $this->validate($request, [
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'confirmed',
                    new SameNewPasswordValidationRule($request["password"]),
                ]
            ]);

        }

        if (!empty($request["current_password"])) {

            $this->validate($request, [
                'current_password' => [
                    'required',
                    'string',
                    'min:6',
                    new PasswordCheckValidationRule($request["current_password"]),
                ]
            ]);

            if (!empty($request['password'])) {

                Auth::user()->password = bcrypt($request["password"]);

            }

            $this -> saveProfileDetails();

        }
        elseif (!empty($request["username"]) || !empty($request["email"]) || !empty($request["password"]) && empty($request["current_password"])) {

            $this->validate($request, [
                'current_password'=>'required'
            ]);

        }

        $request->session()->flash('status', 'Changes successfully saved!');
        return redirect()->route('profile', ['username' => mb_strtolower(Auth::user()->username, 'UTF-8')]);

        }
        else {

        return redirect()->route('home');

        }

  }

    public function index($username)
    {

        if (Auth::check()) {

            if (!Auth::user()->hasVerifiedEmail()) {

                return redirect()->route('verification.notice');

            }

        }

        if (Str::lower($username) == Str::lower(Auth::user()->username)) {

            $ownProfilePage = true;

            return view('ownprofile');

        }
        else {

            $ownProfilePage = false;

            $user = User::where('username', $username)->first();

            $unEditedUsername = $user->username;
            $email = $user->email;
            $avatar = $user->avatar;

            return view('profile', ['username' => $unEditedUsername, 'email' => $email, 'avatar' => $avatar]);

        }

        
 
    }

}
