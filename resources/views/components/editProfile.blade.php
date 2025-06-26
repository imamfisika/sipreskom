<div>
    <form method="post">

        @csrf
        <div class="grid gap-12 mb-10 grid-cols-2 text-md font-semibold">
            <div>
                <div for="nama" class="block my-3 text-gray-400 ">Nama Lengkap</div>
                <input type="nama" id="nama" name="nama" required :value="old('nama')"
                    placeholder="Muhamamad Izzat Azizan"
                    class="bg-gray-50 border text-sm border-gray-300 rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5">
            </div>
            <div>
                <div for="nim" class="block my-3 text-gray-400 ">Nomor Induk
                    Mahasiswa</div>
                <input type="nim" id="nim" name="nim" required" :value="old('nim')"
                    placeholder="1313621013"
                    class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5">
            </div>
            <div>
                <div for="angkatan" class="block my-3 text-gray-400 ">Angkatan</div>
                <input type="text" id="angkatan" name="angkatan" required :value="old(key: 'angkatan')"
                    placeholder="2021" disabled
                    class="bg-gray-200 border border-gray-400 rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5">
            </div>
            <div>
                <div for="email" class="block my-3 text-gray-400 ">Alamat email</div>
                <input type="text" id="email" name="email" required :value="old(key: 'email')"
                    placeholder="ijat@gmail.com"
                    class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5">
            </div>
        </div>

        <div>
            <div>
                Konfirmasi perubahan
            </div>
            <div>
                <div for="password" class="block my-3 text-gray-400">Password</div>
                <input type="password" id="password" required name="password" :value="old(key: 'password')" required
                    placeholder="********"
                    class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5">
            </div>
        </div>
    </form>

</div>
