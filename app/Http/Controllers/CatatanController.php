<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    // CREATE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $catatan = Catatan::create($validated);

        return response()->json([
            'message' => 'Catatan berhasil dibuat',
            'data' => $catatan
        ], 201);
    }

    // READ ALL
    public function index()
    {
        $catatan = Catatan::all(); 
        return response()->json($catatan, 200);
    }

    // READ BY ID
    public function show($id)
    {
        $catatan = Catatan::find($id);

        if (!$catatan) {
            return response()->json([
                'message' => 'Catatan tidak ditemukan'
            ], 404);
        }

        return response()->json($catatan, 200);
    }
}
