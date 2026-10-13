@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

    <h2>Daftar Buku</h2>

    @if(count($buku) > 0)

        <div class="book-list">

            @foreach($buku as $item)

                <x-buku-card :buku="$item"> 
                    <p>Koleksi Perpustakaan</p>
                </x-buku-card>

            @endforeach

        </div>

    @else

        <p>Data buku tidak ditemukan.</p>

    @endif

@endsection