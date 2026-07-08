<!DOCTYPE html>
{{-- Menampilkan identitas, status, dan dokumen lengkap seorang pendaftar. --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Santri</title>

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="dash-body">
@php
    $menuItems = [
        ['key' => 'dashboard', 'label' => 'Dashboard', 'route' => route('admin.dashboard'), 'icon' => 'fa-chart-pie'],
        ['key' => 'calon', 'label' => 'Data Pendaftar', 'route' => route('admin.pendaftar.index'), 'icon' => 'fa-user-clock'],
        ['key' => 'aktif', 'label' => 'Santri Aktif', 'route' => route('admin.santri.aktif'), 'icon' => 'fa-user-check'],
        ['key' => 'alumni', 'label' => 'Alumni', 'route' => route('admin.santri.alumni'), 'icon' => 'fa-user-graduate'],
        ['key' => 'download', 'label' => 'Download Data', 'route' => route('admin.download.index'), 'icon' => 'fa-file-export'],
    ];

    $statusMeta = [
        'menunggu' => ['Menunggu', 'badge-waiting'],
        'perlu_perbaikan' => ['Perlu Perbaikan', 'badge-waiting'],
        'diterima' => ['Aktif', 'badge-active'],
        'aktif' => ['Aktif', 'badge-active'],
        'alumni' => ['Alumni', 'badge-alumni'],
        'ditolak' => ['Ditolak', 'badge-rejected'],
    ];

    $paymentMeta = [
        'belum_upload' => ['Belum Upload', 'badge-gray'],
        'menunggu_verifikasi' => ['Menunggu Verifikasi', 'badge-waiting'],
        'terverifikasi' => ['Terverifikasi', 'badge-blue'],
        'ditolak' => ['Ditolak', 'badge-rejected'],
    ];

    $status = $statusMeta[$pendaftar->status] ?? [ucfirst($pendaftar->status ?? '-'), 'badge-gray'];
    $payment = $paymentMeta[$pendaftar->status_pembayaran] ?? [ucfirst($pendaftar->status_pembayaran ?? '-'), 'badge-gray'];
    $initial = strtoupper(substr($pendaftar->nama ?? 'S', 0, 1));
    $tanggalDaftar = optional($pendaftar->created_at)->format('d/m/Y H:i') ?? '-';
    $tanggalDiterimaValue = $pendaftar->tanggal_diterima ?: (in_array($pendaftar->status, ['diterima', 'aktif', 'alumni'], true) ? $pendaftar->updated_at : null);
    $tanggalAlumniValue = $pendaftar->tanggal_alumni ?: ($pendaftar->status === 'alumni' ? $pendaftar->updated_at : null);
    $tanggalDiterima = optional($tanggalDiterimaValue)->format('d/m/Y H:i') ?? '-';
    $tanggalAlumni = optional($tanggalAlumniValue)->format('d/m/Y H:i') ?? '-';
@endphp

<div class="dashboard-shell">
    <aside class="dashboard-sidebar">
        <div class="brand-block">
            <img src="{{ asset('assets/img/logo-pondok.jpeg') }}" alt="Logo Pondok">
            <div>
                <strong>Darul Furqon</strong>
                <span>Detail Admin</span>
            </div>
        </div>

        <div class="sidebar-label">Menu Admin</div>
        <nav class="sidebar-nav">
            @foreach($menuItems as $item)
                <a class="sidebar-link {{ $category === $item['key'] ? 'active' : '' }}" href="{{ $item['route'] }}">
                    <i class="fa-solid {{ $item['icon'] }}"></i>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

    </aside>

    <main class="dashboard-main">
        <div class="dashboard-topbar">
            <div>
                <span class="eyebrow">Detail Santri</span>
                <h1 class="dashboard-title">{{ $pendaftar->nama }}</h1>
                <p class="dashboard-subtitle">Detail lengkap data santri dari tabel pendaftars.</p>
            </div>

            <div class="topbar-actions">
                <a class="btn btn-ghost" href="{{ route($backRoute) }}">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <a class="btn btn-blue" href="{{ route('admin.pendaftar.edit', $pendaftar) }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                <form action="{{ route('logout') }}" method="POST" class="topbar-logout">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="profile-grid">
            <section class="id-card">
                <div class="id-photo">
                    @if($pendaftar->foto)
                        <img src="{{ asset('storage/' . $pendaftar->foto) }}" alt="Foto {{ $pendaftar->nama }}">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:54px;font-weight:950;">
                            {{ $initial }}
                        </div>
                    @endif
                </div>

                <span class="eyebrow" style="color:rgba(255,255,255,0.85);">Data Santri</span>
                <h2>{{ $pendaftar->nama }}</h2>
                <p>{{ $pendaftar->email }}</p>
                <p>{{ $pendaftar->jenis_kelamin ?? '-' }} - {{ $pendaftar->tempat_lahir ?? '-' }}, {{ $pendaftar->tgl_lahir ?? '-' }}</p>
                <span class="badge">{{ $status[0] }}</span>
            </section>

            <section class="content-card">
                <div class="card-header">
                    <div>
                        <h2>Status</h2>
                        <p>Status pendaftaran, pembayaran, dan akun login santri.</p>
                    </div>
                </div>

                <div class="detail-grid">
                    <div class="detail-item">
                        <span>Status Santri</span>
                        <strong><span class="badge {{ $status[1] }}">{{ $status[0] }}</span></strong>
                    </div>

                    <div class="detail-item">
                        <span>Status Pembayaran</span>
                        <strong><span class="badge {{ $payment[1] }}">{{ $payment[0] }}</span></strong>
                    </div>

                    @if($category === 'aktif')
                        <div class="detail-item">
                            <span>Tanggal Daftar</span>
                            <strong>{{ $tanggalDaftar }}</strong>
                        </div>

                        <div class="detail-item">
                            <span>Tanggal Diterima Aktif</span>
                            <strong>{{ $tanggalDiterima }}</strong>
                        </div>
                    @elseif($category === 'alumni')
                        <div class="detail-item">
                            <span>Tanggal Diterima Aktif</span>
                            <strong>{{ $tanggalDiterima }}</strong>
                        </div>

                        <div class="detail-item">
                            <span>Tanggal Menjadi Alumni</span>
                            <strong>{{ $tanggalAlumni }}</strong>
                        </div>
                    @endif

                    <div class="detail-item">
                        <span>Email Login</span>
                        <strong>{{ $pendaftar->user?->email ?? '-' }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>Nomor Induk Santri</span>
                        <strong>{{ $pendaftar->nomor_induk_santri ?? '-' }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>Password Awal</span>
                        <strong>{{ $pendaftar->password_awal ?? $pendaftar->nomor_induk_santri ?? '-' }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>Catatan Admin</span>
                        <strong>{{ $pendaftar->catatan ?? '-' }}</strong>
                    </div>
                </div>
            </section>
        </div>

        <div class="dashboard-grid" style="margin-top:20px;">
            <section class="content-card">
                <div class="card-header">
                    <div>
                        <h2>Data Inti</h2>
                        <p>Identitas santri dan data keluarga.</p>
                    </div>
                </div>

                <div class="detail-grid">
                    <div class="detail-item">
                        <span>Asal Sekolah</span>
                        <strong>{{ $pendaftar->asal_sekolah ?? '-' }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>WA Wali / WA Santri</span>
                        <strong>{{ $pendaftar->wa_wali ?? '-' }} / {{ $pendaftar->wa_santri ?? '-' }}</strong>
                    </div>

                    <div class="detail-item full">
                        <span>Alamat</span>
                        <strong>{{ $pendaftar->alamat ?? '-' }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>Nama Ayah</span>
                        <strong>{{ $pendaftar->nama_ayah ?? '-' }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>Pekerjaan Ayah</span>
                        <strong>{{ $pendaftar->pekerjaan_ayah ?? '-' }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>Nama Ibu</span>
                        <strong>{{ $pendaftar->nama_ibu ?? '-' }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>Pekerjaan Ibu</span>
                        <strong>{{ $pendaftar->pekerjaan_ibu ?? '-' }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>Kemampuan Membaca Al-Quran</span>
                        <strong>{{ $pendaftar->kemampuan_membaca_alquran ?? '-' }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>Jumlah Hafalan</span>
                        <strong>{{ $pendaftar->jumlah_hafalan ?? '-' }}</strong>
                    </div>

                    <div class="detail-item full">
                        <span>Riwayat Penyakit</span>
                        <strong>{{ $pendaftar->riwayat_penyakit ?? '-' }}</strong>
                    </div>

                    <div class="detail-item full">
                        <span>Motivasi Masuk Pondok</span>
                        <strong>{{ $pendaftar->motivasi_masuk_pondok ?? '-' }}</strong>
                    </div>
                </div>
            </section>

            <aside>
                <div class="side-card">
                    <h3>Dokumen</h3>
                    <p>Dokumen yang diunggah calon santri.</p>
                    <div class="doc-links" style="margin-top:16px;">
                        @if($pendaftar->foto)<a href="{{ asset('storage/' . $pendaftar->foto) }}" target="_blank">Foto Santri</a>@endif
                        @if($pendaftar->kartu_keluarga)<a href="{{ asset('storage/' . $pendaftar->kartu_keluarga) }}" target="_blank">Kartu Keluarga</a>@endif
                        @if($pendaftar->akta_lahir)<a href="{{ asset('storage/' . $pendaftar->akta_lahir) }}" target="_blank">Akta Lahir</a>@endif
                        @if($pendaftar->bukti_pembayaran)<a href="{{ asset('storage/' . $pendaftar->bukti_pembayaran) }}" target="_blank">Bukti Pembayaran</a>@endif
                        @if(!$pendaftar->foto && !$pendaftar->kartu_keluarga && !$pendaftar->akta_lahir && !$pendaftar->bukti_pembayaran)
                            <span class="meta-list">Belum ada dokumen.</span>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </main>
</div>
</body>
</html>
