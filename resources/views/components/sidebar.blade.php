<aside id="separator-sidebar" class="h-screen fixed top-0 left-0 z-40 w-72">
    <div class="h-full px-3 py-4 overflow-y-auto bg-linear-to-bl from-teal-950 to-teal-700 border-r-1">
        <div class="mt-2 ml-5 pt-5 pb-8 font-black text-2xl text-white">
            <a href="{{ route('dashboard') }}">
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
                <a href="dashboard" class="flex items-center p-4 ml-1 text-gray-200 rounded-lg hover:text-gray-900 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-900" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <div class="flex-1 ml-4 whitespace-nowrap">
                        Dashboard
                    </div>

                </a>
            </li>
            <li>
                <a href="prestasi-akademik"
                    class="flex items-center p-4 ml-1 text-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-900 group">
                    <svg class="w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-900"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    <div class="flex-1 ml-4 whitespace-nowrap">Prestasi Akademik</div>
                </a>
            </li>
            <li>
                <a href="rekomendasi"
                    class="flex items-center p-4 ml-1 mb-10 text-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-900 group">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-900"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div class="flex-1 ml-4 whitespace-nowrap">Rekomendasi</div>
                </a>
            </li>
        </ul>
        <ul class="pt-4 mt-5 space-y-2 font-medium border-t-1 border-gray-400">
            <li>
                <div class="flex items-center p-2 mt-10 mb-3 ml-3 font-black text-gray-300 text-sm">
                    SETTING
                </div>
            </li>
            <li>
                <a href="profil" class="flex items-center p-4 ml-1 text-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-900 group">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-900"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <div class="flex-1 ml-4 whitespace-nowrap">Profil</div>
                </a>
            </li>
            <li>
                <div class="mt-40 text-center text-gray-200 hover:font-bold">
                    <a href="login">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</aside>
