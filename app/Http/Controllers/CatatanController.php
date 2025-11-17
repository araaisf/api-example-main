<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    // GET semua catatan, bisa filter user_id
    public function index(Request $request)
    {
        $query = Catatan::with('user'); // pastikan relasi 'user' ada di model

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        return response()->json([
            'status' => true,
            'data' => $query->get()
        ]);
    }

    // POST tambah catatan
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'judul'   => 'required|string',
            'isi'     => 'nullable|string', // bisa kosong
        ]);

        $catatan = Catatan::create([
            'user_id' => $request->user_id,
            'judul'   => $request->judul,
            'isi'     => $request->isi,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Catatan berhasil dibuat',
            'data' => $catatan
        ], 201);
    }

    // GET detail catatan per ID
    public function show($id)
    {
        $catatan = Catatan::with('user')->find($id);
        if (!$catatan) {
            return response()->json([
                'status' => false,
                'message' => 'Catatan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $catatan
        ]);
    }

    // PUT update catatan
    public function update(Request $request, $id)
    {
        $catatan = Catatan::find($id);
        if (!$catatan) {
            return response()->json([
                'status' => false,
                'message' => 'Catatan tidak ditemukan'
            ], 404);
        }

        $catatan->update($request->only(['judul', 'isi']));

        return response()->json([
            'status' => true,
            'message' => 'Catatan berhasil diupdate',
            'data' => $catatan
        ]);
    }

    // DELETE catatan
    public function destroy($id)
    {
        $catatan = Catatan::find($id);
        if (!$catatan) {
            return response()->json([
                'status' => false,
                'message' => 'Catatan tidak ditemukan'
            ], 404);
        }

        $catatan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Catatan berhasil dihapus'
        ]);
    }
}
