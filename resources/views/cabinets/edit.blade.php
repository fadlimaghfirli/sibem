<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Kabinet</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('cabinets.update', $cabinet->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kabinet</label>
                    <input type="text" name="nama_kabinet" value="{{ $cabinet->nama_kabinet }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tahun Periode</label>
                    <input type="text" name="tahun_periode" value="{{ $cabinet->tahun_periode }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500" required>
                </div>
                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_active" value="1"
                            {{ $cabinet->is_active ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500">
                        <span class="ml-2 text-gray-700 font-bold">Set sebagai Kabinet Aktif Sekarang?</span>
                    </label>
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
