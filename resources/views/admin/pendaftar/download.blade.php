<!DOCTYPE html>
{{-- Halaman pemilihan filter dan format unduhan data santri. --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Data Santri</title>

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

    $typeLabels = [
        'semua' => 'Semua Data',
        'calon' => 'Calon Santri',
        'aktif' => 'Santri Aktif',
        'alumni' => 'Alumni',
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
                <a class="sidebar-link {{ $item['key'] === 'download' ? 'active' : '' }}" href="{{ $item['route'] }}">
                    <i class="fa-solid {{ $item['icon'] }}"></i>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

    </aside>

    <main class="dashboard-main">
        <div class="dashboard-topbar">
            <div>
                <span class="eyebrow">Export Data</span>
                <h1 class="dashboard-title">Download Data Santri</h1>
                <p class="dashboard-subtitle">Pilih jenis data, tahun, dan data tertentu untuk Excel (.xlsx), atau download satu data lengkap dalam PDF.</p>
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

        <section class="content-card">
            <form method="GET" action="{{ route('admin.download.index') }}" class="filter-form download-filter">
                <select name="jenis_data">
                    @foreach($typeLabels as $value => $label)
                        <option value="{{ $value }}" {{ $filters['jenis_data'] === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>

                <select name="tahun">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ (string) $filters['tahun'] === (string) $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>

                <input type="text" name="search" value="{{ $filters['search'] }}" placeholder="Cari nama, email, nomor induk, wali, status...">

                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-filter"></i> Terapkan
                </button>
            </form>
        </section>

        <section class="content-card" style="margin-top:20px;">
            <div class="card-header">
                <div>
                    <h2>Data Siap Download</h2>
                    <p>{{ $pendaftars->count() }} data ditemukan untuk filter {{ $typeLabels[$filters['jenis_data']] ?? 'Semua Data' }}.</p>
                </div>
            </div>

            <form action="{{ route('admin.download.export') }}" method="POST">
                @csrf
                <input type="hidden" name="jenis_data" value="{{ $filters['jenis_data'] }}">
                <input type="hidden" name="tahun" value="{{ $filters['tahun'] }}">
                <input type="hidden" name="search" value="{{ $filters['search'] }}">

                <div class="download-actions">
                    <label class="check-all">
                        <input type="checkbox" id="checkAllDownload">
                        Pilih semua data di tabel
                    </label>

                    <div class="download-action-buttons">
                        <button type="button" class="btn btn-primary" id="downloadSinglePdfButton" data-pdf-url-template="{{ route('admin.download.pdf', ['pendaftar' => '__ID__']) }}">
                            <i class="fa-solid fa-file-pdf"></i> Download PDF
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-download"></i> Download Excel (.xlsx)
                        </button>
                    </div>
                </div>

                <div class="table-wrap">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Pilih</th>
                                <th>Santri</th>
                                <th>Status</th>
                                <th>Orang Tua / Wali</th>
                                <th>Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendaftars as $pendaftar)
                                @php
                                    $status = $statusMeta[$pendaftar->status] ?? [ucfirst($pendaftar->status ?? '-'), 'badge-gray'];
                                    $payment = $paymentMeta[$pendaftar->status_pembayaran] ?? [ucfirst($pendaftar->status_pembayaran ?? '-'), 'badge-gray'];
                                    $nomorInduk = $pendaftar->nomor_induk_santri ?: $pendaftar->password_awal ?: '-';
                                @endphp
                                <tr>
                                    <td>
                                        <input class="download-checkbox" type="checkbox" name="pendaftar_ids[]" value="{{ $pendaftar->id }}">
                                    </td>
                                    <td>
                                        <div class="student-name">{{ $pendaftar->nama }}</div>
                                        <div class="meta-list">
                                            {{ $pendaftar->email }}<br>
                                            <strong>Nomor Induk Santri:</strong> {{ $nomorInduk }}<br>
                                            {{ $pendaftar->asal_sekolah ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $status[1] }}">{{ $status[0] }}</span>
                                        <div style="height:8px;"></div>
                                        <span class="badge {{ $payment[1] }}">{{ $payment[0] }}</span>
                                    </td>
                                    <td>
                                        <div class="meta-list">
                                            <strong>Ayah:</strong> {{ $pendaftar->nama_ayah ?? '-' }}<br>
                                            <strong>Ibu:</strong> {{ $pendaftar->nama_ibu ?? '-' }}<br>
                                            <strong>WA Wali:</strong> {{ $pendaftar->wa_wali ?? '-' }}<br>
                                            <strong>WA Santri:</strong> {{ $pendaftar->wa_santri ?? '-' }}
                                        </div>
                                    </td>
                                    <td>{{ optional($pendaftar->created_at)->format('d/m/Y') ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-state">Tidak ada data sesuai filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </section>
    </main>
</div>

<div class="download-notice-overlay" id="downloadNotice" aria-hidden="true">
    <div class="download-notice-dialog" role="dialog" aria-modal="true" aria-labelledby="downloadNoticeTitle">
        <button type="button" class="download-notice-close" id="closeDownloadNotice" aria-label="Tutup notifikasi">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="download-notice-icon">
            <i class="fa-solid fa-file-pdf"></i>
        </div>

        <div>
            <span class="eyebrow">Download PDF</span>
            <h2 id="downloadNoticeTitle">Pilih Data Terlebih Dahulu</h2>
            <p id="downloadNoticeMessage">Pilih satu data terlebih dahulu untuk download PDF.</p>
        </div>

        <button type="button" class="btn btn-primary" id="confirmDownloadNotice">
            Mengerti
        </button>
    </div>
</div>

<script>
    const checkAll = document.getElementById('checkAllDownload');
    if (checkAll) {
        checkAll.addEventListener('change', function () {
            document.querySelectorAll('.download-checkbox').forEach(function (checkbox) {
                checkbox.checked = checkAll.checked;
            });
        });
    }

    const downloadNotice = document.getElementById('downloadNotice');
    const downloadNoticeTitle = document.getElementById('downloadNoticeTitle');
    const downloadNoticeMessage = document.getElementById('downloadNoticeMessage');
    const closeDownloadNoticeButton = document.getElementById('closeDownloadNotice');
    const confirmDownloadNoticeButton = document.getElementById('confirmDownloadNotice');

    function showDownloadNotice(title, message) {
        downloadNoticeTitle.textContent = title;
        downloadNoticeMessage.textContent = message;
        downloadNotice.classList.add('show');
        downloadNotice.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        confirmDownloadNoticeButton.focus();
    }

    function closeDownloadNotice() {
        downloadNotice.classList.remove('show');
        downloadNotice.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        downloadSinglePdfButton?.focus();
    }

    window.alert = function (message) {
        showDownloadNotice('Download PDF', String(message || 'Terjadi kesalahan saat memproses download PDF.'));
    };

    if (closeDownloadNoticeButton) {
        closeDownloadNoticeButton.addEventListener('click', closeDownloadNotice);
    }

    if (confirmDownloadNoticeButton) {
        confirmDownloadNoticeButton.addEventListener('click', closeDownloadNotice);
    }

    if (downloadNotice) {
        downloadNotice.addEventListener('click', function (event) {
            if (event.target === downloadNotice) {
                closeDownloadNotice();
            }
        });
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && downloadNotice?.classList.contains('show')) {
            closeDownloadNotice();
        }
    });

    const downloadSinglePdfButton = document.getElementById('downloadSinglePdfButton');
    if (downloadSinglePdfButton) {
        downloadSinglePdfButton.addEventListener('click', function () {
            const checkedItems = Array.from(document.querySelectorAll('.download-checkbox:checked'));

            if (checkedItems.length === 0) {
                showDownloadNotice('Pilih Data Terlebih Dahulu', 'Centang satu data santri pada tabel sebelum menekan tombol Download PDF.');
                return;
            }

            if (checkedItems.length > 1) {
                showDownloadNotice('Cukup Satu Data', 'Download PDF hanya bisa untuk satu data. Hapus centang lain, lalu sisakan satu data yang ingin didownload.');
                return;
            }

            window.location.href = downloadSinglePdfButton.dataset.pdfUrlTemplate.replace('__ID__', checkedItems[0].value);
        });
    }
</script>
</body>
</html>
