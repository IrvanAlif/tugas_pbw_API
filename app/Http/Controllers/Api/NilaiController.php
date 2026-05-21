<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    // GET /api/nilais
    // Ambil semua nilai + info mahasiswanya (dari dua tabel sekaligus)
    public function index()
    {
        // with('mahasiswa') = ambil data tabel mahasiswas juga
        $nilais = Nilai::with('mahasiswa')->get();

        return response()->json([
            'status' => true,
            'data' => $nilais
        ], 200);
    }

    // GET /api/mahasiswas/{id}/nilais
    // Ambil semua nilai milik satu mahasiswa tertentu
    public function byMahasiswa($id)
    {
        $mhs = Mahasiswa::with('nilais')->find($id);

        if (!$mhs) {
            return response()->json(['status' => false, 'message' => 'Mahasiswa tidak ada'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Nilai milik ' . $mhs->nama,
            'data' => [
                'mahasiswa' => [
                    'id' => $mhs->id,
                    'nim' => $mhs->nim,
                    'nama' => $mhs->nama,
                ],
                'daftar_nilai' => $mhs->nilais,
                'total_sks' => $mhs->nilais->sum('sks'),
            ]
        ], 200);
    }

    // POST /api/nilais
    // Tambah nilai baru untuk mahasiswa
    public function store(Request $request)
    {
        $data = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'mata_kuliah' => 'required|string',
            'kode_mk' => 'required|string',
            'nilai_angka' => 'required|numeric|min:0|max:100',
            'nilai_huruf' => 'required|string|max:2',
            'sks' => 'required|integer',
            'semester' => 'required|string',
        ]);

        $nilai = Nilai::create($data);
        $nilai->load('mahasiswa'); // load relasi setelah create

        return response()->json([
            'status' => true,
            'message' => 'Nilai ditambahkan',
            'data' => $nilai
        ], 201);
    }
}
