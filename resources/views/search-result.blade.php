<x-app-layout>
    <div class="p-9 m-3 flex justify-center ">
        @foreach ($cities as $city)
            @php
                //$boja = App\Http\ForecastHelper::getColorByTemp($city->forecasts->first()->temperature);
                $icon = App\Http\ForecastHelper::getIcon($city->todaysForecast->weather_type);
            @endphp
            <button
            class="p-3 m-1 bg-indigo-500 text-white rounded-lg hover:bg-indigo-700"
            ><a href="{{ route('all-city-forecasts', ['city' => $city->name])  }}">
            <i class="mdi {{ $icon }}"></i>
            {{ $city->name }}</a></button>
        @endforeach
    </div>
</x-app-layout>