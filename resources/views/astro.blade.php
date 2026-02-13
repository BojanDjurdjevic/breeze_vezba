<x-app-layout>
    <h2 class="text-center">{{ $city->name }}</h2>

    <div class="w-full max-w-4xl mx-auto mt-6 p-3">
            <div class="shadow-md rounded-lg p-4 bg-white text-center">
                <p>Izlazak Sunca: {{ $sunrise }}</p>
                <p>Zalazak Sunca: {{ $sunset }}</p>
            </div>
    </div>
</x-app-layout>