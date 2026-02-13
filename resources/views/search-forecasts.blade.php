<x-app-layout>
    <h3 class="text-center">{{ $myCity->name }}</h3>
    <div class="w-full max-w-4xl mx-auto mt-6 p-3 
                grid grid-cols-4 gap-2">
        @foreach ($myCity->forecasts as $day)
            <div class="shadow-md rounded-lg p-4 bg-white">
                <p><b>{{ $day->date }}</b></p>
                <p>{{ $day->temperature }}</p>
                <p>{{ $day->weather_type }}</p>
                <p>Padavine: {{ $day->probability }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>