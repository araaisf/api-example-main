<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catatan;

class CatatanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        // Simpan ke database
        $catatan = Catatan::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        return response()->json([
            'message' => 'Catatan berhasil dibuat',
            'data' => $catatan
        ], 201);
    }
    public function index()
{
    return response()->json([
        'message' => 'Berhasil ambil data catatan',
        'data' => \App\Models\Catatan::all()
    ]);
}

}
