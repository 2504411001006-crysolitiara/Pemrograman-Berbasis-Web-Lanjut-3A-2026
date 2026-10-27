<div class="card">

    <h3>{{ $buku['judul'] }}</h3>

    <p><strong>Penulis:</strong> {{ $buku['penulis'] }}</p>

    <p><strong>Tahun Terbit:</strong> {{ $buku['tahun'] }}</p>

    {{ $slot }}

    <a href="{{ route('buku.show', $buku['id']) }}"> 
        Lihat Detail
    </a>

</div>