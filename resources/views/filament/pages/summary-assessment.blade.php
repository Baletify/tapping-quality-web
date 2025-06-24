<x-filament-panels::page>
    <div class="bg-white p-6 rounded-lg shadow">
        <form method="GET" class="mb-4 flex flex-wrap gap-2 justify-end">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Penyadap..." class="border rounded px-2 py-1" />

            <select name="departemen" class="border rounded px-2 py-1">
                <option value="">Semua Departemen</option>
                @foreach ($this->departemenOptions as $departemen)
                    <option value="{{ $departemen }}" @selected(request('departemen') == $departemen)>{{ $departemen }}</option>
                @endforeach
            </select>

            <button type="submit" class="px-3 py-1 bg-primary-600 text-white rounded">Filter</button>
        </form>
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-500 rounded-lg shadow">
                <thead class="bg-gray-100 text-white">
                    <tr class="divide-x divide-gray-300">
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">No.</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Tanggal Inspeksi</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Dept</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">NIK Penyadap</th>
                        <th class="w-36 px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Nama Penyadap</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Kemandoran</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Task</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Panel Sadap</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Status Kulit</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">1.1</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">1.2</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">1.3</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">2.1</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">2.2</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">2.3</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">3.1</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">3.2</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">3.3</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">3.4</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">3.5</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">3.6</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">3.7</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">4.1</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">4.2</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">5.1</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">5.2</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">6.1</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">6.2</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">6.3</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">7.1</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">7.2</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">7.3</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">8</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">9</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">10</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Nilai</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Kelas</th>
                    </tr>
                    @php
                    $i = 0;
                    $totalAverage = 0;
                    // Helper function for DRY code
                    function getScore($treeAssessments, $criteriaId, $assessmentCode) {
                            $score = $treeAssessments->first(function ($data) use ($criteriaId, $assessmentCode) {
                                return $data->criteria_id === $criteriaId && $data->assessment_code === $assessmentCode;
                            });
                            return $score ? $score->sum_score / 10 : '-';
                        }
                    @endphp
                    @foreach ($this->assessmentDetails as $item)
                    @php
                        $i++;
                        $totalAverage = 0;
                    @endphp
                    <tr class="divide-x divide-gray-300">
                        <td class="text-gray-500 px-2 text-center">{{ $i }}</td>
                        <td class="text-gray-500 px-2">{{ \Carbon\Carbon::parse($item->tanggal_inspeksi)->format('d M Y') }}</td>
                        <td class="text-gray-500 px-2">{{ $item->departemen }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->tapper_nik }}</td>
                        <td class="text-gray-500 px-2">{{ $item->tapper_name }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->status }}</td>
                        <td class="text-gray-500 px-2">{{ $item->kemandoran }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->task }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->panel_sadap }}</td>
                        <td class="text-gray-500 px-2">{{ $item->jenis_kulit_pohon }}</td>
                        @php
                        $treeAssessments = $this->treeAssessments;
                        // Criteria 1
                        $score1_1 = $item->jenis_sadap == 'BO'
                            ? getScore($treeAssessments, 1, $item->assessment_code)
                            : getScore($treeAssessments, 5, $item->assessment_code);
                        $totalAverage += $score1_1 !== '-' ? $score1_1 : 0;

                        $score1_2 = $item->jenis_sadap == 'BO'
                            ? getScore($treeAssessments, 2, $item->assessment_code)
                            : getScore($treeAssessments, 6, $item->assessment_code);
                        $totalAverage += $score1_2 !== '-' ? $score1_2 : 0;

                        $score1_3 = $item->jenis_sadap == 'BO'
                            ? getScore($treeAssessments, 3, $item->assessment_code)
                            : getScore($treeAssessments, 7, $item->assessment_code);
                        $totalAverage += $score1_3 !== '-' ? $score1_3 : 0;

                        // Criteria 2
                        $score2_1 = getScore($treeAssessments, 9, $item->assessment_code);
                        $totalAverage += $score2_1 !== '-' ? $score2_1 : 0;

                        $score2_2 = getScore($treeAssessments, 10, $item->assessment_code);
                        $totalAverage += $score2_2 !== '-' ? $score2_2 : 0;

                        $score2_3 = getScore($treeAssessments, 11, $item->assessment_code);
                        $totalAverage += $score2_3 !== '-' ? $score2_3 : 0;

                        // Criteria 3
                        $score3_1 = getScore($treeAssessments, 12, $item->assessment_code);
                        $totalAverage += $score3_1 !== '-' ? $score3_1 : 0;

                        $score3_2 = getScore($treeAssessments, 13, $item->assessment_code);
                        $totalAverage += $score3_2 !== '-' ? $score3_2 : 0;

                        $score3_3 = getScore($treeAssessments, 14, $item->assessment_code);
                        $totalAverage += $score3_3 !== '-' ? $score3_3 : 0;

                        $score3_4 = getScore($treeAssessments, 15, $item->assessment_code);
                        $totalAverage += $score3_4 !== '-' ? $score3_4 : 0;

                        $score3_5 = getScore($treeAssessments, 16, $item->assessment_code);
                        $totalAverage += $score3_5 !== '-' ? $score3_5 : 0;

                        $score3_6 = getScore($treeAssessments, 17, $item->assessment_code);
                        $totalAverage += $score3_6 !== '-' ? $score3_6 : 0;

                        $score3_7 = getScore($treeAssessments, 18, $item->assessment_code);
                        $totalAverage += $score3_7 !== '-' ? $score3_7 : 0;

                        // Criteria 4
                        $score4_1 = $item->jenis_sadap == 'BO'
                            ? getScore($treeAssessments, 20, $item->assessment_code)
                            : getScore($treeAssessments, 23, $item->assessment_code);
                        $totalAverage += $score4_1 !== '-' ? $score4_1 : 0;

                        $score4_2 = $item->jenis_sadap == 'BO'
                            ? getScore($treeAssessments, 21, $item->assessment_code)
                            : getScore($treeAssessments, 24, $item->assessment_code);
                        $totalAverage += $score4_2 !== '-' ? $score4_2 : 0;

                        // Criteria 5
                        $score5_1 = getScore($treeAssessments, 26, $item->assessment_code);
                        $totalAverage += $score5_1 !== '-' ? $score5_1 : 0;

                        $score5_2 = getScore($treeAssessments, 27, $item->assessment_code);
                        $totalAverage += $score5_2 !== '-' ? $score5_2 : 0;

                        // Criteria 6
                        $score6_1 = getScore($treeAssessments, 28, $item->assessment_code);
                        $totalAverage += $score6_1 !== '-' ? $score6_1 : 0;

                        $score6_2 = getScore($treeAssessments, 29, $item->assessment_code);
                        $totalAverage += $score6_2 !== '-' ? $score6_2 : 0;

                        $score6_3 = getScore($treeAssessments, 30, $item->assessment_code);
                        $totalAverage += $score6_3 !== '-' ? $score6_3 : 0;

                        // Criteria 7
                        $score7_1 = getScore($treeAssessments, 32, $item->assessment_code);
                        $totalAverage += $score7_1 !== '-' ? $score7_1 : 0;

                        $score7_2 = getScore($treeAssessments, 33, $item->assessment_code);
                        $totalAverage += $score7_2 !== '-' ? $score7_2 : 0;

                        // Criteria 8, 9, 10, 11
                        $score8 = getScore($treeAssessments, 36, $item->assessment_code);
                        $totalAverage += $score8 !== '-' ? $score8 : 0;

                        $score9 = getScore($treeAssessments, 37, $item->assessment_code);
                        $totalAverage += $score9 !== '-' ? $score9 : 0;

                        $score10 = getScore($treeAssessments, 39, $item->assessment_code);
                        $totalAverage += $score10 !== '-' ? $score10 : 0;

                        $score11 = getScore($treeAssessments, 41, $item->assessment_code);
                        $totalAverage += $score11 !== '-' ? $score11 : 0;


                        @endphp
                        <td class="text-gray-500 px-2 text-center">{{ $score1_1 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score1_2 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score1_3 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score2_1 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score2_2 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score2_3 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score3_1 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score3_2 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score3_3 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score3_4 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score3_5 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score3_6 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score3_7 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score4_1 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score4_2 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score5_1 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score5_2 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score6_1 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score6_2 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score6_3 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score7_1 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score7_2 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score8 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score9 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score10 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $score11 ?? '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $totalAverage }}</td>
                        @if ($totalAverage > 0 && $totalAverage <= 10.9)
                                <td class="text-gray-500 px-2 text-center">1</td>
                            @elseif ($totalAverage > 10 && $totalAverage <= 20.9)
                                <td class="text-gray-500 px-2 text-center">2</td>
                            @elseif ($totalAverage > 20 && $totalAverage <= 26.9)
                                <td class="text-gray-500 px-2 text-center">3</td>
                            @elseif ($totalAverage > 26 && $totalAverage <= 32.9)
                                <td class="text-gray-500 px-2 text-center">4</td>
                            @else
                                <td class="text-gray-500 px-2 text-center">No Class</td>
                            @endif

                    </tr>
                    @endforeach
                </thead>
            </table>
        <div class="mt-4 py-4 justify-end space-x-2 flex">
            {{ $this->assessmentDetails->links() }}
        </div>
    </div>
</div>
</x-filament-panels::page>
