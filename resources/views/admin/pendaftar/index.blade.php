<!DOCTYPE html>
{{-- Daftar pendaftar dengan filter serta tindakan verifikasi admin. --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page['title'] }}</title>

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

    $formatWaNumber = function ($value) {
        $number = preg_replace('/[^0-9]/', '', (string) $value);

        if (!$number) {
            return '';
        }

        if (substr($number, 0, 1) === '0') {
            return '62' . substr($number, 1);
        }

        return $number;
    };

    $accountWaSantri = $formatWaNumber(session('wa_santri'));
    $accountWaWali = $formatWaNumber(session('wa_wali'));
    $accountWaMessage = '';

    if (session('email_santri') && session('password_santri')) {
        $accountWaMessage = rawurlencode(implode("\n", [
            "Assalamu'alaikum.",
            '',
            'Alhamdulillah, ananda ' . session('nama_santri') . ' sudah diterima menjadi santri aktif Pondok Pesantren Tahfidzul Quran Darul Furqon.',
            '',
            'Berikut akun login santri:',
            'Nama: ' . session('nama_santri'),
            'Nomor Induk Santri: ' . session('nomor_induk_santri'),
            'Gmail: ' . session('email_santri'),
            'Password: ' . session('password_santri'),
            '',
            'Silakan login melalui halaman website pondok.',
        ]));
    }
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
                <a class="sidebar-link {{ $page['menu'] === $item['key'] ? 'active' : '' }}" href="{{ $item['route'] }}">
                    <i class="fa-solid {{ $item['icon'] }}"></i>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

    </aside>

    <main class="dashboard-main">
        <div class="dashboard-topbar">
            <div>
                <span class="eyebrow">Manajemen Admin</span>
                <h1 class="dashboard-title">{{ $page['title'] }}</h1>
                <p class="dashboard-subtitle">{{ $page['subtitle'] }}</p>
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
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('email_santri') && session('password_santri'))
            <dialog class="action-dialog account-dialog" id="accountSuccessDialog" aria-labelledby="account-success-title">
                <div class="action-dialog-panel">
                    <div class="action-dialog-header">
                        <div>
                            <span class="eyebrow">Akun Santri Aktif</span>
                            <h3 id="account-success-title">Akun login santri berhasil dibuat</h3>
                            <div class="action-dialog-badges">
                                <span class="badge badge-active">Santri Aktif</span>
                                <span class="badge badge-blue">Pembayaran Terverifikasi</span>
                            </div>
                        </div>
                        <button type="button" class="dialog-close" data-close-account aria-label="Tutup popup akun">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="action-dialog-body">
                        <div class="account-login-box">
                            <div class="account-row">
                                <span>Nama Santri</span>
                                <strong>{{ session('nama_santri') }}</strong>
                            </div>
                            <div class="account-row">
                                <span>Nomor Induk Santri</span>
                                <strong>{{ session('nomor_induk_santri') }}</strong>
                            </div>
                            <div class="account-row">
                                <span>Gmail Login</span>
                                <strong>{{ session('email_santri') }}</strong>
                            </div>
                            <div class="account-row">
                                <span>Password Awal</span>
                                <strong>{{ session('password_santri') }}</strong>
                            </div>
                        </div>

                        <p class="account-note">
                            Password awal dibuat otomatis dari nomor induk santri. Tombol WhatsApp hanya membuka pesan siap kirim, pengiriman terakhir tetap dilakukan admin di WhatsApp.
                        </p>

                        <div class="account-actions">
                            @if($accountWaSantri)
                                <a class="btn btn-primary" href="https://wa.me/{{ $accountWaSantri }}?text={{ $accountWaMessage }}" target="_blank">
                                    <i class="fa-brands fa-whatsapp"></i> Kirim WhatsApp ke Santri
                                </a>
                            @endif

                            @if($accountWaWali && $accountWaWali !== $accountWaSantri)
                                <a class="btn btn-ghost" href="https://wa.me/{{ $accountWaWali }}?text={{ $accountWaMessage }}" target="_blank">
                                    <i class="fa-brands fa-whatsapp"></i> Kirim WhatsApp ke Wali
                                </a>
                            @endif

                            <button type="button" class="btn btn-secondary" data-close-account>Tutup</button>
                        </div>
                    </div>
                </div>
            </dialog>
        @endif

        <section class="content-card">
            <form method="GET" action="{{ url()->current() }}" class="filter-form compact-filter">
                <div class="filter-search-group">
                    <input type="text" name="search" value="{{ $filters['search'] }}" placeholder="Cari nama, email, wali, WA, status...">

                    <a class="btn btn-ghost" href="{{ url()->current() }}">
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
                            <th>Status</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftars as $pendaftar)
                            @php
                                $status = $statusMeta[$pendaftar->status] ?? [ucfirst($pendaftar->status ?? '-'), 'badge-gray'];
                                $payment = $paymentMeta[$pendaftar->status_pembayaran] ?? [ucfirst($pendaftar->status_pembayaran ?? '-'), 'badge-gray'];
                                $initial = strtoupper(substr($pendaftar->nama ?? 'S', 0, 1));
                                $isCandidate = in_array($pendaftar->status, ['menunggu', 'perlu_perbaikan'], true);
                                $nomorWaSantri = $formatWaNumber($pendaftar->wa_santri);
                                $nomorWaWali = $formatWaNumber($pendaftar->wa_wali);
                                $akunSantri = $pendaftar->user;
                                $pesanWa = rawurlencode(implode("\n", [
                                    "Assalamu'alaikum.",
                                    '',
                                    'Alhamdulillah, ananda ' . ($pendaftar->nama ?? '-') . ' sudah diterima menjadi santri aktif Pondok Pesantren Tahfidzul Quran Darul Furqon.',
                                    '',
                                    'Berikut akun login santri:',
                                    'Nama: ' . ($pendaftar->nama ?? '-'),
                                    'Nomor Induk Santri: ' . ($pendaftar->nomor_induk_santri ?? '-'),
                                    'Gmail: ' . ($akunSantri?->email ?? $pendaftar->email ?? '-'),
                                    'Password: ' . ($pendaftar->password_awal ?? $pendaftar->nomor_induk_santri ?? '-'),
                                    '',
                                    'Silakan login melalui halaman website pondok.',
                                ]));
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
                                                <strong>Nomor Induk Santri:</strong> {{ $pendaftar->nomor_induk_santri ?? '-' }}<br>
                                                <strong>Tanggal Daftar:</strong> {{ optional($pendaftar->created_at)->format('d/m/Y') ?? '-' }}<br>
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
                                    <div style="height:8px;"></div>
                                    <span class="badge {{ $payment[1] }}">{{ $payment[0] }}</span>
                                    <div class="meta-list">
                                        <strong>Catatan:</strong><br>
                                        {{ $pendaftar->catatan ?? '-' }}
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

                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-primary action-modal-trigger"
                                        data-open-action="action-dialog-{{ $pendaftar->id }}"
                                    >
                                        <i class="fa-solid fa-ellipsis"></i> Aksi
                                    </button>

                                    <dialog class="action-dialog" id="action-dialog-{{ $pendaftar->id }}" aria-labelledby="action-title-{{ $pendaftar->id }}">
                                        <div class="action-dialog-panel">
                                            <div class="action-dialog-header">
                                                <div>
                                                    <span class="eyebrow">Aksi Santri</span>
                                                    <h3 id="action-title-{{ $pendaftar->id }}">{{ $pendaftar->nama }}</h3>
                                                    <div class="action-dialog-badges">
                                                        <span class="badge {{ $status[1] }}">{{ $status[0] }}</span>
                                                        <span class="badge {{ $payment[1] }}">{{ $payment[0] }}</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="dialog-close" data-close-action aria-label="Tutup modal">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>

                                            <div class="action-dialog-body">
                                                <div class="action-shortcuts">
                                                    <a class="btn btn-ghost" href="{{ route('admin.pendaftar.show', $pendaftar) }}">
                                                        <i class="fa-solid fa-eye"></i> Detail
                                                    </a>

                                                    <a class="btn btn-blue" href="{{ route('admin.pendaftar.edit', $pendaftar) }}">
                                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                                    </a>

                                                    @if($page['category'] === 'pendaftar' && $akunSantri && $nomorWaSantri)
                                                        <a class="btn btn-ghost" href="https://wa.me/{{ $nomorWaSantri }}?text={{ $pesanWa }}" target="_blank">
                                                            <i class="fa-brands fa-whatsapp"></i> Kirim Akun ke Santri
                                                        </a>
                                                    @endif

                                                    @if($page['category'] === 'pendaftar' && $akunSantri && $nomorWaWali && $nomorWaWali !== $nomorWaSantri)
                                                        <a class="btn btn-ghost" href="https://wa.me/{{ $nomorWaWali }}?text={{ $pesanWa }}" target="_blank">
                                                            <i class="fa-brands fa-whatsapp"></i> Kirim Akun ke Wali
                                                        </a>
                                                    @endif
                                                </div>

                                                @if($isCandidate)
                                                    <div class="action-form-grid">
                                                        <div class="action-form-panel action-verification-panel">
                                                            <form class="mini-form" action="{{ route('admin.pendaftar.updateVerification', $pendaftar) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <label class="action-panel-title">Verifikasi Data dan Pembayaran</label>
                                                                <textarea name="catatan" placeholder="Catatan verifikasi">{{ $pendaftar->catatan }}</textarea>
                                                                <p class="account-note">Saat diterima, sistem otomatis membuat nomor induk dan akun login santri aktif.</p>
                                                                <div class="verification-actions">
                                                                    <button class="btn btn-primary" type="submit" name="status_verifikasi" value="diterima">Terima & Buat Akun Santri</button>
                                                                    <button class="btn btn-secondary" type="submit" name="status_verifikasi" value="perlu_perbaikan">Perlu Perbaikan</button>
                                                                    <button class="btn btn-danger" type="submit" name="status_verifikasi" value="ditolak">Ditolak</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @elseif($page['category'] === 'aktif')
                                                    <form class="mini-form action-form-panel" action="{{ route('admin.pendaftar.updateStatus', $pendaftar) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="alumni">
                                                        <label>Ubah Menjadi Alumni</label>
                                                        <textarea name="catatan" placeholder="Catatan alumni">{{ $pendaftar->catatan }}</textarea>
                                                        <button class="btn btn-primary" type="submit">Pindahkan ke Alumni</button>
                                                    </form>
                                                @elseif($page['category'] === 'pendaftar')
                                                    <div class="action-form-panel meta-list">
                                                        Data ini sudah diproses. Jika santri sudah aktif, gunakan tombol WhatsApp di atas untuk mengirim ulang akun login.
                                                    </div>
                                                @else
                                                    <div class="action-form-panel meta-list">Alumni tidak tampil lagi di menu Santri Aktif.</div>
                                                @endif
                                            </div>
                                        </div>
                                    </dialog>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">{{ $page['empty'] }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
<script>
    document.querySelectorAll('[data-open-action]').forEach((button) => {
        button.addEventListener('click', () => {
            const dialog = document.getElementById(button.dataset.openAction);

            if (!dialog) {
                return;
            }

            if (typeof dialog.showModal === 'function') {
                dialog.showModal();
                return;
            }

            dialog.setAttribute('open', 'open');
        });
    });

    document.querySelectorAll('.action-dialog').forEach((dialog) => {
        const closeDialog = () => {
            if (typeof dialog.close === 'function') {
                dialog.close();
                return;
            }

            dialog.removeAttribute('open');
        };

        dialog.querySelectorAll('[data-close-action]').forEach((button) => {
            button.addEventListener('click', closeDialog);
        });

        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) {
                closeDialog();
            }
        });
    });

    const accountDialog = document.getElementById('accountSuccessDialog');

    if (accountDialog) {
        const closeAccountDialog = () => {
            if (typeof accountDialog.close === 'function') {
                accountDialog.close();
                return;
            }

            accountDialog.removeAttribute('open');
        };

        if (typeof accountDialog.showModal === 'function') {
            accountDialog.showModal();
        } else {
            accountDialog.setAttribute('open', 'open');
        }

        accountDialog.querySelectorAll('[data-close-account]').forEach((button) => {
            button.addEventListener('click', closeAccountDialog);
        });

        accountDialog.addEventListener('click', (event) => {
            if (event.target === accountDialog) {
                closeAccountDialog();
            }
        });
    }
</script>
</body>
</html>
