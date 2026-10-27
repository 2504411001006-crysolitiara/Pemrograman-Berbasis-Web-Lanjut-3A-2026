<?php

use Illuminate\Support\Facades\Route; //menghubungkan route dengan file web.php
use App\Http\Controllers\BukuController; //menghubungkan controller BukuController dengan route

Route::get('/', [BukuController::class, 'home'])->name('home'); //membuat route untuk halaman home

Route::get('/buku', [BukuController::class, 'index'])->name('buku.index'); //membuat route untuk halaman daftar buku

Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.show');