<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // GET /api/mahasiswas
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Data semua mahasiswa',
            'data' => Mahasiswa::all()
        ], 200);
    }

    // POST /api/mahasiswas
    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required|string',
            'prodi' => 'required|string',
            'angkatan' => 'required|string|max:4',
            'email' => 'required|email|unique:mahasiswas',
        ]);

        $mhs = Mahasiswa::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Mahasiswa ditambahkan',
            'data' => $mhs
        ], 201);
    }

    // GET /api/mahasiswas/{id}
    public function show($id)
    {
        $mhs = Mahasiswa::find($id);

        if (!$mhs) {
            return response()->json(['status' => false, 'message' => 'Tidak ditemukan'], 404);
        }

        return response()->json(['status' => true, 'data' => $mhs], 200);
    }

    // PUT /api/mahasiswas/{id}
    public function update(Request $request, $id)
    {
        $mhs = Mahasiswa::find($id);

        if (!$mhs) {
            return response()->json(['status' => false, 'message' => 'Tidak ditemukan'], 404);
        }

        $mhs->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data diperbarui',
            'data' => $mhs
        ], 200);
    }

    // DELETE /api/mahasiswas/{id}
    public function destroy($id)
    {
        $mhs = Mahasiswa::find($id);

        if (!$mhs) {
            return response()->json(['status' => false, 'message' => 'Tidak ditemukan'], 404);
        }

        $mhs->delete();

        return response()->json(['status' => true, 'message' => 'Data dihapus'], 200);
    }
}
