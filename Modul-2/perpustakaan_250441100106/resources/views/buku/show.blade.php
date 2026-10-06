@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')

    <h2>Detail Buku</h2>

    @if($buku) 

        <div class="card">

            <h3>{{ $buku['judul'] }}</h3>

            <p>
                <strong>Penulis:</strong>
                {{ $buku['penulis'] }}
            </p>

            <p>
                <strong>Tahun Terbit:</strong>
                {{ $buku['tahun'] }}
            </p>

            <p>
                <strong>Kategori:</strong>
                {{ $buku['kategori'] }}
            </p>

            <a href="{{ route('buku.index') }}"> 
                Kembali ke Daftar Buku
            </a>

        </div>

    @else

        <p>Data buku tidak ditemukan.</p>

        <a href="{{ route('buku.index') }}">
            Kembali ke Daftar Buku
        </a>

    @endif

@endsection