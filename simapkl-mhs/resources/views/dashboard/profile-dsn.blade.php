@extends('layout.app')
<title>Profil Dosen - SIMAPKL</title>

@section('content')
<style>
 #perusahaanResults, #lowonganResults {
    border: 1px solid #e5e7eb;
    border-radius: 0.375rem;
    background-color: white;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.dark #perusahaanResults, .dark #lowonganResults {
    background-color: #374151;
    border-color: #4b5563;
}   
</style>
<div class="p-4 min-h-screen">

    <!-- Modal Edit Profile -->
    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md mx-4">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Profile</h3>
                <button onclick="closeEditProfileModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form id="editProfileForm" action="{{ route('profile.update.dsn') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 dark:text-gray-300 mb-2">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ Auth::guard('dospem')->user()->nama }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ Auth::guard('dospem')->user()->email }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="foto" class="block text-gray-700 dark:text-gray-300 mb-2">Foto Profil (opsional)</label>
                        <input type="file" name="foto" id="foto" accept="image/*" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeEditProfileModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 transition-colors duration-200">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-2">
            <div class="w-8 h-8 bg-green-700 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold bg-green-700 bg-clip-text text-transparent">
                Profil Dosen
            </h1>
        </div>
        <p class="text-gray-600 dark:text-gray-400">Kelola informasi profil Anda</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Profile Card -->
        <div class="xl:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                <!-- Cover Background -->
                <div class="h-32 bg-gradient-to-r from-green-500 to-green-700 relative">
                    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                </div>

                <!-- Profile Content -->
                <div class="px-8 pb-8">
                    <!-- Profile Picture -->
                    <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-5 mb-6">
                        <div class="relative group">
                            <div class="w-32 h-32 bg-white rounded-full p-1 shadow-2xl">
                                <div class="w-full h-full bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center overflow-hidden">
                                    @if(Auth::guard('dospem')->user()->foto)
                                        <img src="{{ asset('storage/' . Auth::guard('dospem')->user()->foto) }}" alt="Foto Profil" class="w-full h-full rounded-full object-cover">
                                    @else
                                        <svg class="w-16 h-16 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <!-- Camera Icon Overlay -->
                            <div class="absolute bottom-2 right-2 bg-blue-600 text-white p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="sm:ml-6 text-center sm:text-left mt-4 sm:mt-0">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ Auth::guard('dospem')->user()->nama }}
                            </h2>
                            <div class="flex flex-wrap gap-2 justify-center sm:justify-start">
                                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm font-medium rounded-full">
                                    {{ Auth::guard('dospem')->user()->nip }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-xl">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Email</p>
                                <p class="text-sm text-gray-900 dark:text-white font-medium">{{ Auth::guard('dospem')->user()->email }}</p>
                            </div>
                        </div> 
                    </div>

                    <!-- Action Button -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <button onclick="showEditProfileModal()" class="flex-1 bg-green-700 hover:bg-green-800 text-white py-3 px-6 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-500 ease-in-out flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span>Edit Profil</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}
</style>

<script>

    function showEditProfileModal() {
            document.getElementById('editProfileModal').classList.remove('hidden');
            document.getElementById('editProfileModal').classList.add('flex');
        }

    function closeEditProfileModal() {
            document.getElementById('editProfileModal').classList.add('hidden');
            document.getElementById('editProfileModal').classList.remove('flex');
        }

    // Close modal when clicking outside
    document.getElementById('editProfileModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('editProfileModal')) {
            closeEditProfileModal();
        }
    });
</script>
@endsection