<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    // 1. LIHAT DAFTAR (INDEX)
    public function index()
    {
        $departements = Departement::all();
        return view('departements.index', compact('departements'));
    }

    // 2. FORM TAMBAH (CREATE)
    public function create()
    {
        return view('departements.create');
    }

    // 3. SIMPAN DATA BARU (STORE)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Departement::create($request->all());

        return redirect()->route('departements.index')->with('success', 'Departemen baru berhasil ditambahkan!');
    }

    // 4. FORM EDIT (EDIT)
    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    // 5. UPDATE DATA (UPDATE)
    public function update(Request $request, Departement $departement)
    {
        // Validasi: Nama dan Deskripsi boleh diubah
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $departement->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('departements.index')->with('success', 'Data departemen diperbarui.');
    }

    // 6. HAPUS DATA (DESTROY)
    public function destroy(Departement $departement)
    {
        // Hati-hati, pengurus yang terhubung ke dept ini foreign key-nya akan jadi NULL (set null)
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'Departemen berhasil dihapus.');
    }
}
