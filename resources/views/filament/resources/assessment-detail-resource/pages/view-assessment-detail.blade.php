<x-filament::page>
    <div class="">
        <p class="font-semibold text-sm">Detail Tapper</p>
        <div class="">
            <table>
                <tr>
                    <td class="text-sm text-gray-500">NIK</td>
                    <td class="text-sm text-gray-500 px-3">:</td>
                    <td class="text-sm text-gray-500">{{ $tapperCreds->tapper_nik }}</td>
                </tr>
                <tr>
                    <td class="text-sm text-gray-500">Nama</td>
                    <td class="text-sm text-gray-500 px-3">:</td>
                    <td class="text-sm text-gray-500">{{ $tapperCreds->tapper_name }}</td>
                </tr>
                <tr>
                    <td class="text-sm text-gray-500">Departemen</td>
                    <td class="text-sm text-gray-500 px-3">:</td>
                    <td class="text-sm text-gray-500">{{ $tapperCreds->departemen }}</td>
                </tr>
                <tr>
                    <td class="text-sm text-gray-500">Inspeksi Oleh</td>
                    <td class="text-sm text-gray-500 px-3">:</td>
                    <td class="text-sm text-gray-500">{{ $tapperCreds->inspection_by }}</td>
                </tr>
            </table>
        </div>
    </div>
        <div class="">
            <table class="w-1/2 divide-y divide-gray-500  rounded-lg shadow">
                <thead class="bg-gray-100 text-white">
                    <tr class="divide-x divide-gray-300">
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Nama Kriteria</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Nilai Rata-Rata</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @php
                        $i = 0;
                        $totalScore = 0;
                    @endphp
                    @foreach ($customData as $item)
                        @php
                            $i++;
                            $totalScore += $item->avg_score;
                        @endphp
                        <tr class="divide-x divide-gray-300 {{ $i % 2 == 0 ? 'bg-gray-100' : '' }}">
                            <td class="px-4 py-2 text-center">{{ $i }}</td>
                            <td class="px-4 py-2">{{ $item->nama_kriteria }}</td>
                            <td class="px-4 py-2 text-center">{{ number_format($item->avg_score, 1) }}</td>
                        </tr>
                    @endforeach
                    <tr class="font-semibold divide-x divide-gray-200">
                        <td class="px-4 py-2 text-center" colspan="2">Total</td>
                        <td class="px-4 py-2 text-center">{{ number_format($totalScore, 1) }}</td>
                    </tr>
                    <tr class="font-semibold divide-x divide-gray-200">
                        <td class="px-4 py-2 text-center" colspan="2">Kelas</td>
                        @if ($totalScore > 0 && $totalScore <= 10.9)
                            <td class="px-4 py-2 text-center">1</td>
                        @elseif ($totalScore > 10 && $totalScore <= 20.9)
                            <td class="px-4 py-2 text-center">2</td>
                        @elseif ($totalScore > 20 && $totalScore <= 26.9)
                            <td class="px-4 py-2 text-center">3</td>
                        @elseif ($totalScore > 26 && $totalScore <= 32.9)
                            <td class="px-4 py-2 text-center">4</td>
                        @else
                            <td class="px-4 py-2 text-center">No Class</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
</x-filament::page>