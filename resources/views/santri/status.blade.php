<!DOCTYPE html>
{{-- Dashboard santri untuk melihat identitas, status, pembayaran, dan catatan admin. --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Santri</title>

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .santri-layout {
            display: grid;
            grid-template-columns: minmax(300px, 360px) minmax(0, 1fr);
            gap: 22px;
            align-items: start;
        }

        .dashboard-shell.santri-single-shell {
            grid-template-columns: minmax(0, 1fr);
        }

        .santri-single-shell .dashboard-main {
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
        }

        .santri-id-card {
            position: sticky;
            top: 28px;
            overflow: hidden;
            border-radius: 28px;
            color: #ffffff;
            background:
                radial-gradient(circle at top right, rgba(163, 230, 53, 0.22), transparent 30%),
                radial-gradient(circle at bottom left, rgba(255, 255, 255, 0.08), transparent 28%),
                linear-gradient(145deg, #064e3b 0%, #0f766e 58%, #15803d 100%);
            box-shadow: var(--dash-shadow);
        }

        .santri-id-card::before,
        .santri-id-card::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            pointer-events: none;
        }

        .santri-id-card::before {
            width: 210px;
            height: 210px;
            right: -92px;
            top: -84px;
        }

        .santri-id-card::after {
            width: 230px;
            height: 230px;
            left: -120px;
            bottom: -118px;
        }

        .santri-id-inner {
            position: relative;
            z-index: 2;
            padding: 28px;
        }

        .santri-photo-ring {
            width: 184px;
            height: 184px;
            margin: 0 auto 20px;
            padding: 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.88);
            box-shadow: 0 22px 42px rgba(2, 44, 34, 0.24);
        }

        .santri-photo {
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: inherit;
            background: linear-gradient(135deg, #dcfce7, #ffffff);
            color: #064e3b;
            display: grid;
            place-items: center;
            font-size: 64px;
            font-weight: 950;
        }

        .santri-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .id-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.26);
            color: #ffffff;
            font-size: 12px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .id-kicker i {
            color: #d9f99d;
        }

        .santri-id-card h2 {
            margin: 14px 0 6px;
            color: #ffffff;
            font-size: 29px;
            line-height: 1.18;
            font-weight: 950;
        }

        .santri-id-subtitle {
            margin: 0;
            color: rgba(255, 255, 255, 0.78);
            line-height: 1.6;
            font-weight: 750;
        }

        .id-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 18px;
            min-height: 38px;
            padding: 0 14px;
            border-radius: 999px;
            background: #ffffff;
            color: #064e3b;
            font-size: 13px;
            font-weight: 950;
        }

        .id-panel {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.20);
        }

        .id-panel-title {
            margin: 0 0 12px;
            color: rgba(255, 255, 255, 0.86);
            font-size: 12px;
            font-weight: 950;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .id-list {
            display: grid;
            gap: 12px;
        }

        .id-row {
            display: grid;
            grid-template-columns: 34px minmax(0, 1fr);
            gap: 10px;
            align-items: start;
        }

        .id-row i {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.13);
            color: #d9f99d;
        }

        .id-row span {
            display: block;
            color: rgba(255, 255, 255, 0.66);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .id-row strong {
            display: block;
            margin-top: 2px;
            color: #ffffff;
            line-height: 1.45;
            overflow-wrap: anywhere;
        }

        .santri-profile-stack {
            display: grid;
            gap: 18px;
        }

        .profile-section-card {
            background: #ffffff;
            border: 1px solid var(--dash-border);
            border-radius: 24px;
            box-shadow: var(--dash-shadow-soft);
            overflow: hidden;
        }

        .profile-section-head {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 20px 22px;
            border-bottom: 1px solid var(--dash-border);
            background:
                radial-gradient(circle at top right, rgba(163, 230, 53, 0.14), transparent 26%),
                linear-gradient(135deg, #ffffff 0%, #f7faf8 100%);
        }

        .profile-section-icon {
            width: 44px;
            height: 44px;
            border-radius: 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            background: #ecfdf5;
            color: #064e3b;
            font-size: 18px;
        }

        .profile-section-head h2 {
            margin: 0 0 5px;
            color: #064e3b;
            font-size: 22px;
            line-height: 1.25;
        }

        .profile-section-head p {
            margin: 0;
            color: var(--dash-muted);
            line-height: 1.65;
            font-size: 14px;
        }

        .profile-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            padding: 18px;
        }

        .profile-detail-grid.single {
            grid-template-columns: 1fr;
        }

        .profile-field {
            min-height: 78px;
            padding: 14px 15px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px solid #edf2f0;
        }

        .profile-field.full {
            grid-column: 1 / -1;
        }

        .profile-field span {
            display: block;
            margin-bottom: 6px;
            color: var(--dash-muted);
            font-size: 12px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .profile-field strong {
            display: block;
            color: #111827;
            line-height: 1.55;
            overflow-wrap: anywhere;
        }

        .payment-action-box {
            display: grid;
            gap: 14px;
            padding: 18px;
        }

        .payment-action-box form {
            display: grid;
            gap: 12px;
            padding: 16px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px dashed #94a3b8;
        }

        .payment-action-box input[type="file"] {
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            background: #ffffff;
        }

        @media (max-width: 1180px) {
            .santri-layout {
                grid-template-columns: 1fr;
            }

            .santri-id-card {
                position: relative;
                top: auto;
            }

        }

        @media (max-width: 760px) {
            .profile-detail-grid {
                grid-template-columns: 1fr;
            }

            .profile-field.full {
                grid-column: auto;
            }

            .santri-id-inner {
                padding: 22px;
            }

            .santri-photo-ring {
                width: 154px;
                height: 154px;
            }
        }
    </style>
</head>
<body class="dash-body">
@php
    $statusMeta = [
        'menunggu' => ['Calon Santri', 'badge-waiting', 'Data pendaftaran sedang menunggu verifikasi admin.'],
        'perlu_perbaikan' => ['Calon Santri', 'badge-waiting', 'Data pendaftaran perlu diperbaiki sesuai catatan admin.'],
        'diterima' => ['Santri Aktif', 'badge-active', 'Santri terdaftar sebagai santri aktif Darul Furqon.'],
        'aktif' => ['Santri Aktif', 'badge-active', 'Santri terdaftar sebagai santri aktif Darul Furqon.'],
        'alumni' => ['Alumni', 'badge-alumni', 'Status santri sudah masuk data alumni.'],
        'ditolak' => ['Ditolak', 'badge-rejected', 'Pendaftaran belum dapat diterima. Silakan cek catatan admin.'],
    ];

    $status = $statusMeta[$pendaftar->status] ?? [ucfirst($pendaftar->status ?? '-'), 'badge-gray', 'Status belum tersedia.'];
    $initial = strtoupper(substr($pendaftar->nama ?? 'S', 0, 1));
    $isAlumni = $pendaftar->status === 'alumni';
    $isActive = in_array($pendaftar->status, ['diterima', 'aktif'], true);
    $cardType = $isAlumni ? 'ID Card Alumni' : 'Santri Darul Furqon';
    $cardStatus = $isAlumni ? 'Alumni' : ($isActive ? 'Santri Aktif' : $status[0]);
    $nomorInduk = $pendaftar->nomor_induk_santri ?: '-';
    $tanggalMasuk = optional($pendaftar->created_at)->format('d/m/Y') ?? '-';
    $tanggalLulus = $isAlumni ? (optional($pendaftar->updated_at)->format('d/m/Y') ?? '-') : '-';
    $tanggalLahir = $pendaftar->tgl_lahir ? \Illuminate\Support\Carbon::parse($pendaftar->tgl_lahir)->format('d/m/Y') : '-';
@endphp

<div class="dashboard-shell santri-single-shell">
    <main class="dashboard-main">
        <div class="dashboard-topbar">
            <div>
                <span class="eyebrow">{{ $cardType }}</span>
                <h1 class="dashboard-title">Assalamu'alaikum, {{ $pendaftar->nama }}</h1>
                <p class="dashboard-subtitle">
                    {{ $isAlumni ? 'Lihat ringkasan identitas alumni dan riwayat selama terdaftar di pondok.' : 'Lihat kartu identitas santri, data pribadi, data wali, dan program hafalan.' }}
                </p>
            </div>

            <div class="topbar-actions">
                <div class="topbar-user">
                    <span>Login sebagai</span>
                    <strong>{{ auth()->user()->email }}</strong>
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

        @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <div class="santri-layout">
            <section class="santri-id-card">
                <div class="santri-id-inner">
                    <div class="santri-photo-ring">
                        <div class="santri-photo">
                            @if($pendaftar->foto)
                                <img src="{{ asset('storage/' . $pendaftar->foto) }}" alt="Foto {{ $pendaftar->nama }}">
                            @else
                                {{ $initial }}
                            @endif
                        </div>
                    </div>

                    <span class="id-kicker">
                        <i class="fa-solid {{ $isAlumni ? 'fa-user-graduate' : 'fa-user-check' }}"></i>
                        {{ $cardType }}
                    </span>
                    <h2>{{ $pendaftar->nama }}</h2>
                    <p class="santri-id-subtitle">{{ $pendaftar->asal_sekolah ?? 'Pondok Pesantren Tahfidzul Quran Darul Furqon' }}</p>
                    <span class="id-status-pill">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ $cardStatus }}
                    </span>

                    <div class="id-panel">
                        <h3 class="id-panel-title">Identitas</h3>
                        <div class="id-list">
                            <div class="id-row">
                                <i class="fa-solid fa-hashtag"></i>
                                <div>
                                    <span>Nomor Induk Santri</span>
                                    <strong>{{ $nomorInduk }}</strong>
                                </div>
                            </div>
                            <div class="id-row">
                                <i class="fa-solid fa-calendar-check"></i>
                                <div>
                                    <span>Tanggal Masuk</span>
                                    <strong>{{ $tanggalMasuk }}</strong>
                                </div>
                            </div>
                            @if($isAlumni)
                                <div class="id-row">
                                    <i class="fa-solid fa-calendar-day"></i>
                                    <div>
                                        <span>Tanggal Boyong / Lulus</span>
                                        <strong>{{ $tanggalLulus }}</strong>
                                    </div>
                                </div>
                            @endif
                            <div class="id-row">
                                <i class="fa-solid fa-envelope"></i>
                                <div>
                                    <span>Email</span>
                                    <strong>{{ $pendaftar->email ?? '-' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="id-panel">
                        <h3 class="id-panel-title">Kontak</h3>
                        <div class="id-list">
                            <div class="id-row">
                                <i class="fa-solid fa-phone"></i>
                                <div>
                                    <span>WA Wali</span>
                                    <strong>{{ $pendaftar->wa_wali ?? '-' }}</strong>
                                </div>
                            </div>
                            <div class="id-row">
                                <i class="fa-brands fa-whatsapp"></i>
                                <div>
                                    <span>WA Santri</span>
                                    <strong>{{ $pendaftar->wa_santri ?? '-' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div>
                <div class="santri-profile-stack">
                    <section class="profile-section-card" id="data-pribadi">
                        <div class="profile-section-head">
                            <div class="profile-section-icon"><i class="fa-solid fa-address-card"></i></div>
                            <div>
                                <h2>Data Pribadi</h2>
                                <p>Identitas santri berdasarkan formulir pendaftaran.</p>
                            </div>
                        </div>
                        <div class="profile-detail-grid">
                            <div class="profile-field">
                                <span>Nama Lengkap</span>
                                <strong>{{ $pendaftar->nama }}</strong>
                            </div>
                            <div class="profile-field">
                                <span>Jenis Kelamin</span>
                                <strong>{{ $pendaftar->jenis_kelamin ?? '-' }}</strong>
                            </div>
                            <div class="profile-field">
                                <span>Tempat / Tanggal Lahir</span>
                                <strong>{{ $pendaftar->tempat_lahir ?? '-' }}, {{ $tanggalLahir }}</strong>
                            </div>
                            <div class="profile-field">
                                <span>Asal Sekolah</span>
                                <strong>{{ $pendaftar->asal_sekolah ?? '-' }}</strong>
                            </div>
                            <div class="profile-field full">
                                <span>Alamat</span>
                                <strong>{{ $pendaftar->alamat ?? '-' }}</strong>
                            </div>
                        </div>
                    </section>

                    <section class="profile-section-card" id="data-wali">
                        <div class="profile-section-head">
                            <div class="profile-section-icon"><i class="fa-solid fa-people-roof"></i></div>
                            <div>
                                <h2>Data Orang Tua / Wali</h2>
                                <p>Data wali yang dapat dihubungi oleh pihak pondok.</p>
                            </div>
                        </div>
                        <div class="profile-detail-grid">
                            <div class="profile-field">
                                <span>Nama Ayah</span>
                                <strong>{{ $pendaftar->nama_ayah ?? '-' }}</strong>
                            </div>
                            <div class="profile-field">
                                <span>Pekerjaan Ayah</span>
                                <strong>{{ $pendaftar->pekerjaan_ayah ?? '-' }}</strong>
                            </div>
                            <div class="profile-field">
                                <span>Nama Ibu</span>
                                <strong>{{ $pendaftar->nama_ibu ?? '-' }}</strong>
                            </div>
                            <div class="profile-field">
                                <span>Pekerjaan Ibu</span>
                                <strong>{{ $pendaftar->pekerjaan_ibu ?? '-' }}</strong>
                            </div>
                        </div>
                    </section>

                    @if($isAlumni)
                        <section class="profile-section-card" id="alumni">
                            <div class="profile-section-head">
                                <div class="profile-section-icon"><i class="fa-solid fa-user-graduate"></i></div>
                                <div>
                                    <h2>Riwayat Pondok</h2>
                                    <p>Ringkasan masa belajar dan status alumni santri.</p>
                                </div>
                            </div>
                            <div class="profile-detail-grid">
                                <div class="profile-field">
                                    <span>Status</span>
                                    <strong>Alumni</strong>
                                </div>
                                <div class="profile-field">
                                    <span>Tanggal Masuk</span>
                                    <strong>{{ $tanggalMasuk }}</strong>
                                </div>
                                <div class="profile-field">
                                    <span>Tanggal Boyong / Lulus</span>
                                    <strong>{{ $tanggalLulus }}</strong>
                                </div>
                                <div class="profile-field">
                                    <span>Jumlah Hafalan Terakhir</span>
                                    <strong>{{ $pendaftar->jumlah_hafalan ?? '-' }}</strong>
                                </div>
                                <div class="profile-field full">
                                    <span>Informasi Alumni</span>
                                    <strong>{{ $pendaftar->catatan ?: 'Data alumni sudah tercatat. Informasi tambahan dapat diperbarui oleh admin pondok.' }}</strong>
                                </div>
                            </div>
                        </section>
                    @else
                        <section class="profile-section-card" id="program">
                            <div class="profile-section-head">
                                <div class="profile-section-icon"><i class="fa-solid fa-book-quran"></i></div>
                                <div>
                                    <h2>Program / Hafalan</h2>
                                    <p>Data kemampuan dan target awal hafalan santri.</p>
                                </div>
                            </div>
                            <div class="profile-detail-grid">
                                <div class="profile-field">
                                    <span>Kemampuan Membaca Al-Quran</span>
                                    <strong>{{ $pendaftar->kemampuan_membaca_alquran ?? '-' }}</strong>
                                </div>
                                <div class="profile-field">
                                    <span>Jumlah Hafalan</span>
                                    <strong>{{ $pendaftar->jumlah_hafalan ?? '-' }}</strong>
                                </div>
                                <div class="profile-field full">
                                    <span>Motivasi Masuk Pondok</span>
                                    <strong>{{ $pendaftar->motivasi_masuk_pondok ?? '-' }}</strong>
                                </div>
                                <div class="profile-field full">
                                    <span>Riwayat Penyakit</span>
                                    <strong>{{ $pendaftar->riwayat_penyakit ?? '-' }}</strong>
                                </div>
                            </div>
                        </section>

                    @endif

                    <section class="profile-section-card">
                        <div class="profile-section-head">
                            <div class="profile-section-icon"><i class="fa-solid fa-folder-open"></i></div>
                            <div>
                                <h2>Dokumen</h2>
                                <p>Dokumen pendukung yang tersimpan di sistem.</p>
                            </div>
                        </div>
                        <div class="payment-action-box">
                            <div class="doc-links">
                                @if($pendaftar->foto)<a href="{{ asset('storage/' . $pendaftar->foto) }}" target="_blank">Foto Santri</a>@endif
                                @if($pendaftar->kartu_keluarga)<a href="{{ asset('storage/' . $pendaftar->kartu_keluarga) }}" target="_blank">Kartu Keluarga</a>@endif
                                @if($pendaftar->akta_lahir)<a href="{{ asset('storage/' . $pendaftar->akta_lahir) }}" target="_blank">Akta Lahir</a>@endif
                                @if(!$pendaftar->foto && !$pendaftar->kartu_keluarga && !$pendaftar->akta_lahir)
                                    <span class="meta-list">Belum ada dokumen yang dapat dilihat.</span>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
