

                    {{-- COSTE --}}
                    <div>
                        <h6 class="font-bold">Coste</h6>
                        @foreach ($edificio['niveles'][$nivel]['recursos'] as $recurso)
                            @if($recurso['pivot']['coste']>0)
                                {{$recurso['name']}}:   {{$recurso['pivot']['coste']}} 
                            @endif
                        @endforeach
                    </div>
                    {{-- CONSUMO --}}
                    <div>
                        <h6 class="font-bold">Consumo</h6>
                        @foreach ($edificio['niveles'][$nivel]['recursos'] as $recurso)
                            @if($recurso['pivot']['consumo']>0)
                                {{$recurso['name']}}:   {{$recurso['pivot']['consumo']}} 
                            @endif
                        @endforeach
                    </div>