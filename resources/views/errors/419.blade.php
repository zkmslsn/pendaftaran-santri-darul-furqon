<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Kedaluwarsa</title>

    <style>
        :root {
            --primary: #064e3b;
            --primary-2: #0f766e;
            --soft: #f0fdf4;
            --text: #102033;
            --muted: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
            background:
                radial-gradient(circle at 90% 12%, rgba(163, 230, 53, 0.28), transparent 28%),
                linear-gradient(135deg, #ffffff 0%, var(--soft) 100%);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        .page-expired {
            width: min(100%, 520px);
            padding: 34px;
            border: 1px solid rgba(6, 78, 59, 0.12);
            border-radius: 26px;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 22px 55px rgba(6, 78, 59, 0.14);
            text-align: center;
        }

        .page-expired strong {
            display: block;
            color: var(--primary);
            font-size: 18px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .page-expired h1 {
            margin: 0 0 12px;
            color: var(--primary);
            font-size: 32px;
            line-height: 1.2;
        }

        .page-expired p {
            margin: 0 0 24px;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .page-expired a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 22px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            font-size: 14px;
            font-weight: 900;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <main class="page-expired">
        <strong>419</strong>
        <h1>Sesi halaman kedaluwarsa</h1>
        <p>
            Silakan buka ulang halaman login, lalu masukkan kembali email dan password.
            Hal ini biasanya terjadi ketika halaman login terlalu lama terbuka atau session baru saja berubah.
        </p>
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </main>
</body>
</html>
