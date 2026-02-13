<x-app-layout>
    <h3 class="text-center">{{ $city->name }}</h3>
    <div class="w-full max-w-4xl mx-auto mt-6 p-3 
                grid md:grid-cols-5 sm:grid-cols-3 gap-2">
        @foreach ($city->forecasts as $day)
            @php
                $color = App\Http\ForecastHelper::getColorByTemp($day->temperature);
                $icon = App\Http\ForecastHelper::getIcon($day->weather_type);
            @endphp
            <div class="shadow-md rounded-lg p-4 bg-white text-center">
                <p><b>{{ $day->date }}</b></p>
                <p class="mdi {{ $color }}">{{ $day->temperature }} C</p>
                <p><i class="mdi {{ $icon }}"></i> {{ $day->weather_type }}</p>
                <p>Padavine: {{ $day->probability }}</p>
            </div>
        @endforeach
    </div
</x-app-layout>