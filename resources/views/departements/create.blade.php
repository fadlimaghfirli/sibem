<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Departemen</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('departements.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Departemen</label>
                    <input type="text" name="nama"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500" required
                        placeholder="Contoh: Departemen Luar Negeri">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Tugas</label>
                    <textarea name="deskripsi" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500"></textarea>
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>
