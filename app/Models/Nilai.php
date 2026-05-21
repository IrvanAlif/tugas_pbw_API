<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'mahasiswa_id', 'mata_kuliah', 'kode_mk',
        'nilai_angka', 'nilai_huruf', 'sks', 'semester'
    ];

    /**
     * Setiap nilai punya satu mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
