<nav x-data="{ open: false }" class="bg-emerald-600 fixed top-0 z-50 w-full">
    <div class="mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center font-black text-3xl text-white">
                    <a href="{{ route('dashboard') }}">
                        {{ config('app.name') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
