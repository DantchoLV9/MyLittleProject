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
    //Profile update form validation
    function updateProfile (Request $request) {

    //Get the current email of the user
    $currentEmail = Auth::user()->email;

    //Validation
    if (Auth::user()) {

        //Validate the username
        if ($request["username"] != Auth::user()->username) {
            $this->validate($request,[
                'username'=>'required|string|max:255|unique:users'
            ]);
            Auth::user()->username = $request["username"];
        }

        //Validate the email
        if ($request["email"] != Auth::user()->email) {
            $this->validate($request, [
                'email'=>'required|string|email|max:255|unique:users'
            ]);
            
            //Make email not verified
            Auth::user()->email_verified_at = NULL;
            Auth::user()->email = $request['email'];
        }

        //Validate the password
        if (!empty($request["password"])) {

            $this->validate($request, [
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    new SameNewPasswordValidationRule($request["password"]),
                ]
            ]);

        }

        //Validate the current password
        if (!empty($request["current_password"])) {

            $this->validate($request, [
                'current_password' => [
                    'required',
                    'string',
                    'min:8',
                    new PasswordCheckValidationRule($request["current_password"]),
                ]
            ]);

            if (!empty($request['password'])) {

                Auth::user()->password = bcrypt($request["password"]);

            }

            Auth::user()->save();

        }
        //ATTENTION - Check the logic below
        elseif (!empty($request["username"]) || !empty($request["email"]) || !empty($request["password"]) && empty($request["current_password"])) {

            $this->validate($request, [
                'current_password'=>'required'
            ]);

        }

        //Send a new confirmation email if the user changed their email
        if ($request['email'] != $currentEmail) {

            Auth::user()->sendEmailVerificationNotification();

        }

        //Status message and redirect to profile page
        $request->session()->flash('status', 'Changes successfully saved!');
        return redirect()->route('profile', ['username' => mb_strtolower(Auth::user()->username, 'UTF-8')]);

        }
        else {
        
        //Return to the home page if the user is not logged in
        return redirect()->route('home');

        }

  }

    //Returns the profile page of a specified user
    public function index($username = NULL)
    {

        //If a username isn't given use the username of the user sending the request
        if (empty($username)) {

            $username = Str::lower(Auth::user()->username);

        }

        //Check if the email of the user is verified
        if (Auth::check()) {

            if (!Auth::user()->hasVerifiedEmail()) {

                return redirect()->route('verification.notice');

            }

        }

        //Determine wheather the profile page of the user that send the request or the profile page of another user should be returned
        if (Str::lower($username) == Str::lower(Auth::user()->username)) {

            //ATTENTION - Probably should remove this
            $ownProfilePage = true;

            return view('ownprofile');

        }
        else {

            ///ATTENTION - Probably should remove this
            $ownProfilePage = false;

            $user = User::where('username', $username)->first();

            //If a user with that username doesn't exist return a 404 error page. Otherwise return the profile page of the specified user
            if (empty($user)) {

                return abort(404);
                
            }
            else {

                //Collect data for the requested user
                $unEditedUsername = $user->username;
                $email = $user->email;
                $avatar = $user->avatar;

                return view('profile', ['username' => $unEditedUsername, 'email' => $email, 'avatar' => $avatar]);

            }

        }

    }

}
