@if (auth()->user()->role === 'admin')
<x-layout>

    <x-slot name="title">
        Tambah Rekomendasi </x-slot>

    <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
        <div class="mx-20 text-3xl font-bold text-gray-500 mb-12 flex ">
            <a href="rekomendasi" class="hover:text-gray-700">Rekomendasi</a>
            <svg class="rtl:rotate-180 w-3 text-gray-400 mx-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="m1 9 4-4-4-4" />
            </svg>
            <div class="font-bold text-black">Tambah Rekomendasi</div>

        </div>
        <div class="bg-white p-10 rounded-2xl mx-20 my-8 shadow-sm border border-gray-300">

            <div class="containers">
                <div class="text-2xl text-center font-bold mb-16">Tambah Rekomendasi</div>
                <form action="{{ route('rekomendasi.store') }}" method="POST">
                    @csrf
                    <div class="mb-8 gap-5 flex items-center justify-center">
                        <label for="name" class="text-gray-600 w-1/6">Nama Dosen:</label>
                        <input type="text"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 p-2.5"
                            id="name" name="name" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="mb-8 gap-5 flex items-center justify-center">
                        <label for="nim" class="text-gray-600 w-1/6">NIM Mahasiswa:</label>
                        <select name="nim"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 p-2.5">
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($mahasiswas as $mhs)
                            <option value="{{ $mhs->nim }}">{{ $mhs->nim }} - {{ $mhs->name }}</option>
                        @endforeach


                        </select>
                    </div>
                    <div class="mb-8 gap-5 flex items-center justify-center">
                        <label class="text-gray-600 w-1/6">Matkul Rekomendasi 1:</label>
                        <select name="matkul_rekomendasi[]"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg py-5 p-2.5"
                            required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($matakuliahs as $matkul)
                                <option value="{{ $matkul->nama_matkul }}">{{ $matkul->nama_matkul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-8 gap-5 flex items-center justify-center">
                        <label class="text-gray-600 w-1/6">Matkul Rekomendasi 2:</label>
                        <select name="matkul_rekomendasi[]"
                            class="w-1/2 bg-gray-50 border border-gray-300 text-gray-600 rounded-lg p-2.5" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($matakuliahs as $matkul)
                                <option value="{{ $matkul->nama_matkul }}">{{ $matkul->nama_matkul }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-8 gap-5 flex items-center justify-center">
                        <label for="isi" class="text-gray-600 w-1/6">Isi Rekomendasi:</label>
                        <textarea class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg block w-1/2 p-2.5 font-normal"
                            id="isi" name="isi" rows="4" required></textarea>
                    </div>

                    <div class="items-center text-center mt-10">
                        <button type="submit"
                            class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-1 focus:ring-teal-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center">
                            <div class="fa fa-paper-plane mr-4" style="font-size:18px"></div>
                            Kirim Rekomendasi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <br><br><br>
</x-layout>
@elseif(in_array(auth()->user()->role, ['mahasiswa', 'superadmin']))
    <script>
        window.location.href = "{{ route('dashboard') }}";
    </script>
@endif