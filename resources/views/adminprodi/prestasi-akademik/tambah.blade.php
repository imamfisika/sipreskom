@extends('layouts.app')

@section('title', 'Tambah Data Akademik')

@section('content')

    @include('components.sidebar.adminprodi')

    @php
        $activeForm = request('form', 'akademik');
    @endphp

    <div class="max-w-5xl mx-auto mt-10 bg-white shadow-md rounded-lg p-10 border">
        <div class="flex justify-between items-center mb-16">
            <a href="{{ route('adminprodi.prestasi-akademik.view') }}">
                <i class="fa fa-angle-left" style="font-size:36px"></i>
            </a>
            <div class="text-center text-xl font-bold">Tambah Prestasi Akademik</div>
            <i class="fa fa-angle-left" style="font-size:24px; visibility: hidden;"></i>
        </div>


        <div class="px-16 flex flex-row gap-6 items-center mb-8">
            <div class="text-base font-semibold">Pilih Form:</div>
            <div class="inline-flex shadow-xs" role="group">
                <a href="{{ route('adminprodi.prestasi-akademik.create', ['form' => 'akademik']) }}"
                    class="px-5 text-sm py-3 font-medium {{ $activeForm === 'akademik' ? 'text-white bg-teal-800' : 'text-gray-700 bg-white' }} border border-gray-300 rounded-s-lg hover:text-white hover:bg-teal-700">
                    Akademik
                </a>
                <a href="{{ route('adminprodi.prestasi-akademik.create', ['form' => 'matkul']) }}"
                    class="px-5 text-sm py-3 font-medium {{ $activeForm === 'matkul' ? 'text-white bg-teal-800' : 'text-gray-700 bg-white' }} border border-gray-300 border-l-0 hover:text-white hover:bg-teal-700">
                    Matkul
                </a>
                <a href="{{ route('adminprodi.prestasi-akademik.create', ['form' => 'nilai']) }}"
                    class="px-5 text-sm py-3 font-medium {{ $activeForm === 'nilai' ? 'text-white bg-teal-800' : 'text-gray-700 bg-white' }} border border-gray-300 border-l-0 rounded-e-lg hover:text-white hover:bg-teal-700">
                    Nilai
                </a>
            </div>
        </div>
        <hr class="w-fill h-px mx-16 my-8 bg-gray-400 border-0">



        @if (session('success'))
            <div id="success-alert"
                class="mx-16 mb-6 px-6 py-4 rounded-lg bg-green-100 border border-green-400 text-green-700 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button type="button" class="text-green-700 font-bold"
                    onclick="document.getElementById('success-alert').style.display='none'">x</button>
            </div>
        @endif
        @if ($errors->any())
            <div class="mx-16 mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if ($activeForm === 'akademik')
        <h2 class="text-lg font-bold mb-10 mx-16 text-teal-700">Input Indeks Prestasi :</h2>

        <div id="formManual" class="hidden">
            <form method="POST" action="{{ route('adminprodi.akademik.store') }}">
                @csrf
                <div class="grid grid-cols-2 gap-8 px-16">
                    <div>
                        <label for="nim" class="block font-semibold text-gray-600 mb-4">NIM :</label>
                        <input type="text" name="nim"
                            class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50" required>
                    </div>
                    <div>
                        <label for="semester" class="block font-semibold text-gray-600 mb-4">Semester :</label>
                        <input type="number" name="semester"
                            class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50" required>
                    </div>
                    <div>
                        <label for="jml_sks" class="block font-semibold text-gray-600 mb-4">Jumlah SKS :</label>
                        <input type="number" name="jml_sks"
                            class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50" required>
                    </div>
                    <div>
                        <label for="ip" class="block font-semibold text-gray-600 mb-4">Indeks Prestasi (IP) :</label>
                        <input type="text" name="ip"
                            class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50" required>
                    </div>
                </div>
                <div class="mt-16 px-16 text-center mb-10">
                    <button type="submit"
                        class="bg-teal-700 hover:bg-teal-800 text-white text-sm px-4 py-4 rounded-lg">
                        <i class="fa fa-paper-plane mr-2" style="font-size:16px"></i>Kirim Data
                    </button>
                    <button onclick="showForm('excel')"
                        type="button"
                        class="p-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-4 rounded-lg ml-1">
                        <i class="fa fa-file mr-2" style="font-size:16px"></i>Import Excel
                    </button>
                </div>
            </form>
        </div>

        <div id="formExcel">
            <form method="POST" action="{{ route('adminprodi.akademik.importExcel') }}" enctype="multipart/form-data"
                class="mx-16">
                @csrf
                <div class="flex gap-2 mb-12 items-left">
                    <input type="file" name="file" accept=".xlsx"
                        class="p-2 bg-gray-50 border border-gray-300 rounded-lg w-96" required>
                    <button type="submit"
                        class="bg-teal-700 hover:bg-teal-800 text-white text-sm px-4 py-2 rounded-lg">
                        <i class="fa fa-paper-plane mr-2" style="font-size:16px"></i>Kirim
                    </button>
                    <a href="{{ asset('downloads/template_akademik.xlsx') }}" download
                        class="bg-sky-600 hover:bg-sky-700 text-white text-sm px-4 py-2 rounded-lg content-center">
                        <i class="fa fa-download mr-2" style="font-size:16px"></i>Template
                    </a>
                    <button onclick="showForm('manual')"
                        type="button"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg content-center">
                        <i class="fa fa-pencil mr-2" style="font-size:16px"></i>Manual
                    </button>
                </div>
            </form>
        </div>

        <script>
            function showForm(form) {
                const forms = ['Manual', 'Excel'];
                forms.forEach(f => {
                    document.getElementById('form' + f).classList.add('hidden');
                });
                document.getElementById('form' + form.charAt(0).toUpperCase() + form.slice(1)).classList.remove('hidden');
            }

            document.addEventListener("DOMContentLoaded", function () {
                showForm('excel');
            });
        </script>
        @endif



        @if ($activeForm === 'matkul')
            <h2 class="text-lg font-bold mb-10 mx-16 text-teal-700">Input Mata Kuliah :</h2>

            <div id="formManual" class="hidden">
                <form method="POST" action="{{ route('adminprodi.matkul.store') }}">
                    @csrf
                    <div class="grid grid-cols-2 gap-8 px-16">
                        <div>
                            <label for="kode_matkul" class="block font-semibold text-gray-600 mb-4">Kode Matkul :</label>
                            <input type="text" name="kode_matkul"
                                class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 " required>
                        </div>
                        <div>
                            <label for="nama_matkul" class="block font-semibold text-gray-600 mb-4">Nama Matkul :</label>
                            <input type="string" name="nama_matkul" pattern="^[a-zA-Z\s\-]+$"
                                class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 " required>
                        </div>
                        <div>
                            <label for="jml_sks" class="block font-semibold text-gray-600 mb-4">Jumlah SKS :</label>
                            <input type="number" name="jml_sks"
                                class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 " required>
                        </div>
                    </div>
                    <div class="mt-16 px-16 text-center mb-10">
                        <button type="submit"
                            class="bg-teal-700 hover:bg-teal-800 text-white text-sm px-4 py-4 rounded-lg">
                            <i class="fa fa-paper-plane mr-2" style="font-size:16px"></i>
                            Kirim Data
                        </button>
                        <button onclick="showForm('excel')"
                            class="p-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-4 rounded-lg ml-1"><i
                                class="fa fa-file mr-2" style="font-size:16px"></i>
                            Import Excel
                        </button>
                    </div>
                </form>
            </div>

            <div id="formExcel">
                <form method="POST" action="{{ route('adminprodi.matkul.importExcel') }}" enctype="multipart/form-data"
                    class="mx-16">
                    @csrf
                    <div class="flex gap-2 mb-12 items-left">
                        <input type="file" name="file" accept=".xlsx"
                            class="p-2 bg-gray-50 border border-gray-300 rounded-lg w-96" required>
                        <button type="submit"
                            class="bg-teal-700 hover:bg-teal-800 text-white text-sm px-4 py-2 rounded-lg">
                            <i class="fa fa-paper-plane mr-2" style="font-size:16px"></i>Kirim
                        </button>
                        <a href="{{ asset('downloads/template_matkul.xlsx') }}" download
                            class="bg-sky-600 hover:bg-sky-700 text-white text-sm px-4 py-2 rounded-lg content-center">
                            <i class="fa fa-download mr-2" style="font-size:16px"></i>Template
                        </a>
                        <button onclick="showForm('manual')"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg content-center"><i
                                class="fa fa-pencil mr-2" style="font-size:16px"></i>Manual
                        </button>
                    </div>
                </form>
            </div>
            <script>
                function showForm(form) {
                    const forms = ['Manual', 'Excel'];
                    forms.forEach(f => {
                        document.getElementById('form' + f).classList.add('hidden');
                    });
                    document.getElementById('form' + form.charAt(0).toUpperCase() + form.slice(1)).classList.remove('hidden');
                }
                document.addEventListener("DOMContentLoaded", function() {
                    showForm('excel');
                });
            </script>
        @endif

        @if ($activeForm === 'nilai')
            <div class="text-lg font-bold mb-10 mx-16 text-teal-700">Input Nilai Mata Kuliah :</div>


            <div id="formManual" class="hidden">
                <form method="POST" action="{{ route('adminprodi.nilai.store') }}">
                    @csrf
                    <div class="grid grid-cols-2 gap-8 px-16">
                        <div>
                            <label for="nim" class="block font-semibold text-gray-600 mb-4">NIM :</label>
                            <input type="text" name="nim"
                                class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 " required>
                        </div>
                        <div>
                            <label for="kode_matkul" class="block font-semibold text-gray-600 mb-4">Kode Matkul :</label>
                            <input type="text" name="kode_matkul"
                                class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 " required>
                        </div>
                        <div>
                            <label for="bobot" class="block font-semibold text-gray-600 mb-4">Bobot :</label>
                            <input type="text" name="bobot"
                                class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 " required>
                        </div>
                        <div>
                            <label for="nilai" class="block font-semibold text-gray-600 mb-4">Nilai :</label>
                            <input type="text" name="nilai"
                                class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 " required>
                        </div>
                        <div>
                            <label for="semester" class="block font-semibold text-gray-600 mb-4">Semester :</label>
                            <input type="number" name="semester"
                                class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50 " required>
                        </div>
                    </div>
                    <div class="mt-16 px-16 text-center mb-10">
                        <button type="submit"
                            class="bg-teal-700 hover:bg-teal-800 text-white text-sm px-4 py-4 rounded-lg">
                            <i class="fa fa-paper-plane mr-2" style="font-size:16px"></i>
                            Kirim Data
                        </button>
                        <button onclick="showForm('excel')"
                            class="p-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-4 rounded-lg ml-1"><i
                                class="fa fa-file mr-2" style="font-size:16px"></i>
                            Import Excel
                        </button>
                    </div>
                </form>
            </div>

            <div id="formExcel">
                <form action="{{ route('adminprodi.nilai.import') }}" method="POST" enctype="multipart/form-data"
                    class="mx-16">
                    @csrf
                    <div class="flex gap-2 mb-12 items-left">
                        <input type="file" name="excel_file" accept=".xlsx"
                            class="p-2 bg-gray-50 border border-gray-300 rounded-lg w-96" required>
                        <button type="submit"
                            class="bg-teal-700 hover:bg-teal-800 text-white text-sm px-4 py-2 rounded-lg">
                            <i class="fa fa-paper-plane mr-2" style="font-size:16px"></i>Kirim </button>
                        <a href="{{ asset('downloads/template_nilai.xlsx') }}"
                            class="bg-sky-600 hover:bg-sky-700 text-white text-sm px-4 py-2 rounded-lg content-center"
                            download>
                            <i class="fa fa-download mr-2" style="font-size:16px"></i>Template
                        </a>
                        <button onclick="showForm('manual')"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg content-center"><i
                                class="fa fa-pencil mr-2" style="font-size:16px"></i>Manual</button>
                    </div>
                </form>
            </div>

            <script>
                function showForm(form) {
                    document.getElementById('formManual').classList.add('hidden');
                    document.getElementById('formExcel').classList.add('hidden');
                    document.getElementById('form' + form.charAt(0).toUpperCase() + form.slice(1)).classList.remove('hidden');
                }
            </script>
        @endif

    </div>
@endsection
