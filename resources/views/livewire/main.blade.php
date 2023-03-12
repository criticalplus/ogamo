<div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                



            @isset($sesion)

                <div class="flex gap-2 text-center justify-center p-2 bg-gray-200">
                    @foreach ($sesion['planetaRecursos'] as $recurso)
                        <span class="flex flex-col items-center">
                            <img src="/images/recursos/50{{$recurso['photo_path']}}" width="50" height="50" title="{{$recurso['name']}}" />
                            <span class="p-2">{{ number_format($recurso['pivot']['cantidad'], 0)}}</span>
                        </span>
                    @endforeach
                </div>

            @endisset

            @include('layouts.partials.alerts')

            
            <div class="py-12 grid grid-cols-12 overflow-hidden">
            
                <div class="md:col-span-3 col-span-12 bg-white shadow-xl sm:rounded-lg sm:mx-1 lg:mx-2">
                    @include('livewire.partials.menu')
                </div>

                <div class="md:col-span-9 col-span-12 bg-white shadow-xl sm:rounded-lg sm:mx-1 lg:mx-2">
                    @switch($p)
                    
                        @case(1)
                            @include('livewire.partials.planeta')
                            @break
                    
                        @case(2)
                            @include('livewire.partials.sistema')
                            @break
                
                        @case(3)
                            @include('livewire.partials.galaxia')
                            @break

                        @case(4)
                            @include('livewire.partials.construir')
                            @break

                    @endswitch
                </div>


            </div>



            @foreach( $sesion as $key=>$dat)
                {{$key}}
                @dump($dat)
            @endforeach
          


            </div>
        </div>
    </div>

</div>