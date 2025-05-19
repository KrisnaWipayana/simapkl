<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dosen Pembimbing</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-lg shadow-sm w-full max-w-sm overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"> -->
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <h1 class="text-xl font-normal text-gray-800 mt-4">Dosen Pembimbing</h1>
            </div>
            
            <form method="POST" action="{{ route('login.dospem.post') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500" 
                               type="text" placeholder="NIDN">
                    </div>
                    
                    <div>
                        <input class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500" 
                               type="password" placeholder="Password">
                    </div>
                    
                    <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md mt-4">
                        Lanjutkan
                    </button>
                </div>
            </form>
        </div>
        <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 text-center">
            <a href="#" class="text-sm text-black-600 hover:text-blue-500">Lupa password?</a>
        </div>
    </div>
</body>
</html>