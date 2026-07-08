<!DOCTYPE html>
{{-- Dashboard baca-saja untuk statistik, filter, dan daftar santri bagi pengasuh. --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengasuh</title>

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="dash-body">
@php
    $menuItems = [
        ['key' => 'semua', 'label' => 'Dashboard Pengasuh', 'route' => route('pengasuh.dashboard'), 'icon' => 'fa-chart-pie'],
        ['key' => 'calon', 'label' => 'Data Pendaftar', 'route' => route('pengasuh.dashboard', ['kategori' => 'calon']), 'icon' => 'fa-user-clock'],
        ['key' => 'aktif', 'label' => 'Santri Aktif', 'route' => route('pengasuh.dashboard', ['kategori' => 'aktif']), 'icon' => 'fa-user-check'],
        ['key' => 'alumni', 'label' => 'Santri Alumni', 'route' => route('pengasuh.dashboard', ['kategori' => 'alumni']), 'icon' => 'fa-user-graduate'],
    ];

    $categoryLabels = [
        'semua' => 'Dashboard Pengasuh',
        'calon' => 'Data Pendaftar',
        'aktif' => 'Santri Aktif',
        'alumni' => 'Santri Alumni',
    ];

    $pageSubtitles = [
        'semua' => 'Pantau jumlah pendaftar, santri aktif, alumni, dan status pembayaran dari satu halaman.',
        'calon' => 'Lihat calon santri yang masih berada dalam proses pendaftaran.',
        'aktif' => 'Lihat santri yang sudah diterima dan masih aktif di pondok.',
        'alumni' => 'Lihat data santri yang sudah menjadi alumni.',
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

    $statusChart = [
        ['label' => 'Calon Santri', 'value' => $stats['calon'], 'class' => 'chart-green'],
        ['label' => 'Santri Aktif', 'value' => $stats['aktif'], 'class' => 'chart-blue'],
        ['label' => 'Alumni', 'value' => $stats['alumni'], 'class' => 'chart-indigo'],
        ['label' => 'Ditolak', 'value' => $stats['ditolak'], 'class' => 'chart-red'],
    ];

    $paymentChart = [
        ['label' => 'Terverifikasi', 'value' => $stats['pembayaran_terverifikasi'], 'class' => 'chart-blue'],
        ['label' => 'Belum / Menunggu', 'value' => $stats['pembayaran_belum'], 'class' => 'chart-amber'],
    ];

    $statusMax = max(1, max(array_column($statusChart, 'value') ?: [0]));
    $paymentMax = max(1, max(array_column($paymentChart, 'value') ?: [0]));
    $currentTitle = $categoryLabels[$filters['kategori']] ?? 'Dashboard Pengasuh';
    $currentSubtitle = $pageSubtitles[$filters['kategori']] ?? $pageSubtitles['semua'];
@endphp

<div class="dashboard-shell">
    <aside class="dashboard-sidebar">
        <div class="brand-block">
            <img src="{{ asset('assets/img/logo-pondok.jpeg') }}" alt="Logo Pondok">
            <div>
                <strong>Darul Furqon</strong>
                <span>Pengasuh Panel</span>
            </div>
        </div>

        <div class="sidebar-label">Menu Pengasuh</div>
        <nav class="sidebar-nav">
            @foreach($menuItems as $item)
                <a class="sidebar-link {{ $filters['kategori'] === $item['key'] ? 'active' : '' }}" href="{{ $item['route'] }}">
                    <i class="fa-solid {{ $item['icon'] }}"></i>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
    </aside>

    <main class="dashboard-main">
        <div class="dashboard-topbar">
            <div>
                <span class="eyebrow">Dashboard Pengasuh</span>
                <h1 class="dashboard-title">{{ $currentTitle }}</h1>
                <p class="dashboard-subtitle">{{ $currentSubtitle }}</p>
            </div>

            <div class="topbar-actions">
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

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($filters['kategori'] === 'semua')
            <section class="stats-grid">
                <div class="stat-card highlight">
                    <div class="stat-top">
                        <span>Jumlah Pendaftar</span>
                        <span class="stat-icon"><i class="fa-solid fa-database"></i></span>
                    </div>
                    <div class="stat-label">Semua data pendaftaran</div>
                    <div class="stat-number">{{ $stats['total'] }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span>Calon Santri</span>
                        <span class="stat-icon"><i class="fa-solid fa-user-clock"></i></span>
                    </div>
                    <div class="stat-label">Masih proses</div>
                    <div class="stat-number">{{ $stats['calon'] }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span>Santri Aktif</span>
                        <span class="stat-icon"><i class="fa-solid fa-user-check"></i></span>
                    </div>
                    <div class="stat-label">Diterima dan aktif</div>
                    <div class="stat-number">{{ $stats['aktif'] }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span>Alumni</span>
                        <span class="stat-icon"><i class="fa-solid fa-user-graduate"></i></span>
                    </div>
                    <div class="stat-label">Sudah alumni</div>
                    <div class="stat-number">{{ $stats['alumni'] }}</div>
                </div>
            </section>

            <section class="chart-grid">
                <div class="chart-card">
                    <div class="card-header flat">
                        <div>
                            <h2>Grafik Status Santri</h2>
                            <p>Grafik batang jumlah calon santri, santri aktif, alumni, dan data ditolak.</p>
                        </div>
                    </div>

                    <div class="graph-wrap">
                        <svg class="graph-svg" viewBox="0 0 430 245" role="img" aria-label="Grafik status santri">
                            <line class="graph-grid-line" x1="34" y1="40" x2="410" y2="40"></line>
                            <line class="graph-grid-line" x1="34" y1="90" x2="410" y2="90"></line>
                            <line class="graph-grid-line" x1="34" y1="140" x2="410" y2="140"></line>
                            <line class="graph-axis" x1="34" y1="190" x2="410" y2="190"></line>
                            <line class="graph-axis" x1="34" y1="30" x2="34" y2="190"></line>

                            @foreach($statusChart as $item)
                                @php
                                    $barHeight = max(8, round(($item['value'] / $statusMax) * 150));
                                    $barX = 58 + ($loop->index * 92);
                                    $barY = 190 - $barHeight;
                                @endphp
                                <rect class="graph-bar {{ $item['class'] }}" x="{{ $barX }}" y="{{ $barY }}" width="48" height="{{ $barHeight }}" rx="10"></rect>
                                <text class="graph-value" x="{{ $barX + 24 }}" y="{{ max(22, $barY - 8) }}">{{ $item['value'] }}</text>
                                <text class="graph-label" x="{{ $barX + 24 }}" y="218">{{ $item['label'] }}</text>
                            @endforeach
                        </svg>

                        <div class="graph-legend">
                            @foreach($statusChart as $item)
                                <span><i class="{{ $item['class'] }}"></i>{{ $item['label'] }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="chart-card">
                    <div class="card-header flat">
                        <div>
                            <h2>Grafik Pembayaran</h2>
                            <p>Grafik pembayaran terverifikasi dibanding data yang belum selesai.</p>
                        </div>
                    </div>

                    <div class="graph-wrap">
                        <svg class="graph-svg" viewBox="0 0 430 245" role="img" aria-label="Grafik pembayaran">
                            <line class="graph-grid-line" x1="34" y1="40" x2="410" y2="40"></line>
                            <line class="graph-grid-line" x1="34" y1="90" x2="410" y2="90"></line>
                            <line class="graph-grid-line" x1="34" y1="140" x2="410" y2="140"></line>
                            <line class="graph-axis" x1="34" y1="190" x2="410" y2="190"></line>
                            <line class="graph-axis" x1="34" y1="30" x2="34" y2="190"></line>

                            @foreach($paymentChart as $item)
                                @php
                                    $barHeight = max(8, round(($item['value'] / $paymentMax) * 150));
                                    $barX = 108 + ($loop->index * 156);
                                    $barY = 190 - $barHeight;
                                @endphp
                                <rect class="graph-bar {{ $item['class'] }}" x="{{ $barX }}" y="{{ $barY }}" width="70" height="{{ $barHeight }}" rx="12"></rect>
                                <text class="graph-value" x="{{ $barX + 35 }}" y="{{ max(22, $barY - 8) }}">{{ $item['value'] }}</text>
                                <text class="graph-label" x="{{ $barX + 35 }}" y="218">{{ $item['label'] }}</text>
                            @endforeach
                        </svg>

                        <div class="graph-legend">
                            @foreach($paymentChart as $item)
                                <span><i class="{{ $item['class'] }}"></i>{{ $item['label'] }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section class="dashboard-actions-grid">
                <a class="side-card action-card" href="{{ route('pengasuh.dashboard', ['kategori' => 'calon']) }}">
                    <i class="fa-solid fa-user-clock"></i>
                    <div>
                        <h3>Data Pendaftar</h3>
                        <p>Lihat calon santri yang masih dalam proses pendaftaran.</p>
                    </div>
                </a>

                <a class="side-card action-card" href="{{ route('pengasuh.dashboard', ['kategori' => 'aktif']) }}">
                    <i class="fa-solid fa-user-check"></i>
                    <div>
                        <h3>Santri Aktif</h3>
                        <p>Pantau santri yang sudah diterima dan aktif di pondok.</p>
                    </div>
                </a>

                <a class="side-card action-card" href="{{ route('pengasuh.dashboard', ['kategori' => 'alumni']) }}">
                    <i class="fa-solid fa-user-graduate"></i>
                    <div>
                        <h3>Santri Alumni</h3>
                        <p>Lihat data alumni yang sudah tercatat di sistem.</p>
                    </div>
                </a>
            </section>
        @endif

        @if($filters['kategori'] !== 'semua')
        <section class="content-card">
            <form method="GET" action="{{ route('pengasuh.dashboard') }}" class="filter-form compact-filter">
                <input type="hidden" name="kategori" value="{{ $filters['kategori'] }}">
                <div class="filter-search-group">
                    <input type="text" name="search" value="{{ $filters['search'] }}" placeholder="Cari nama, email, wali, WA, status...">

                    <a class="btn btn-ghost" href="{{ route('pengasuh.dashboard', ['kategori' => $filters['kategori']]) }}">
                        <i class="fa-solid fa-rotate-left"></i> Reset
                    </a>
                </div>

                <select name="tahun">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ (string) $filters['tahun'] === (string) $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i> Filter
                </button>
            </form>

            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Santri</th>
                            <th>Orang Tua / Wali</th>
                            <th>Status Santri</th>
                            <th>Pembayaran</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftars as $pendaftar)
                            @php
                                $status = $statusMeta[$pendaftar->status] ?? [ucfirst($pendaftar->status ?? '-'), 'badge-gray'];
                                $payment = $paymentMeta[$pendaftar->status_pembayaran] ?? [ucfirst($pendaftar->status_pembayaran ?? '-'), 'badge-gray'];
                                $initial = strtoupper(substr($pendaftar->nama ?? 'S', 0, 1));
                            @endphp
                            <tr>
                                <td>
                                    <div class="student-cell">
                                        <div class="avatar">
                                            @if($pendaftar->foto)
                                                <img src="{{ asset('storage/' . $pendaftar->foto) }}" alt="Foto {{ $pendaftar->nama }}">
                                            @else
                                                {{ $initial }}
                                            @endif
                                        </div>
                                        <div>
                                            <div class="student-name">{{ $pendaftar->nama }}</div>
                                            <div class="meta-list">
                                                {{ $pendaftar->email }}<br>
                                                {{ $pendaftar->jenis_kelamin ?? '-' }} - {{ $pendaftar->tempat_lahir ?? '-' }}, {{ $pendaftar->tgl_lahir ?? '-' }}<br>
                                                {{ $pendaftar->asal_sekolah ?? '-' }}<br>
                                                {{ $pendaftar->alamat ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="meta-list">
                                        <strong>Ayah:</strong> {{ $pendaftar->nama_ayah ?? '-' }}<br>
                                        <strong>Ibu:</strong> {{ $pendaftar->nama_ibu ?? '-' }}<br>
                                        <strong>WA Wali:</strong> {{ $pendaftar->wa_wali ?? '-' }}<br>
                                        <strong>WA Santri:</strong> {{ $pendaftar->wa_santri ?? '-' }}
                                    </div>
                                </td>

                                <td>
                                    <span class="badge {{ $status[1] }}">{{ $status[0] }}</span>
                                    <div class="meta-list">
                                        <strong>Catatan:</strong><br>
                                        {{ $pendaftar->catatan ?? '-' }}
                                    </div>
                                </td>

                                <td>
                                    <span class="badge {{ $payment[1] }}">{{ $payment[0] }}</span>
                                    <div class="meta-list">
                                        <strong>Tanggal upload:</strong><br>
                                        {{ $pendaftar->tanggal_upload_pembayaran ?? '-' }}
                                    </div>
                                </td>

                                <td>
                                    <div class="doc-links">
                                        @if($pendaftar->foto)<a href="{{ asset('storage/' . $pendaftar->foto) }}" target="_blank">Foto Santri</a>@endif
                                        @if($pendaftar->kartu_keluarga)<a href="{{ asset('storage/' . $pendaftar->kartu_keluarga) }}" target="_blank">Kartu Keluarga</a>@endif
                                        @if($pendaftar->akta_lahir)<a href="{{ asset('storage/' . $pendaftar->akta_lahir) }}" target="_blank">Akta Lahir</a>@endif
                                        @if($pendaftar->bukti_pembayaran)<a href="{{ asset('storage/' . $pendaftar->bukti_pembayaran) }}" target="_blank">Bukti Pembayaran</a>@endif
                                        @if(!$pendaftar->foto && !$pendaftar->kartu_keluarga && !$pendaftar->akta_lahir && !$pendaftar->bukti_pembayaran)
                                            <span class="meta-list">Belum ada dokumen</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">Belum ada data untuk filter ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        @endif
    </main>
</div>
</body>
</html>
