<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div x-data="{ showForm: false }" 
                    class="p-6 text-gray-900 flex flex-col align-center items-center">
                    <button
                        @click="showForm = !showForm"
                        class="mb-4 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition w-36"
                    >
                        <span x-show="!showForm">➕ Dodaj grad</span>
                        <span x-show="showForm">✖ Zatvori</span>
                    </button>

                    <form
                        @click.outside="showForm = false"
                        x-show="showForm"
                        x-transition 
                        action="{{ route('add-city') }}" method="POST" 
                        class="w-full md:max-w-md sm:max-w-sm flex items-center flex-col align-center rounded-xl shadow-xl">
                        @if ($errors->any())
                            <p class="text-red-600"><b>Greška:{{ $errors->first() }}</b></p>
                        @endif
                        @csrf
                        @method('POST')
                        <h3 class="text-center text-indigo-700">Unesite grad i trenutnu temperaturu</h3>
                        <input type="text" name="city" placeholder="Unesite Grad" class="p-2 rounded-xl m-3 
                            hover:bg-gray-300 focus:border-indigo-700 w-72 self-center"
                            value="{{ old('city') }}"  
                        />
                        <input type="number" name="temp" placeholder="Unesite temperaturu" class="p-2 rounded-xl m-3 
                            hover:bg-gray-300 focus:border-indigo-700 w-72 self-center"
                            value="{{ old('temp') }}"  
                        />

                        <button type="submit" 
                            class="p-2 m-3 text-white bg-indigo-700 rounded-xl w-36 self-center"
                        >Snimi</button>
                    </form>
                </div>
                <div class="w-full max-w-4xl mx-auto mt-6 bg-white rounded-xl shadow border border-indigo-200 overflow-x-auto mb-6"
                    x-data="{open: false}"
                >
                    <table class="w-full text-center border-collapse">
                        <thead class="bg-indigo-100">
                            <tr>
                                <th class="p-3 font-semibold text-indigo-700">Grad</th>
                                <th class="p-3 font-semibold text-indigo-700">Temperatura</th>
                                <th class="p-3 font-semibold text-indigo-700" colspan="2">Akcije</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cities as $c)
                                <tr class="border-t hover:bg-gray-50 transition">
                                    <td class="p-3 font-medium">
                                        {{ $c->city }}
                                    </td>

                                    <td class="p-3">
                                        {{ $c->temp }} °C
                                    </td>
                                    <!-- EDIT -->
                                    <td class="p-3">
                                         <button @click="open = true"
                                            class="bg-indigo-600 hover:bg-indigo-800 text-white rounded-xl p-2">
                                            Uredi
                                        </button>
                                    </td>

                                    <td class="p-3">
                                        <!-- DELETE -->
                                        <form action="{{ route('admin.remove', $c) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 hover:bg-red-800 text-white rounded-lg px-3 py-1">
                                                Obriši
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div x-show="open" x-transition
                        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                        <div @click.away="open = false" class="bg-white rounded-xl p-6 shadow-xl w-full max-w-md">
                            <h3 class="text-center text-indigo-700 text-xl mb-4">Uredi grad</h3>

                            <form action="{{ route('admin-update', $c) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="text" name="city" value="{{ $c->city }}" 
                                    class="w-full mb-3 p-2 border rounded-lg" placeholder="Grad">
                                <input type="number" name="temp" value="{{ $c->temp }}" 
                                    class="w-full mb-3 p-2 border rounded-lg" placeholder="Temperatura">

                                <div class="flex justify-end space-x-2">
                                    <button type="button" @click="open = false"
                                            class="px-4 py-2 bg-gray-400 rounded-lg hover:bg-gray-500">
                                        Otkaži
                                    </button>
                                    <button type="submit"
                                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                        Snimi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
