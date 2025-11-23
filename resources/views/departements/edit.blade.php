<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Departemen
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('departements.update', $departement->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Departemen</label>
                    <input type="text" value="{{ $departement->nama }}"
                        class="w-full rounded-md border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed" readonly>
                    <p class="text-xs text-gray-400 mt-1">Nama departemen tidak dapat diubah (Sesuai AD/ART).</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Tugas</label>
                    <textarea name="deskripsi" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500">{{ $departement->deskripsi }}</textarea>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('departements.index') }}"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
