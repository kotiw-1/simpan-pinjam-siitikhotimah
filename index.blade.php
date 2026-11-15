<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Simpanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

    <h3>Data Transaksi Simpanan</h3>

    <a href="{{ route('dashboard') }}"
       class="btn btn-secondary mb-3">Dashboard</a>

    <a href="{{ route('simpanan.create') }}"
       class="btn btn-primary mb-3">Tambah Simpanan</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped">

                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal</th>
                        <th>Jenis Simpanan</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($simpanans as $simpanan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $simpanan->anggota->nama }}</td>
                        <td>{{ $simpanan->tanggal }}</td>
                        <td>{{ $simpanan->jenis_simpanan }}</td>
                        <td>Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $simpanan->keterangan }}</td>

                        <td>
                            <a href="{{ route('simpanan.edit', $simpanan->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('simpanan.destroy', $simpanan->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Hapus transaksi ini?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada transaksi simpanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>
