<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>@yield('title', 'Dashboard Magang')</title> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        mint: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .sidebar-icon {
                @apply flex items-center justify-center h-12 w-12 mt-2 mb-2 mx-auto bg-gray-100 dark:bg-gray-800 text-mint-600 dark:text-gray-300 hover:bg-mint-200 dark:hover:bg-gray-700 rounded-xl hover:rounded-3xl transition-all duration-300 ease-linear cursor-pointer;
            }
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="flex h-screen">
        
        <div id="sidebar" class="w-0 bg-white dark:bg-gray-800 shadow-lg transition-all duration-300 overflow-hidden">
            <div class="flex flex-col items-center mt-1">
                <form action="{{ route('logout.mahasiswa') }}" method="POST" id="logoutForm">
                @csrf
                <button type="submit" class="sidebar-icon" title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>
                </form>

                <a href="" title="Dashboard">
                <div class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                </a>

                <a href="" title="Profil">
                <div class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                </a>

                <a href="" title="Berkas">
                <div class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                </a>

                <a href="" title="Soon">
                <div class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <div class="bg-white dark:bg-gray-800 p-4 shadow-md">
                <div class="flex justify-between items-center">
            
            <button id="sidebarToggle" class="p-2 rounded-full bg-gray-800 dark:bg-gray-200 mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white dark:text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </button>
            
            <div class="flex items-center gap-2">
            
                <button id="themeToggle" class="p-2 rounded-full bg-gray-800 dark:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white dark:text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
     
            @yield('content')

        </div>
    </div>
</body>
    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        
        // Check for saved theme preference or use system preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        
        // Toggle theme on button click
        themeToggle.addEventListener('click', () => {
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });

        // Hide welcome alert
        document.addEventListener('DOMContentLoaded', function(){
            const closeBtn = document.getElementById('closeAlertBtn');
            const alertBox = document.getElementById('alert');
            if (closeBtn &&alertBox) {
            closeBtn.addEventListener('click', () => {
                alertBox.classList.remove('translate-y-0', 'opacity-100');
                alertBox.classList.add('-translate-y-0', 'opacity-0');
    
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 500); // match the transition duration
            });
            }
        })


        // Sidebar toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        let sidebarOpen = true;

        sidebarToggle.addEventListener('click', () => {
        sidebarOpen = !sidebarOpen;
            if (sidebarOpen) {
                sidebar.classList.remove('w-0');
                sidebar.classList.add('w-20');
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-0');
            }
});
    </script>
</html>