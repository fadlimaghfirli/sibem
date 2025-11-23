<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Pengurus Baru
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <form action="{{ route('penguruses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" name="nim" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Angkatan</label>
                        <input type="number" name="angkatan" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select name="prodi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="Pendidikan Informatika">Pendidikan Informatika</option>
                            <option value="Pendidikan Ilmu Pengetahuan Alam">Pendidikan Ilmu Pengetahuan Alam</option>
                            <option value="Pendidikan Bahasa dan Sastra Indonesia">Pendidikan Bahasa dan Sastra
                                Indonesia</option>
                            <option value="Pendidikan Guru Sekolah Dasar">Pendidikan Guru Sekolah Dasar</option>
                            <option value="Pendidikan Anak Usia Dini">Pendidikan Anak Usia Dini</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kabinet / Periode</label>
                        <select name="cabinet_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach ($cabinets as $c)
                                <option value="{{ $c->id }}">{{ $c->nama_kabinet }} ({{ $c->tahun_periode }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <select name="jabatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="Gubernur">Gubernur</option>
                            <option value="Wakil Gubernur">Wakil Gubernur</option>
                            <option value="Sekretaris Jenderal">Sekretaris Jenderal</option>
                            <option value="Sekretaris Umum">Sekretaris Umum</option>
                            <option value="Bendahara Umum">Bendahara Umum</option>
                            <option value="Kepala Departemen">Kepala Departemen</option>
                            <option value="Sekretaris Departemen">Sekretaris Departemen</option>
                            <option value="Anggota Departemen">Anggota Departemen</option>
                            <option value="Staff Departemen">Staff Departemen</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Departemen <span
                                class="text-gray-400 text-xs">(Kosongkan jika Gubernur/Sekjen/Bendum)</span></label>
                        <select name="departement_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">-- Tidak Ada Departemen --</option>
                            @foreach ($departements as $d)
                                <option value="{{ $d->id }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Foto Pengurus</label>
                        <input type="file" name="foto"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
