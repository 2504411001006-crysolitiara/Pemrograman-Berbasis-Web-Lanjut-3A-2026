@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

<div class="container">
    <h2>Daftar Buku</h2>

    <p id="pesan"></p>

    <h3 id="judul-form">Tambah Buku</h3>

    <form id="form-buku" style="margin-bottom: 25px;">

        <div style="margin-bottom: 10px;">
            <label for="kategori_id">Kategori</label><br>
            <select id="kategori_id" name="kategori_id" required>
                <option value="">Pilih Kategori</option>
                <option value="1">Novel</option>
                <option value="2">Fantasi</option>
                <option value="3">Pengembangan Diri</option>
            </select>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="judul">Judul Buku</label><br>
            <input type="text" id="judul" name="judul"
                   minlength="3" maxlength="150" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="penulis">Penulis</label><br>
            <input type="text" id="penulis" name="penulis"
                   minlength="3" maxlength="100" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="tahun_terbit">Tahun Terbit</label><br>
            <input type="number" id="tahun_terbit" name="tahun_terbit"
                   min="1900" max="{{ date('Y') }}" required>
        </div>

        <button type="submit" id="tombol-simpan">
            Tambah Buku
        </button>

        <button type="button" id="batal-ubah" hidden>
            Batal
        </button>

    </form>

    <h3>Koleksi Buku</h3>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">

            <thead>
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Kategori</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Judul</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Penulis</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Tahun Terbit</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Aksi</th>
                </tr>
            </thead>

            <tbody id="tabel-buku">
                <tr>
                    <td colspan="6" style="padding: 10px; text-align: center;">
                        Memuat data buku...
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

<script>
// GET: Menampilkan daftar buku
async function tampilkanBuku() {
    const tabel = document.getElementById('tabel-buku');
    const pesan = document.getElementById('pesan');

    try {
        const response = await fetch('/api/buku', {
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Gagal mengambil data buku.');
        }

        const hasil = await response.json();
        const daftarBuku = hasil.data;

        tabel.innerHTML = '';

        if (!daftarBuku || daftarBuku.length === 0) {
            tabel.innerHTML = `
                <tr>
                    <td colspan="6" style="padding: 10px; text-align: center;">
                        Data buku tidak ditemukan.
                    </td>
                </tr>
            `;
            return;
        }

        daftarBuku.forEach(buku => {
            const baris = document.createElement('tr');

            [
                buku.id,
                buku.kategori ?? '-',
                buku.judul ?? '-',
                buku.penulis ?? '-',
                buku.tahun_terbit ?? '-'
            ].forEach(nilai => {
                const kolom = document.createElement('td');

                kolom.style.padding = '10px';
                kolom.style.border = '1px solid #ddd';
                kolom.textContent = nilai;

                baris.appendChild(kolom);
            });

            // Kolom Aksi
            const kolomAksi = document.createElement('td');

            kolomAksi.style.padding = '10px';
            kolomAksi.style.border = '1px solid #ddd';

            // Tombol Ubah
            const tombolUbah = document.createElement('button');

            tombolUbah.textContent = 'Ubah';
            tombolUbah.type = 'button';

            tombolUbah.addEventListener('click', function () {
                const form = document.getElementById('form-buku');

                document.getElementById('kategori_id').value =
                    buku.kategori_id ?? '';

                document.getElementById('judul').value =
                    buku.judul ?? '';

                document.getElementById('penulis').value =
                    buku.penulis ?? '';

                document.getElementById('tahun_terbit').value =
                    buku.tahun_terbit ?? '';

                form.dataset.id = buku.id;

                document.getElementById('judul-form').textContent =
                    'Ubah Buku';

                document.getElementById('tombol-simpan').textContent =
                    'Simpan Perubahan';

                document.getElementById('batal-ubah').hidden = false;

                document.getElementById('pesan').textContent =
                    'Silakan ubah data buku, lalu simpan perubahan.';

                form.scrollIntoView({
                    behavior: 'smooth'
                });
            });

            kolomAksi.appendChild(tombolUbah);

            // Tombol Hapus
            const tombolHapus = document.createElement('button');

            tombolHapus.textContent = 'Hapus';
            tombolHapus.type = 'button';
            tombolHapus.style.marginLeft = '5px';

            tombolHapus.addEventListener('click', async function () {
                const konfirmasi = confirm(
                    `Apakah kamu yakin ingin menghapus buku "${buku.judul}"?`
                );

                if (!konfirmasi) {
                    return;
                }

                const pesan = document.getElementById('pesan');

                try {
                    const response = await fetch(`/api/buku/${buku.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    const hasil = await response.json();

                    if (!response.ok) {
                        throw new Error(
                            hasil.message || 'Gagal menghapus buku.'
                        );
                    }

                    pesan.textContent =
                        hasil.message || 'Buku berhasil dihapus.';

                    pesan.style.color = 'green';

                    await tampilkanBuku();

                } catch (error) {
                    pesan.textContent = error.message;
                    pesan.style.color = 'red';
                }
            });

            kolomAksi.appendChild(tombolHapus);
            baris.appendChild(kolomAksi);

            tabel.appendChild(baris);
        });

    } catch (error) {
        pesan.textContent = error.message;
        pesan.style.color = 'red';

        tabel.innerHTML = `
            <tr>
                <td colspan="6" style="padding: 10px; text-align: center;">
                    Data buku gagal dimuat.
                </td>
            </tr>
        `;
    }
}


// POST dan PUT: Menambah atau mengubah buku
document.getElementById('form-buku').addEventListener('submit', async function (event) {
    event.preventDefault();

    const form = this;
    const pesan = document.getElementById('pesan');
    const id = form.dataset.id;

    const dataBuku = {
        kategori_id: document.getElementById('kategori_id').value,
        judul: document.getElementById('judul').value,
        penulis: document.getElementById('penulis').value,
        tahun_terbit: document.getElementById('tahun_terbit').value
    };

    try {
        const response = await fetch(
            id ? `/api/buku/${id}` : '/api/buku',
            {
                method: id ? 'PUT' : 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },

                body: JSON.stringify(dataBuku)
            }
        );

        const hasil = await response.json();

        if (!response.ok) {
            const kesalahan = hasil.errors
                ? Object.values(hasil.errors).flat().join(', ')
                : hasil.message || 'Gagal menyimpan data buku.';

            throw new Error(kesalahan);
        }

        pesan.textContent = hasil.message ||
            (id
                ? 'Buku berhasil diperbarui.'
                : 'Buku berhasil ditambahkan.');

        pesan.style.color = 'green';

        form.reset();
        delete form.dataset.id;

        document.getElementById('judul-form').textContent =
            'Tambah Buku';

        document.getElementById('tombol-simpan').textContent =
            'Tambah Buku';

        document.getElementById('batal-ubah').hidden = true;

        await tampilkanBuku();

    } catch (error) {
        pesan.textContent = error.message;
        pesan.style.color = 'red';
    }
});


// Membatalkan proses ubah
document.getElementById('batal-ubah').addEventListener('click', function () {
    const form = document.getElementById('form-buku');

    form.reset();
    delete form.dataset.id;

    document.getElementById('judul-form').textContent =
        'Tambah Buku';

    document.getElementById('tombol-simpan').textContent =
        'Tambah Buku';

    this.hidden = true;

    document.getElementById('pesan').textContent = '';
});


// Menjalankan fungsi saat halaman dibuka
tampilkanBuku();
</script>

@endsection