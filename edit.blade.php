<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Simpanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <div class="card">
        <div class="card-header bg-warning">
            Edit Transaksi Simpanan
        </div>

        <div class="card-body">

            <form action="{{ route('simpanan.update', $simpanan->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Anggota</label>
                    <select name="anggota_id" class="form-select">
                        @foreach($anggotas as $anggota)
                            <option value="{{ $anggota->id }}"
                                {{ old('anggota_id', $simpanan->anggota_id) == $anggota->id ? 'selected' : '' }}>
                                {{ $anggota->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('anggota_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal"
                           class="form-control"
                           value="{{ old('tanggal', $simpanan->tanggal) }}">
                    @error('tanggal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Jenis Simpanan</label>
                    <select name="jenis_simpanan" class="form-select">
                        @foreach(['Pokok', 'Wajib', 'Sukarela'] as $jenis)
                            <option value="{{ $jenis }}"
                                {{ old('jenis_simpanan', $simpanan->jenis_simpanan) == $jenis ? 'selected' : '' }}>
                                {{ $jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah"
                           class="form-control"
                           min="1"
                           value="{{ old('jumlah', $simpanan->jumlah) }}">
                    @error('jumlah')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control">{{ old('keterangan', $simpanan->keterangan) }}</textarea>
                </div>

                <button class="btn btn-primary">Update</button>

                <a href="{{ route('simpanan.index') }}"
                   class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>

</body>
</html>
