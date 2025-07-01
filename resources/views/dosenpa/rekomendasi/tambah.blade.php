@extends('layouts.app')

@section('title', 'Tambah Rekomendasi')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="mx-32">
        <div class="text-3xl font-bold mb-12 flex items-center">
            <a href="{{ route('dosenpa.rekomendasi.view') }}" class="text-gray-500 hover:text-black">Rekomendasi</a>
            <svg class="rtl:rotate-180 w-3 text-gray-400 mx-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="M1 9L5 5 1 1" />
            </svg>
            <span class="font-bold">Tambah Rekomendasi</span>
        </div>

        <div class="bg-white p-10 rounded-2xl mx-20 my-8 shadow-sm border border-gray-300">
            <div class="text-center text-xl font-bold mb-16">Tambah Rekomendasi</div>
            <form action="{{ route('dosenpa.rekomendasi.simpan') }}" method="POST">
                @csrf

                <div class="mb-10 flex items-center justify-center gap-3">
                    <label class="text-gray-600 font-semibold w-1/6">Nama Dosen:</label>
                    <input type="text" value="{{ $nama_dosen }}" disabled
                        class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 px-2.5">
                    <input type="hidden" name="nama_dosen" value="{{ $nama_dosen }}">
                </div>

                <div class="mb-10 flex items-center justify-center gap-3">
                    <label class="text-gray-600 font-semibold w-1/6">Mahasiswa:</label>
                    <select name="nim" id="nim"
                        class="w-1/2 bg-gray-50 border border-gray-300 text-gray-700 rounded-lg py-3 px-2.5" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach ($mahasiswa as $mhs)
                            <option value="{{ $mhs['nim'] }}">{{ $mhs['nim'] }} - {{ $mhs['nama'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-10 flex items-center justify-center gap-3">
                    <label class="text-gray-600 font-semibold w-1/6">Mata Kuliah 1:</label>
                    <select name="id_matkul[]" id="matkul1"
                        class="w-1/2 bg-gray-50 border border-gray-300 text-gray-700 rounded-lg py-3 px-2.5" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach ($matkuls as $matkul)
                            <option value="{{ $matkul->id }}">{{ $matkul->nama_matkul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-10 flex items-center justify-center gap-3">
                    <label class="text-gray-600 font-semibold w-1/6">Mata Kuliah 2:</label>
                    <select name="id_matkul[]" id="matkul2"
                        class="w-1/2 bg-gray-50 border border-gray-300 text-gray-700 rounded-lg py-3 px-2.5">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach ($matkuls as $matkul)
                            <option value="{{ $matkul->id }}">{{ $matkul->nama_matkul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-10 flex items-center justify-center gap-3">
                    <label for="keterangan" class="text-gray-600 font-semibold w-1/6">Isi Rekomendasi:</label>
                    <textarea name="keterangan" rows="4" required
                        class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg p-3 font-normal"></textarea>
                </div>

                <div class="text-center mt-16">
                    <button type="submit"
                        class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-1 focus:ring-teal-600 rounded-lg text-sm px-4 py-2.5 inline-flex items-center">
                        <i class="fa fa-paper-plane mr-3" style="font-size:18px"></i>
                        Kirim Rekomendasi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
