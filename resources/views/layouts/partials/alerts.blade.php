{{-- CONTROL DE ERRORES Y MENSAJES FLASH --}}

@if( $error != null )

    @switch( $error )
    
        @case('recursos')                
        <x-css.alerta backColor="red" iconName="warning">
            {{ __('No hay recursos suficientes') }}
        </x-css.alerta>
        @break


        @case('class')                
        <div class="bg-red-300"></div>
        @break


            
    @endswitch

@endif