<x-app-layout>
    <div class="p-9 m-3 flex justify-center ">
        @foreach ($cities as $city)
            <button
            class="p-3 m-1 bg-indigo-500 text-white rounded-lg hover:bg-indigo-700"
            >{{ $city->name }}</button>
        @endforeach
    </div>
</x-app-layout>