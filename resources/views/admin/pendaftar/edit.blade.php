<!DOCTYPE html>
{{-- Form admin untuk memperbaiki data dan mengganti dokumen pendaftar. --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Santri</title>

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="dash-body">
@php
    $statusOptions = [
        'menunggu' => 'Menunggu Verifikasi',
        'perlu_perbaikan' => 'Perlu Perbaikan',
        'aktif' => 'Aktif',
        'alumni' => 'Alumni',
        'ditolak' => 'Ditolak',
    ];

    $paymentOptions = [
        'belum_upload' => 'Belum Upload',
        'menunggu_verifikasi' => 'Menunggu Verifikasi',
        'terverifikasi' => 'Terverifikasi',
        'ditolak' => 'Ditolak',
    ];

    $category = in_array($pendaftar->status, ['diterima', 'aktif'], true)
        ? 'aktif'
        : ($pendaftar->status === 'alumni' ? 'alumni' : 'calon');

    $backUrl = [
        'calon' => route('admin.pendaftar.index'),
        'aktif' => route('admin.santri.aktif'),
        'alumni' => route('admin.santri.alumni'),
    ][$category];
@endphp

<div class="dashboard-shell">
    <aside class="dashboard-sidebar">
        <div class="brand-block">
            <img src="{{ asset('assets/img/logo-pondok.jpeg') }}" alt="Logo Pondok">
            <div>
                <strong>Darul Furqon</strong>
                <span>Edit Admin</span>
            </div>
        </div>

        <div class="sidebar-label">Navigasi</div>
        <nav class="sidebar-nav">
            <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-chart-pie"></i> Dashboard
            </a>
            <a class="sidebar-link {{ $category === 'calon' ? 'active' : '' }}" href="{{ route('admin.pendaftar.index') }}">
                <i class="fa-solid fa-user-clock"></i> Calon Santri
            </a>
            <a class="sidebar-link {{ $category === 'aktif' ? 'active' : '' }}" href="{{ route('admin.santri.aktif') }}">
                <i class="fa-solid fa-user-check"></i> Santri Aktif
            </a>
            <a class="sidebar-link {{ $category === 'alumni' ? 'active' : '' }}" href="{{ route('admin.santri.alumni') }}">
                <i class="fa-solid fa-user-graduate"></i> Alumni
            </a>
            <a class="sidebar-link" href="{{ route('admin.download.index') }}">
                <i class="fa-solid fa-file-export"></i> Download Data
            </a>
        </nav>

    </aside>

    <main class="dashboard-main">
        <div class="dashboard-topbar">
            <div>
                <span class="eyebrow">Edit Data</span>
                <h1 class="dashboard-title">{{ $pendaftar->nama }}</h1>
                <p class="dashboard-subtitle">Perbarui identitas, data wali, status santri, pembayaran, dan dokumen pendukung.</p>
            </div>

            <div class="topbar-actions">
                <a class="btn btn-ghost" href="{{ $backUrl }}">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <div class="topbar-user">
                    <span>Login sebagai</span>
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="topbar-logout">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Data belum bisa disimpan:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="content-card">
            <div class="card-header">
                <div>
                    <h2>Form Edit Data Santri</h2>
                    <p>Dokumen lama tetap dipakai jika admin tidak mengunggah file pengganti.</p>
                </div>
            </div>

            <form action="{{ route('admin.pendaftar.update', $pendaftar) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="edit-form">
                    <div>
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $pendaftar->nama) }}" required>
                    </div>

                    <div>
                        <label>Email / Gmail</label>
                        <input type="email" name="email" value="{{ old('email', $pendaftar->email) }}" required>
                    </div>

                    <div>
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $pendaftar->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label>Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $pendaftar->asal_sekolah) }}" required>
                    </div>

                    <div>
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $pendaftar->tempat_lahir) }}" required>
                    </div>

                    <div>
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $pendaftar->tgl_lahir) }}" required>
                    </div>

                    <div class="full">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" required>{{ old('alamat', $pendaftar->alamat) }}</textarea>
                    </div>

                    <div>
                        <label>Nama Ayah</label>
                        <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $pendaftar->nama_ayah) }}" required>
                    </div>

                    <div>
                        <label>Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $pendaftar->pekerjaan_ayah) }}">
                    </div>

                    <div>
                        <label>Nama Ibu</label>
                        <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $pendaftar->nama_ibu) }}" required>
                    </div>

                    <div>
                        <label>Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $pendaftar->pekerjaan_ibu) }}">
                    </div>

                    <div>
                        <label>WA Orang Tua / Wali</label>
                        <input type="text" name="wa_wali" value="{{ old('wa_wali', $pendaftar->wa_wali) }}" required>
                    </div>

                    <div>
                        <label>WA Calon Santri</label>
                        <input type="text" name="wa_santri" value="{{ old('wa_santri', $pendaftar->wa_santri) }}">
                    </div>

                    <div>
                        <label>Kemampuan Membaca Al-Quran</label>
                        <select name="kemampuan_membaca_alquran">
                            <option value="">Pilih kemampuan</option>
                            @foreach(['Belum lancar', 'Cukup lancar', 'Lancar', 'Sangat lancar'] as $option)
                                <option value="{{ $option }}" {{ old('kemampuan_membaca_alquran', $pendaftar->kemampuan_membaca_alquran) === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Jumlah Hafalan</label>
                        <input type="text" name="jumlah_hafalan" value="{{ old('jumlah_hafalan', $pendaftar->jumlah_hafalan) }}" placeholder="Contoh: 2 juz">
                    </div>

                    <div class="full">
                        <label>Riwayat Penyakit</label>
                        <textarea name="riwayat_penyakit">{{ old('riwayat_penyakit', $pendaftar->riwayat_penyakit) }}</textarea>
                    </div>

                    <div class="full">
                        <label>Motivasi Masuk Pondok</label>
                        <textarea name="motivasi_masuk_pondok">{{ old('motivasi_masuk_pondok', $pendaftar->motivasi_masuk_pondok) }}</textarea>
                    </div>

                    <div>
                        <label>Status Santri</label>
                        <select name="status" required>
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ old('status', $pendaftar->status === 'diterima' ? 'aktif' : $pendaftar->status) === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Status Pembayaran</label>
                        <select name="status_pembayaran" required>
                            @foreach($paymentOptions as $value => $label)
                                <option value="{{ $value }}" {{ old('status_pembayaran', $pendaftar->status_pembayaran) === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="full">
                        <label>Catatan Admin</label>
                        <textarea name="catatan">{{ old('catatan', $pendaftar->catatan) }}</textarea>
                    </div>

                    <div>
                        <label>Ganti Foto Santri</label>
                        <input type="file" name="foto" accept=".jpg,.jpeg,.png">
                        @if($pendaftar->foto)
                            <div class="meta-list"><a href="{{ asset('storage/' . $pendaftar->foto) }}" target="_blank">Lihat foto saat ini</a></div>
                        @endif
                    </div>

                    <div>
                        <label>Ganti Kartu Keluarga</label>
                        <input type="file" name="kartu_keluarga" accept=".jpg,.jpeg,.png,.pdf">
                        @if($pendaftar->kartu_keluarga)
                            <div class="meta-list"><a href="{{ asset('storage/' . $pendaftar->kartu_keluarga) }}" target="_blank">Lihat KK saat ini</a></div>
                        @endif
                    </div>

                    <div>
                        <label>Ganti Akta Lahir</label>
                        <input type="file" name="akta_lahir" accept=".jpg,.jpeg,.png,.pdf">
                        @if($pendaftar->akta_lahir)
                            <div class="meta-list"><a href="{{ asset('storage/' . $pendaftar->akta_lahir) }}" target="_blank">Lihat akta saat ini</a></div>
                        @endif
                    </div>

                    <div>
                        <label>Ganti Bukti Pembayaran</label>
                        <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf">
                        @if($pendaftar->bukti_pembayaran)
                            <div class="meta-list"><a href="{{ asset('storage/' . $pendaftar->bukti_pembayaran) }}" target="_blank">Lihat bukti saat ini</a></div>
                        @endif
                    </div>
                </div>

                <div class="form-actions">
                    <a class="btn btn-ghost" href="{{ $backUrl }}">Batal</a>
                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </section>
    </main>
</div>
</body>
</html>
