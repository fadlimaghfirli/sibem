<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BEM {{ $selectedCabinet ? $selectedCabinet->nama_kabinet : 'Mahasiswa' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <nav
        class="fixed w-full z-50 top-0 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        B
                    </div>
                    <div>
                        <span class="block text-xl font-bold text-gray-900 leading-none tracking-tight">BEM-FKIP</span>
                        <span class="text-xs text-blue-600 font-semibold tracking-wider uppercase">Portal Informasi
                            Organisasi</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-gray-600 hover:text-blue-600 font-medium transition">Beranda</a>
                    <a href="#struktur" class="text-gray-600 hover:text-blue-600 font-medium transition">Struktur</a>
                    <a href="#tentang" class="text-gray-600 hover:text-blue-600 font-medium transition">Tentang</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="bg-gray-900 text-white px-5 py-2.5 rounded-full font-medium hover:bg-gray-800 transition shadow-lg transform hover:-translate-y-0.5">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Login
                                Pengurus</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section id="beranda" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white -z-10"></div>
        <div
            class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            @if ($selectedCabinet)
                <span
                    class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-700 text-sm font-bold mb-6 border border-blue-200 shadow-sm">
                    🔥 Sedang Menjabat: Periode {{ $selectedCabinet->tahun_periode }}
                </span>
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                    {{ $selectedCabinet->nama_kabinet }}
                </h1>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 mb-10">
                    Bersinergi membangun kampus yang lebih baik melalui kolaborasi, inovasi, dan aksi nyata untuk
                    mahasiswa.
                </p>
            @else
                <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight mb-6">
                    Selamat Datang di Portal BEM
                </h1>
                <p class="text-xl text-gray-500 mb-10">Belum ada kabinet aktif saat ini.</p>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-3xl mx-auto mt-12">
                <div
                    class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 transform hover:-translate-y-1 transition duration-300">
                    <p class="text-4xl font-bold text-blue-600">{{ $totalAnggota }}</p>
                    <p class="text-gray-500 text-sm font-medium uppercase tracking-wide mt-1">Pengurus Aktif</p>
                </div>
                <div
                    class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 transform hover:-translate-y-1 transition duration-300">
                    <p class="text-4xl font-bold text-purple-600">{{ $totalDepartemen }}</p>
                    <p class="text-gray-500 text-sm font-medium uppercase tracking-wide mt-1">Departemen</p>
                </div>
                <div
                    class="col-span-2 md:col-span-1 bg-gradient-to-br from-blue-600 to-blue-800 p-6 rounded-2xl shadow-xl text-white transform hover:-translate-y-1 transition duration-300 flex flex-col justify-center items-center">
                    <p class="text-lg font-semibold">Lihat Struktur</p>
                    <svg class="w-6 h-6 mt-2 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section id="struktur" class="py-24 bg-gray-50 relative overflow-hidden">
        <div class="absolute inset-0"
            style="background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 32px 32px; opacity: 0.5;">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center mb-16">
                <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Struktur Organisasi</span>
                <h2 class="text-4xl font-extrabold text-gray-900 mt-2 mb-4">Hierarki Kepengurusan</h2>

                <div class="flex justify-center mt-6">
                    <form action="{{ route('landing') }}" method="GET" class="relative z-20">
                        <select name="cabinet_id" onchange="this.form.submit()"
                            class="bg-white border-2 border-blue-100 text-gray-700 py-2 pl-4 pr-10 rounded-full focus:outline-none focus:border-blue-500 font-medium shadow-sm cursor-pointer hover:border-blue-300 transition">
                            @foreach ($cabinets as $cab)
                                <option value="{{ $cab->id }}"
                                    {{ $selectedCabinet && $selectedCabinet->id == $cab->id ? 'selected' : '' }}>
                                    Periode {{ $cab->tahun_periode }} - {{ $cab->nama_kabinet }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            @if ($selectedCabinet)

                <div class="flex flex-wrap justify-center gap-8 mb-12 relative">
                    <div
                        class="absolute -bottom-12 left-1/2 transform -translate-x-1/2 w-px h-12 bg-blue-300 hidden md:block">
                    </div>

                    @foreach ($pimpinan as $p)
                        <div class="w-full max-w-xs z-10">
                            <div
                                class="bg-white rounded-3xl p-4 shadow-xl border-b-4 border-yellow-400 text-center transform hover:-translate-y-2 transition duration-300">
                                <div
                                    class="relative mx-auto w-40 h-40 mb-4 rounded-full p-1 bg-gradient-to-tr from-yellow-400 to-orange-500">
                                    <div
                                        class="w-full h-full rounded-full overflow-hidden bg-white border-4 border-white">
                                        @if ($p->foto)
                                            <img src="{{ asset('storage/' . $p->foto) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div
                                        class="absolute bottom-2 right-2 bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-full border border-white shadow-sm">
                                        TOP
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ $p->nama }}</h3>
                                <p class="text-yellow-600 font-bold text-sm uppercase mt-1">{{ $p->jabatan }}</p>
                                <p class="text-gray-400 text-xs mt-2">{{ $p->prodi }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($bph_inti->count() > 0)
                    <div class="relative mb-20">
                        <div
                            class="absolute -top-12 left-1/2 transform -translate-x-1/2 w-3/4 h-px bg-blue-300 hidden md:block">
                        </div>
                        <div
                            class="absolute -top-12 left-1/2 transform -translate-x-1/2 w-px h-12 bg-blue-300 hidden md:block">
                        </div>

                        <div class="flex flex-wrap justify-center gap-6 px-4">
                            @foreach ($bph_inti as $p)
                                <div
                                    class="bg-white rounded-2xl p-4 w-64 shadow-lg border border-gray-100 text-center flex flex-col items-center hover:shadow-xl transition">
                                    <div
                                        class="w-24 h-24 rounded-full overflow-hidden mb-3 bg-gray-200 border-2 border-blue-100">
                                        @if ($p->foto)
                                            <img src="{{ asset('storage/' . $p->foto) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-200"></div>
                                        @endif
                                    </div>
                                    <h4 class="font-bold text-gray-800 text-lg leading-snug">{{ $p->nama }}</h4>
                                    <span
                                        class="bg-blue-50 text-blue-700 px-3 py-0.5 rounded-full text-xs font-bold mt-1 mb-2">{{ $p->jabatan }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="max-w-7xl mx-auto px-4">
                    <h3
                        class="text-center text-2xl font-bold text-gray-800 mb-10 flex items-center justify-center gap-3">
                        <span class="h-px w-12 bg-gray-300"></span>
                        Divisi & Departemen
                        <span class="h-px w-12 bg-gray-300"></span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach ($departments_data as $dept)
                            <div
                                class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300">
                                <div
                                    class="bg-gradient-to-r from-blue-900 to-blue-700 p-4 flex justify-between items-center">
                                    <h4 class="text-white font-bold text-lg">{{ $dept->nama }}</h4>
                                    <span
                                        class="bg-white/20 text-white text-xs px-2 py-1 rounded">{{ $dept->members->count() }}
                                        Anggota</span>
                                </div>

                                <div class="p-5">
                                    <div class="space-y-4">
                                        @foreach ($dept->members as $member)
                                            <div class="flex items-center group">
                                                <div
                                                    class="w-12 h-12 flex-shrink-0 rounded-full overflow-hidden border border-gray-100 bg-gray-100 mr-4">
                                                    @if ($member->foto)
                                                        <img src="{{ asset('storage/' . $member->foto) }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <div
                                                            class="w-full h-full bg-gray-200 flex items-center justify-center text-xs">
                                                            N/A</div>
                                                    @endif
                                                </div>

                                                <div class="flex-1 min-w-0">
                                                    <p
                                                        class="text-sm font-bold text-gray-900 truncate group-hover:text-blue-600 transition">
                                                        {{ $member->nama }}
                                                    </p>
                                                    <div class="flex items-center gap-2">
                                                        @if (str_contains($member->jabatan, 'Kepala'))
                                                            <span
                                                                class="text-xs font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded">Kepala</span>
                                                        @elseif(str_contains($member->jabatan, 'Sekretaris'))
                                                            <span
                                                                class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-0.5 rounded">Sekretaris</span>
                                                        @else
                                                            <span
                                                                class="text-xs text-gray-500">{{ $member->jabatan }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-20">
                    <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Data Struktur Belum Tersedia</h3>
                    <p class="text-gray-500 mt-1">Silakan pilih periode kabinet lain atau hubungi admin.</p>
                </div>
            @endif

        </div>
    </section>

    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <div>
                    <h3 class="text-2xl font-bold mb-4">BEM-FKIP</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Wadah aspirasi dan kreasi mahasiswa. Bergerak bersama untuk menciptakan lingkungan kampus yang
                        inklusif dan prestatif.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gray-200">Tautan Cepat</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-white transition">Program Kerja</a></li>
                        <li><a href="#" class="hover:text-white transition">Berita Terkini</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Login Admin</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gray-200">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Gedung PKM Lt. 2, Kampus Pusat<br>Jl. Pendidikan No. 1</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>humas@bemkampus.ac.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Sistem Informasi BEM-FKIP. All rights reserved.
            </div>
        </div>
    </footer>

</body>

</html>
