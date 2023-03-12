<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Elige Universo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
            @isset($data)
              
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Numero
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Nombre
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Fecha
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $d)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$d->id}}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{$d->name}}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{$d->created_at}}
                                    </td>
                                    <td class="py-4 px-6">
                                        <form action="{{ route('uniReg',$d->id) }}" method="POST" style="display: inline" class="">
                                            @csrf
                                          {{--   @method('POST') --}}
                                            <div class="ml-5">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    Unirse
                                                </button>
                                            </div>
                                            </form> 
                                        {{-- <button wire:click="unirse({{ $d->id }})">Unirse</button> --}}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            @endisset


                
            </div>
        </div>
    </div>
</x-app-layout>
