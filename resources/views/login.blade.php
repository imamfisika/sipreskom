<x-form>

    <x-slot name="title">
        Login</x-slot>


    <div class="w-1/2 px-48 h-screen place-content-center ">
        <div class="text-3xl font-bold py-2 mb-12">Silahkan Login</div>

        {{-- <form action="{{ route('dashboard') }}" method="POST" class="space-y-4"> --}}
        <form action="{{ route('dashboard') }}" class="space-y-4">
            @csrf
            <div>
                <label for="nim" class="block my-3 text-sm font-medium text-gray-900 ">Nomor Induk
                    Mahasiswa</label>
                <input type="text" id="nim" name="nim" required
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div>
                <label for="password" class="block my-3 text-sm font-medium text-gray-900">Password</label>
                <input type="password" id="password" name="password" required
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
                        <label for="remember" class="text-gray-500">Ingat saya</label>
                    </div>
                </div>
                <a href="" class="mb-5 text-sm font-semibold text-gray-900 hover:underline">Lupa
                    password?</a>
            </div>

            <button type="submit"
                class="p-2.5 block w-full bg-teal-900 text-white py-3 rounded-md hover:bg-teal-950 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-1 transition ease-in-out duration-150">
                Login
            </button>

            <p class="pt-5 text-sm text-center font-light text-gray-500">
                Belum memiliki akun? <a href="register" class="font-semibold text-teal-700 hover:underline">Register</a>
            </p>

        </form>
    </div>
</x-form>
