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
                        <span class="block text-xl font-bold text-gray-900 leading-none tracking-tight">BEM
                            KAMPUS</span>
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

    <section id="struktur" class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6 border-b border-gray-100 pb-8">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-bold text-gray-900">Struktur Organisasi</h2>
                    <p class="mt-2 text-gray-500">Mengenal wajah-wajah di balik layar yang menggerakkan organisasi.</p>
                </div>

                <form action="{{ route('landing') }}" method="GET" class="relative group w-full md:w-auto">
                    <label for="cabinet_id"
                        class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pilih
                        Periode</label>
                    <div class="relative">
                        <select name="cabinet_id" onchange="this.form.submit()"
                            class="block w-full md:w-64 pl-4 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-xl bg-gray-50 cursor-pointer shadow-sm hover:shadow-md transition">
                            @foreach ($cabinets as $cab)
                                <option value="{{ $cab->id }}"
                                    {{ $selectedCabinet && $selectedCabinet->id == $cab->id ? 'selected' : '' }}>
                                    {{ $cab->tahun_periode }} - {{ $cab->nama_kabinet }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>

            @if ($penguruses->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($penguruses as $p)
                        <div
                            class="group relative bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col">

                            <div class="relative w-full max-h-72 aspect-[3/4] bg-gray-200 overflow-hidden">
                                @if ($p->foto)
                                    <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}"
                                        class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 text-gray-300">
                                        <svg class="w-24 h-24 mb-2 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-400">No Photo</span>
                                    </div>
                                @endif

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-gray-900/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                </div>

                                <div class="absolute top-4 left-4">
                                    @if ($p->jabatan == 'Gubernur' || $p->jabatan == 'Wakil Gubernur')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-yellow-400/90 text-yellow-900 backdrop-blur-sm shadow-sm">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            Pimpinan Inti
                                        </span>
                                    @elseif($p->departement)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-600/90 text-white backdrop-blur-sm shadow-sm">
                                            {{ Str::limit($p->departement->nama, 20) }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gray-800/80 text-white backdrop-blur-sm shadow-sm">
                                            Pengurus Pusat
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-6 flex flex-col flex-grow justify-between bg-white relative z-10">
                                <div>
                                    <h3 class="text-xl font-extrabold text-gray-900 leading-tight group-hover:text-blue-600 transition-colors duration-300 line-clamp-2 mb-1"
                                        title="{{ $p->nama }}">
                                        {{ $p->nama }}
                                    </h3>

                                    <p class="text-blue-600 font-bold text-sm mb-4">
                                        {{ $p->jabatan }}
                                    </p>

                                    <div
                                        class="w-12 h-1 bg-gray-100 rounded-full mb-4 group-hover:bg-blue-100 transition-colors">
                                    </div>
                                </div>

                                <div class="space-y-2.5 text-sm text-gray-500">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-gray-400 mr-2.5 flex-shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                            <path
                                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                        </svg>
                                        <span class="font-medium leading-tight">{{ $p->prodi }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2.5 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span class="font-medium">Angkatan {{ $p->angkatan }} <span
                                                class="text-gray-300 mx-1">|</span> NIM {{ $p->nim }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="flex flex-col items-center justify-center py-24 text-center bg-gray-50 rounded-3xl border border-dashed border-gray-300">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada data pengurus</h3>
                    <p class="text-gray-500 max-w-sm mt-1">Data pengurus untuk periode kabinet ini belum diinput oleh
                        admin.</p>
                </div>
            @endif
        </div>
    </section>

    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <div>
                    <h3 class="text-2xl font-bold mb-4">BEM KAMPUS</h3>
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
                &copy; {{ date('Y') }} Sistem Informasi BEM. All rights reserved. Built with Laravel & Tailwind.
            </div>
        </div>
    </footer>

</body>

</html>
