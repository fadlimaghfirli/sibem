<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manajemen Kabinet / Periode
            </h2>
            <a href="{{ route('cabinets.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm">
                + Tambah Periode
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kabinet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($cabinets as $c)
                        <tr>
                            <td class="px-6 py-4 font-bold">{{ $c->tahun_periode }}</td>
                            <td class="px-6 py-4">{{ $c->nama_kabinet }}</td>
                            <td class="px-6 py-4">
                                @if ($c->is_active)
                                    <span class="px-2 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full">
                                        AKTIF (SEDANG MENJABAT)
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs text-gray-500 bg-gray-100 rounded-full">
                                        Demisioner / Arsip
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex space-x-3">
                                <a href="{{ route('cabinets.edit', $c->id) }}"
                                    class="text-yellow-600 hover:text-yellow-900 font-bold">Edit</a>

                                <form action="{{ route('cabinets.destroy', $c->id) }}" method="POST"
                                    onsubmit="return confirm('PERINGATAN: Menghapus kabinet ini akan MENGHAPUS SEMUA DATA PENGURUS di dalamnya. Lanjutkan?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
