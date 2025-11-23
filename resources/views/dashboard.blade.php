<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Overview
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                Selamat Datang, <strong>{{ Auth::user()->name }}</strong>! Anda login sebagai Administrator.
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-blue-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-blue-100 text-sm">Kabinet Aktif</p>
                        @php $activeCab = \App\Models\Cabinet::where('is_active', true)->first(); @endphp
                        <p class="text-xl font-bold">
                            {{ $activeCab ? $activeCab->nama_kabinet : 'Tidak Ada' }}
                        </p>
                        <p class="text-xs text-blue-200">{{ $activeCab ? $activeCab->tahun_periode : '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-green-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-green-100 text-sm">Total Pengurus Aktif</p>
                        <p class="text-2xl font-bold">
                            @if ($activeCab)
                                {{ \App\Models\Pengurus::where('cabinet_id', $activeCab->id)->count() }}
                            @else
                                0
                            @endif
                        </p>
                        <p class="text-xs text-green-200">Orang</p>
                    </div>
                </div>
            </div>

            <div class="bg-purple-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-500 bg-opacity-75">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-purple-100 text-sm">Jumlah Departemen</p>
                        <p class="text-2xl font-bold">{{ \App\Models\Departement::count() }}</p>
                        <p class="text-xs text-purple-200">Divisi / Biro</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('penguruses.create') }}"
                class="bg-white p-6 rounded-lg shadow hover:shadow-md transition flex items-center border-l-4 border-blue-600">
                <div class="text-blue-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-700">Tambah Pengurus Baru</h3>
                    <p class="text-sm text-gray-500">Input data anggota BEM baru</p>
                </div>
            </a>

            <a href="{{ route('cabinets.index') }}"
                class="bg-white p-6 rounded-lg shadow hover:shadow-md transition flex items-center border-l-4 border-green-600">
                <div class="text-green-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-700">Ganti Periode Kabinet</h3>
                    <p class="text-sm text-gray-500">Update status aktif tahun ajaran</p>
                </div>
            </a>
        </div>

    </div>
</x-app-layout>
