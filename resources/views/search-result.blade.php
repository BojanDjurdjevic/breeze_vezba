<x-app-layout>
    <div>
        @foreach ($cities as $city)
            <p>{{ $city->name }}</p>
        @endforeach
    </div>
</x-app-layout>