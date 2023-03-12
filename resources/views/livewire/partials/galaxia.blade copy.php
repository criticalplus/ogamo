
<div class="m-2 max-w-7xl mx-auto sm:px-2 lg:px-4">
        
    GALAXIA
    <br>
    <div class="overflow-x-auto">
        <table  class="w-full whitespace-nowrap" 
                style="font-size: 8px;
                        border: solid 1px #ccc;
                        text-align: center;">

            <thead>
                <tr>
                        <th class="min-w-3"> <sup>z</sup>/<sub>y</sub> </th>
                    @for ($c = -25; $c <= 25; $c++)
                        <th  style="min-width: 15px;">{{$c}}</th>
                    @endfor
                </tr>    
            </thead>

            <tbody>
                

                @for ($y = -25; $y <= 25; $y++)

                <tr>

                        @for ($z = -26; $z <= 25; $z++)

                        @if ($z == -26)
                            <td class="">
                                {{$y}}
                        @else

                            @foreach ($sesion['sistemasGalaxia'] as $sistema)

                                @if( $sistema['posY'] == $y AND $sistema['posZ'] == $z )
                                    <td class="hover:bg-gray-300 border border-stone-500">
                                        <div class="hidden hover:block ">
                                            {{$sistema['id']}}
                                        </div>
                                @else
                                    <td class="hover:bg-gray-300 border border-stone-500">
                                @endif
                                
                            @endforeach
                        @endif

                    </td>
                    
                    @endfor

                </tr>

                @endfor





                
            </tbody>
        </table>
    </div>

</div>