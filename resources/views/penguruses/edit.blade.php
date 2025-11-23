<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Pengurus: {{ $pengurus->nama }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <form action="{{ route('penguruses.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $pengurus->nama) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim', $pengurus->nim) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Angkatan</label>
                        <input type="number" name="angkatan" value="{{ old('angkatan', $pengurus->angkatan) }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select name="prodi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach (['Pendidikan Informatika', 'Pendidikan Ilmu Pengetahuan Alam', 'Pendidikan Bahasa dan Sastra Indonesia', 'Pendidikan Guru Sekolah Dasar', 'Pendidikan Anak Usia Dini'] as $prodi)
                                <option value="{{ $prodi }}" {{ $pengurus->prodi == $prodi ? 'selected' : '' }}>
                                    {{ $prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kabinet</label>
                        <select name="cabinet_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach ($cabinets as $c)
                                <option value="{{ $c->id }}"
                                    {{ $pengurus->cabinet_id == $c->id ? 'selected' : '' }}>{{ $c->nama_kabinet }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <select name="jabatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach (['Gubernur', 'Wakil Gubernur', 'Sekretaris Jenderal', 'Sekretaris Umum', 'Bendahara Umum', 'Kepala Departemen', 'Sekretaris Departemen', 'Anggota Departemen', 'Staff Departemen'] as $jbt)
                                <option value="{{ $jbt }}"
                                    {{ $pengurus->jabatan == $jbt ? 'selected' : '' }}>{{ $jbt }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Departemen</label>
                        <select name="departement_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">-- Tidak Ada Departemen --</option>
                            @foreach ($departements as $d)
                                <option value="{{ $d->id }}"
                                    {{ $pengurus->departement_id == $d->id ? 'selected' : '' }}>{{ $d->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Foto Pengurus (Biarkan kosong jika tidak
                            ingin diganti)</label>
                        @if ($pengurus->foto)
                            <div class="mt-2 mb-2">
                                <img src="{{ asset('storage/' . $pengurus->foto) }}" alt="Foto Lama"
                                    class="h-24 w-24 object-cover rounded-md border">
                                <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="foto"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                </div>

                <div class="flex justify-end mt-6 space-x-3">
                    <a href="{{ route('penguruses.index') }}"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Update
                        Data</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
