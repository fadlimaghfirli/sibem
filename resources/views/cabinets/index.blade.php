<x-app-layout>
    <div x-data="{ isOpen: false }" class="min-h-screen">

        <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 relative">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        Manajemen Periode
                    </h2>
                    <p class="text-sm text-gray-500">Atur periode aktif dan arsip kepengurusan lama</p>
                </div>

                <button @click="isOpen = true" type="button"
                    class="inline-flex items-center bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 font-medium transition shadow-lg shadow-blue-500/30 transform hover:-translate-y-0.5 cursor-pointer">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Periode Baru
                </button>
            </div>

            @if (session('success'))
                <div x-data="{ show: true }" x-show="show"
                    class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm flex justify-between items-center transition-all">
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
                                    <h3 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                                        {{ $c->nama_kabinet }}</h3>
                                    <p class="mt-2 text-blue-100">Total anggota: <strong>{{ $c->penguruses_count }}
                                            Orang</strong></p>
                                </div>
                                <div
                                    class="flex items-center gap-3 bg-white/10 p-2 rounded-xl backdrop-blur-sm border border-white/20">
                                    <a href="{{ route('cabinets.edit', $c->id) }}"
                                        class="p-2 bg-white text-blue-700 rounded-lg hover:bg-blue-50 transition shadow-sm"><svg
                                            class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg></a>
                                    <button disabled
                                        class="p-2 bg-gray-400 text-white rounded-lg cursor-not-allowed opacity-70"><svg
                                            class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg></button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div
                            class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col">
                            <div class="p-6 flex-1">
                                <div class="flex justify-between items-start mb-4">
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-semibold text-gray-500 bg-gray-100 rounded uppercase">Demisioner</span>
                                    <span class="text-sm font-medium text-gray-400 flex items-center"><svg
                                            class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>{{ $c->tahun_periode }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $c->nama_kabinet }}</h3>
                                <div class="text-gray-500 text-sm">{{ $c->penguruses_count }} Anggota terdata</div>
                            </div>
                            <div
                                class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end gap-2 rounded-b-xl">
                                <a href="{{ route('cabinets.edit', $c->id) }}"
                                    class="text-sm font-medium text-yellow-600 hover:text-yellow-800 transition px-3 py-2 hover:bg-yellow-50 rounded-md">Edit</a>
                                <form action="{{ route('cabinets.destroy', $c->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data ini? Data pengurus juga akan hilang.');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="text-sm font-medium text-red-600 hover:text-red-800 transition px-3 py-2 hover:bg-red-50 rounded-md">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div x-show="isOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">

            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">

                <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm transition-opacity"
                    @click="isOpen = false" aria-hidden="true">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-lg p-8 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl relative z-50">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold leading-6 text-gray-900" id="modal-title">
                            Tambah Periode Baru
                        </h3>
                        <button @click="isOpen = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('cabinets.store') }}" method="POST">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label for="nama_kabinet" class="block text-sm font-bold text-gray-700 mb-1">Nama
                                    Kabinet</label>
                                <input type="text" name="nama_kabinet" id="nama_kabinet" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition"
                                    placeholder="Contoh: Kabinet Sinergi">
                            </div>
                            <div>
                                <label for="tahun_periode" class="block text-sm font-bold text-gray-700 mb-1">Tahun
                                    Periode</label>
                                <input type="text" name="tahun_periode" id="tahun_periode" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition"
                                    placeholder="Contoh: 2024/2025">
                            </div>
                            <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="is_active" name="is_active" value="1" type="checkbox"
                                        class="focus:ring-blue-500 h-5 w-5 text-blue-600 border-gray-300 rounded cursor-pointer">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_active" class="font-bold text-blue-800 cursor-pointer">Set sebagai
                                        Kabinet Aktif?</label>
                                    <p class="text-blue-600 mt-1 text-xs">Otomatis menonaktifkan kabinet lama.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end gap-3">
                            <button type="button" @click="isOpen = false"
                                class="bg-white text-gray-700 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 font-medium transition">Batal</button>
                            <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-bold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">Simpan
                                Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
