<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Hash;
use Auth;

class ChangePasswordController extends Controller
{

public function changepassword(Request $request){
 
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('password'), $request->get('password1')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $validatedData = $request->validate([
            'password' => 'required',
            'password1' => 'required|string|min:6|',
        ]);
        if ($request["password1"] === $request["password_confirmation"]) 
            {
   
            }
            else    {
                      die ("New Password Can Not Match With Confirmed Password :(");
                    }


 
        //Change Password
        $users = Auth::user();
        $users->password = bcrypt($request->get('password1'));
        $users->save();
 
        return redirect()->back()->with("success","Password changed successfully !");
 
    }
     public function showchangepassword(){
        return view('/changepassword');
    }

     public function __construct()
    {
        $this->middleware('auth');
    }

    
}