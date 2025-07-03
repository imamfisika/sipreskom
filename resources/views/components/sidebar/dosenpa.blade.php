<aside id="separator-sidebar" class="h-full overflow-hidden fixed top-0 left-0 w-72">
    <div class="h-full overflow-hidden px-3 py-4 bg-teal-900 border-r-1">
        <div class="mt-2 ml-5 pt-5 pb-8 font-bold text-2xl text-white">
            <a href="{{ route('dosenpa.dashboard') }}">
                {{ config('app.name') }}
            </a>
        </div>
        <ul class="space-y-2">
            <li>
                <div class="flex items-center p-2 mt-5 ml-3 mb-3 font-black text-gray-300 text-sm">
                    MAIN MENU
                </div>
            </li>
            <li>
                <a href="{{ route('dosenpa.dashboard') }}"
                    class="text-sm flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer {{ request()->routeIs('dosenpa.dashboard') ? 'text-white font-semibold' : '' }}">
                    <i class="fa fa-pie-chart" style="font-size:21px"></i>
                    <span class="flex-1 ml-4 whitespace-nowrap">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dosenpa.prestasi-akademik.index') }}"
                    class="text-sm flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer {{ request()->routeIs('dosenpa.prestasi-akademik.index') || request()->routeIs('dosenpa.prestasi-akademik.mahasiswa') ? 'text-white font-semibold' : '' }}">
                    <i class="fa fa-trophy" style="font-size:22px"></i>
                    <span class="flex-1 ml-4 whitespace-nowrap">Prestasi Akademik</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dosenpa.rekomendasi.view') }}"
                    class="text-sm flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer {{ request()->routeIs('dosenpa.rekomendasi.view') || request()->routeIs('dosenpa.rekomendasi.tambah') ? 'text-white font-semibold' : '' }}">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="flex-1 ml-4 whitespace-nowrap">Rekomendasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dosenpa.prestasi-akademik.laporan') }}"
                    class="text-sm flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer {{ request()->routeIs('dosenpa.prestasi-akademik.laporan') ? 'text-white font-semibold' : '' }}">
                    <i class="fa fa-book" style="font-size:22px"></i>
                    <span class="flex-1 ml-4 whitespace-nowrap">Laporan Akademik</span>
                </a>
            </li>
        </ul>
        <ul class="pt-4 mt-10 font-medium border-t-1 border-gray-400 space-y-2">
            <li>
                <div class="flex items-center p-2 mt-6 mb-3 ml-3 font-black text-gray-300 text-sm">
                    SETTING
                </div>
            </li>
            <li>
                <a href="{{ route('dosenpa.profile') }}"
                    class="text-sm flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer {{ request()->routeIs('profil') ? 'text-white font-semibold' : '' }}">
                    <i class="fa fa-user" style="font-size:25px"></i>
                    <span class="flex-1 ml-4 whitespace-nowrap">Profil Saya</span>
                </a>
            </li>
            <li>
                <a {{-- href="{{ route('login') }}" --}}
                    onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin logout?')) { document.getElementById('logout-form').submit(); }"
                    class="text-sm flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer">
                    <i class="fa fa-sign-out" style="font-size:22px"></i>
                    <span class="flex-1 ml-4 whitespace-nowrap">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>
