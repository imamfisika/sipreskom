<x-form>
    <x-slot name="title">
        Login
    </x-slot>

    <div class="w-1/2 px-48 place-content-center">
        <div class="text-3xl font-bold py-2 mb-12">Silakan Login</div>

        <form method="POST" action="{{ route('login.form') }}">
            @csrf
            @if (session('success'))
                <div class="alert alert-success mb-2 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-2 text-red-500">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div>
                <label for="nim" class="block my-3 text-sm font-medium text-gray-900">
                    Nomor Induk Mahasiswa
                </label>
                <input type="text" name="nim" id="nim" required value="{{ old('nim') }}"
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5">
            </div>

            <div>
                <label for="password" class="block my-3 text-sm font-medium text-gray-900">
                    Password
                </label>
                <input type="password" name="password" id="password" required
                    class="mb-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5">
            </div>

            <button type="submit"
                class="w-full bg-teal-900 text-white py-3 rounded-md hover:bg-teal-950
                       focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-1
                       transition ease-in-out duration-150">
                {{ __('Login') }}
            </button>
            <p class="pt-5 text-sm text-center font-light text-gray-500">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="font-semibold text-teal-700 hover:underline">Register</a>
            </p>
        </form>
    </div>
</x-form>
