<?php

namespace App\Http\Controllers;

use App\Models\Cabinet;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    // 1. DAFTAR KABINET
    public function index()
    {
        $cabinets = Cabinet::withCount('penguruses')
            ->orderBy('is_active', 'desc') // Yang aktif paling atas
            ->orderBy('tahun_periode', 'desc') // Lalu urutkan tahun
            ->get();

        return view('cabinets.index', compact('cabinets'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('cabinets.create');
    }

    // 3. SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'nama_kabinet' => 'required|string|max:255',
            'tahun_periode' => 'required|string|max:20',
        ]);

        // LOGIKA SAKLAR: Jika user memilih Active, maka kabinet lain harus Non-Active
        if ($request->has('is_active')) {
            Cabinet::where('is_active', true)->update(['is_active' => false]);
        }

        Cabinet::create([
            'nama_kabinet' => $request->nama_kabinet,
            'tahun_periode' => $request->tahun_periode,
            'is_active' => $request->has('is_active'), // Bernilai true jika dicentang
        ]);

        return redirect()->route('cabinets.index')->with('success', 'Kabinet baru berhasil dibuat!');
    }

    // 4. FORM EDIT
    public function edit(Cabinet $cabinet)
    {
        return view('cabinets.edit', compact('cabinet'));
    }

    // 5. UPDATE DATA
    public function update(Request $request, Cabinet $cabinet)
    {
        $request->validate([
            'nama_kabinet' => 'required|string|max:255',
            'tahun_periode' => 'required|string|max:20',
        ]);

        // LOGIKA SAKLAR (Sama seperti create)
        if ($request->has('is_active')) {
            Cabinet::where('id', '!=', $cabinet->id)->update(['is_active' => false]);
        }

        $cabinet->update([
            'nama_kabinet' => $request->nama_kabinet,
            'tahun_periode' => $request->tahun_periode,
            // Jika checkbox dicentang -> true, jika tidak -> false
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('cabinets.index')->with('success', 'Data kabinet berhasil diperbarui!');
    }

    // 6. HAPUS DATA
    public function destroy(Cabinet $cabinet)
    {
        // Hati-hati: Menghapus kabinet akan menghapus semua pengurus di dalamnya (Cascade Delete)
        $cabinet->delete();
        return redirect()->route('cabinets.index')->with('success', 'Kabinet berhasil dihapus.');
    }
}
