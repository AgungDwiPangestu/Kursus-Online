<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(!Auth::user()->isAdmin() && !Auth::user()->isPengajar())
            {{-- PESERTA DASHBOARD --}}
            @php
            $myEnrollments = Auth::user()->enrollments()->with('kursus.pengajar')->get();
            $activeEnrollments = $myEnrollments->where('status', 'active');
            $completedEnrollments = $myEnrollments->where('status', 'completed');
            $certificates = $completedEnrollments->count(); // Bisa dikembangkan dengan tabel certificates
            $allKursus = App\Models\Kursus::with('pengajar')->take(6)->get();
            @endphp

            <!-- Welcome Message -->
            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-900 rounded-2xl shadow-2xl mb-8 p-8 text-white transform hover:scale-[1.02] transition-transform duration-300">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-extrabold mb-3 drop-shadow-lg">Selamat datang kembali, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-lg text-indigo-50 font-medium">Lanjutkan perjalanan belajar Anda hari ini dan raih impian Anda!</p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Kursus Aktif -->
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-indigo-100 mb-2 font-semibold uppercase tracking-wide">Kursus Aktif</p>
                            <h4 class="text-5xl font-extrabold mb-1">{{ $activeEnrollments->count() }}</h4>
                            <p class="text-xs text-indigo-200 mt-1 font-medium">Sedang berjalan</p>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-4">
                            <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Kursus Selesai -->
                <div class="bg-gradient-to-br from-green-500 to-emerald-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-green-100 mb-2 font-semibold uppercase tracking-wide">Kursus Selesai</p>
                            <h4 class="text-5xl font-extrabold mb-1">{{ $completedEnrollments->count() }}</h4>
                            <p class="text-xs text-green-200 mt-1 font-medium">Berhasil diselesaikan</p>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-4">
                            <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Sertifikat -->
                <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-amber-100 mb-2 font-semibold uppercase tracking-wide">Sertifikat</p>
                            <h4 class="text-5xl font-extrabold mb-1">{{ $certificates }}</h4>
                            <p class="text-xs text-amber-200 mt-1 font-medium">Sertifikat diperoleh</p>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-4">
                            <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if($myEnrollments->count() > 0)
            <!-- Kursus Saya dengan Progress -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl mb-8 border-t-4 border-indigo-600">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-extrabold text-gray-900">Kursus Saya</h3>
                        <span class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg">{{ $myEnrollments->count() }} kursus</span>
                    </div>
                    <div class="space-y-4">
                        @foreach($myEnrollments as $enrollment)
                        @php
                        // Simulasi progress (bisa diganti dengan data real)
                        $progress = $enrollment->status == 'completed' ? 100 : rand(20, 85);
                        @endphp
                        <div class="relative border-2 border-indigo-100 rounded-xl p-6 hover:shadow-2xl hover:border-indigo-300 transition-all duration-300 bg-gradient-to-br from-white to-indigo-50">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full opacity-20 -mr-16 -mt-16"></div>
                            <div class="relative z-10">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-lg text-indigo-600 mb-1">
                                            {{ $enrollment->kursus->nama_kursus }}
                                        </h4>
                                        <p class="text-sm text-gray-600">
                                            <i class="bi bi-person-badge"></i> {{ $enrollment->kursus->pengajar->nama_pengajar }}
                                        </p>
                                    </div>
                                    <span class="inline-block px-3 py-1 text-xs rounded-full 
                                    @if($enrollment->status == 'active') bg-green-100 text-green-800
                                    @elseif($enrollment->status == 'completed') bg-blue-100 text-blue-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-3">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">Progress</span>
                                        <span class="font-semibold text-indigo-600">{{ $progress }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-gradient-to-r from-indigo-400 to-indigo-600 h-2.5 rounded-full transition-all duration-500"
                                            style="width: {{ $progress }}%"></div>
                                    </div>
                                </div>

                                <a href="{{ route('kursus.show', $enrollment->kursus) }}"
                                    class="block text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all duration-300">
                                    @if($progress == 100)
                                    Lihat Sertifikat
                                    @else
                                    Lanjutkan Belajar →
                                    @endif
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Rekomendasi Kursus -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-t-4 border-purple-600">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-extrabold text-gray-900">
                            @if($myEnrollments->count() > 0)
                            Kursus Lainnya untuk Anda
                            @else
                            Mulai Perjalanan Belajar Anda
                            @endif
                        </h3>
                        <a href="{{ route('kursus.index') }}" class="text-indigo-600 hover:text-blue-700 font-semibold text-sm transition-colors">
                            Lihat Semua →
                        </a>
                    </div>

                    @if($allKursus->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($allKursus->take(6) as $kursus)
                        <div class="border-2 border-gray-200 rounded-xl overflow-hidden hover:shadow-2xl hover:border-indigo-300 transition-all duration-300 group transform hover:-translate-y-2">
                            <div class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 h-40 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 bg-black opacity-10"></div>
                                <svg class="h-20 w-20 text-white opacity-30 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="p-5 bg-gradient-to-br from-white to-gray-50">
                                <h4 class="font-bold text-xl mb-3 group-hover:text-indigo-600 transition-colors leading-tight">
                                    {{ $kursus->nama_kursus }}
                                </h4>
                                <p class="text-sm text-gray-600 mb-3">
                                    <i class="bi bi-person-badge"></i> {{ $kursus->pengajar->nama_pengajar }}
                                </p>
                                <p class="text-sm text-gray-500 mb-4 line-clamp-2">
                                    {{ Str::limit($kursus->deskripsi, 80) }}
                                </p>
                                <a href="{{ route('kursus.show', $kursus) }}"
                                    class="block text-center bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-3 rounded-lg transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada kursus tersedia</h3>
                        <p class="mt-2 text-sm text-gray-500">Kursus akan segera ditambahkan!</p>
                    </div>
                    @endif
                </div>
            </div>

            @else
            {{-- ADMIN/PENGAJAR DASHBOARD --}}
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">
                        @if(Auth::user()->isAdmin())
                        Anda login sebagai <span class="font-semibold text-indigo-600">Administrator</span>
                        @else
                        Anda login sebagai <span class="font-semibold text-indigo-600">Pengajar</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Available Courses -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">
                            @if(Auth::user()->isAdmin())
                            Kelola Kursus
                            @else
                            Jelajahi Kursus Tersedia
                            @endif
                        </h3>
                        <a href="{{ route('kursus.index') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                            Lihat Semua →
                        </a>
                    </div>

                    <div class="text-center py-6">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="mt-3 text-base font-medium text-gray-900">
                            @if(Auth::user()->isAdmin())
                            Kelola Semua Kursus
                            @else
                            Temukan Kursus yang Tepat untuk Anda
                            @endif
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Klik tombol di bawah untuk melihat daftar lengkap kursus yang tersedia
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('kursus.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Jelajahi Kursus
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                @if(Auth::user()->isAdmin() || Auth::user()->isPengajar())
                <a href="{{ route('pengajar.index') }}" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Pengajar</h4>
                            <p class="text-sm text-gray-500">Lihat daftar pengajar</p>
                        </div>
                    </div>
                </a>
                @endif

                <a href="{{ route('kursus.index') }}" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Kursus</h4>
                            <p class="text-sm text-gray-500">Jelajahi semua kursus</p>
                        </div>
                    </div>
                </a>

                @if(Auth::user()->isAdmin() || Auth::user()->isPengajar())
                <a href="{{ route('peserta.index') }}" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Peserta</h4>
                            <p class="text-sm text-gray-500">Lihat daftar peserta</p>
                        </div>
                    </div>
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>
</x-app-layout>