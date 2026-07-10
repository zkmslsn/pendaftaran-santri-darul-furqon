<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran Belum Terhubung</title>

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">

    <style>
        .unlinked-shell {
            width: min(760px, calc(100% - 32px));
            margin: 0 auto;
            padding: 48px 0;
        }

        .unlinked-card {
            overflow: hidden;
            border: 1px solid var(--dash-border);
            border-radius: 28px;
            background: #ffffff;
            box-shadow: var(--dash-shadow);
        }

        .unlinked-card-header {
            padding: 34px;
            color: #ffffff;
            background:
                radial-gradient(circle at top right, rgba(163, 230, 53, 0.25), transparent 34%),
                linear-gradient(135deg, var(--dash-primary-dark), var(--dash-primary));
            text-align: center;
        }

        .unlinked-icon {
            width: 78px;
            height: 78px;
            margin: 0 auto 18px;
            display: grid;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, 0.28);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.14);
            font-size: 32px;
        }

        .unlinked-card-header h1 {
            margin: 0 0 10px;
            font-size: clamp(26px, 5vw, 36px);
            line-height: 1.2;
        }

        .unlinked-card-header p {
            max-width: 580px;
            margin: 0 auto;
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.7;
        }

        .unlinked-card-body {
            padding: 30px 34px 34px;
        }

        .account-summary {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 22px;
        }

        .account-field {
            padding: 15px;
            border: 1px solid #e5ede9;
            border-radius: 16px;
            background: #f8faf9;
        }

        .account-field span {
            display: block;
            margin-bottom: 5px;
            color: var(--dash-muted);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .account-field strong {
            display: block;
            color: var(--dash-primary-dark);
            overflow-wrap: anywhere;
        }

        .unlinked-note {
            margin: 0 0 24px;
            color: var(--dash-muted);
            line-height: 1.75;
            text-align: center;
        }

        .unlinked-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .unlinked-actions form {
            margin: 0;
        }

        @media (max-width: 560px) {
            .unlinked-shell {
                padding: 18px 0;
            }

            .unlinked-card-header,
            .unlinked-card-body {
                padding: 24px 20px;
            }

            .account-summary {
                grid-template-columns: 1fr;
            }

            .unlinked-actions,
            .unlinked-actions .btn,
            .unlinked-actions form {
                width: 100%;
            }
        }
    </style>
</head>
<body class="dash-body">
    <main class="unlinked-shell">
        <section class="unlinked-card">
            <div class="unlinked-card-header">
                <div class="unlinked-icon">
                    <i class="fa-solid fa-link-slash"></i>
                </div>
                <h1>Data Pendaftaran Belum Terhubung</h1>
                <p>
                    Akun Anda berhasil masuk, tetapi sistem belum menemukan formulir
                    pendaftaran yang cocok dengan nomor induk atau email akun ini.
                </p>
            </div>

            <div class="unlinked-card-body">
                <div class="account-summary">
                    <div class="account-field">
                        <span>Nama Akun</span>
                        <strong>{{ $user->name }}</strong>
                    </div>
                    <div class="account-field">
                        <span>Email</span>
                        <strong>{{ $user->email }}</strong>
                    </div>
                    <div class="account-field">
                        <span>Nomor Induk Santri</span>
                        <strong>{{ $user->nomor_induk_santri ?: 'Belum tersedia' }}</strong>
                    </div>
                    <div class="account-field">
                        <span>Status Akun</span>
                        <strong>Akun aktif, data belum terhubung</strong>
                    </div>
                </div>

                <p class="unlinked-note">
                    Jika belum mengisi formulir, silakan lengkapi pendaftaran terlebih dahulu.
                    Jika sudah pernah mendaftar, hubungi admin pondok agar data akun diperiksa.
                </p>

                <div class="unlinked-actions">
                    <a href="{{ route('daftar.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-pen-to-square"></i> Isi Form Pendaftaran
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
