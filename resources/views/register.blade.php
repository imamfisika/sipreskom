<x-form>

    <x-slot name="title">
        Register</x-slot>

    <div class="w-1/2 px-48 h-screen place-content-center ">
        <div class="text-3xl font-bold py-2 mb-12">Silahkan Registrasi Akun</div>
        {{-- <form action="{{ route('register') }}" method="POST" class="space-y-4" novalidate> --}}
        <form action="{{ route('register') }}" class="space-y-4" novalidate>

            @csrf
            <div>
                <label for="nama" class="block my-3 text-sm font-medium text-gray-900 ">Nama Lengkap</label>
                <input type="nama" id="nama" name="nama" required :value="old('nama')"
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

            </div>
            <div>
                <label for="nim" class="block my-3 text-sm font-medium text-gray-900 ">Nomor Induk
                    Mahasiswa</label>
                <input type="nim" id="nim" name="nim" required" :value="old('nim')"
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

            </div>
            <div>
                <label for="email" class="block my-3 text-sm font-medium text-gray-900 ">Alamat email</label>
                <input type="text" id="email" name="email" required :value="old(key: 'email')"
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div>
                <label for="password" class="block my-3 text-sm font-medium text-gray-900">Password</label>
                <input type="password" id="password" required name="password" :value="old(key: 'password')" required
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div>
                <label for="comfirmation-password" class="block my-3 text-sm font-medium text-gray-900">Konfirmasi
                    password</label>
                <input type="comfirmation-password" id="comfirmation-password" required name="comfirmation-password"
                    required
                    class="mb-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-start mb-5">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300"
                            required="">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-500">Saya menerima <a href="#"
                                class="font-semibold text-teal-700 hover:underline">Syarat dan
                                Ketentuan</a></label>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="p-2.5 block w-full bg-teal-900 text-white py-3 rounded-md hover:bg-teal-950 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-1 transition ease-in-out duration-150">
                {{ __('Register') }}
            </button>

            <p class="pt-5 text-sm text-center font-light text-gray-500">
                Sudah memiliki akun? <a href="login" class="font-semibold text-teal-700 hover:underline">Login</a>
            </p>

        </form>
    </div>
</x-form>
