<x-app-layout>
    <div x-data="{
        createOpen: false,
        editOpen: false,
        // Data kosong untuk form Create
        createForm: {
            cabinet_id: '{{ $selectedCabinet ? $selectedCabinet->id : '' }}', // Default ke kabinet yg dipilih
            jabatan: 'Staff Departemen',
            prodi: 'Pendidikan Informatika'
        },
        // Data untuk form Edit (akan diisi saat tombol diklik)
        editData: {
            id: null,
            nama: '',
            nim: '',
            angkatan: '',
            prodi: '',
            jabatan: '',
            cabinet_id: '',
            departement_id: '',
            foto_url: null
        },
        // Fungsi untuk membuka modal edit dan mengisi data
        openEditModal(data) {
            this.editData = data;
            this.editOpen = true;
        }
    }" class="min-h-screen">

        <x-slot name="header">
        </x-slot>

        <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Data Pengurus</h2>
                <button @click="createOpen = true"
                    class="inline-flex items-center bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 font-medium transition shadow-lg shadow-blue-500/30 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Anggota
                </button>
            </div>

            @if (session('success'))
                <div x-data="{ show: true }" x-show="show"
                    class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm flex justify-between items-center transition-all mb-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 text-green-500"><svg class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg></div>
                        <p class="ml-3 text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-green-700 hover:text-green-900 font-bold">&times;</button>
                </div>
            @endif

            <div
                class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <form action="{{ route('penguruses.index') }}" method="GET"
                    class="w-full md:w-auto flex items-center gap-2">
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <select name="cabinet_id" onchange="this.form.submit()"
                            class="pl-10 pr-8 py-2 border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 cursor-pointer bg-gray-50 hover:bg-white transition min-w-[250px]">
                            @foreach ($cabinets as $cab)
                                <option value="{{ $cab->id }}"
                                    {{ $selectedCabinet && $selectedCabinet->id == $cab->id ? 'selected' : '' }}>
                                    {{ $cab->nama_kabinet }} ({{ $cab->tahun_periode }})</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <form action="{{ route('penguruses.index') }}" method="GET" class="w-full md:w-auto relative">
                    @if (request('cabinet_id'))
                        <input type="hidden" name="cabinet_id" value="{{ request('cabinet_id') }}">
                    @elseif($selectedCabinet)
                        <input type="hidden" name="cabinet_id" value="{{ $selectedCabinet->id }}">
                    @endif
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama atau NIM..."
                            class="pl-10 pr-4 py-2 border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 w-full md:w-64">
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                @if ($penguruses->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Profil
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Jabatan
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Akademik
                                    </th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($penguruses as $p)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-12 w-12">
                                                    @if ($p->foto)
                                                        <img class="h-12 w-12 rounded-full object-cover border-2 border-white shadow-sm"
                                                            src="{{ asset('storage/' . $p->foto) }}">
                                                    @else
                                                        <div
                                                            class="h-12 w-12 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">
                                                            {{ substr($p->nama, 0, 1) }}</div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-bold text-gray-900">{{ $p->nama }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 font-mono">{{ $p->nim }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-col items-start gap-1">
                                                <span
                                                    class="text-sm font-medium text-gray-800">{{ $p->jabatan }}</span>
                                                @if ($p->departement)
                                                    <span
                                                        class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">{{ $p->departement->nama }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $p->prodi }}</div>
                                            <div class="text-xs text-gray-500">Angkatan {{ $p->angkatan }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end items-center gap-2">
                                                <button
                                                    @click="openEditModal({
                                                id: {{ $p->id }},
                                                nama: '{{ addslashes($p->nama) }}',
                                                nim: '{{ $p->nim }}',
                                                angkatan: '{{ $p->angkatan }}',
                                                prodi: '{{ $p->prodi }}',
                                                jabatan: '{{ $p->jabatan }}',
                                                cabinet_id: '{{ $p->cabinet_id }}',
                                                departement_id: '{{ $p->departement_id }}',
                                                foto_url: '{{ $p->foto ? asset('storage/' . $p->foto) : null }}'
                                            })"
                                                    class="text-white bg-yellow-500 hover:bg-yellow-600 p-2 rounded-lg transition shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                <form action="{{ route('penguruses.destroy', $p->id) }}"
                                                    method="POST" onsubmit="return confirm('Hapus permanen?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="text-white bg-red-500 hover:bg-red-600 p-2 rounded-lg transition shadow-sm"><svg
                                                            class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">{{ $penguruses->links() }}</div>
                @else
                    <div class="text-center py-16">
                        <p class="text-gray-500">Data tidak ditemukan. Silakan tambah baru.</p>
                    </div>
                @endif
            </div>
        </div>

        <div x-show="createOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <div x-show="createOpen" x-transition.opacity
                    class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm" @click="createOpen = false">
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div x-show="createOpen" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    class="inline-block w-full max-w-3xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl relative z-50">
                    <div class="flex justify-between items-center mb-6 border-b pb-4">
                        <h3 class="text-xl font-bold text-gray-900">Tambah Anggota Baru</h3>
                        <button @click="createOpen = false" class="text-gray-400 hover:text-gray-500"><svg
                                class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg></button>
                    </div>

                    <form action="{{ route('penguruses.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label><input
                                    type="text" name="nama" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500"></div>
                            <div><label class="block text-sm font-bold text-gray-700 mb-1">NIM</label><input
                                    type="text" name="nim" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500"></div>

                            <div><label class="block text-sm font-bold text-gray-700 mb-1">Angkatan</label><input
                                    type="number" name="angkatan" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500"></div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Program Studi</label>
                                <select name="prodi" x-model="createForm.prodi"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500">
                                    @foreach (['Pendidikan Informatika', 'Pendidikan Ilmu Pengetahuan Alam', 'Pendidikan Bahasa dan Sastra Indonesia', 'Pendidikan Guru Sekolah Dasar', 'Pendidikan Anak Usia Dini'] as $prodi)
                                        <option value="{{ $prodi }}">{{ $prodi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Kabinet</label>
                                <select name="cabinet_id" x-model="createForm.cabinet_id"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500">
                                    @foreach ($cabinets as $c)
                                        <option value="{{ $c->id }}">{{ $c->nama_kabinet }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Jabatan</label>
                                <select name="jabatan" x-model="createForm.jabatan"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500">
                                    @foreach (['Gubernur', 'Wakil Gubernur', 'Sekretaris Jenderal', 'Sekretaris Umum', 'Bendahara Umum', 'Kepala Departemen', 'Sekretaris Departemen', 'Anggota Departemen', 'Staff Departemen'] as $j)
                                        <option value="{{ $j }}">{{ $j }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-1">Departemen <span
                                        class="font-normal text-gray-400 text-xs">(Opsional)</span></label>
                                <select name="departement_id"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500">
                                    <option value="">-- Tidak Ada Departemen --</option>
                                    @foreach ($departements as $d)
                                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-1">Foto Profil</label>
                                <input type="file" name="foto"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-3 border-t pt-4">
                            <button type="button" @click="createOpen = false"
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Batal</button>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow font-bold">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div x-show="editOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <div x-show="editOpen" x-transition.opacity
                    class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm" @click="editOpen = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div x-show="editOpen" x-transition:enter="transition ease-out duration-300"
                    class="inline-block w-full max-w-3xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl relative z-50">
                    <div class="flex justify-between items-center mb-6 border-b pb-4">
                        <h3 class="text-xl font-bold text-gray-900">Edit Data Anggota</h3>
                        <button @click="editOpen = false" class="text-gray-400 hover:text-gray-500"><svg
                                class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg></button>
                    </div>

                    <form method="POST" :action="'/penguruses/' + editData.id" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><label class="block text-sm font-bold text-gray-700">Nama Lengkap</label><input
                                    type="text" name="nama" x-model="editData.nama" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm"></div>
                            <div><label class="block text-sm font-bold text-gray-700">NIM</label><input type="text"
                                    name="nim" x-model="editData.nim" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm"></div>

                            <div><label class="block text-sm font-bold text-gray-700">Angkatan</label><input
                                    type="number" name="angkatan" x-model="editData.angkatan" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm"></div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Program Studi</label>
                                <select name="prodi" x-model="editData.prodi"
                                    class="w-full rounded-lg border-gray-300 shadow-sm">
                                    @foreach (['Pendidikan Informatika', 'Pendidikan Ilmu Pengetahuan Alam', 'Pendidikan Bahasa dan Sastra Indonesia', 'Pendidikan Guru Sekolah Dasar', 'Pendidikan Anak Usia Dini'] as $prodi)
                                        <option value="{{ $prodi }}">{{ $prodi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700">Kabinet</label>
                                <select name="cabinet_id" x-model="editData.cabinet_id"
                                    class="w-full rounded-lg border-gray-300 shadow-sm">
                                    @foreach ($cabinets as $c)
                                        <option value="{{ $c->id }}">{{ $c->nama_kabinet }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Jabatan</label>
                                <select name="jabatan" x-model="editData.jabatan"
                                    class="w-full rounded-lg border-gray-300 shadow-sm">
                                    @foreach (['Gubernur', 'Wakil Gubernur', 'Sekretaris Jenderal', 'Sekretaris Umum', 'Bendahara Umum', 'Kepala Departemen', 'Sekretaris Departemen', 'Anggota Departemen', 'Staff Departemen'] as $j)
                                        <option value="{{ $j }}">{{ $j }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700">Departemen</label>
                                <select name="departement_id" x-model="editData.departement_id"
                                    class="w-full rounded-lg border-gray-300 shadow-sm">
                                    <option value="">-- Tidak Ada Departemen --</option>
                                    @foreach ($departements as $d)
                                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-1 md:col-span-2 border-t pt-4">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Foto Profil</label>
                                <div class="flex items-center gap-4">
                                    <template x-if="editData.foto_url">
                                        <img :src="editData.foto_url"
                                            class="h-16 w-16 rounded-full object-cover border">
                                    </template>
                                    <template x-if="!editData.foto_url">
                                        <div
                                            class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center text-xs text-gray-500">
                                            No Img</div>
                                    </template>

                                    <input type="file" name="foto"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">*Biarkan kosong jika tidak ingin mengubah foto.
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-3 border-t pt-4">
                            <button type="button" @click="editOpen = false"
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Batal</button>
                            <button type="submit"
                                class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 shadow font-bold">Update
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
