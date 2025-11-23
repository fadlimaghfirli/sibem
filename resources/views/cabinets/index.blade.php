<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    Manajemen Periode
                </h2>
                <p class="text-sm text-gray-500">Atur periode aktif dan arsip kepengurusan lama</p>
            </div>
            <a href="{{ route('cabinets.create') }}"
                class="inline-flex items-center bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 font-medium transition shadow-lg shadow-blue-500/30 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Periode Baru
            </a>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show"
                class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm flex justify-between items-center">
                <div class="flex items-center">
                    <div class="flex-shrink-0 text-green-500">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <p class="ml-3 text-sm text-green-700">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-green-700 hover:text-green-900 font-bold">&times;</button>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($cabinets as $c)
                @if ($c->is_active)
                    <div
                        class="col-span-1 md:col-span-2 lg:col-span-3 bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl shadow-xl overflow-hidden text-white relative group">
                        <div
                            class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition duration-700">
                        </div>

                        <div
                            class="p-8 relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span
                                        class="bg-blue-500 bg-opacity-50 border border-blue-400 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider flex items-center">
                                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                                        Sedang Menjabat
                                    </span>
                                    <span class="text-blue-200 font-medium text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $c->tahun_periode }}
                                    </span>
                                </div>
                                <h3 class="text-3xl md:text-4xl font-extrabold tracking-tight">{{ $c->nama_kabinet }}
                                </h3>
                                <p class="mt-2 text-blue-100">Total anggota terdaftar:
                                    <strong>{{ $c->penguruses_count }} Orang</strong>
                                </p>
                            </div>

                            <div
                                class="flex items-center gap-3 bg-white/10 p-2 rounded-xl backdrop-blur-sm border border-white/20">
                                <a href="{{ route('cabinets.edit', $c->id) }}"
                                    class="p-2 bg-white text-blue-700 rounded-lg hover:bg-blue-50 transition shadow-sm"
                                    title="Edit Kabinet">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </a>
                                <button type="button"
                                    class="p-2 bg-gray-400 text-white rounded-lg cursor-not-allowed opacity-70"
                                    title="Kabinet aktif tidak bisa dihapus langsung" disabled>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div
                        class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col">
                        <div class="p-6 flex-1">
                            <div class="flex justify-between items-start mb-4">
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold text-gray-500 bg-gray-100 rounded uppercase">
                                    Demisioner
                                </span>
                                <span class="text-sm font-medium text-gray-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $c->tahun_periode }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $c->nama_kabinet }}</h3>
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                {{ $c->penguruses_count }} Anggota terdata
                            </div>
                        </div>

                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end gap-2 rounded-b-xl">
                            <a href="{{ route('cabinets.edit', $c->id) }}"
                                class="text-sm font-medium text-yellow-600 hover:text-yellow-800 transition px-3 py-2 hover:bg-yellow-50 rounded-md">
                                Edit
                            </a>
                            <form action="{{ route('cabinets.destroy', $c->id) }}" method="POST"
                                onsubmit="return confirm('PERINGATAN KERAS:\n\nMenghapus kabinet ini akan MENGHAPUS SEMUA DATA PENGURUS ({{ $c->penguruses_count }} orang) yang ada di dalamnya.\n\nData tidak bisa dikembalikan. Yakin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-sm font-medium text-red-600 hover:text-red-800 transition px-3 py-2 hover:bg-red-50 rounded-md">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
</x-app-layout>
