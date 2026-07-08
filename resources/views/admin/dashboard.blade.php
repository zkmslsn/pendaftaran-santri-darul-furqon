<!DOCTYPE html>
{{-- Dashboard admin untuk statistik penerimaan dan akses cepat pengelolaan santri. --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <noscript>
        <style>
            .dash-animate {
                opacity: 1;
                transform: none;
            }
        </style>
    </noscript>
</head>
<body class="dash-body dashboard-motion-page">
@php
    $menuItems = [
        ['label' => 'Dashboard', 'route' => route('admin.dashboard'), 'icon' => 'fa-chart-pie', 'active' => true],
        ['label' => 'Data Pendaftar', 'route' => route('admin.pendaftar.index'), 'icon' => 'fa-user-clock', 'active' => false],
        ['label' => 'Santri Aktif', 'route' => route('admin.santri.aktif'), 'icon' => 'fa-user-check', 'active' => false],
        ['label' => 'Alumni', 'route' => route('admin.santri.alumni'), 'icon' => 'fa-user-graduate', 'active' => false],
        ['label' => 'Download Data', 'route' => route('admin.download.index'), 'icon' => 'fa-file-export', 'active' => false],
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
@endphp

<div class="dashboard-shell">
    <aside class="dashboard-sidebar">
        <div class="brand-block">
            <img src="{{ asset('assets/img/logo-pondok.jpeg') }}" alt="Logo Pondok">
            <div>
                <strong>Darul Furqon</strong>
                <span>Admin Panel</span>
            </div>
        </div>

        <div class="sidebar-label">Menu Admin</div>
        <nav class="sidebar-nav">
            @foreach($menuItems as $item)
                <a class="sidebar-link {{ $item['active'] ? 'active' : '' }}" href="{{ $item['route'] }}">
                    <i class="fa-solid {{ $item['icon'] }}"></i>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

    </aside>

    <main class="dashboard-main">
        <div class="dashboard-topbar dash-animate">
            <div>
                <span class="eyebrow">Dashboard Admin</span>
                <h1 class="dashboard-title">Ringkasan Pendaftaran</h1>
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

        <section class="stats-grid">
            <div class="stat-card highlight dash-animate" style="--dash-delay: 0ms;">
                <div class="stat-top">
                    <span>Jumlah Pendaftar</span>
                    <span class="stat-icon"><i class="fa-solid fa-database"></i></span>
                </div>
                <div class="stat-label">Semua data pendaftaran</div>
                <div class="stat-number">{{ $stats['total'] }}</div>
            </div>

            <div class="stat-card dash-animate" style="--dash-delay: 90ms;">
                <div class="stat-top">
                    <span>Calon Santri</span>
                    <span class="stat-icon"><i class="fa-solid fa-user-clock"></i></span>
                </div>
                <div class="stat-label">Masih proses</div>
                <div class="stat-number">{{ $stats['calon'] }}</div>
            </div>

            <div class="stat-card dash-animate" style="--dash-delay: 180ms;">
                <div class="stat-top">
                    <span>Santri Aktif</span>
                    <span class="stat-icon"><i class="fa-solid fa-user-check"></i></span>
                </div>
                <div class="stat-label">Diterima dan aktif</div>
                <div class="stat-number">{{ $stats['aktif'] }}</div>
            </div>

            <div class="stat-card dash-animate" style="--dash-delay: 270ms;">
                <div class="stat-top">
                    <span>Alumni</span>
                    <span class="stat-icon"><i class="fa-solid fa-user-graduate"></i></span>
                </div>
                <div class="stat-label">Sudah alumni</div>
                <div class="stat-number">{{ $stats['alumni'] }}</div>
            </div>
        </section>

        <section class="chart-grid">
            <div class="chart-card dash-animate" style="--dash-delay: 80ms;">
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

            <div class="chart-card dash-animate" style="--dash-delay: 180ms;">
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
            <a class="side-card action-card dash-animate" href="{{ route('admin.pendaftar.index') }}" style="--dash-delay: 0ms;">
                <i class="fa-solid fa-user-clock"></i>
                <div>
                    <h3>Data Pendaftar</h3>
                    <p>Verifikasi calon santri, pembayaran, akun, dan WhatsApp.</p>
                </div>
            </a>

            <a class="side-card action-card dash-animate" href="{{ route('admin.santri.aktif') }}" style="--dash-delay: 90ms;">
                <i class="fa-solid fa-user-check"></i>
                <div>
                    <h3>Santri Aktif</h3>
                    <p>Kelola santri aktif dan ubah status menjadi alumni.</p>
                </div>
            </a>

            <a class="side-card action-card dash-animate" href="{{ route('admin.santri.alumni') }}" style="--dash-delay: 180ms;">
                <i class="fa-solid fa-user-graduate"></i>
                <div>
                    <h3>Alumni</h3>
                    <p>Lihat data alumni dan edit bila diperlukan.</p>
                </div>
            </a>
        </section>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var animatedItems = document.querySelectorAll('.dash-animate');
        var clickableItems = document.querySelectorAll('.stat-card, .chart-card, .action-card, .sidebar-link, .btn');

        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.16,
                rootMargin: '0px 0px -40px 0px'
            });

            animatedItems.forEach(function (item) {
                observer.observe(item);
            });
        } else {
            animatedItems.forEach(function (item) {
                item.classList.add('is-visible');
            });
        }

        clickableItems.forEach(function (item) {
            item.addEventListener('click', function () {
                item.classList.remove('dash-tap');
                void item.offsetWidth;
                item.classList.add('dash-tap');
            });
        });
    });
</script>
</body>
</html>
