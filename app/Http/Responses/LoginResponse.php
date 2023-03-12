<?php

namespace App\Http\Responses;

use App\Http\Controllers\UnirseController;
use App\Models\UserData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract{
    
    public function toResponse($request){
        
        $id = Auth::id(); 
        $userData = UserData::where('user_id', $id)->first();

        if( $userData == NULL ){

            return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect(route('indexUni'));
    
        }else{

            UnirseController::setSession($userData);

            return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(config('fortify.home'));

        }
        
        
    }

}