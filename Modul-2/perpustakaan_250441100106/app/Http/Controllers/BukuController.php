<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class BukuController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $buku = Buku::with('kategori')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'penulis' => $item->penulis,
                'tahun' => $item->tahun_terbit,
                'kategori' => $item->kategori->nama,
            ];
        });

        return view('buku.index', compact('buku'));
    }

    public function show($id)
    {
        $item = Buku::with('kategori')->find($id);

        $buku = $item ? [
            'id' => $item->id,
            'judul' => $item->judul,
            'penulis' => $item->penulis,
            'tahun' => $item->tahun_terbit,
            'kategori' => $item->kategori->nama,
        ] : null;

        return view('buku.show', compact('buku'));
    }
}