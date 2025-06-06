@extends('layout.app')
<title>Profil Mahasiswa - SIMAPKL</title>

@section('content')
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
                <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 dark:text-gray-300 mb-2">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ Auth::guard('mahasiswa')->user()->nama }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ Auth::guard('mahasiswa')->user()->email }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div class="mb-4">
                        <label for="avatar" class="block text-gray-700 dark:text-gray-300 mb-2">Foto Profil (opsional)</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 mb-2">Skill</label>
                        <div id="selectedSkills" class="flex flex-wrap gap-2 mb-2">
                            @foreach(Auth::guard('mahasiswa')->user()->skills as $skill)
                                <span class="flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                    {{ $skill->nama }}
                                    <button type="button" class="ml-1 text-red-500 hover:text-red-700 focus:outline-none remove-skill-btn" data-id="{{ $skill->id }}">
                                        &times;
                                    </button>
                                </span>
                            @endforeach
                        </div>
                        <input type="text" id="skillSearch" placeholder="Cari skill..." class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-700 dark:text-white">
                        <div id="skillSuggestions" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded shadow-lg hidden"></div>
                        <small class="text-gray-500 dark:text-gray-400">Cari dan tambahkan skill. Klik <span class="font-bold text-red-500">×</span> untuk menghapus.</small>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeEditProfileModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
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
            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Profil Mahasiswa
            </h1>
        </div>
        <p class="text-gray-600 dark:text-gray-400">Kelola informasi profil dan data akademik Anda</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Profile Card -->
        <div class="xl:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                <!-- Cover Background -->
                <div class="h-32 bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-600 relative">
                    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                </div>

                <!-- Profile Content -->
                <div class="px-8 pb-8">
                    <!-- Profile Picture -->
                    <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-16 mb-6">
                        <div class="relative group">
                            <div class="w-32 h-32 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full p-1 shadow-2xl">
                                <div class="w-full h-full bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center overflow-hidden">
                                    @if(Auth::guard('mahasiswa')->user()->foto)
                                        <img src="{{ asset('storage/' . Auth::guard('mahasiswa')->user()->foto) }}" alt="Foto Profil" class="w-full h-full rounded-full object-cover">
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
                                {{ Auth::guard('mahasiswa')->user()->nama }}
                            </h2>
                            <div class="flex flex-wrap gap-2 justify-center sm:justify-start">
                                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm font-medium rounded-full">
                                    {{ Auth::guard('mahasiswa')->user()->nim }}
                                </span>
                                <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-sm font-medium rounded-full">
                                    Aktif
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
                                <p class="text-sm text-gray-900 dark:text-white font-medium">{{ Auth::guard('mahasiswa')->user()->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-xl">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Program Studi</p>
                                <p class="text-sm text-gray-900 dark:text-white font-medium">{{ $prodi->nama_prodi ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Info -->
                    <div class="border-t dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h2M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 8v-2a1 1 0 011-1h1a1 1 0 011 1v2"/>
                            </svg>
                            Informasi Akademik
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl hover:shadow-md transition-shadow duration-200">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Jurusan</p>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $jurusan->nama_jurusan ?? '-' }}</p>
                            </div>
                            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl hover:shadow-md transition-shadow duration-200">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Tanggal Daftar</p>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ Auth::guard('mahasiswa')->user()->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <button onclick="showEditProfileModal()" class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-3 px-6 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span>Edit Profil</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Internship Status -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Status Magang</h3>
                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                </div>
                
                <div class="space-y-4">
                    <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl border border-green-200 dark:border-green-800">
                        <p class="text-sm text-green-700 dark:text-green-300 mb-1">Perusahaan</p>
                        <p class="font-bold text-green-900 dark:text-green-100">{{ $perusahaan->nama_perusahaan ?? 'Belum ditentukan' }}</p>
                    </div>
                    
                    <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                        <p class="text-sm text-blue-700 dark:text-blue-300 mb-1">Posisi</p>
                        <p class="font-bold text-blue-900 dark:text-blue-100">{{ $lowongan->nama_lowongan ?? 'Belum ditentukan' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Skill
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 gap-x-4">
                    @forelse($skillMahasiswa as $skill)
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                            <span class="text-xs text-gray-600 dark:text-gray-400">{{ $skill }}</span>
                        </div>
                    @empty
                        <span class="text-xs text-gray-400">Belum ada skill</span>
                    @endforelse
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

    //skill section
        document.addEventListener('DOMContentLoaded', function () {
        // Search skill
        const skillSearch = document.getElementById('skillSearch');
        const skillSuggestions = document.getElementById('skillSuggestions');
        const selectedSkillsDiv = document.getElementById('selectedSkills');

        let debounceTimeout = null;

        skillSearch.addEventListener('input', function () {
            clearTimeout(debounceTimeout);
            const query = this.value.trim();
            if (query.length < 2) {
                skillSuggestions.classList.add('hidden');
                return;
            }
            
            debounceTimeout = setTimeout(() => {
                fetch(`{{ route('skills.search') }}?q=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        skillSuggestions.innerHTML = '';
                        
                        if (data.length === 0) {
                            skillSuggestions.classList.add('hidden');
                            return;
                        }
                        
                        data.forEach(skill => {
                            // Cek apakah sudah dipilih
                            if (selectedSkillsDiv.querySelector(`[data-id="${skill.id}"]`)) return;
                            
                            const btn = document.createElement('button');
                            btn.type = 'button';
                            btn.className = 'block w-full text-left px-3 py-2 hover:bg-blue-100 dark:hover:bg-blue-900';
                            btn.textContent = skill.text || skill.nama;
                            btn.onclick = function () {
                                addSkill(skill.id, skill.text || skill.nama);
                                skillSuggestions.classList.add('hidden');
                                skillSearch.value = '';
                            };
                            skillSuggestions.appendChild(btn);
                        });
                        skillSuggestions.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error searching skills:', error);
                        skillSuggestions.classList.add('hidden');
                    });
            }, 300);
        });

        // Add skill via AJAX
        function addSkill(skillId, skillNama) {
            fetch('{{ route('profile.skill.add') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ skill_id: skillId })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const span = document.createElement('span');
                    span.className = 'flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300';
                    span.setAttribute('data-id', skillId);
                    span.innerHTML = `${skillNama}
                        <button type="button" class="ml-1 text-red-500 hover:text-red-700 focus:outline-none remove-skill-btn" data-id="${skillId}">&times;</button>`;
                    selectedSkillsDiv.appendChild(span);
                    
                    // Reset input
                    skillSearch.value = '';
                } else {
                    alert(data.message || 'Gagal menambahkan skill');
                }
            })
            .catch(error => {
                console.error('Error adding skill:', error);
                alert(error.message || 'Terjadi kesalahan saat menambahkan skill');
            });
        }

        // Remove skill via AJAX
        selectedSkillsDiv.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-skill-btn')) {
                const skillId = e.target.getAttribute('data-id');
                
                fetch('{{ route('profile.skill.remove') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ skill_id: skillId })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        e.target.parentElement.remove();
                    } else {
                        alert(data.message || 'Gagal menghapus skill');
                    }
                })
                .catch(error => {
                    console.error('Error removing skill:', error);
                    alert(error.message || 'Terjadi kesalahan saat menghapus skill');
                });
            }
        });

        // Hide suggestions on blur
        skillSearch.addEventListener('blur', function () {
            setTimeout(() => skillSuggestions.classList.add('hidden'), 200);
        });
    });
</script>
@endsection