<x-app-layout>
    <div class="w-full max-w-4xl mx-auto mt-6 bg-white rounded-xl shadow border border-indigo-200 overflow-x-auto mb-6
        grid gap-1 md:grid-cols-2"
    >
    
            <div class="p-6 mt-3 shadow-md rounded-lg ">
                <h3>{{ $city->name }}</h3>
                <ul>
                @foreach ($city->forecasts as $f)

                    @php
                        $boja = App\Http\ForecastHelper::getColorByTemp($f->temperature);
                        $icon = App\Http\ForecastHelper::getIcon($f->weather_type);
                    @endphp

                    <li>Datum: {{ $f->date }} <b><span class="{{ $boja }}">{{ $f->temperature }} °C</span></b>
                         / {{ $f->weather_type }} / Padavine: {{ $f->probability }}%
                         <i class="mdi {{ $icon }}"></i>
                    </li>
                @endforeach
                </ul>
            </div>
    </div>
</x-app-layout>