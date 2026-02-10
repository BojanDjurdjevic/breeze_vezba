<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forecasts') }}
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
                        <span x-show="!showForm">➕ Dodaj prognozu</span>
                        <span x-show="showForm">✖ Zatvori</span>
                    </button>

                    <form
                        @click.outside="showForm = false"
                        x-show="showForm"
                        x-transition 
                        action="{{ route('create-forecast') }}" method="POST" 
                        class="w-full md:max-w-md sm:max-w-sm flex items-center flex-col align-center rounded-xl shadow-xl">
                        @if ($errors->any())
                            <p class="text-red-600"><b>Greška:{{ $errors->first() }}</b></p>
                        @endif
                        @csrf
                        @method('POST')
                        <h3 class="text-center text-indigo-700">Unesite grad i prognozu</h3>
                        <select 
                            name="city_id" id="" 
                            class="p-2 rounded-xl m-3 
                            hover:bg-gray-300 focus:border-indigo-700 w-72 self-center"
                            >
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="temperature" placeholder="Unesite temperaturu" class="p-2 rounded-xl m-3 
                            hover:bg-gray-300 focus:border-indigo-700 w-72 self-center"
                        />
                        <select name="weather_type" id=""
                            class="p-2 rounded-xl m-3 
                            hover:bg-gray-300 focus:border-indigo-700 w-72 self-center"
                        >
                            <option value="sunny">Sunny</option>
                            <option value="rainy">Rainy</option>
                            <option value="snowy">Snowy</option>
                        </select>
                        <input type="number" name="probability" placeholder="Unesite šansu za padavine" class="p-2 rounded-xl m-3 
                            hover:bg-gray-300 focus:border-indigo-700 w-72 self-center"
                        />
                        <input type="date" name="date" placeholder="Unesite datum" class="p-2 rounded-xl m-3 
                            hover:bg-gray-300 focus:border-indigo-700 w-72 self-center"
                        />

                        <button type="submit" 
                            class="p-2 m-3 text-white bg-indigo-700 rounded-xl w-36 self-center"
                        >Snimi</button>
                    </form>
                </div>
                <div class="w-full max-w-4xl mx-auto mt-6 bg-white rounded-xl shadow border border-indigo-200 overflow-x-auto mb-6
                    flex flex-col items-center"
                >
                    
                    @foreach ($cities as $city)
                        <div class="p-6 mt-3 shadow-md rounded-lg ">
                            <h3>{{ $city->name }}</h3>
                            <ul>
                            @foreach ($city->forecasts as $f)

                                @php
                                    $boja = App\Http\ForecastHelper::getColorByTemp($f->temperature);
                                @endphp

                                <li>Datum: {{ $f->date }} <b><span class="{{ $boja }}">{{ $f->temperature }} °C</span></b> / {{ $f->weather_type }} / Padavine: {{ $f->probability }}%</li>
                            @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>