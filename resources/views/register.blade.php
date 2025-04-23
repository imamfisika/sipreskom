<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-indigo-100 h-screen px-20">
    <div class="bg-white flex rounded-3xl shadow-md w-full">
        <!-- Left Side (Image) -->
        <div class="w-1/2 place-content-center rounded-2xl text-white text-wrap bg-emerald-600 my-8 ml-8">
            <div class="px-20 text-center">
                <p class="mb-4 text-xl font-light">Selamat Datang di</p>
                <h1 class="text-4xl px-12 font-bold mb-6">Sistem Informasi
                    Monitoring Prestasi Akademik</h1>
                <h1 class="text-md leading-7 px-6 mb-16">Platform untuk memantau prestasi akademik mahasiswa berdasarkan
                    capaian nilai
                    akademik yang diraih
                    selama masa studi sebagai mahasiswa aktif di Program Studi Ilmu Komputer Universitas Negeri Jakarta.
                </h1>
                <img class="scale-125 px-10" src="{{ url('storage/images/monitoring.png') }}" alt="">
            </div>
        </div>
        <!-- Right Side (Login Form) -->
        <div class="w-1/2 px-48 h-screen place-content-center ">
            <h2 class="text-3xl font-bold py-2 mb-16">Silahkan Registrasi</h2>
            <form action="{{ route('register') }}" method="POST" class="space-y-4" novalidate>
                @csrf
                <div>
                    <label for="nim" class="block my-4 text-sm font-medium text-gray-900 ">Nomor Induk
                        Mahasiswa</label>
                    <input type="nim" id="nim" name="nim" required placeholder="Masukkan NIM" :value="old('nim')"
                        class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    </div>
                <div>
                    <label for="email" class="block my-4 text-sm font-medium text-gray-900 ">Alamat email</label>
                    <input type="text" id="email" name="email" required placeholder="Masukkan email" :value="old(key: 'email')"
                        class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div>
                    <label for="password" class="block my-4 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" id="password" required placeholder="Masukkan password" name="password" :value="old(key: 'password')"
                        required
                        class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div>
                    <label for="comfirmation-password" class="block my-4 text-sm font-medium text-gray-900">Konfirmasi
                        password</label>
                    <input type="comfirmation-password" id="comfirmation-password" required
                        placeholder="Masukkan kembali password" name="comfirmation-password" required
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
                                    class="font-medium text-emerald-600 hover:underline">Syarat dan
                                    Ketentuan</a></label>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="p-2.5 block w-full bg-emerald-600 text-white py-3 rounded-md hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    {{ __('Register') }}
                </button>

                <p class="pt-5 text-sm text-center font-light text-gray-500">
                    Sudah memiliki akun? <a href="login" class="font-medium text-gray-700 hover:underline">Login</a>
                </p>

            </form>
        </div>

    </div>
</body>

</html>
