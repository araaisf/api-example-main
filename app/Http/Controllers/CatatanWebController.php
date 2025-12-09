<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;

class CatatanWebController extends Controller
{
    public function index()
    {
        $catatan = Catatan::latest()->get();
        return view('index', compact('catatan')); // pakai resources/views/index.blade.php
    }

    public function create()
    {
        return view('create'); // pakai resources/views/create.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        Catatan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
public function delete($id)
{
    $catatan = Catatan::find($id);

    if (!$catatan) {
        return redirect()->back()->with('error', 'Catatan tidak ditemukan!');
    }

    $catatan->delete();

    return redirect()->back()->with('success', 'Catatan berhasil dihapus!');
}


}
