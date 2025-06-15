<aside id="separator-sidebar" class="h-screen fixed top-0 left-0 z-40 w-72">
    <div class="h-full px-3 py-4 overflow-y-auto bg-linear-to-bl from-teal-950 to-teal-700 border-r-1">
        <div class="mt-2 ml-5 pt-5 pb-8 font-black text-2xl text-white">
            <a href="dashboard">
                {{ config('app.name') }}
            </a>
        </div>
        <ul class="space-y-2">
            <li>
                <div class="flex items-center p-2 mt-5 ml-3 mb-3 font-black text-gray-300 text-sm">
                    DAFTAR ROLE </div>
            </li>
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer {{ request()->routeIs('dashboard') ? 'text-white font-bold' : 'text-gray-900 group-hover:text-black' }}">
                    <i class="fa fa-user" style="font-size:25px"></i>
                    <span class="flex-1 ml-6 whitespace-nowrap">Dosen</span>
                </a>
            </li>
            <li>
                <a href="{{ route('list-mhs') }}"
                    class="flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer {{ request()->routeIs('list-mhs') ? 'text-white font-bold' : 'text-gray-900 group-hover:text-black' }}">
                    <i class="fa fa-mortar-board" style="font-size:21px; color:white"></i>
                    <span class="flex-1 ml-4 whitespace-nowrap">Mahasiswa</span>
                </a>
            </li>
        </ul>
            <ul class="pt-4 mt-10 font-medium border-t-1 border-gray-400 space-y-2">
            <li>
                <a href="{{ route('login') }}"
                    onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin logout?')) { document.getElementById('logout-form').submit(); }"
                    class="flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer">
                    <i class="fa fa-sign-out" style="font-size:25px"></i>
                    <span class="flex-1 ml-6 whitespace-nowrap">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>
