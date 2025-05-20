<!DOCTYPE html>
<html lang="en" class="bg-white dark:bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'dark-green': '#14532d',
                        'light-green': '#22c55e',
                    }
                }
            }
        }
    </script>
</head>
<body class="flex min-h-screen bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    @include('layout.sidebar')
    <main class="flex-1 p-6 transition-all duration-300" id="main-content">
        @yield('content')
    </main>
    <script>
        // Sidebar toggle
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            btn?.addEventListener('click', function () {
                sidebar.classList.toggle('w-64');
                sidebar.classList.toggle('w-16');
            });
        });
    </script>
</body>
</html>