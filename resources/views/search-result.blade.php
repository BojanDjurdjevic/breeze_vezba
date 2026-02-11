<x-app-layout>
    <div class="p-9 m-3 grid gap-4 lg:grid-cols-8 md:grid-cols-6 sm:grid-cols-4">
        @foreach ($cities as $city)
            @php
                $icon = App\Http\ForecastHelper::getIcon($city->todaysForecast->weather_type);
            @endphp

            <div
                class="p-3 m-1 bg-indigo-500 text-white rounded-lg hover:bg-indigo-700
                       flex items-center justify-between transition"
            >
                @if (in_array($city->id, $userFavourites))
                    <form action="{{ route('rmfavourite', $city) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="appearance-none bg-transparent border-0 p-0 cursor-pointer">
                            <i class="mdi mdi-heart text-red-600 text-2xl"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('favourites', $city) }}">
                        <i class="mdi mdi-heart text-indigo-100 text-2xl"></i>
                    </a>
                @endif

                {{-- Grad --}}
                <a href="{{ route('all-city-forecasts', ['city' => $city->name]) }}"
                   class="flex items-center gap-2 flex-1 justify-center">
                    <i class="mdi {{ $icon }}"></i>
                    {{ $city->name }}
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>
