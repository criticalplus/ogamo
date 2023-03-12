<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserData;
use App\Models\Planeta;
use App\Models\Sistema;
use App\Models\Universo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UnirseController extends Controller{

    public function index(){

        $data = Universo::all();
        return view('universoSelector', ['data' => $data]);

    }

    public function unirse($id){

        $userid = Auth::id(); 
        $user = User::find($userid);
        
        $userData = new UserData();
        $userData->universo_id = $id;
        $userData->user_id = $userid;
        $user->userData()->save($userData);

        $planeta = Planeta::where('user_id', NULL)
                        ->where('universo_id', $id)
                        ->inRandomOrder()->first();
        $planeta->user_id = $userid;

        $planeta->Recursos()->attach( 1, ['cantidad' => 500] );     //Añado recursos al planeta inicial
        $planeta->Recursos()->attach( 2, ['cantidad' => 250] );

        $planeta->save();        
        
        $this->setSession($userData);

        return redirect(route('dashboard'));

    }


    public static function setSession( $userData ){

        $uni = Universo::find($userData->universo_id);

        $planeta = Planeta::where('user_id', $userData->user_id)->where('universo_id', $userData->universo_id)->first();

        $recursoPlaneta = $planeta->Recursos()->get();

        $sistema = Sistema::where('id', $planeta->sistema_id)->first();

        $data = [
            'userData' => $userData,
            'userUniverso' => $uni,
            'userPlaneta' => $planeta,
            'planetaSistema' => $sistema,
            'planetaRecursos' => $recursoPlaneta,
        ];

        Session::put('userData', $data);
        

    }

}
