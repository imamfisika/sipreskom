<x-form>
    <x-slot name="title">
        Register
    </x-slot>

    <div class="w-1/2 px-48 place-content-center">
        <div class="text-3xl font-bold py-2 mb-12">Silakan Registrasi Akun</div>

        <form method="POST" action="/register">
            @csrf

            {{-- Nama --}}
            <div>
                <label for="nama" class="block my-3 text-sm font-medium text-gray-900">
                    Nama Lengkap
                </label>
                <input
                    id="nama"
                    type="text"
                    name="nama"
                    required
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('nama')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIM --}}
            <div>
                <label for="nim" class="block my-3 text-sm font-medium text-gray-900">
                    Nomor Induk Mahasiswa/Pegawai
                </label>
                <input
                    id="nim"
                    type="text"
                    name="nim"
                    required
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('nim')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block my-3 text-sm font-medium text-gray-900">
                    Alamat Email
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    required
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block my-3 text-sm font-medium text-gray-900">
                    Password
                </label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block my-3 text-sm font-medium text-gray-900">
                    Konfirmasi Password
                </label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    class="mb-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="block w-full bg-teal-900 text-white py-3 rounded-md hover:bg-teal-950
                       focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-1
                       transition ease-in-out duration-150">
                {{ __('Register') }}
            </button>
        </form>

        {{-- Halaman Login --}}
        <p class="pt-5 text-sm text-center font-light text-gray-500">
            Sudah memiliki akun?
            <a href="login" class="font-semibold text-teal-700 hover:underline">Login</a>
        </p>
    </div>
</x-form>