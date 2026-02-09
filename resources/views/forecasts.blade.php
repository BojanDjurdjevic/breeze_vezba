<x-app-layout>
    <div class="w-full max-w-4xl mx-auto mt-6 bg-white rounded-xl shadow border border-indigo-200 overflow-x-auto mb-6"
        x-data="{open: false}"
    >
        <table class="w-full text-center border-collapse">
            <thead class="bg-indigo-100">
                <tr>
                    <th class="p-3 font-semibold text-indigo-700">Grad</th>
                    <th class="p-3 font-semibold text-indigo-700">Temperature</th>
                </tr>
            </thead>

            <tbody>
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-3 font-medium">
                        {{ $city->name }}
                    </td>

                    <td class="p-3">
                        @foreach ($city->forecasts as $f)
                           {{ $f->date }}: <b>{{ $f->temperature }} °C</b>,  
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>