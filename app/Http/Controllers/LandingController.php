<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabinet;
use App\Models\Pengurus;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil daftar semua kabinet untuk dropdown filter
        $cabinets = Cabinet::orderBy('tahun_periode', 'desc')->get();

        // 2. Tentukan kabinet mana yang mau ditampilkan
        // Jika user memilih dari dropdown (?cabinet_id=...), pakai itu.
        // Jika tidak, pakai kabinet yang is_active = true (default).
        if ($request->has('cabinet_id')) {
            $selectedCabinet = Cabinet::find($request->cabinet_id);
        } else {
            $selectedCabinet = Cabinet::where('is_active', true)->first();
        }

        // 3. Ambil data pengurus berdasarkan kabinet yang dipilih
        // Kita urutkan berdasarkan departemen agar rapi
        $penguruses = Pengurus::with('departement')
            ->where('cabinet_id', $selectedCabinet->id)
            ->orderBy('departement_id', 'asc')
            ->get();

        // 4. Kirim semua data ke tampilan (View)
        return view('landing', [
            'cabinets' => $cabinets,
            'selectedCabinet' => $selectedCabinet,
            'penguruses' => $penguruses
        ]);
    }
}
