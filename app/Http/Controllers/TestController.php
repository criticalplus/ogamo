<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use App\Models\Nivel;
use App\Models\Planeta;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TestController extends Controller{

    public $sesion;
    public function index(){


        $this->sesion = Session::get('userData');

/*         //Actualizo produccion/consumo
        $planetaConsumo = Planeta::find($this->sesion['userPlaneta']['id'])->Niveles()->with('recursos', 'edificios')->get();
        $prodCons = array();

        foreach( $planetaConsumo as $nivel ){
            
            //dump($nivel->edificios->name);
            
            foreach( $nivel->recursos as $recurso ){
                
                if( $recurso->pivot->consumo > 0 ){
                    $prodCons[$recurso->name]['cons'][$nivel->edificios->name] = $recurso->pivot->consumo;
                }
                if( $recurso->pivot->produccion > 0 ){
                    $prodCons[$recurso->name]['prod'][$nivel->edificios->name] = $recurso->pivot->produccion;
                }

            }

        }
        
        $prodCons = collect($prodCons);

        dump($prodCons);
        exit(); */
        

        $planetaNiveles = Planeta::find($this->sesion['userPlaneta']['id'])->Niveles()->get();
        $edificios = Edificio::with('niveles.recursos')->get();

        $fechaAhora = Carbon::now()->setTimezone('Europe/Madrid');

        foreach ($edificios as $key=>$edificio){

            $nivel = 0;
            $segundosRestantes = null;
            $consumoActual = [];
            $consumoProx = [];
            $produccionActual = [];
            $produccionProx = [];

            foreach ($planetaNiveles as $planetaNivel){

                if ($planetaNivel['edificio_id'] == $edificio['id'] ){
                    if( $planetaNivel['pivot']['fin'] < $fechaAhora){
                        /* CONSTRUIDO */
                        $nivel = $planetaNivel['nivel'];
                    }else{
                        /* CONSTRUYENDO */
                        $fechaFin = \Carbon\Carbon::parse($planetaNivel['pivot']['fin'])->shiftTimezone('Europe/Madrid');
                        $segundosRestantes = $fechaAhora->diffInSeconds($fechaFin, false)+1;
                        $nivel = $planetaNivel['nivel']-1;
                    }
                    $tiempoFin = new Carbon($planetaNivel['pivot']['fin']);
                    $edificios[$key]['fechaFin'] = $tiempoFin->shiftTimezone('Europe/Madrid');
                }                
            }
        
            //Calculo consumo actual
            foreach( $edificio->niveles[ $nivel ]->recursos as $recurso){
                if( $recurso->pivot->consumo > 0 ){
                    $consumoActual[$recurso->id] = $recurso->pivot->consumo;
                }
            } 
            //Calculo consumo proximo
            foreach( $edificio->niveles[ ($nivel+1) ]->recursos as $recurso){
                if( $recurso->pivot->consumo > 0 ){
                    $consumoProx[$recurso->id] = $recurso->pivot->consumo;
                }
            } 
            //Calculo produccion actual
            foreach( $edificio->niveles[ $nivel ]->recursos as $recurso){
                if( $recurso->pivot->produccion > 0 ){
                    $produccionActual[$recurso->id] = $recurso->pivot->produccion;
                }
            } 
            //Calculo produccion proximo
            foreach( $edificio->niveles[ ($nivel+1) ]->recursos as $recurso){
                if( $recurso->pivot->produccion > 0 ){
                    $produccionProx[$recurso->id] = $recurso->pivot->produccion;
                }
            } 

            $edificios[$key]['nivelActual'] = $nivel;
            $edificios[$key]['segundosRestantes'] = $segundosRestantes;
            $edificios[$key]['consumoActual'] = $consumoActual;
            $edificios[$key]['consumoProx'] = $consumoProx;
            $edificios[$key]['produccionActual'] = $produccionActual;
            $edificios[$key]['produccionProx'] = $produccionProx;

        }
        
        $this->sesion['edificios'] = $edificios;

        dump($edificios->toArray());






    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
