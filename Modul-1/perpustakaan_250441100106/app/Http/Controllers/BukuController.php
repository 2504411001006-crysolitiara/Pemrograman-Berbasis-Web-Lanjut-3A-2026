<?php

namespace App\Http\Controllers; //membuat namespace untuk controller

class BukuController extends Controller //membuat controller BukuController
{
    private $dataBuku = [ //membuat data buku dalam bentuk array
        [
            'id' => 1,
            'judul' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'tahun' => 2005,
            'kategori' => 'Novel'
        ],
        [
            'id' => 2,
            'judul' => 'Bumi',
            'penulis' => 'Tere Liye',
            'tahun' => 2014,
            'kategori' => 'Fantasi'
        ],
        [
            'id' => 3,
            'judul' => 'Negeri 5 Menara',
            'penulis' => 'Ahmad Fuadi',
            'tahun' => 2009,
            'kategori' => 'Novel'
        ],
        [
            'id' => 4,
            'judul' => 'Filosofi Teras',
            'penulis' => 'Henry Manampiring',
            'tahun' => 2018,
            'kategori' => 'Pengembangan Diri'
        ],
        [
            'id' => 5,
            'judul' => 'Atomic Habits',
            'penulis' => 'James Clear',
            'tahun' => 2018,
            'kategori' => 'Pengembangan Diri' 
        ],
    ];

    public function home() 
    {
        return view('home');
    } //membuat method home untuk menampilkan halaman home

    public function index()
    {
        $buku = $this->dataBuku;

        return view('buku.index', compact('buku'));
    } 

    public function show($id)
    {
        $buku = collect($this->dataBuku)
            ->firstWhere('id', (int) $id);

        return view('buku.show', compact('buku')); 
    }
}