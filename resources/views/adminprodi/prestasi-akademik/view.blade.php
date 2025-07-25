@extends('layouts.app')

@section('title', 'Kelola Prestasi Akademik')

@section('content')


    @include('components.sidebar.adminprodi')

    <div class="mx-32">
        <div class="flex items-center mb-12">
            <div class="text-3xl font-bold mr-8">
                Kelola Prestasi </div>
            <div class="text-right">
                <a type="button" href="{{ route('adminprodi.prestasi-akademik.create') }}"
                    class="text-center transition ease-in-out duration-150 hover:bg-teal-800 text-white bg-teal-700 rounded-full w-1/2 px-5 py-2.5">Tambah
                    Data</a>
            </div>
        </div>
        <div class="flex flex-row gap-6 items-center mb-8">
            <div class="text-lg font-semibold">Pilih menu:</div>
            <div class="inline-flex shadow-xs" role="group">
                <button onclick="showTable('akademik')" id="btn-akademik"
                    class="px-5 text-sm py-3 font-medium {{ request('tab', 'akademik') === 'akademik' ? 'text-white bg-teal-700' : 'text-gray-700 bg-white' }} border border-gray-300 rounded-s-lg hover:bg-gray-200 hover:text-black focus:z-10 focus:ring-2 focus:ring-teal-700">
                    Akademik
                </button>
                <button onclick="showTable('matkul')" id="btn-matkul"
                    class="px-5 text-sm py-3 font-medium {{ request('tab') === 'matkul' ? 'text-white bg-teal-700' : 'text-gray-700 bg-white' }} border border-gray-300 border-l-0 hover:bg-gray-200 hover:text-black focus:z-10 focus:ring-2 focus:ring-teal-700">
                    Mata Kuliah
                </button>
                <button onclick="showTable('nilai')" id="btn-nilai"
                    class="px-5 text-sm py-3 font-medium {{ request('tab') === 'nilai' ? 'text-white bg-teal-700' : 'text-gray-700 bg-white' }} border border-gray-300 border-l-0 rounded-e-lg hover:bg-gray-200 hover:text-black focus:z-10 focus:ring-2 focus:ring-teal-700">
                    Nilai
                </button>
            </div>
        </div>


        @if (session('success'))
            <div id="success-alert"
                class="mb-6 px-6 py-4 rounded-lg bg-green-100 border border-green-400 text-green-700 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button type="button" class="text-green-700 font-bold"
                    onclick="document.getElementById('success-alert').style.display='none'">x</button>
            </div>
        @endif

        <div id="table-akademik" class="tabel-data {{ request('tab', 'akademik') !== 'akademik' ? 'hidden' : '' }}">
            <div class="border border-gray-300 rounded-2xl mb-10 ">
                <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                    <div class="py-6 px-10 bg-white">
                        <h1 class="text-lg font-bold text-center">Daftar Prestasi Akademik (IP)</h1>
                    </div>
                    <table class="w-full text-sm text-left text-gray-700 table-fixed">
                        <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                            <tr>
                                <th class="pl-10 pr-4 py-4 w-12">No.</th>
                                <th class="px-10 py-4 w-64">Nama</th>
                                <th class="px-6 py-4 w-32">NIM</th>
                                <th class="px-6 py-4 w-28 text-center">Semester</th>
                                <th class="px-6 py-4 w-28 text-center">SKS</th>
                                <th class="px-6 py-4 w-32 text-center">IP</th>
                                <th class="px-4 py-4 w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akademiks->sortByDesc('created_at')->values() as $index => $item)
                                <tr class="bg-white border-b border-gray-300">
                                    <td class="pl-10 pr-4 py-4">{{ $index + 1 }}.</td>
                                    <td class="px-10 py-4 font-medium text-black">{{ $item->user->nama ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $item->user->nim ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->semester }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->jml_sks }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->IP }}</td>
                                    <td class="px-4 py-4">
                                        <form method="POST"
                                            action="{{ route('adminprodi.prestasi-akademik.deletePrestasi', $item->id) }}"
                                            onsubmit="return confirm('Anda yakin ingin menghapus data prestasi akademik?')"
                                            class="w-full inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center bg-red-500 text-white py-2 rounded w-8">
                                                <i class="fa fa-trash" style="font-size:18px"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="my-6 px-8">
                        {{ $akademiks->appends(['tab' => 'akademik'])->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div id="table-matkul" class="tabel-data {{ request('tab') !== 'matkul' ? 'hidden' : '' }}">
            <div class="border border-gray-300 rounded-2xl mb-10">
                <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                    <div class="py-6 px-10 bg-white">
                        <h1 class="text-lg font-bold text-center">Daftar Mata Kuliah</h1>
                    </div>
                    <table class="w-full text-left text-gray-700 table-fixed text-sm">
                        <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                            <tr>
                                <th class="pl-10 pr-4 py-4 w-12">No.</th>
                                <th class="px-6 py-4 w-32">Kode Matkul</th>
                                <th class="px-6 py-4 w-48">Nama Matkul</th>
                                <th class="px-10 py-4 w-24 text-center">SKS</th>
                                <th class="px-10 py-4 w-28 text-center">Bobot Matkul</th>
                                <th class="px-4 py-4 w-16">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                            @foreach ($matkuls->sortByDesc('created_at')->values() as $index => $matkul)
                                <tr class="bg-white border-b border-gray-300">
                                    <td class="pl-10 pr-4 py-4">{{ $index + 1 }}.</td>
                                    <td class="px-6 py-4">{{ $matkul->kode_matkul }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $matkul->nama_matkul }}</td>
                                    <td class="px-6 py-4 text-center">{{ $matkul->jml_sks }}</td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $matkul->jml_sks * 4 }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <form method="POST"
                                            action="{{ route('adminprodi.prestasi-akademik.deleteMatkul', $matkul->id) }}"
                                            onsubmit="return confirm('Anda yakin ingin menghapus mata kuliah ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center bg-red-500 text-white py-2 rounded w-8">
                                                <i class="fa fa-trash" style="font-size:18px"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="my-6 px-8">
                        {{ $matkuls->appends(['tab' => 'matkul'])->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div id="table-nilai" class="tabel-data {{ request('tab') !== 'nilai' ? 'hidden' : '' }}">
            <div class="border border-gray-300 rounded-2xl">
                <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                    <div class="py-6 px-10 bg-white">
                        <h1 class="text-lg font-bold text-center">Daftar Nilai Mata Kuliah</h1>
                    </div>
                    <table class="w-full text-left text-gray-700 table-fixed text-sm">
                        <thead class="text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                            <tr>
                                <th class="pl-10 pr-4 py-4 w-12">No.</th>
                                <th class="px-6 py-4 w-20">NIM</th>
                                <th class="px-6 py-4 w-24">Kode Matkul</th>
                                <th class="px-6 py-4 w-36">Nama Matkul</th>
                                <th class="px-6 py-4 text-center w-16">Nilai</th>
                                <th class="px-6 py-4 text-center w-16">Bobot</th>
                                <th class="px-6 py-4 text-center w-20">Semester</th>
                                <th class="px-4 py-4 w-16">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilais->sortByDesc('created_at')->values() as $index => $item)
                                <tr class="bg-white border-b border-gray-300">
                                    <td class="pl-10 pr-4 py-4">{{ $index + 1 }}.</td>
                                    <td class="px-6 py-4 font-medium text-black">{{ $item->user->nim ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $item->matkul->kode_matkul ?? '-' }}</td>
                                    <td class="px-6 py-4 font-medium text-black">{{ $item->matkul->nama_matkul ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->nilai }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->bobot }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->semester }}</td>
                                    <td class="px-4 py-4">
                                        <form method="POST"
                                            action="{{ route('adminprodi.daftar-nilai.delete', $item->id) }}"
                                            onsubmit="return confirm('Anda yakin ingin menghapus data prestasi akademik?')"
                                            class="w-full inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center bg-red-500 text-white py-2 rounded w-8">
                                                <i class="fa fa-trash" style="font-size:18px"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="my-6 px-8">
                        {{ $nilais->appends(['tab' => 'nilai'])->links() }} </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        function showTable(id) {
            const tables = document.querySelectorAll('.tabel-data');
            tables.forEach(table => table.classList.add('hidden'));

            const selectedTable = document.getElementById('table-' + id);
            if (selectedTable) selectedTable.classList.remove('hidden');

            ['akademik', 'matkul', 'nilai'].forEach(key => {
                const btn = document.getElementById('btn-' + key);
                if (btn) {
                    btn.classList.remove('text-white', 'bg-teal-700');
                    btn.classList.add('text-gray-700', 'bg-white');
                }
            });

            const activeBtn = document.getElementById('btn-' + id);
            if (activeBtn) {
                activeBtn.classList.add('text-white', 'bg-teal-700');
                activeBtn.classList.remove('text-gray-700', 'bg-white');
            }
            const url = new URL(window.location);
            url.searchParams.set('tab', id);
            window.history.replaceState({}, '', url);
        }
    </script>

@endsection
