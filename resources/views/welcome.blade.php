<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" shadow-sm sm:rounded-lg flex justify-center">
                <form
                    action="{{ route('city-forecast') }}" method="GET" 
                    class="bg-white w-full md:max-w-md sm:max-w-sm flex items-center flex-col align-center rounded-xl shadow-xl">
                    @if ($errors->any())
                        <p class="text-red-600"><b>Greška:{{ $errors->first() }}</b></p>
                    @endif
                    @csrf
                    <h3 class="text-center text-indigo-700">Pronađite grad</h3>
                        <input type="text" name="city" placeholder="Unesite grad" class="p-2 rounded-xl m-3 
                            hover:bg-gray-300 focus:border-indigo-700 w-72 self-center"
                        />
                    <button type="submit" 
                        class="p-2 m-3 text-white bg-indigo-700 rounded-xl w-36 self-center"
                    >Pronađi</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="w-full max-w-4xl mx-auto mt-6 overflow-x-auto mb-6
                grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2"
    >
        @foreach ($cities as $city)
            @php
                $icon = isset($city->todaysForecasts) ? App\Http\ForecastHelper::getIcon($city->todaysForecast->weather_type) : 'mdi-weather-sunny';
            @endphp
            @if (in_array($city->id, $userFavourites))
            <div
                class="p-3 m-1 bg-indigo-500 text-white rounded-lg hover:bg-indigo-700
                flex items-center justify-between transition"
            >
                <a href="{{ route('all-city-forecasts', ['city' => $city->name]) }}"
                    class="flex items-center gap-2 flex-1 justify-center">
                    <i class="mdi {{ $icon }}"></i>
                    {{ $city->name }}
                </a>
            </div>
            @endif
        @endforeach

    </div>
</x-app-layout>