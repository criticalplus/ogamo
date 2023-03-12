<style>
    img{
        margin: 0 auto;
    }
</style>
<div class="max-w-7xl mx-auto sm:px-2 lg:px-4 mb-2">
                        
                CONSTRUCCIÓN 


    <div class="grid grid-cols-4 gap-2">

        @foreach ($sesion['edificios'] as $edificio)

            <div class="bg-gray-200 p-2">

                <span class="text-xs font-bold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1" style="float: left;position: absolute;">
                    {{$edificio['nivelActual']}}
                </span>


                <div class="flex flex-col items-center justify-between h-full">
                    <div class="flex flex-col items-center" style="margin-top: 30px;">
                        <h3 class="text-lg">{{$edificio['name']}}</h3>
                        <img src="/images/minas/100{{$edificio['photo_path']}}" width="100" height="100" title="{{$edificio['name']}}">

                        {{-- PRODUCCION --}}
                        <div>
                            @if( $edificio['produccionActual'] != NULL OR $edificio['produccionProx'] != NULL )
                                <h6 class="font-bold">Producción</h6>

                                @foreach ($edificio['niveles'][ ($edificio['nivelActual']) ]['recursos'] as $key=>$recurso)
                                    @if($recurso['pivot']['produccion'] >= 0 AND $recurso['pivot']['produccion'] !== NULL)
                                        <img src="/images/recursos/50{{$recurso['photo_path']}}" width="50" height="50" title="{{$recurso['name']}}" />
                                        {{$recurso['pivot']['produccion']}} 
                                    @endif
                                    @if($edificio['niveles'][ ($edificio['nivelActual']+1) ]['recursos'][$key]['pivot']['produccion'] >= 0 AND $edificio['niveles'][ ($edificio['nivelActual']+1) ]['recursos'][$key]['pivot']['produccion'] !== NULL)
                                        ->
                                        {{$edificio['niveles'][ ($edificio['nivelActual']+1) ]['recursos'][$key]['pivot']['produccion']}} 
                                    @endif

                                @endforeach
                            @endif

                        </div>

                        {{-- CONSUMO --}}
                        <div>

                            @if( $edificio['consumoActual'] != NULL OR $edificio['consumoProx'] != NULL )
                                <h6 class="font-bold">Consumo</h6>

                                @foreach ($edificio['niveles'][ ($edificio['nivelActual']) ]['recursos'] as $key=>$recurso)
                                    @if($recurso['pivot']['consumo'] >= 0 AND $recurso['pivot']['consumo'] !== NULL)
                                        <img src="/images/recursos/50{{$recurso['photo_path']}}" width="50" height="50"  title="{{$recurso['name']}}"  />
                                        {{$recurso['pivot']['consumo']}} 
                                    @endif
                                    @if($edificio['niveles'][ ($edificio['nivelActual']+1) ]['recursos'][$key]['pivot']['consumo'] >= 0 AND $edificio['niveles'][ ($edificio['nivelActual']+1) ]['recursos'][$key]['pivot']['consumo'] !== NULL)
                                        ->
                                        {{$edificio['niveles'][ ($edificio['nivelActual']+1) ]['recursos'][$key]['pivot']['consumo']}} 
                                    @endif

                                @endforeach
                            @endif

                        </div>
                    </div>


                    <div class="flex flex-col items-center">                        

                        @if( $edificio['segundosRestantes'] == NULL )
                            {{-- COSTE MEJORA --}}
                            <div class="text-center">
                                <h6 class="font-bold">Mejora a nivel {{($edificio['nivelActual']+1)}}</h6>
                                <div style="display: flex;text-align: center;gap: 5px; justify-content: center;">
                                    <div>
                                        <img src="/images/recursos/50/tiempo.png" width="25" height="25"  title="Tiempo de construcción" />
                                        {{$edificio['niveles'][ ($edificio['nivelActual']+1) ]['tiempo']}} 
                                    </div>
                                    @foreach ($edificio['niveles'][ ($edificio['nivelActual']) ]['recursos'] as $key=>$recurso)
                                        @if($edificio['niveles'][ ($edificio['nivelActual']+1) ]['recursos'][$key]['pivot']['coste'] >= 0 AND $edificio['niveles'][ ($edificio['nivelActual']+1) ]['recursos'][$key]['pivot']['coste'] !== NULL)
                                            <div>
                                                <img src="/images/recursos/50{{$recurso['photo_path']}}" width="25" height="25"  title="{{$recurso['name']}}" />
                                                {{$edificio['niveles'][ ($edificio['nivelActual']+1) ]['recursos'][$key]['pivot']['coste']}} 
                                            </div>
                                        @endif

                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <button class="bg-green-500 hover:bg-green-700 text-white  disabled:bg-green-200 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                                        wire:click="mejorar({{$edificio['id']}},{{$edificio['nivelActual']}})"
                                        @if($construyendo) disabled @endif
                                        >Mejorar</button>
                            </div>
                        @else
                            <div>
                                <span class="font-bold">Tiempo Restante</span>
                                <x-countdown :expires="$edificio['fechaFin']" class="text-center"/>
                            </div>

                        @endif
                    </div>

                    
                </div>

               

            </div>

            
        @endforeach

    </div>


</div>