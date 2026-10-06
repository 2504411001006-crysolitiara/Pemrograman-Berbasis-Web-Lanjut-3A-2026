@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    <section class="hero">

        <div class="hero-text">

            <p class="hero-label">SELAMAT DATANG DI</p>

            <h2>Perpustakaan Tiara</h2>

            <p class="hero-description">
                Temukan berbagai koleksi buku yang menarik dan
                menambah wawasan. Jelajahi buku favoritmu
                dan nikmati pengalaman membaca yang menyenangkan.
            </p>

            <a href="{{ route('buku.index') }}" class="btn">
                Jelajahi Koleksi Buku
            </a>

        </div>

        <div class="hero-icon">
            📚
        </div>

    </section>

    <section class="info-section">

        <div class="info-card">
            <div class="info-icon">📖</div>
            <h3>Koleksi Buku</h3>
            <p>
                Temukan berbagai buku dengan berbagai
                kategori yang tersedia.
            </p>
        </div>

        <div class="info-card">
            <div class="info-icon">🔍</div>
            <h3>Mudah Dicari</h3>
            <p>
                Lihat daftar buku dan temukan informasi
                buku dengan mudah.
            </p>
        </div>

        <div class="info-card">
            <div class="info-icon">✨</div>
            <h3>Tambah Wawasan</h3>
            <p>
                Membaca buku dapat membantu menambah
                pengetahuan dan wawasan.
            </p>
        </div>

    </section>

@endsection