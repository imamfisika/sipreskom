@extends('layouts.app')

@section('title', 'Tambah Prestasi Akademik')

@section('content')
    @include('components.sidebar.adminprodi')

    <div class="max-w-5xl mx-auto mt-10 bg-white shadow-md rounded-lg p-8 border">
        <div class="text-center text-xl font-bold mb-12">Tambah Data Akademik, Matkul, & Nilai</div>

        <form method="POST" action="{{ route('adminprodi.akademik.store') }}" class="mb-12">

            @if (session('success'))
                <div id="success-alert"
                    class="mb-6 px-6 py-4 rounded-lg bg-green-100 border border-green-400 text-green-700 flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="text-green-700 font-bold"
                        onclick="document.getElementById('success-alert').style.display='none'">x</button>
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Terjadi kesalahan:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf
            <h2 class="text-lg font-semibold mb-10 mx-16">Form Akademik</h2>
            <div class="grid grid-cols-2 gap-8 px-16">
                <div>
                    <label for="nim" class="block font-semibold mb-4">NIM :</label>
                    <input type="text" name="nim" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="semester" class="block font-semibold mb-4">Semester :</label>
                    <input type="number" name="semester" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="jml_sks" class="block font-semibold mb-4">Jumlah SKS :</label>
                    <input type="number" name="jml_sks" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="ip" class="block font-semibold mb-4">Indeks Prestasi (IP) :</label>
                    <input type="text" name="ip" class="w-full border rounded p-2" required>
                </div>
            </div>
            <div class="mt-10 text-right px-16">
                <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white text-sm px-4 py-2.5 rounded-lg">
                    Simpan</button>
            </div>
        </form>

        <form method="POST" action="{{ route('adminprodi.matkul.store') }}" class="mb-12">

            @csrf
            <h2 class="text-lg font-semibold mb-10 mx-16">Form Matkul</h2>
            <div class="grid grid-cols-2 gap-8 px-16">
                <div>
                    <label for="kode_matkul" class="block font-semibold mb-4">Kode Matkul :</label>
                    <input type="text" name="kode_matkul" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="nama_matkul" class="block font-semibold mb-4">Nama Matkul :</label>
                    <input type="text" name="nama_matkul" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="jml_sks" class="block font-semibold mb-4">Jumlah SKS :</label>
                    <input type="number" name="jml_sks" class="w-full border rounded p-2" required>
                </div>
            </div>
            <div class="mt-10 text-right px-16">
                <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white text-sm px-4 py-2.5 rounded-lg">
                    Simpan
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('adminprodi.nilai.store') }}">

            @csrf
            <h2 class="text-lg font-semibold mb-10 mx-16">Form Nilai</h2>

            <div class="grid grid-cols-2 gap-8 px-16">
                <div>
                    <label for="nim" class="block font-semibold mb-4">NIM :</label>
                    <input type="number" name="nim" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="kode_matkul" class="block font-semibold mb-4">Kode Matkul :</label>
                    <input type="number" name="kode_matkul" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="bobot" class="block font-semibold mb-4">Bobot :</label>
                    <input type="text" name="bobot" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="nilai" class="block font-semibold mb-4">Nilai :</label>
                    <input type="text" name="nilai" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="semester" class="block font-semibold mb-4">Semester :</label>
                    <input type="number" name="semester" class="w-full border rounded p-2" required>
                </div>
            </div>
            <div class="mt-10 text-right px-16">
                <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white text-sm px-4 py-2.5 rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
