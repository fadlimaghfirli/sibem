<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabinet;
use App\Models\Pengurus;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil daftar semua kabinet
        $cabinets = Cabinet::orderBy('tahun_periode', 'desc')->get();

        // 2. Tentukan kabinet aktif
        if ($request->has('cabinet_id')) {
            $selectedCabinet = Cabinet::find($request->cabinet_id);
        } else {
            $selectedCabinet = Cabinet::where('is_active', true)->first();
        }

        // 3. Query Data Pengurus (dengan Eager Loading departemen)
        $penguruses = collect(); // Default kosong
        if ($selectedCabinet) {
            $penguruses = Pengurus::with('departement')
                ->where('cabinet_id', $selectedCabinet->id)
                // Urutkan: Gubernur dulu, lalu Kepala Dept, lalu sisanya
                ->orderByRaw("FIELD(jabatan, 'Gubernur', 'Wakil Gubernur', 'Sekretaris Jenderal', 'Bendahara Umum', 'Kepala Departemen') DESC")
                ->orderBy('departement_id', 'asc')
                ->get();
        }

        // 4. Data Tambahan untuk Statistik (Informatif)
        $totalDepartemen = \App\Models\Departement::count();
        $totalAnggota = $penguruses->count();

        return view('landing', [
            'cabinets' => $cabinets,
            'selectedCabinet' => $selectedCabinet,
            'penguruses' => $penguruses,
            'totalDepartemen' => $totalDepartemen, // Kirim data ini
            'totalAnggota' => $totalAnggota // Kirim data ini
        ]);
    }
}
