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
    public function index()
    {
        // Ambil data pengurus, urutkan terbaru, dan loading relasinya
        $penguruses = Pengurus::with(['cabinet', 'departement'])->latest()->paginate(10);

        return view('penguruses.index', compact('penguruses'));
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

    // Fungsi edit, update, destroy kita kerjakan nanti agar tidak kepanjangan
}
