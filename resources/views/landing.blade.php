<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi BEM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-600">SI-BEM</span>
                </div>
                <div class="flex items-center">
                    @if (Route::has('login'))
                        <div class="">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium transition">Login
                                    Pengurus</a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-blue-600 py-16 text-center text-white">
        <h1 class="text-4xl font-extrabold tracking-tight">Struktur Pengurus BEM</h1>
        <p class="mt-4 text-xl text-blue-100">
            @if ($selectedCabinet)
                {{ $selectedCabinet->nama_kabinet }} (Periode {{ $selectedCabinet->tahun_periode }})
            @else
                Belum ada kabinet aktif
            @endif
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex justify-end mb-8">
            <form action="{{ route('landing') }}" method="GET"
                class="flex items-center space-x-2 bg-white p-3 rounded-lg shadow-sm">
                <label for="cabinet_id" class="text-sm font-medium text-gray-700">Pilih Periode:</label>
                <select name="cabinet_id" onchange="this.form.submit()"
                    class="border-gray-300 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach ($cabinets as $cab)
                        <option value="{{ $cab->id }}" {{ $selectedCabinet->id == $cab->id ? 'selected' : '' }}>
                            {{ $cab->tahun_periode }} - {{ $cab->nama_kabinet }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        @if ($penguruses->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($penguruses as $p)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                            @if ($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}"
                                    class="w-full h-full object-cover">
                            @else
                                <svg class="h-20 w-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            @endif
                        </div>

                        <div class="p-5 text-center">
                            <h3 class="text-lg font-bold text-gray-900 truncate">{{ $p->nama }}</h3>
                            <p class="text-sm text-blue-600 font-medium mb-1">{{ $p->jabatan }}</p>

                            <div class="mt-3 text-xs text-gray-500 space-y-1">
                                <p>{{ $p->prodi }}</p>
                                @if ($p->departement)
                                    <span class="inline-block bg-gray-100 rounded-full px-2 py-1 mt-1">
                                        Dept. {{ $p->departement->nama }}
                                    </span>
                                @elseif($p->jabatan == 'Gubernur' || $p->jabatan == 'Wakil Gubernur')
                                    <span
                                        class="inline-block bg-yellow-100 text-yellow-800 rounded-full px-2 py-1 mt-1">
                                        Pimpinan Inti
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 text-gray-500">
                <p class="text-xl">Belum ada data pengurus untuk periode ini.</p>
            </div>
        @endif

    </div>

    <footer class="bg-white border-t mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Sistem Informasi BEM. Built with Laravel.
        </div>
    </footer>

</body>

</html>
