<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat dan Ketentuan Pendaftaran</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary: #064e3b;
            --primary-2: #0f766e;
            --primary-3: #16a34a;
            --dark: #022c22;
            --lime: #a3e635;
            --lime-2: #d9f99d;
            --cream: #fffdf4;
            --soft: #f0fdf4;
            --white: #ffffff;
            --text: #102033;
            --muted: #64748b;
            --border: #dbe7dd;
            --shadow: 0 22px 55px rgba(6, 78, 59, 0.16);
            --shadow-soft: 0 12px 32px rgba(6, 78, 59, 0.09);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            overflow-x: hidden;
            background: #f7fbf8;
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        /* ================= NAVBAR ================= */

        .navbar.main-navbar {
            width: 100%;
            min-height: 76px;
            padding: 0 7%;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(16px);
            box-shadow: 0 10px 30px rgba(6, 78, 59, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .brand img {
            width: 48px;
            height: 48px;
            min-width: 48px;
            max-width: 48px;
            max-height: 48px;
            object-fit: contain;
            object-position: center;
            border-radius: 0;
            background: transparent;
            padding: 0;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-3));
            color: #ffffff;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 900;
        }

        .brand span {
            color: var(--primary);
            font-size: 15px;
            font-weight: 950;
            line-height: 1.25;
            white-space: nowrap;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 26px;
            margin-left: auto;
        }

        .nav-links a {
            color: var(--primary);
            font-size: 15px;
            font-weight: 900;
            text-decoration: none;
            position: relative;
            transition: 0.25s ease;
            white-space: nowrap;
        }

        .nav-links a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -9px;
            width: 0;
            height: 3px;
            border-radius: 999px;
            background: var(--lime);
            transition: 0.25s ease;
        }

        .nav-links a.active::after {
            width: 100%;
        }

        .nav-links a:hover::after {
            width: 0;
        }

        .nav-links .nav-login {
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            padding: 12px 22px;
            border-radius: 999px;
            box-shadow: 0 12px 26px rgba(6, 78, 59, 0.20);
            margin-left: 4px;
        }

        .nav-links .nav-login::after {
            display: none;
        }

        .nav-links .nav-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(6, 78, 59, 0.24);
        }

        /* ================= HERO ================= */

        .page-hero {
            position: relative;
            padding: 82px 7% 76px;
            background:
                radial-gradient(circle at 92% 10%, rgba(163, 230, 53, 0.28), transparent 28%),
                radial-gradient(circle at 0% 86%, rgba(15, 118, 110, 0.12), transparent 34%),
                linear-gradient(135deg, #ffffff 0%, #f0fdf4 55%, #fffdf4 100%);
            overflow: hidden;
            text-align: center;
        }

        .page-hero::before {
            content: "";
            position: absolute;
            top: 70px;
            right: 8%;
            width: 170px;
            height: 170px;
            background-image: radial-gradient(#a3e635 2px, transparent 2px);
            background-size: 16px 16px;
            opacity: 0.45;
        }

        .page-hero::after {
            content: "";
            position: absolute;
            left: -120px;
            bottom: -120px;
            width: 300px;
            height: 300px;
            border-radius: 999px;
            border: 45px solid rgba(6, 78, 59, 0.06);
        }

        .page-hero-content {
            position: relative;
            z-index: 2;
            max-width: 920px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 11px 18px;
            border-radius: 999px;
            background: #ffffff;
            border: 1px solid #bef264;
            color: var(--primary);
            font-size: 14px;
            font-weight: 950;
            box-shadow: var(--shadow-soft);
            margin-bottom: 24px;
        }

        .hero-badge span {
            width: 26px;
            height: 14px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--lime), var(--primary));
            display: inline-block;
        }

        .page-hero h1 {
            margin: 0;
            color: var(--dark);
            font-size: clamp(42px, 4vw, 66px);
            line-height: 1.1;
            letter-spacing: -1.2px;
            font-weight: 950;
        }

        .page-hero h1 strong {
            color: #65a30d;
        }

        .page-hero p {
            max-width: 760px;
            margin: 22px auto 0;
            color: #475569;
            font-size: 17px;
            line-height: 1.85;
        }

        /* ================= WRAPPER ================= */

        .syarat-wrapper {
            padding: 86px 7%;
            background:
                radial-gradient(circle at top left, rgba(15, 118, 110, 0.07), transparent 30%),
                linear-gradient(180deg, #f7fbf8 0%, #f0fdf4 100%);
        }

        .content-container {
            max-width: 1420px;
            margin: 0 auto;
        }

        .section-heading {
            max-width: 860px;
            margin: 0 auto 44px;
            text-align: center;
        }

        .section-heading .mini-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            font-weight: 950;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .section-heading .mini-label::before {
            content: "";
            width: 24px;
            height: 13px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--lime), var(--primary));
        }

        .section-heading h2 {
            margin: 0 0 12px;
            color: var(--primary);
            font-size: clamp(34px, 2.8vw, 48px);
            line-height: 1.2;
            font-weight: 950;
            letter-spacing: -0.6px;
            white-space: nowrap;
            overflow-wrap: normal;
        }

        .section-heading p {
            margin: 0 auto;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.75;
        }

        /* ================= SYARAT GRID ================= */

        .syarat-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 26px;
        }

        .syarat-card {
            position: relative;
            background: #ffffff;
            border: 1px solid rgba(6, 78, 59, 0.10);
            border-radius: 30px;
            padding: 32px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            transition: 0.25s ease;
        }

        .syarat-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow);
        }

        .syarat-card::after {
            content: "";
            position: absolute;
            right: -48px;
            top: -48px;
            width: 120px;
            height: 120px;
            border-radius: 999px;
            background: rgba(163, 230, 53, 0.22);
        }

        .syarat-card-content {
            position: relative;
            z-index: 2;
        }

        .syarat-icon {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
            box-shadow: 0 12px 26px rgba(6, 78, 59, 0.18);
        }

        .syarat-card h2 {
            color: var(--primary);
            margin: 0 0 16px;
            font-size: 26px;
            line-height: 1.25;
            font-weight: 950;
        }

        .syarat-card h3 {
            color: var(--primary);
            margin: 24px 0 10px;
            font-size: 18px;
            font-weight: 950;
        }

        .syarat-card ul {
            margin: 0;
            padding-left: 20px;
        }

        .syarat-card li {
            color: #475569;
            margin-bottom: 11px;
            line-height: 1.7;
            font-size: 15px;
        }

        .syarat-card li::marker {
            color: var(--primary-3);
        }

        /* ================= FOOTER ================= */

        .footer-modern {
            background:
                radial-gradient(circle at top right, rgba(163, 230, 53, 0.15), transparent 22%),
                linear-gradient(135deg, #022c22 0%, #064e3b 55%, #0f766e 100%);
            color: rgba(255,255,255,0.92);
            padding: 60px 7% 24px;
        }

        .footer-container {
            max-width: 1420px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.35fr 0.8fr 1fr 0.9fr;
            gap: 34px;
        }

        .footer-brand {
            display: flex;
            gap: 14px;
            align-items: flex-start;
        }

        .footer-brand img {
            width: 56px;
            height: 56px;
            object-fit: contain;
            background: rgba(255,255,255,0.10);
            border-radius: 14px;
            padding: 7px;
        }

        .footer-brand-text h3 {
            margin: 0 0 10px;
            font-size: 20px;
            line-height: 1.35;
            color: #ffffff;
            font-weight: 950;
        }

        .footer-brand-text p {
            margin: 0;
            color: rgba(255,255,255,0.78);
            line-height: 1.8;
            font-size: 14px;
        }

        .footer-title {
            margin: 0 0 16px;
            font-size: 18px;
            font-weight: 950;
            color: #ffffff;
        }

        .footer-links,
        .footer-contact {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li,
        .footer-contact li {
            margin-bottom: 12px;
        }

        .footer-links a,
        .footer-contact a,
        .footer-contact span {
            color: rgba(255,255,255,0.82);
            text-decoration: none;
            font-size: 14px;
            line-height: 1.7;
            transition: 0.25s ease;
        }

        .footer-links a:hover,
        .footer-contact a:hover {
            color: var(--lime-2);
        }

        .footer-social {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 8px;
        }

        .footer-social a {
            width: 42px;
            height: 42px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.10);
            color: #ffffff;
            font-size: 18px;
            transition: 0.25s ease;
        }

        .footer-social a:hover {
            background: var(--lime);
            color: var(--primary);
            transform: translateY(-3px);
        }

        .footer-social a i {
            font-size: 18px;
        }

        .footer-social a:nth-child(1):hover {
            background: #e1306c;
            color: #ffffff;
        }

        .footer-social a:nth-child(2):hover {
            background: #000000;
            color: #ffffff;
        }

        .footer-social a:nth-child(3):hover {
            background: #ff0000;
            color: #ffffff;
        }

        .footer-social a:nth-child(4):hover {
            background: #25d366;
            color: #ffffff;
        }

        .footer-bottom {
            max-width: 1420px;
            margin: 34px auto 0;
            padding-top: 22px;
            border-top: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .footer-bottom p {
            margin: 0;
            font-size: 14px;
            color: rgba(255,255,255,0.78);
        }

        .footer-bottom-links {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
        }

        .footer-bottom-links a {
            color: rgba(255,255,255,0.78);
            font-size: 14px;
        }

        .footer-bottom-links a:hover {
            color: var(--lime-2);
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 1200px) {
            .footer-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 950px) {
            .navbar.main-navbar {
                padding: 12px 5%;
                min-height: auto;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .brand {
                width: 100%;
            }

            .brand img,
            .brand-logo {
                width: 40px;
                height: 40px;
                min-width: 40px;
                max-width: 40px;
                max-height: 40px;
            }

            .brand span {
                font-size: 13px;
                white-space: normal;
            }

            .nav-links {
                width: 100%;
                flex-wrap: wrap;
                gap: 12px;
                margin-left: 0;
            }

            .nav-links a {
                font-size: 13px;
            }

            .nav-links .nav-login {
                padding: 9px 16px;
                margin-left: 0;
            }

            .page-hero {
                padding: 56px 5% 58px;
            }

            .page-hero h1 {
                font-size: 36px;
            }

            .page-hero p {
                font-size: 15px;
            }

            .syarat-wrapper {
                padding: 62px 5%;
            }

            .syarat-grid,
            .syarat-note {
                grid-template-columns: 1fr;
            }

            .syarat-card {
                padding: 26px;
            }

            .syarat-note {
                padding: 38px 24px;
            }

            .syarat-note-actions {
                justify-content: flex-start;
            }

            .btn-modern {
                width: 100%;
            }

            .footer-modern {
                padding: 50px 5% 22px;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .footer-bottom {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* ==================================================
           BACKGROUND GLOBAL FINAL - SAMA SEPERTI LOGIN
           Untuk halaman Informasi, Syarat, dan Daftar
           ================================================== */

        body {
            background: #f7fbf8 !important;
        }

        body::before,
        body::after {
            display: none !important;
        }

        .info-wrapper,
        .syarat-wrapper,
        .form-wrapper {
            min-height: calc(100vh - 76px);
            background:
                radial-gradient(circle at 92% 10%, rgba(163, 230, 53, 0.28), transparent 28%),
                radial-gradient(circle at 0% 86%, rgba(15, 118, 110, 0.12), transparent 34%),
                linear-gradient(135deg, #ffffff 0%, #f0fdf4 55%, #fffdf4 100%) !important;
            position: relative;
            isolation: isolate;
            overflow: hidden;
        }

        .info-wrapper::before,
        .syarat-wrapper::before,
        .form-wrapper::before {
            content: "";
            position: absolute;
            top: 70px;
            right: 8%;
            width: 170px;
            height: 170px;
            background-image: radial-gradient(#a3e635 2px, transparent 2px);
            background-size: 16px 16px;
            opacity: 0.45;
            pointer-events: none;
            z-index: 0;
        }

        .info-wrapper::after,
        .syarat-wrapper::after,
        .form-wrapper::after {
            content: "";
            position: absolute;
            left: -120px;
            bottom: -120px;
            width: 300px;
            height: 300px;
            border-radius: 999px;
            border: 45px solid rgba(6, 78, 59, 0.06);
            pointer-events: none;
            z-index: 0;
        }

        .info-wrapper > *,
        .syarat-wrapper > *,
        .form-wrapper > * {
            position: relative;
            z-index: 1;
        }

        @media (max-width: 950px) {
            .info-wrapper,
            .syarat-wrapper,
            .form-wrapper {
                background:
                    radial-gradient(circle at 100% 4%, rgba(163, 230, 53, 0.24), transparent 30%),
                    radial-gradient(circle at 0% 92%, rgba(15, 118, 110, 0.10), transparent 36%),
                    linear-gradient(135deg, #ffffff 0%, #f0fdf4 58%, #fffdf4 100%) !important;
            }

            .info-wrapper::before,
            .syarat-wrapper::before,
            .form-wrapper::before {
                top: 42px;
                right: -26px;
                width: 132px;
                height: 132px;
                background-size: 13px 13px;
                opacity: 0.34;
            }

            .info-wrapper::after,
            .syarat-wrapper::after,
            .form-wrapper::after {
                left: -155px;
                bottom: -155px;
            }
        }

        /* ==================================================
           SECTION HEADING BOX FINAL
           Kotak judul transparan tanpa background tambahan
           ================================================== */

        .section-heading {
            width: 100% !important;
            max-width: 1420px !important;
            margin: 0 auto 46px !important;
            padding: 54px 42px 56px !important;
            border: 1px solid rgba(6, 78, 59, 0.14) !important;
            border-radius: 32px !important;
            background:
                radial-gradient(circle at 92% 8%, rgba(217, 249, 157, 0.32), transparent 26%),
                linear-gradient(135deg, rgba(255, 255, 255, 0.94) 0%, rgba(240, 253, 244, 0.90) 58%, rgba(255, 253, 244, 0.92) 100%) !important;
            backdrop-filter: blur(10px) !important;
            box-shadow:
                0 24px 60px rgba(6, 78, 59, 0.11),
                inset 0 1px 0 rgba(255, 255, 255, 0.65) !important;
            position: relative !important;
            overflow: hidden !important;
            isolation: isolate !important;
        }

        .section-heading::before,
        .section-heading::after {
            display: none !important;
            content: none !important;
        }

        .section-heading > * {
            position: relative !important;
            z-index: 1 !important;
        }

        .section-heading .mini-label {
            display: inline-flex !important;
            align-items: center !important;
            gap: 10px !important;
            padding: 10px 18px !important;
            border: 1px solid rgba(163, 230, 53, 0.72) !important;
            border-radius: 999px !important;
            background: transparent !important;
            color: #064e3b !important;
            font-size: 15px !important;
            font-weight: 950 !important;
            box-shadow: 0 12px 28px rgba(6, 78, 59, 0.08) !important;
            margin-bottom: 24px !important;
        }

        .section-heading .mini-label::before {
            width: 26px !important;
            height: 14px !important;
            flex: 0 0 26px !important;
            background: linear-gradient(90deg, var(--lime), var(--primary)) !important;
        }

        .section-heading h2 {
            margin: 0 0 18px !important;
            color: #064e3b !important;
            font-size: clamp(38px, 4.1vw, 62px) !important;
            line-height: 1.1 !important;
            letter-spacing: 0 !important;
            font-weight: 950 !important;
            white-space: normal !important;
        }

        .section-heading p {
            max-width: 860px !important;
            margin: 0 auto !important;
            color: #475569 !important;
            font-size: 17px !important;
            line-height: 1.8 !important;
        }

        @media (max-width: 950px) {
            .section-heading {
                padding: 38px 24px 40px !important;
                border-radius: 26px !important;
                margin-bottom: 34px !important;
            }

            .section-heading h2 {
                font-size: 34px !important;
            }

            .section-heading p {
                font-size: 15px !important;
            }
        }

        /* ==================================================
        FOOTER LAYOUT FINAL - 3 KOLOM RAPI TANPA KOSONG KANAN
        ================================================== */

        .footer-modern,
        .footer-modern.reveal {
            padding: 64px 7% 24px !important;
        }

        .footer-container {
            max-width: 1500px !important;
            width: 100% !important;
            margin: 0 auto !important;
            display: grid !important;
            grid-template-columns: 1.25fr 0.85fr 1fr !important;
            gap: 90px !important;
            align-items: flex-start !important;
        }

        /* Kolom identitas pondok */
        .footer-container > div:nth-child(1) {
            justify-self: start !important;
            width: 100% !important;
        }

        .footer-brand {
            display: flex !important;
            align-items: flex-start !important;
            gap: 18px !important;
        }

        .footer-brand-text h3 {
            max-width: 520px !important;
            margin-bottom: 14px !important;
        }

        .footer-brand-text p {
            max-width: 560px !important;
            text-align: left !important;
        }

        /* Kolom kontak */
        .footer-container > div:nth-child(2) {
            justify-self: center !important;
            width: 100% !important;
            max-width: 340px !important;
        }

        /* Kolom media sosial digeser ke kanan */
        .footer-container > div:nth-child(3) {
            justify-self: end !important;
            width: 100% !important;
            max-width: 420px !important;
        }

        .footer-container > div:nth-child(3) .footer-title,
        .footer-container > div:nth-child(3) .footer-social-text {
            text-align: left !important;
        }

        .footer-social {
            justify-content: flex-start !important;
        }

        /* Garis dan copyright tetap rapi */
        .footer-bottom {
            max-width: 1500px !important;
            margin: 44px auto 0 !important;
            padding-top: 24px !important;
            justify-content: center !important;
            text-align: center !important;
        }

        /* Responsive tablet */
        @media (max-width: 1200px) {
            .footer-container {
                grid-template-columns: 1fr 1fr !important;
                gap: 46px !important;
            }

            .footer-container > div:nth-child(1) {
                grid-column: 1 / -1 !important;
            }

            .footer-container > div:nth-child(2),
            .footer-container > div:nth-child(3) {
                justify-self: start !important;
                max-width: none !important;
            }
        }

        /* Responsive HP */
        @media (max-width: 768px) {
            .footer-modern,
            .footer-modern.reveal {
                padding: 50px 5% 22px !important;
            }

            .footer-container {
                grid-template-columns: 1fr !important;
                gap: 34px !important;
            }

            .footer-container > div:nth-child(1),
            .footer-container > div:nth-child(2),
            .footer-container > div:nth-child(3) {
                justify-self: start !important;
                width: 100% !important;
                max-width: none !important;
            }

            .footer-brand {
                gap: 14px !important;
            }

            .footer-bottom {
                margin-top: 34px !important;
            }
        }

        /* ==================================================
           CTA FINAL SERAGAM - INFORMASI & SYARAT
           ================================================== */

        .cta-modern,
        .syarat-note {
            max-width: 1420px !important;
            width: 100% !important;
            margin: 46px auto 0 !important;
            padding: 48px 64px !important;
            border-radius: 34px !important;
            background:
                radial-gradient(circle at top right, rgba(163, 230, 53, 0.18), transparent 28%),
                radial-gradient(circle at bottom left, rgba(255, 255, 255, 0.07), transparent 24%),
                linear-gradient(135deg, #064e3b 0%, #0f766e 58%, #238b52 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 22px 50px rgba(6, 78, 59, 0.16) !important;
            display: grid !important;
            grid-template-columns: minmax(0, 1.25fr) minmax(320px, 0.75fr) !important;
            gap: 34px !important;
            align-items: center !important;
            text-align: left !important;
            overflow: hidden !important;
            position: relative !important;
        }

        .cta-modern::before,
        .syarat-note::before {
            content: "" !important;
            position: absolute !important;
            top: -70px !important;
            right: -50px !important;
            width: 190px !important;
            height: 190px !important;
            border-radius: 999px !important;
            background: rgba(255, 255, 255, 0.08) !important;
        }

        .cta-modern::after,
        .syarat-note::after {
            content: "" !important;
            position: absolute !important;
            left: -70px !important;
            bottom: -80px !important;
            width: 220px !important;
            height: 220px !important;
            border-radius: 999px !important;
            background: rgba(255, 255, 255, 0.055) !important;
        }

        .cta-modern > *,
        .syarat-note > * {
            position: relative !important;
            z-index: 2 !important;
        }

        .cta-modern h2,
        .syarat-note h2 {
            margin: 0 0 14px !important;
            max-width: 760px !important;
            color: #ffffff !important;
            font-size: clamp(36px, 3vw, 52px) !important;
            line-height: 1.14 !important;
            font-weight: 950 !important;
            letter-spacing: -0.6px !important;
        }

        .cta-modern p,
        .syarat-note p {
            max-width: 780px !important;
            margin: 0 !important;
            color: rgba(255, 255, 255, 0.88) !important;
            font-size: 16.5px !important;
            line-height: 1.85 !important;
            font-weight: 500 !important;
        }

        .cta-actions,
        .syarat-note-actions {
            display: flex !important;
            justify-content: flex-end !important;
            align-items: center !important;
            gap: 16px !important;
            flex-wrap: wrap !important;
            text-align: right !important;
        }

        .cta-btn,
        .btn-modern,
        .syarat-note-actions .btn {
            min-width: 190px !important;
            min-height: 56px !important;
            padding: 0 28px !important;
            border-radius: 999px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 16px !important;
            font-weight: 950 !important;
            text-decoration: none !important;
            transition: 0.25s ease !important;
            white-space: nowrap !important;
        }

        .cta-btn-light,
        .btn-modern-light,
        .syarat-note-actions .btn-primary {
            background: #ffffff !important;
            color: #064e3b !important;
            border: 2px solid #ffffff !important;
            box-shadow: 0 12px 26px rgba(0, 0, 0, 0.12) !important;
        }

        .cta-btn-outline,
        .btn-modern-outline,
        .syarat-note-actions .btn-outline {
            background: transparent !important;
            color: #ffffff !important;
            border: 2px solid rgba(255, 255, 255, 0.68) !important;
        }

        .cta-btn:hover,
        .btn-modern:hover,
        .syarat-note-actions .btn:hover {
            transform: translateY(-3px) !important;
        }

        /* Responsive */
        @media (max-width: 950px) {
            .cta-modern,
            .syarat-note {
                grid-template-columns: 1fr !important;
                padding: 38px 28px !important;
                border-radius: 28px !important;
                gap: 26px !important;
            }

            .cta-modern h2,
            .syarat-note h2 {
                font-size: 34px !important;
            }

            .cta-actions,
            .syarat-note-actions {
                justify-content: flex-start !important;
                text-align: left !important;
            }

            .cta-btn,
            .btn-modern,
            .syarat-note-actions .btn {
                width: 100% !important;
            }
        }

        /* ==================================================
        CARD SYARAT MODERN FINAL
        ================================================== */

        .syarat-grid {
            counter-reset: syarat-counter;
            gap: 30px !important;
            align-items: stretch !important;
        }

        .syarat-card {
            counter-increment: syarat-counter;
            position: relative !important;
            min-height: 390px !important;
            padding: 0 !important;
            border-radius: 30px !important;
            background:
                linear-gradient(180deg, #ffffff 0%, #fbfffc 100%) !important;
            border: 1px solid rgba(6, 78, 59, 0.10) !important;
            box-shadow: 0 18px 42px rgba(6, 78, 59, 0.09) !important;
            overflow: hidden !important;
            transition: 0.28s ease !important;
        }

        /* Efek hover */
        .syarat-card:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 28px 60px rgba(6, 78, 59, 0.15) !important;
            border-color: rgba(6, 78, 59, 0.20) !important;
        }

        /* Garis hijau atas card */
        .syarat-card::before {
            content: "" !important;
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            height: 7px !important;
            background: linear-gradient(90deg, #064e3b, #0f766e, #a3e635) !important;
            z-index: 3 !important;
        }

        /* Dekorasi lingkaran kanan atas */
        .syarat-card::after {
            content: "" !important;
            position: absolute !important;
            top: -55px !important;
            right: -55px !important;
            width: 145px !important;
            height: 145px !important;
            border-radius: 999px !important;
            background:
                radial-gradient(circle, rgba(163, 230, 53, 0.35), rgba(163, 230, 53, 0.12)) !important;
            z-index: 1 !important;
        }

        .syarat-card-content {
            position: relative !important;
            z-index: 2 !important;
            padding: 36px 36px 38px !important;
        }

        /* Hapus ikon emoji lama */
        .syarat-icon {
            display: none !important;
        }

        /* Judul card */
        .syarat-card h2 {
            display: flex !important;
            align-items: center !important;
            gap: 15px !important;
            margin: 0 0 24px !important;
            padding-bottom: 18px !important;
            border-bottom: 1px solid rgba(6, 78, 59, 0.13) !important;
            color: #064e3b !important;
            font-size: 25px !important;
            line-height: 1.25 !important;
            font-weight: 950 !important;
            letter-spacing: 0.2px !important;
        }

        /* Nomor card */
        .syarat-card h2::before {
            content: counter(syarat-counter, decimal-leading-zero);
            width: 46px !important;
            height: 46px !important;
            min-width: 46px !important;
            border-radius: 16px !important;
            background: linear-gradient(135deg, #064e3b, #0f766e) !important;
            color: #ffffff !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 14px !important;
            font-weight: 950 !important;
            box-shadow: 0 12px 26px rgba(6, 78, 59, 0.22) !important;
        }

        /* Subjudul seperti A. Ketentuan Berkunjung */
        .syarat-card h3 {
            display: inline-flex !important;
            align-items: center !important;
            margin: 18px 0 14px !important;
            padding: 9px 15px !important;
            border-radius: 999px !important;
            background: #ecfdf5 !important;
            border: 1px solid #bbf7d0 !important;
            color: #064e3b !important;
            font-size: 15px !important;
            line-height: 1.3 !important;
            font-weight: 950 !important;
        }

        /* List dibuat lebih rapi */
        .syarat-card ul {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .syarat-card li {
            position: relative !important;
            margin-bottom: 13px !important;
            padding-left: 30px !important;
            color: #334155 !important;
            font-size: 15.5px !important;
            line-height: 1.78 !important;
            font-weight: 500 !important;
        }

        /* Bullet modern */
        .syarat-card li::before {
            content: "" !important;
            position: absolute !important;
            left: 3px !important;
            top: 13px !important;
            width: 8px !important;
            height: 8px !important;
            border-radius: 999px !important;
            background: #16a34a !important;
            box-shadow: 0 0 0 5px rgba(22, 163, 74, 0.12) !important;
        }

        /* Card isi panjang biar tetap enak dibaca */
        .syarat-card:nth-child(2) li,
        .syarat-card:nth-child(3) li,
        .syarat-card:nth-child(4) li {
            font-size: 15px !important;
        }

        /* Responsive */
        @media (max-width: 950px) {
            .syarat-card {
                min-height: auto !important;
            }

            .syarat-card-content {
                padding: 30px 26px 32px !important;
            }

            .syarat-card h2 {
                font-size: 22px !important;
                align-items: flex-start !important;
            }

            .syarat-card h2::before {
                width: 42px !important;
                height: 42px !important;
                min-width: 42px !important;
            }

            .syarat-card li {
                font-size: 14.5px !important;
                line-height: 1.75 !important;
            }
        }
        /* ==================================================
           FOOTER FONT SIZE FINAL
           Samakan ukuran teks footer di semua halaman
           ================================================== */

        .footer-modern,
        .footer-modern.reveal {
            font-size: 16px !important;
        }

        .footer-brand-text h3 {
            font-size: 22px !important;
            line-height: 1.35 !important;
        }

        .footer-title {
            font-size: 21px !important;
            line-height: 1.3 !important;
        }

        .footer-brand-text p,
        .footer-contact a,
        .footer-contact span,
        .footer-social-text,
        .footer-modern .footer-container > div:nth-child(3) > p {
            font-size: 16px !important;
            line-height: 1.75 !important;
        }

        .footer-bottom p,
        .footer-bottom-links a {
            font-size: 15px !important;
            line-height: 1.7 !important;
        }

        .footer-social a {
            font-size: 20px !important;
        }

        @media (max-width: 768px) {
            .footer-brand-text h3 {
                font-size: 19px !important;
            }

            .footer-title {
                font-size: 18px !important;
            }

            .footer-brand-text p,
            .footer-contact a,
            .footer-contact span,
            .footer-social-text,
            .footer-modern .footer-container > div:nth-child(3) > p,
            .footer-bottom p,
            .footer-bottom-links a {
                font-size: 14px !important;
            }

            .footer-social a {
                font-size: 18px !important;
            }
        }
        /* ==================================================
           NAVBAR FONT SIZE FINAL
           Perbesar ukuran teks navbar di semua halaman
           ================================================== */

        .navbar.main-navbar .brand span {
            font-size: 16px !important;
            line-height: 1.3 !important;
        }

        .navbar.main-navbar .nav-links a,
        .navbar.main-navbar .nav-links .nav-login {
            font-size: 17px !important;
        }

        @media (max-width: 950px) {
            .navbar.main-navbar .brand span {
                font-size: 14px !important;
            }

            .navbar.main-navbar .nav-links a,
            .navbar.main-navbar .nav-links .nav-login {
                font-size: 14px !important;
            }
        }
        /* ==================================================
           HERO DARK GREEN FINAL
           ================================================== */

        .page-hero,
        .section-heading {
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.18) !important;
            background:
                radial-gradient(circle at top right, rgba(163, 230, 53, 0.18), transparent 28%),
                radial-gradient(circle at bottom left, rgba(255, 255, 255, 0.07), transparent 24%),
                linear-gradient(135deg, #064e3b 0%, #0f766e 58%, #238b52 100%) !important;
            box-shadow: 0 22px 50px rgba(6, 78, 59, 0.18) !important;
            overflow: hidden !important;
            position: relative !important;
            isolation: isolate !important;
        }

        .page-hero::before,
        .section-heading::before {
            content: "" !important;
            display: block !important;
            position: absolute !important;
            top: -70px !important;
            right: -50px !important;
            width: 190px !important;
            height: 190px !important;
            border: 0 !important;
            border-radius: 999px !important;
            background: rgba(255, 255, 255, 0.08) !important;
            pointer-events: none !important;
            z-index: 0 !important;
        }

        .page-hero::after,
        .section-heading::after {
            content: "" !important;
            display: block !important;
            position: absolute !important;
            left: -70px !important;
            bottom: -80px !important;
            width: 220px !important;
            height: 220px !important;
            border: 0 !important;
            border-radius: 999px !important;
            background: rgba(255, 255, 255, 0.055) !important;
            pointer-events: none !important;
            z-index: 0 !important;
        }

        .page-hero > *,
        .section-heading > * {
            position: relative !important;
            z-index: 2 !important;
        }

        .hero-badge,
        .page-badge,
        .section-heading .mini-label {
            background: rgba(255, 255, 255, 0.10) !important;
            border: 1px solid rgba(255, 255, 255, 0.42) !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }

        .hero-badge span,
        .page-badge::before,
        .section-heading .mini-label::before {
            background: linear-gradient(90deg, #d9f99d, #ffffff) !important;
        }

        .page-hero h1,
        .page-hero h1 strong,
        .section-heading h2 {
            color: #ffffff !important;
        }

        .page-hero p,
        .section-heading p {
            color: rgba(255, 255, 255, 0.88) !important;
        }

        /* ==================================================
           COMPACT RESPONSIVE BOX FINAL
           ================================================== */

        .form-container,
        .content-container,
        .page-container {
            width: min(1120px, calc(100% - 48px)) !important;
            max-width: 1120px !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .page-hero,
        .section-heading {
            width: 100% !important;
            max-width: 1120px !important;
            padding: 38px 34px 40px !important;
            border-radius: 28px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            margin-bottom: 32px !important;
        }

        .page-hero h1,
        .section-heading h2 {
            font-size: clamp(32px, 3.4vw, 50px) !important;
        }

        .page-hero p,
        .section-heading p {
            max-width: 760px !important;
            font-size: 15.5px !important;
            line-height: 1.75 !important;
        }

        .hero-badge,
        .page-badge,
        .section-heading .mini-label {
            padding: 9px 15px !important;
            font-size: 13.5px !important;
            margin-bottom: 18px !important;
        }

        .syarat-grid {
            gap: 22px !important;
        }

        .form-card,
        .info-card,
        .activity-card,
        .syarat-card,
        .syarat-note,
        .cta-modern {
            border-radius: 24px !important;
        }

        .syarat-card {
            min-height: auto !important;
        }

        .syarat-card-content {
            padding: 28px 28px 30px !important;
        }

        .syarat-card h2 {
            font-size: 22px !important;
            margin-bottom: 18px !important;
            padding-bottom: 14px !important;
        }

        .syarat-card li {
            font-size: 14.5px !important;
            line-height: 1.72 !important;
        }

        .cta-modern,
        .syarat-note {
            max-width: 1120px !important;
            padding: 38px 44px !important;
            border-radius: 28px !important;
        }

        @media (max-width: 950px) {
            .form-container,
            .content-container,
            .page-container {
                width: min(820px, calc(100% - 32px)) !important;
                max-width: 820px !important;
            }

            .page-hero,
            .section-heading {
                padding: 30px 24px 32px !important;
                border-radius: 24px !important;
            }

            .syarat-card-content {
                padding: 24px 22px 26px !important;
            }

            .cta-modern,
            .syarat-note {
                padding: 30px 24px !important;
                border-radius: 24px !important;
            }
        }

        @media (max-width: 640px) {
            .form-container,
            .content-container,
            .page-container {
                width: calc(100% - 24px) !important;
                max-width: none !important;
            }

            .page-hero,
            .section-heading {
                padding: 26px 18px 28px !important;
                border-radius: 20px !important;
                margin-bottom: 24px !important;
            }

            .page-hero h1,
            .section-heading h2 {
                font-size: 29px !important;
            }

            .syarat-card,
            .cta-modern,
            .syarat-note {
                border-radius: 20px !important;
            }
        }

        /* ==================================================
           SYARAT CTA BUTTONS SIDE BY SIDE
           ================================================== */

        .syarat-note-actions {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            gap: 14px !important;
            flex-wrap: nowrap !important;
            text-align: right !important;
        }

        .syarat-note-actions .btn-modern {
            width: auto !important;
            min-width: 160px !important;
            min-height: 54px !important;
            padding: 0 22px !important;
            flex: 0 0 auto !important;
        }

        @media (max-width: 950px) {
            .syarat-note-actions {
                justify-content: flex-start !important;
            }
        }

        @media (max-width: 520px) {
            .syarat-note-actions {
                flex-direction: column !important;
                align-items: stretch !important;
            }

            .syarat-note-actions .btn-modern {
                width: 100% !important;
                min-width: 0 !important;
            }
        }

        @media (max-width: 700px) {
            input,
            select,
            textarea,
            button {
                font-size: 16px !important;
            }

            .navbar.main-navbar {
                padding: 12px 16px !important;
            }

            .nav-links {
                display: grid !important;
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                width: 100% !important;
                gap: 10px !important;
            }

            .nav-links a,
            .nav-links .nav-login {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                min-height: 42px !important;
                padding: 9px 10px !important;
                white-space: normal !important;
                text-align: center !important;
            }

            .syarat-wrapper {
                padding: 40px 0 52px !important;
            }

            .section-heading h2 {
                white-space: normal !important;
                overflow-wrap: anywhere !important;
            }

            .syarat-grid {
                grid-template-columns: 1fr !important;
            }

            .syarat-card-content {
                padding: 20px 18px 22px !important;
            }

            .syarat-card h2 {
                align-items: flex-start !important;
            }

            .syarat-note {
                grid-template-columns: 1fr !important;
                gap: 22px !important;
                text-align: left !important;
            }
        }

        @media (max-width: 420px) {
            .nav-links {
                grid-template-columns: 1fr !important;
            }

            .brand img,
            .brand-logo {
                width: 38px !important;
                height: 38px !important;
                min-width: 38px !important;
            }
        }

        /* ==================================================
           SYARAT HERO FONT FINAL
           ================================================== */

        .syarat-wrapper .section-heading h2 {
            max-width: 980px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            font-size: clamp(30px, 3vw, 46px) !important;
            line-height: 1.16 !important;
            font-weight: 800 !important;
            letter-spacing: 0 !important;
        }

        .syarat-wrapper .section-heading p {
            max-width: 920px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            font-size: 16px !important;
            line-height: 1.7 !important;
        }

        .syarat-wrapper .section-heading .mini-label {
            font-size: 14px !important;
            line-height: 1.2 !important;
        }

        @media (max-width: 768px) {
            .syarat-wrapper .section-heading h2 {
                max-width: 620px !important;
                font-size: 30px !important;
                line-height: 1.22 !important;
            }

            .syarat-wrapper .section-heading p {
                max-width: 620px !important;
                font-size: 14.5px !important;
                line-height: 1.65 !important;
            }
        }

        @media (max-width: 420px) {
            .syarat-wrapper .section-heading h2 {
                font-size: 27px !important;
            }

            .syarat-wrapper .section-heading .mini-label {
                font-size: 13px !important;
            }
        }
    </style>
</head>

<body>

@php
    $waDisplay = '0838-9916-2195';
    $waLink = '6283899162195';

    $emailPondok = 'darulfurqon108@gmail.com';

    $instagramUrl = 'https://www.instagram.com/darulfurqon10?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==';
    $tiktokUrl = 'https://www.tiktok.com/@pptq.darul.furqon3?is_from_webapp=1&sender_device=pc';
    $youtubeUrl = 'https://www.youtube.com/@darulfurqon';
@endphp

@include('partials.public-navbar')

<main class="syarat-wrapper">
    <div class="content-container">
        <div class="section-heading">
            <div class="mini-label">Aturan Pondok</div>
            <h2>Syarat dan Ketentuan Pendaftaran</h2>
            <p>
                Informasi berikut menjadi pedoman bagi calon santri dan wali santri
                sebelum melakukan pendaftaran di Pondok Pesantren Tahfidzul Quran Darul Furqon.
            </p>
        </div>

        <div class="syarat-grid">
            <section class="syarat-card">
                <div class="syarat-card-content">
                    <div class="syarat-icon">✅</div>
                    <h2>Syarat Calon Santri</h2>

                    <ul>
                        <li>Batas usia minimal 15 tahun.</li>
                        <li>Didaftarkan oleh Orang Tua/Wali Santri yang bersangkutan.</li>
                        <li>Berpaham Ahlu al-Sunnah wa al-Jama'ah al-Nahdliyah.</li>
                        <li>Diwajibkan bersilaturahim kepada Pengasuh bersama Orang Tua/Wali Santri ketika telah diterima.</li>
                        <li>Calon Santri dan Orang Tua/Wali Santri bersedia mematuhi tata tertib dan peraturan Pesantren.</li>
                        <li>Memiliki komitmen kuat menghafalkan Al-Quran 30 juz.</li>
                        <li>Mengikuti wisuda dan pengambilan Syahadah serta Sanad Al-Quran.</li>
                    </ul>
                </div>
            </section>

            <section class="syarat-card">
                <div class="syarat-card-content">
                    <div class="syarat-icon">📌</div>
                    <h2>Tata Tertib</h2>

                    <ul>
                        <li>Santri wajib mengikuti sholat berjama'ah.</li>
                        <li>Santri wajib mengikuti kegiatan setoran dan ta'lim.</li>
                        <li>Santri harus mencapai 25 kali setoran dalam rentang waktu 15 hari.</li>
                        <li>Santri tidak diperkenankan membawa HP, laptop, dan barang lain yang mengganggu kegiatan ubudiyah, setoran, dan ta'lim.</li>
                        <li>Santri wajib tepat waktu dalam mengikuti kegiatan Pesantren.</li>
                        <li>Santri dilarang memutar musik melalui berbagai media kecuali sholawatan dan murottal dalam batas kewajaran.</li>
                        <li>Santri wajib menjaga kesopanan, kenyamanan, keamanan, ketertiban, kebersihan Pesantren dan lingkungan Pesantren.</li>
                        <li>Santri diharamkan berpacaran atau memiliki hubungan khusus yang tidak dibenarkan oleh syari'at.</li>
                        <li>Segala pelanggaran akan dikenakan teguran, peringatan, ta'zir/sanksi, dan seterusnya sesuai kebijakan Pengasuh.</li>
                    </ul>
                </div>
            </section>

            <section class="syarat-card">
                <div class="syarat-card-content">
                    <div class="syarat-icon">🕌</div>
                    <h2>Ketentuan-Ketentuan</h2>

                    <h3>A. Ketentuan Berkunjung</h3>
                    <ul>
                        <li>Santri hanya boleh dikunjungi oleh Orang Tua/Wali Santri atau mahromnya yang telah mendapat izin.</li>
                        <li>Tidak diperkenankan membawa teman masuk ke Pesantren.</li>
                        <li>Segala pelanggaran akan dikenakan teguran, peringatan, ta'zir/sanksi, dan seterusnya sesuai kebijakan Pengasuh.</li>
                    </ul>

                    <h3>B. Ketentuan Berpakaian</h3>
                    <ul>
                        <li>Kegiatan setoran dan ta'lim, santri wajib memakai busana muslimah yang menutup aurat dengan sempurna, tidak ketat, dan tidak transparan.</li>
                        <li>Kegiatan setoran dan ta'lim, santri tidak diperkenankan menggunakan jaket atau sejenisnya.</li>
                        <li>Dilarang memakai celana jenis apapun pada saat kegiatan Pesantren maupun ketika di luar Pesantren.</li>
                        <li>Segala pelanggaran akan dikenakan teguran, peringatan, ta'zir/sanksi, dan seterusnya sesuai kebijakan Pengasuh.</li>
                    </ul>
                </div>
            </section>

            <section class="syarat-card">
                <div class="syarat-card-content">
                    <div class="syarat-icon">📝</div>
                    <h2>Perizinan</h2>

                    <ul>
                        <li>Santri yang berhalangan mengikuti kegiatan Pesantren wajib izin kepada Pengasuh dan Pengurus Pesantren.</li>
                        <li>Santri yang hendak pulang wajib izin kepada Pengasuh, kemudian membawa bukti izin kepada Pengurus Pesantren.</li>
                        <li>Santri yang pulang tanpa izin atau tidak bermalam di Pesantren akan langsung dikonfirmasi kepada Orang Tua/Wali Santri, serta mendapatkan teguran keras dan ta'zir.</li>
                        <li>Batas keluar pukul 17.00 WIB. Di atas jam tersebut harus mendapat izin dari Pengasuh atau diantar oleh Pengurus yang diizini oleh Pengasuh.</li>
                    </ul>
                </div>
            </section>
        </div>

        <section class="syarat-note">
            <div>
                <h2>Sudah Membaca Syarat dan Ketentuan?</h2>
                <p>
                    Setelah memahami seluruh aturan pondok, calon santri dapat melanjutkan
                    proses pendaftaran online melalui sistem pendaftaran santri baru.
                </p>
            </div>

            <div class="syarat-note-actions">
                <a href="{{ route('daftar.create') }}" class="btn-modern btn-modern-light">Lanjut Daftar</a>
                <a href="{{ route('informasi') }}" class="btn-modern btn-modern-outline">Lihat Informasi</a>
            </div>
        </section>
    </div>
</main>

<footer class="footer-modern">
    <div class="footer-container">
        <div>
            <div class="footer-brand">
                <img src="{{ asset('assets/img/logo-pondok.jpeg') }}" alt="Logo Pondok">
                <div class="footer-brand-text">
                    <h3>Pondok Pesantren Tahfidzul Quran Darul Furqon</h3>
                    <p>
                        Lembaga pendidikan Islam yang berfokus pada pembinaan akhlak,
                        tahfidz Al-Quran, dan pengembangan generasi Qurani yang unggul.
                    </p>
                </div>
            </div>
        </div>

        <div>
            <h4 class="footer-title">Kontak</h4>
            <ul class="footer-contact">
                <li><span>📍 Malang, Jawa Timur</span></li>
                <li><a href="https://wa.me/{{ $waLink }}" target="_blank">📞 {{ $waDisplay }}</a></li>
                <li><a href="mailto:{{ $emailPondok }}">✉ {{ $emailPondok }}</a></li>
                <li><span>🕒 Senin - Sabtu, 08.00 - 16.00 WIB</span></li>
            </ul>
        </div>

        <div>
            <h4 class="footer-title">Media Sosial</h4>
            <p style="margin:0 0 14px; color: rgba(255,255,255,0.78); font-size:14px; line-height:1.7;">
                Ikuti kegiatan pondok melalui media sosial resmi kami.
            </p>

            <div class="footer-social">
                <a href="{{ $instagramUrl }}" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="{{ $tiktokUrl }}" target="_blank" title="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                <a href="{{ $youtubeUrl }}" target="_blank" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://wa.me/{{ $waLink }}" target="_blank" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2026 Pondok Pesantren Tahfidzul Quran Darul Furqon. All rights reserved.</p>
    </div>
</footer>

<script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>
