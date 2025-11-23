<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Cabinet;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    // 1. MENAMPILKAN DAFTAR PENGURUS
    public function index(Request $request)
    {
        // 1. Data Pendukung untuk Dropdown di Modal
        $cabinets = Cabinet::orderBy('tahun_periode', 'desc')->get();
        $departements = Departement::all(); // <--- INI TAMBAHAN PENTING

        // 2. Logika Filter Kabinet (Sama seperti sebelumnya)
        if ($request->has('cabinet_id')) {
            $selectedCabinet = Cabinet::find($request->cabinet_id);
        } else {
            $selectedCabinet = Cabinet::where('is_active', true)->first();
            if (!$selectedCabinet) {
                $selectedCabinet = Cabinet::latest()->first();
            }
        }

        // 3. Query Data (Sama seperti sebelumnya)
        $query = Pengurus::with(['departement'])
            ->when($selectedCabinet, function ($q) use ($selectedCabinet) {
                return $q->where('cabinet_id', $selectedCabinet->id);
            });

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('nim', 'LIKE', "%{$search}%");
            });
        }

        $penguruses = $query->orderByRaw("FIELD(jabatan, 'Gubernur', 'Wakil Gubernur', 'Sekretaris Jenderal', 'Bendahara Umum', 'Kepala Departemen') DESC")
            ->orderBy('departement_id', 'asc')
            ->paginate(10)
            ->withQueryString();

        // Kirim $departements ke view
        return view('penguruses.index', compact('penguruses', 'cabinets', 'selectedCabinet', 'departements'));
    }

    // 2. HALAMAN FORM TAMBAH DATA
    public function create()
    {
        $cabinets = Cabinet::where('is_active', true)->get(); // Ambil kabinet aktif saja
        $departements = Departement::all();

        return view('penguruses.create', compact('cabinets', 'departements'));
    }

    // 3. PROSES SIMPAN DATA KE DATABASE
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'angkatan' => 'required|integer',
            'prodi' => 'required|string',
            'jabatan' => 'required|string',
            'cabinet_id' => 'required|exists:cabinets,id',
            'departement_id' => 'nullable|exists:departements,id', // Boleh kosong jika Gubernur
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        // Cek apakah ada upload foto
        if ($request->hasFile('foto')) {
            // Simpan ke folder public/pengurus
            $path = $request->file('foto')->store('pengurus', 'public');
            $validated['foto'] = $path;
        }

        Pengurus::create($validated);

        return redirect()->route('penguruses.index')->with('success', 'Data pengurus berhasil ditambahkan!');
    }

    // 4. HALAMAN EDIT DATA
    public function edit(Pengurus $pengurus)
    {
        $cabinets = Cabinet::where('is_active', true)->get();
        $departements = Departement::all();

        return view('penguruses.edit', compact('pengurus', 'cabinets', 'departements'));
    }

    // 5. PROSES UPDATE DATA
    public function update(Request $request, Pengurus $pengurus)
    {
        // Validasi (mirip store, tapi foto tidak wajib/nullable)
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'angkatan' => 'required|integer',
            'prodi' => 'required|string',
            'jabatan' => 'required|string',
            'cabinet_id' => 'required|exists:cabinets,id',
            'departement_id' => 'nullable|exists:departements,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cek apakah user mengupload foto baru
        if ($request->hasFile('foto')) {
            // 1. Hapus foto lama jika ada (agar server tidak penuh)
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            // 2. Simpan foto baru
            $path = $request->file('foto')->store('pengurus', 'public');
            $validated['foto'] = $path;
        }

        // Update data di database
        $pengurus->update($validated);

        return redirect()->route('penguruses.index')->with('success', 'Data pengurus berhasil diperbarui!');
    }

    // 6. PROSES HAPUS DATA
    public function destroy(Pengurus $pengurus)
    {
        // Hapus foto fisik dari penyimpanan
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        // Hapus data dari database
        $pengurus->delete();

        return redirect()->route('penguruses.index')->with('success', 'Data pengurus berhasil dihapus!');
    }
}
