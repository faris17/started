<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        try{
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'facebook_id'=> $user->id,
                        'password' => Hash::make('password')
                    ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }
        } catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
