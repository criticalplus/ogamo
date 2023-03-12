<?php

namespace App\Http\Livewire;

use App\Models\Edificio;
use App\Models\Planeta;
use App\Models\Sistema;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class MainLive extends Component{

    public $p = 1;
    public $sesion;
    public $error = null;
    public $construyendo = false;

    protected $listeners = ['menu'];
    
    public function mount(){

        //Agrego la variable de sesion a $this->sesion
        $this->sesion = Session::get('userData');

    }

    public function render(){
        
        //Cada actualización actualizo recursos del planeta activo
        $planetaRecursos = Planeta::find($this->sesion['userPlaneta']['id'])->Recursos()->get();
        $this->sesion['planetaRecursos'] = $planetaRecursos;

        //Actualizo produccion/consumo
        $planetaConsumo = Planeta::find($this->sesion['userPlaneta']['id'])->Niveles()->with('recursos', 'edificios')->get();



        return view('livewire.main')->with('sesion', $this->sesion)->with('p',  $this->p);

    }

    public function menu( $p=1 ){

        $this->p = $p;

        switch ($p) {

            case 1:
                                 
                $planetaEdificios = Planeta::find($this->sesion['userPlaneta']['id'])->Niveles()->with('recursos', 'edificios')->get();
                $this->sesion['planetaNiveles'] = $planetaEdificios; 
                break;

            case 2:
                $planetasSistema = Planeta::where('sistema_id', $this->sesion['planetaSistema']['id'])->get();
                $this->sesion['sistemaPlanetas'] = $planetasSistema;                
                break;
            
            case 3:
                $sistemasGalaxia = Sistema::where('galaxia_id', $this->sesion['planetaSistema']['galaxia_id'])->get();
                $this->sesion['sistemasGalaxia'] = $sistemasGalaxia;                
                break;

            case 4:
                

                $planetaNiveles = Planeta::find($this->sesion['userPlaneta']['id'])->Niveles()->get();
                $edificios = Edificio::with('niveles.recursos')->get();
                $this->construyendo = false;
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
                                $this->construyendo = true;
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
                break;
    
        }


    }


    
    public function mejorar( $edificio_id, $nivelActual ){

        $recursosSuficientes = true;
        $planetaOBJ = Planeta::where( 'id', $this->sesion['userPlaneta']['id'] )->with('recursos', 'niveles')->first();
        $edificios = $this->sesion['edificios'];

        foreach( $edificios as $edificio){
            if( $edificio['id'] == $edificio_id AND $edificio['nivelActual'] == $nivelActual ){
                
                foreach( $edificio['niveles'][ ($nivelActual+1) ]['recursos'] as $recurso ){

                    if( $recurso['pivot']['coste'] !== NULL ){

                        foreach( $this->sesion['planetaRecursos'] as $recursoPlaneta ){

                            if( $recursoPlaneta['pivot']['recurso_id'] === $recurso['pivot']['recurso_id'] ){
                                if( $recursoPlaneta['pivot']['cantidad'] < $recurso['pivot']['coste'] ){
                                    /* ERROR NO HAY SUFICIENTE RECURSOS */
                                    $recursosSuficientes = false;
                                }
                                break;
                            }

                        }

                    }

                }

                if( $recursosSuficientes ){

                    //RESTO RECURSOS
                    foreach( $planetaOBJ->recursos as $planetaRecurso ){

                        foreach( $edificio['niveles'][ ($nivelActual+1) ]['recursos'] as $recurso ){
                            if( ($recurso['pivot']['coste'] !== NULL) AND ($recurso['id'] == $planetaRecurso->id) ){

                                $planetaRecurso->pivot->cantidad = $planetaRecurso->pivot->cantidad - $recurso['pivot']['coste'];

                            }
                        }

                    }
                    $planetaOBJ->push();

                    //MODIFICO EDIFICIO
                    if( $planetaOBJ->niveles->firstWhere('edificio_id', $edificio_id ) == NULL ){
                        //si todavia no existe relacion creada entre planeta y nivel 0 lo creo
                        $edificio = collect($edificios)->where('id', $edificio_id )->first();
                        $nivelCero = collect($edificio['niveles'])->where('nivel', ($nivelActual) )->first();                        
                        $nivelAttach = $planetaOBJ->niveles()->attach($nivelCero['id'], ['fin' => Carbon::now()->setTimezone('Europe/Madrid')->format('Y-m-d H:i:s.u')]);
                        $planetaOBJ->niveles->push($nivelAttach);
                    }
                    $planetaOBJ = Planeta::where( 'id', $this->sesion['userPlaneta']['id'] )->with('recursos', 'niveles')->first();
                    $nivelActualObj = $planetaOBJ->niveles->firstWhere('edificio_id', $edificio_id );
                    $nivelNuevo = collect($edificio['niveles'])->where('edificio_id', $edificio_id)->where('nivel', ($nivelActualObj->nivel+1) )->first();

                    $nivelActualObj->pivot->fin = Carbon::now()->setTimezone('Europe/Madrid')->addSecond( $nivelNuevo['tiempo'] )->format('Y-m-d H:i:s.u');
                    
                    $planetaOBJ->niveles()->detach($nivelActualObj->id);
                    $planetaOBJ->niveles()->attach($nivelNuevo['id'], ['fin' => $nivelActualObj->pivot->fin]);



                }else{
                    /* ERROR NO HAY SUFICIENTE RECURSOS */ 
                    $this->emit('error');   
                    $this->error = 'recursos';
                }
                
                break;

            }
            
            
        }
        
        $this->menu(4);



    }


}