<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Izinkan semua kolom diisi selain ID

    // Satu kabinet punya banyak pengurus
    public function penguruses()
    {
        return $this->hasMany(Pengurus::class);
    }
}
