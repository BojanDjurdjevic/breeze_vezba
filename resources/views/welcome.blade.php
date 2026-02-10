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
                            value="{{ old('temp') }}"  
                        />
                    <button type="submit" 
                        class="p-2 m-3 text-white bg-indigo-700 rounded-xl w-36 self-center"
                    >Pronađi</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="w-full max-w-4xl mx-auto mt-6 bg-white rounded-xl shadow border border-indigo-200 overflow-x-auto mb-6"
        x-data="{open: false}"
    >
        <table class="w-full text-center border-collapse">
            <thead class="bg-indigo-100">
                <tr>
                    <th class="p-3 font-semibold text-indigo-700">Grad</th>
                    <th class="p-3 font-semibold text-indigo-700">Temperatura</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($cities as $c)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="p-3 font-medium">
                            {{ $c->name }}
                        </td>

                        <td class="p-3">
                            {{ $c->weather->temp }} °C
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </table>
    </div>
</x-app-layout>