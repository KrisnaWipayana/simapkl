<aside id="sidebar" class="w-64 bg-dark-green dark:bg-gray-800 text-white transition-all duration-300 flex flex-col">
    <div class="flex items-center justify-between h-16 px-4 border-b border-green-900 dark:border-gray-700">
        <span class="font-bold text-lg">SIMAPKL</span>
        <button id="sidebar-toggle" class="focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
        </button>
    </div>
    <nav class="flex-1 px-2 py-4 space-y-2">
        <a href="{{ route('dashboard.mahasiswa') }}" class="block py-2 px-4 rounded hover:bg-light-green dark:hover:bg-green-700 transition">Laporan Magang</a>
        <!-- Tambahkan menu lain di sini -->
    </nav>
    <form action="{{ route('logout.mahasiswa') }}" method="POST" class="p-4 border-t border-green-900 dark:border-gray-700">
        @csrf
        <button type="submit" class="w-full py-2 px-4 rounded bg-light-green dark:bg-green-700 hover:bg-green-600 dark:hover:bg-green-800 text-white font-semibold transition">Logout</button>
    </form>
</aside>