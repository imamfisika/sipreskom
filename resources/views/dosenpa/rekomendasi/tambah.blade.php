@extends('layouts.app')

@section('title', 'Tambah Rekomendasi')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="mx-32">

        <div class="text-3xl font-bold mb-12 flex">
            <a href="{{ route('dosenpa.rekomendasi.view') }}" class="text-gray-500 hover:text-black">Rekomendasi</a>
            <svg class="rtl:rotate-180 w-3 text-gray-400 mx-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="m1 9 4-4-4-4" />
            </svg>
            <div class="font-bold">Tambah Rekomendasi</div>
        </div>

        <div class="bg-white p-10 rounded-2xl mx-20 my-8 shadow-sm border border-gray-300">
            <div class="containers">
                <div class="text-2xl text-center font-semibold mb-16">Tambah Rekomendasi</div>
                <form>
                    <div class="mb-10 gap-5 flex items-center justify-center">
                        <label for="name" class="text-gray-600 w-1/6">Nama Dosen:</label>
                        <input type="text"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 p-2.5"
                            id="name" name="name" value="Nama Dosen" readonly>
                    </div>
                    <div class="mb-10 gap-5 flex items-center justify-center">
                        <label for="nim" class="text-gray-600 w-1/6">NIM Mahasiswa:</label>
                        <select name="nim"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 p-2.5" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            <option value="123456">123456 - Mahasiswa 1</option>
                            <option value="789012">789012 - Mahasiswa 2</option>
                        </select>
                    </div>
                    <div class="mb-10 gap-5 flex items-center justify-center">
                        <label class="text-gray-600 w-1/6">Matkul Rekomendasi 1:</label>
                        <select name="matkul_rekomendasi[]"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 p-2.5" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <option value="Matkul 1">Matkul 1</option>
                            <option value="Matkul 2">Matkul 2</option>
                        </select>
                    </div>
                    <div class="mb-10 gap-5 flex items-center justify-center">
                        <label class="text-gray-600 w-1/6">Matkul Rekomendasi 2:</label>
                        <select name="matkul_rekomendasi[]"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg p-2.5" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <option value="Matkul 3">Matkul 3</option>
                            <option value="Matkul 4">Matkul 4</option>
                        </select>
                    </div>

                    <div class="mb-10 gap-5 flex items-center justify-center">
                        <label for="isi" class="text-gray-600 w-1/6">Isi Rekomendasi:</label>
                        <textarea class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-1/2 p-2.5 font-normal"
                            id="isi" name="isi" rows="4" required>Isi rekomendasi</textarea>
                    </div>

                    <div class="items-center text-center mt-16">
                        <button type="button"
                            class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-1 focus:ring-teal-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center">
                            <div class="fa fa-paper-plane mr-2" style="font-size:18px"></div>
                            Kirim Rekomendasi
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>

@endsection
