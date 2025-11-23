<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    // Agar semua kolom bisa diisi (untuk mencegah error Mass Assignment nantinya)
    protected $guarded = ['id'];

    // Relasi: Satu Pengurus "Milik" (Belongs To) Satu Kabinet
    public function cabinet()
    {
        return $this->belongsTo(Cabinet::class, 'cabinet_id');
    }

    // Relasi: Satu Pengurus "Milik" (Belongs To) Satu Departemen
    // Nama fungsi ini harus 'departement' sesuai yang kita panggil di Controller
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }
}
