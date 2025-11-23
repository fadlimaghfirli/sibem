<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabinet;
use App\Models\Pengurus;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil daftar kabinet
        $cabinets = Cabinet::orderBy('tahun_periode', 'desc')->get();

        // 2. Tentukan kabinet aktif
        if ($request->has('cabinet_id')) {
            $selectedCabinet = Cabinet::find($request->cabinet_id);
        } else {
            $selectedCabinet = Cabinet::where('is_active', true)->first();
        }

        // Default data kosong
        $pimpinan = collect();
        $bph_inti = collect();
        $departments_data = collect();
        $totalAnggota = 0;

        if ($selectedCabinet) {
            // Ambil semua pengurus di kabinet ini
            $allPengurus = Pengurus::with('departement')
                ->where('cabinet_id', $selectedCabinet->id)
                ->get();

            $totalAnggota = $allPengurus->count();

            // LEVEL 1: Gubernur & Wakil
            $pimpinan = $allPengurus->filter(function ($item) {
                return in_array($item->jabatan, ['Gubernur', 'Wakil Gubernur']);
            })->sortBy(fn($item) => $item->jabatan === 'Wakil Gubernur'); // Gubernur dulu baru Wakil

            // LEVEL 2: Sekjen, Bendum, Sekum (Tanpa Departemen)
            $bph_inti = $allPengurus->filter(function ($item) {
                return in_array($item->jabatan, ['Sekretaris Jenderal', 'Sekretaris Umum', 'Bendahara Umum'])
                    && $item->departement_id == null;
            });

            // LEVEL 3: Departemen beserta anggotanya
            // Kita ambil departemen yang ada, lalu "inject" pengurusnya
            $departments_data = \App\Models\Departement::all()->map(function ($dept) use ($selectedCabinet) {
                // Ambil pengurus yang ada di dept ini & kabinet ini
                $members = Pengurus::where('cabinet_id', $selectedCabinet->id)
                    ->where('departement_id', $dept->id)
                    ->orderByRaw("FIELD(jabatan, 'Kepala Departemen', 'Sekretaris Departemen', 'Anggota Departemen', 'Staff Departemen')")
                    ->get();

                $dept->members = $members;
                return $dept;
            })->filter(function ($dept) {
                return $dept->members->count() > 0; // Hanya tampilkan dept yang ada orangnya
            });
        }

        $totalDepartemen = \App\Models\Departement::count();

        return view('landing', [
            'cabinets' => $cabinets,
            'selectedCabinet' => $selectedCabinet,
            'pimpinan' => $pimpinan,
            'bph_inti' => $bph_inti,
            'departments_data' => $departments_data,
            'totalDepartemen' => $totalDepartemen,
            'totalAnggota' => $totalAnggota
        ]);
    }
}
