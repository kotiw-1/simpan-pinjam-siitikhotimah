<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Simpanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Tambah Transaksi Simpanan
        </div>

        <div class="card-body">

            <form action="{{ route('simpanan.store') }}" method="POST">
                @csrf

                <!-- Nama Anggota -->
                <div class="mb-3">
                    <label class="form-label">Nama Anggota</label>

                    <input type="text"
                           id="nama_anggota"
                           class="form-control"
                           list="daftar_anggota"
                           placeholder="Ketik nama anggota"
                           required>

                    <datalist id="daftar_anggota">
                        @foreach ($anggotas as $anggota)
                            <option value="{{ $anggota->nama }}"
                                    data-id="{{ $anggota->id }}">
                            </option>
                        @endforeach
                    </datalist>

                    <input type="hidden"
                           name="anggota_id"
                           id="anggota_id">

                    <small id="pesan_anggota" class="text-muted">
                        Pilih nama anggota dari daftar saran.
                    </small>

                    @error('anggota_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ old('tanggal') }}"
                           required>
                </div>

                <!-- Jenis Simpanan -->
                <div class="mb-3">
                    <label class="form-label">Jenis Simpanan</label>

                    <select name="jenis_simpanan" class="form-select" required>
                        <option value="">Pilih Jenis</option>
                        <option value="Pokok">Simpanan Pokok</option>
                        <option value="Wajib">Simpanan Wajib</option>
                        <option value="Sukarela">Simpanan Sukarela</option>
                    </select>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label class="form-label">Jumlah Simpanan</label>
                    <input type="number"
                           name="jumlah"
                           class="form-control"
                           min="1"
                           value="{{ old('jumlah') }}"
                           required>
                </div>

                <!-- Keterangan -->
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control">{{ old('keterangan') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('simpanan.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>
        </div>
    </div>
</div>

<script>
const inputNama = document.getElementById('nama_anggota');
const inputId = document.getElementById('anggota_id');
const pesan = document.getElementById('pesan_anggota');

function cariAnggota() {
    const nama = inputNama.value.trim();
    const options = document.querySelectorAll('#daftar_anggota option');

    inputId.value = '';

    for (const option of options) {
        if (option.value === nama) {
            inputId.value = option.dataset.id;
            pesan.textContent = 'Anggota berhasil dipilih.';
            pesan.className = 'text-success';
            return;
        }
    }

    pesan.textContent = 'Pilih nama anggota yang tersedia.';
    pesan.className = 'text-danger';
}

inputNama.addEventListener('input', cariAnggota);
inputNama.addEventListener('change', cariAnggota);

document.querySelector('form').addEventListener('submit', function(e) {
    cariAnggota();

    if (!inputId.value) {
        e.preventDefault();
        alert('Silakan pilih nama anggota dari daftar yang tersedia!');
    }
});
</script>

</body>
</html>