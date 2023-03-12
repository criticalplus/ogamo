
<div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
        
    SISTEMA
    <br>
    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap">

            <thead>                
                <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                    <td>
                        <div class="ml-5">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2"> ID</p>
                            </div>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2"> Nombre</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2"> Posición</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2"> Habitable</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2"> Atmosfera</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2"> Tipo</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2"> Bioma</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2"> Tamaño</p>
                        </div>
                    </td>
                    <tr class="h-3"></tr>
            </thead>

            <tbody>
                @for ($i = 0; $i < $sesion['planetaSistema']['num_estrellas']; $i++)
                    <tr tabindex="0" class=" bg-amber-300 focus:outline-none h-16 border border-gray-100 rounded">
                        <td colspan="8">
                                <div class="items-center pl-5 text-center">
                                    <p class=" font-medium leading-none text-gray-700 mr-2"> ESTRELLA</p>
                                </div>
                        </td>
                    </tr>     
                @endfor
                
                @foreach ($sesion['sistemaPlanetas'] as $planeta)
                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        <td>
                            <div class="ml-5">
                                <div class="flex items-center pl-5">
                                    <p class="text-base font-medium leading-none text-gray-700 mr-2"> {{$planeta['id']}}</p>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2"> {{$planeta['nombre']}}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2"> {{$planeta['pos']}}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2"> {{$planeta['habitable']}}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2"> {{$planeta['atmosfera']}}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2"> {{$planeta['tipo']}}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2"> {{$planeta['bioma']}}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2"> {{$planeta['magnitud']}}</p>
                            </div>
                        </td>
                    </tr>         

                    {{--     #attributes: array:12 [▶
                        "id" => 342
                        "universo_id" => 2
                        "sistema_id" => 105
                        "user_id" => null
                        "nombre" => "Dasia"
                        "pos" => 1
                        "habitable" => 0
                        "atmosfera" => 0
                        "tipo" => "gas"
                        "bioma" => "oceano"
                        "magnitud" => "meteroide"
                        "deleted_at" => null
                     --}}           
                    
                @endforeach
                
            </tbody>
        </table>
    </div>

</div>