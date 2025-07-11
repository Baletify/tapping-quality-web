<x-filament-panels::page>
    <div class="bg-white p-6 rounded-lg shadow">
        <form method="GET" class="mb-4 flex flex-wrap gap-2 justify-end">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search" class="border rounded px-1 py-1" />

            <select name="departemen" class="border rounded px-5 py-1">
                <option value="">All Dept</option>
                @foreach ($this->departemenOptions as $departemen)
                    <option value="{{ $departemen }}" @selected(request('departemen') == $departemen)>{{ $departemen }}</option>
                @endforeach
            </select>
            <select name="month" id="month">
                <option value="">Select Month</option>
                @foreach (range(1, 12) as $month)
                    <option value="{{ $month }}" @selected(request('month') == $month)>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
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
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Nama Inspektur</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">NIK Penyadap</th>
                        <th class="w-36 px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Nama Penyadap</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Kemandoran</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Blok</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Task</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Tahun Tanam</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Panel Sadap</th>
                        <th class="px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">Status Kulit</th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                1.1
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Luka kayu kecil (BO) / Tidak Mengunakan Gagang Panjang (HO)
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                1.2
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Luka kayu sedang (BO)/Tidak Menggunakan Pisau sodhok(HO)
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                1.3
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Luka kayu besar (BO)/Sadapan Tidak Disodhok (HO)
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                2.1
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Kedalaman sadap (normatif)
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                2.2 
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Kedalaman sadap (kurang)
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                2.3
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Kedalaman sadap (terlalu dalam)
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                3.1
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Irisan melampaui batas depan
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                3.2
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Irisan melampaui batas belakang
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                3.3
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Tidak ada sodokan
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                3.4
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Tidak ada pethikan (V)
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                3.5
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Tebal Tatal > 2mm (BO)/ >3mm(HO)
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                3.6
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                    Bergelombang
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                3.7
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Tidak ada tanda bulan
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                4.1
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Sudut sadap > 30°(BO)/45° (HO)
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                4.2
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Sudut sadap < 30°(BO)/45° (HO)
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                5.1
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Pengambilan scrap Diambil
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                5.2
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Pengambilan scrap tidak Diambil
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                6.1
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Peralatan tidak lengkap Talang
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                6.2
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Peralatan tidak lengkap mangkok
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                6.3
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Peralatan tidak lengkap Hanger
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                7.1
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Kebersihan alat Talang
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                7.2
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Kebersihan alat Mangkok
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                7.3
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Kebersihan alat Ember
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                8
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Pohon sehat tidak disadap
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                9
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Hasil tidak dipungut
                                </span>
                            </span>
                        </th>
                        <th class=" relative px-4 py-3 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">
                            <span
                                x-data="{ show: false }"
                                @mouseenter="show = true"
                                @mouseleave="show = false"
                                class="cursor-pointer"
                            >
                                10
                                <span
                                    x-show="show"
                                    x-transition
                                    class="absolute top-1/2 bottom-full z-10 mb-2 w-56 -translate-x-1/2 rounded bg-gray-100 px-2 py-1 text-xs text-gray-800 shadow"
                                    style="display: none;"
                                >
                                Talang sadap mepet
                                </span>
                            </span>
                        </th>
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
                        <td class="text-gray-500 px-2">{{ \Carbon\Carbon::parse($item->tgl_inspeksi)->format('d M Y') }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->dept }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->nama_inspektur }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->nik_penyadap }}</td>
                        <td class="text-gray-500 px-2">{{ $item->nama_penyadap }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->status }}</td>
                        <td class="text-gray-500 px-2">{{ $item->kemandoran }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->blok }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->task }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->tahun_tanam }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ $item->panel_sadap }}</td>
                        <td class="text-gray-500 px-2">{{ $item->jenis_kulit_pohon }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item1_1 > 0) ? $item->item1_1 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item1_2 > 0) ? $item->item1_2 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item1_3 > 0) ? $item->item1_3 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item2_1 > 0) ? $item->item2_1 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item2_2 > 0) ? $item->item2_2 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item2_3 > 0) ? $item->item2_3 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item3_1 > 0) ? $item->item3_1 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item3_2 > 0) ? $item->item3_2 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item3_3 > 0) ? $item->item3_3 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item3_4 > 0) ? $item->item3_4 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item3_5 > 0) ? $item->item3_5 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item3_6 > 0) ? $item->item3_6 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item3_7 > 0) ? $item->item3_7 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item4_1 > 0) ? $item->item4_1 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item4_2 > 0) ? $item->item4_2 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item5_1 > 0) ? $item->item5_1 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item5_2 > 0) ? $item->item5_2 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item6_1 > 0) ? $item->item6_1 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item6_2 > 0) ? $item->item6_2 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item6_3 > 0) ? $item->item6_3 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item7_1 > 0) ? $item->item7_1 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item7_2 > 0) ? $item->item7_2 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item7_3 > 0) ? $item->item7_3 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item8 > 0) ? $item->item8 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item9 > 0) ? $item->item9 : '-' }}</td>
                        <td class="text-gray-500 px-2 text-center">{{ ($item->item10 > 0) ? $item->item10 : '-' }}</td>
                        {{-- <td class="text-gray-500 px-2 text-center">{{ $item->item11 ?? '-' }}</td> --}}
                        <td class="text-gray-500 px-2 text-center">{{ $item->nilai }}</td>
                        @if ($item->nilai > 0 && $item->nilai <= 10.9)
                                <td class="text-gray-500 px-2 text-center">1</td>
                            @elseif ($item->nilai > 10 && $item->nilai <= 20.9)
                                <td class="text-gray-500 px-2 text-center">2</td>
                            @elseif ($item->nilai > 20 && $item->nilai <= 26.9)
                                <td class="text-gray-500 px-2 text-center">3</td>
                            @elseif ($item->nilai > 26 && $item->nilai <= 32.9)
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
