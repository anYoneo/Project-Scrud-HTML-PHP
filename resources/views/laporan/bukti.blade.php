<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - {{ $peserta->nomor_pendaftaran }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Times New Roman', serif; }
        .header-logo { font-size: 3rem; }
        @media print { .no-print { display: none !important; } body { font-size: 12pt; } }
    </style>
</head>
<body class="container py-4">
    <div class="text-center border-bottom border-dark pb-3 mb-4">
        <div class="header-logo">🏫</div>
        <h3 class="fw-bold mb-0">SMK NEGERI / SWASTA</h3>
        <p class="text-muted mb-0">Jl. Pendidikan No. 1, Kab. Majalengka, Jawa Barat</p>
        <h4 class="fw-bold mt-3 text-primary">BUKTI PENDAFTARAN SISWA BARU</h4>
        <p class="mb-0">Tahun Pelajaran {{ $peserta->tahun_ajaran }}</p>
    </div>

    <div class="row mb-3">
        <div class="col-8">
            <table class="table table-sm table-borderless">
                <tr><td width="35%"><strong>No. Pendaftaran</strong></td><td>: <strong class="text-primary fs-5">{{ $peserta->nomor_pendaftaran }}</strong></td></tr>
                <tr><td><strong>Tanggal Daftar</strong></td><td>: {{ $peserta->tanggal_daftar->format('d F Y') }}</td></tr>
                <tr><td><strong>Jurusan</strong></td><td>: {{ $peserta->jurusan }}</td></tr>
            </table>
        </div>
        <div class="col-4 text-center">
            @if($peserta->foto)
            <img src="{{ Storage::url($peserta->foto) }}" height="100" class="border">
            @else
            <div class="border d-inline-block" style="width:80px;height:100px;line-height:100px;">FOTO</div>
            @endif
        </div>
    </div>

    <h6 class="fw-bold">DATA PRIBADI</h6>
    <table class="table table-sm table-bordered">
        <tr><td width="35%">Nama Lengkap</td><td>{{ $peserta->nama_peserta }}</td></tr>
        <tr><td>Tempat, Tgl Lahir</td><td>{{ $peserta->tempat_lahir }}, {{ $peserta->tanggal_lahir->format('d F Y') }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>{{ $peserta->jenis_kelamin }}</td></tr>
        <tr><td>Agama</td><td>{{ $peserta->agama }}</td></tr>
        <tr><td>Alamat</td><td>{{ $peserta->alamat }}, Kec. {{ $peserta->kecamatan->nama_kecamatan }}</td></tr>
        <tr><td>No. Telepon</td><td>{{ $peserta->telepon ?? '-' }}</td></tr>
        <tr><td>Asal Sekolah</td><td>{{ $peserta->asal_sekolah ?? '-' }}</td></tr>
    </table>

    <div class="row mt-4">
        <div class="col-6 text-center">
            <p>Mengetahui,<br>Panitia PSB</p>
            <br><br><br>
            <p>(_______________________)</p>
        </div>
        <div class="col-6 text-center">
            <p>Majalengka, {{ $peserta->tanggal_daftar->format('d F Y') }}<br>Calon Peserta Didik</p>
            <br><br><br>
            <p>({{ $peserta->nama_peserta }})</p>
        </div>
    </div>

    <div class="text-center mt-3 no-print">
        <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer me-2"></i>Cetak Bukti</button>
        <a href="{{ route('peserta.show', $peserta) }}" class="btn btn-outline-secondary ms-2">Kembali</a>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
