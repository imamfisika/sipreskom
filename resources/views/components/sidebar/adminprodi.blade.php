<aside id="separator-sidebar" class="h-screen fixed top-0 left-0 z-40 w-72">
    <div class="h-full overflow-hidden px-3 py-4 bg-teal-900 border-r-1">
        <div class="mt-2 ml-5 pt-5 pb-8 font-bold text-2xl text-white">
            <a href="{{ route('adminprodi.dashboard') }}">
                {{ config('app.name') }}
            </a>
        </div>
        <ul class="space-y-2">
            <li>
                <div class="flex items-center p-2 mt-5 ml-3 mb-3 font-extrabold text-gray-300 text-sm">
                    PENGATURAN</div>
            </li>
            <li>
                <a href="{{ route('adminprodi.dashboard') }}"
                    class="text-sm flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer {{ request()->routeIs('adminprodi.dashboard') ? 'text-white font-semibold' : '' }}">
                    <i class="fa fa-pie-chart" style="font-size:21px"></i>
                    <span class="flex-1 ml-4 whitespace-nowrap">Dashboard</span></a>
            </li>
            <li>
                <a href="{{ route('adminprodi.kelola-pengguna.view') }}"
                    class="text-sm flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer {{ request()->routeIs('adminprodi.kelola-pengguna.view') ? 'text-white font-semibold' : '' }}">
                    <i class="fa fa-user" style="font-size:25px"></i>
                    <span class="flex-1 ml-4 whitespace-nowrap">Kelola Pengguna</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminprodi.prestasi-akademik.view') }}"
                    class="text-sm flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer {{ request()->routeIs('adminprodi.prestasi-akademik.view') ? 'text-white font-semibold' : '' }}">
                    <i class="fa fa-trophy" style="font-size:22px"></i>
                    <span class="flex-1 ml-4 whitespace-nowrap">Kelola Prestasi</span>
                </a>
            </li>
        </ul>
        <ul class="pt-4 mt-10 border-t-1 border-gray-400 space-y-2">
            <li>
                <a href="#"
                    onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin logout?')) { document.getElementById('logout-form').submit(); }"
                    class="text-sm flex items-center p-4 ml-1 text-white rounded-lg hover:bg-teal-600 group cursor-pointer">
                    <i class="fa fa-sign-out" style="font-size:25px"></i>
                    <span class="flex-1 ml-4 whitespace-nowrap">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>
