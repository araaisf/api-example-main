<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;

class CatatanWebController extends Controller
{
    public function index()
    {
        $catatan = Catatan::latest()->get();
        return view('index', compact('catatan')); // lihat index.blade.php
    }

    public function create()
    {
        return view('create'); // ← INI DIA!
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

    // proses simpan data...

    return redirect()->back()->with('success', 'Data berhasil disimpan!');
}


} //
