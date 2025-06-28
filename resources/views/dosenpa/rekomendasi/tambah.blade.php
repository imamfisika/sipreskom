@extends('layouts.app')

@section('title', 'Tambah Rekomendasi')

@section('content')

    @include('components.sidebar.dosenpa')

    <div class="mx-32">

        <div class="text-3xl font-bold mb-12 flex items-center">
            <a href="{{ route('dosenpa.rekomendasi.view') }}" class="text-gray-500 hover:text-black">Rekomendasi</a>
            <svg class="rtl:rotate-180 w-3 text-gray-400 mx-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10" aria-hidden="true">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M1 9L5 5 1 1" />
            </svg>
            <span class="font-bold">Tambah Rekomendasi</span>
        </div>

        <div class="bg-white p-10 rounded-2xl mx-20 my-8 shadow-sm border border-gray-300">
            <div class="container">
                <h2 class="text-2xl text-center font-semibold mb-16">Tambah Rekomendasi</h2>
                <form>
                    <div class="mb-10 flex items-center justify-center gap-5">
                        <label for="name" class="text-gray-600 w-1/6">Nama Dosen:</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="Nama Dosen"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 px-2.5"
                            readonly>
                    </div>

                    <div class="mb-10 flex items-center justify-center gap-5">
                        <label for="nim" class="text-gray-600 w-1/6">NIM Mahasiswa:</label>
                        <select
                            id="nim"
                            name="nim"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 px-2.5"
                            required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            <option value="123456">123456 - Mahasiswa 1</option>
                            <option value="789012">789012 - Mahasiswa 2</option>
                        </select>
                    </div>

                    <div class="mb-10 flex items-center justify-center gap-5">
                        <label class="text-gray-600 w-1/6">Matkul Rekomendasi 1:</label>
                        <select
                            name="matkul_rekomendasi[]"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 px-2.5"
                            required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <option value="Matkul 1">Matkul 1</option>
                            <option value="Matkul 2">Matkul 2</option>
                        </select>
                    </div>

                    <div class="mb-10 flex items-center justify-center gap-5">
                        <label class="text-gray-600 w-1/6">Matkul Rekomendasi 2:</label>
                        <select
                            name="matkul_rekomendasi[]"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 px-2.5"
                            required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <option value="Matkul 3">Matkul 3</option>
                            <option value="Matkul 4">Matkul 4</option>
                        </select>
                    </div>

                    <div class="mb-10 flex items-center justify-center gap-5">
                        <label for="isi" class="text-gray-600 w-1/6">Isi Rekomendasi:</label>
                        <textarea
                            id="isi"
                            name="isi"
                            rows="4"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-500 rounded-lg p-2.5 font-normal"
                            required>Isi rekomendasi</textarea>
                    </div>

                    <div class="text-center mt-16">
                        <button
                            type="button"
                            class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-1 focus:ring-teal-600 font-medium rounded-lg text-sm px-3 py-2.5 inline-flex items-center">
                            <i class="fa fa-paper-plane mr-2" style="font-size:18px"></i>
                            Kirim Rekomendasi
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
