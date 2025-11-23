<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    // 1. LIHAT DAFTAR
    public function index()
    {
        $departements = Departement::all();
        return view('departements.index', compact('departements'));
    }

    // 2. FORM EDIT
    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    // 3. UPDATE DATA
    public function update(Request $request, Departement $departement)
    {
        // Validasi: Hanya deskripsi yang boleh diubah
        $request->validate([
            'deskripsi' => 'nullable|string',
        ]);

        $departement->update([
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('departements.index')->with('success', 'Deskripsi departemen diperbarui.');
    }
}
