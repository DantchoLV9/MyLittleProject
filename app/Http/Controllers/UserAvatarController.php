<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;
use Auth;

class UserAvatarController extends Controller
{
    public function resetUserAvatar (Request $request) {

        //Check if old avatar file should be deleted
        if (Auth::user()->avatar != 'default.jpg') {

            //Delete old avatar file
            Storage::delete('public/avatars/' . Auth::user()->avatar);
            
            //Change avatar path in db to the default
            Auth::user()->avatar = 'default.jpg';
            Auth::user()->save();

        }

        //Status message
        $request->session()->flash('status', 'Avatar reset successfully!');
        
    }
    
    public function updateUserAvatar (Request $request) {

        //Check if avatar should be reset
        if ($request["reset"]) {

            //Call the avatar reset function
            $this -> resetUserAvatar ($request);

        }
        
        if ($request->hasFile('avatar')) {

            //Generate a file, crop it, generate a path, store it
            $userUpload = $request->file('avatar');

            //Check Extension Doesn't Work
            /*$extension = $userUpload->extension();

            if ($extension != 'jpeg' || $extension != 'png' || $extension != 'gif' || $extension != 'webp') {

                $request->session()->flash('error', 'The uploaded file is not supported. Supported file types are: JPEG, PNG, GIF and WebP!');
                return redirect()->route('profile', ['username' => mb_strtolower(Auth::user()->username, 'UTF-8')]);

            }*/

            $fileName = Auth::user()->username . time() . '.' . $userUpload->getClientOriginalExtension();
            $height = Image::make($userUpload)->height();
            $avatar = Image::make($userUpload)->crop($height, $height);
            $avatarPath = 'public/avatars/' . $fileName;

            //Check if the avatars folder exists inside storage/public and create it if it doesn't
            if (!Storage::disk('local')->exists('public/avatars')) {

                Storage::makeDirectory('public/avatars');

            }

            Storage::put($avatarPath, $avatar->stream());

            //Check if old avatar file should be deleted
            if (Auth::user()->avatar != "default.jpg") {

                //Delete old avatar file
                Storage::delete('public/avatars/' . Auth::user()->avatar);

            }
            
            //Store new avatar path in db
            Auth::user()->avatar = $fileName;
            Auth::user()->save();

            //Status message
            $request->session()->flash('status', 'Avatar saved successfully!');

        }
        
        //Redirect to profile page
        return redirect()->route('profile', ['username' => mb_strtolower(Auth::user()->username, 'UTF-8')]);

    }
}
