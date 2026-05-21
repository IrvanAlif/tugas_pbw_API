<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['nim', 'nama', 'prodi', 'angkatan', 'email'];

    /**
     * Satu mahasiswa punya banyak nilai
     */
    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
}
