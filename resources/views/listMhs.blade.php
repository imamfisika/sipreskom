@if (auth()->user()->role === 'superadmin')
    <x-layout>

        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Data Mahasiswa Berhasil Dihapus!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        <x-slot name="title">
            Daftar Mahasiswa </x-slot>

        <div class="px-40 pt-16 sm:ml-64 scroll-smooth">
            <div class="mx-20">
                <div class="text-3xl font-bold mb-6">
                    Daftar Mahasiswa </div>

                <div class="mt-12 border border-gray-300 rounded-2xl">
                    <div class="overflow-x-auto shadow-sm sm:rounded-2xl">
                        <table class="w-full text-m text-left text-gray-700">
                            <thead class="font-bold text-gray-200 border-b border-t bg-teal-900 border-gray-400">
                                <tr>
                                    <th class="pl-10 py-6">No.</th>
                                    <th class="px-8 py-6">Nama Mahasiswa</th>
                                    <th class="px-4 py-6">NIM</th>
                                    <th class="px-8 py-6">Angkatan</th>
                                    <th class="px-8 py-6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($mahasiswa as $index => $user)
                                    <tr class="border-b border-gray-300">
                                        <td class="pl-10 py-6">{{ $index + 1 }}.</td>
                                        <td class="px-8 py-6">{{ $user->name }}</td>
                                        <td class="px-4 py-6">{{ $user->nim }}</td>
                                        <td class="px-12 py-6">20{{ $user->angkatan }}</td>
                                        <td class="px-4 py-6">
                                            <form action="{{ route('hapus-mahasiswa', $user->nim) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-800 text-sm font-semibold text-white px-3 py-1 rounded">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    </x-layout>
@else
    <script>
        window.location.href = "{{ route('dashboard') }}";
    </script>
@endif
