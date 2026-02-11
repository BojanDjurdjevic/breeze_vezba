<x-app-layout>
    <div class="p-9 m-3 grid gap-1 lg:grid-cols-8 md:grid-cols-6 sm:grid-cols-4">
        @foreach ($cities as $city)
            @php
                //$boja = App\Http\ForecastHelper::getColorByTemp($city->forecasts->first()->temperature);
                $icon = App\Http\ForecastHelper::getIcon($city->todaysForecast->weather_type);
            @endphp
            <button
            class="p-3 m-1 bg-indigo-500 text-white rounded-lg hover:bg-indigo-700
                    flex items-center justify-between"
            >
                @if (in_array($city->id, $userFavourites))
                    <a href="{{ route('favourites', $city) }}">
                        <i class="mdi mdi-heart text-red-600"></i>
                    </a>
                @else
                <a href="{{ route('favourites', $city) }}">
                    <i class="mdi mdi-heart text-indigo-100"></i>
                </a>
                @endif
                
                
                <a href="{{ route('all-city-forecasts', ['city' => $city->name])  }}">
                    <i class="mdi {{ $icon }}"></i>
                    {{ $city->name }}
                </a>
            </button>
        @endforeach
    </div>
</x-app-layout>

