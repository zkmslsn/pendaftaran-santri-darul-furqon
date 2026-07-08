<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Pendaftaran Santri</title>

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
            --soft: #f0fdf4;
            --white: #ffffff;
            --text: #102033;
            --muted: #64748b;
            --border: #dbe7dd;
            --danger: #dc2626;
            --shadow: 0 22px 55px rgba(6, 78, 59, 0.16);
            --shadow-soft: 0 12px 32px rgba(6, 78, 59, 0.09);
        }

        * {
            box-sizing: border-box;
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

        /* ================= LOGIN PAGE ================= */

        .login-page {
            min-height: calc(100vh - 76px);
            padding: 76px 7%;
            background:
                radial-gradient(circle at 92% 10%, rgba(163, 230, 53, 0.28), transparent 28%),
                radial-gradient(circle at 0% 86%, rgba(15, 118, 110, 0.12), transparent 34%),
                linear-gradient(135deg, #ffffff 0%, #f0fdf4 55%, #fffdf4 100%);
            background-size: 120% 120%, 120% 120%, 100% 100%;
            position: relative;
            overflow: hidden;
            animation: loginBackdrop 16s ease-in-out infinite alternate;
        }

        .login-page::before {
            content: "";
            position: absolute;
            top: 70px;
            right: 8%;
            width: 170px;
            height: 170px;
            background-image: radial-gradient(#a3e635 2px, transparent 2px);
            background-size: 16px 16px;
            opacity: 0.45;
            animation: dotDrift 11s ease-in-out infinite alternate;
        }

        .login-page::after {
            content: "";
            position: absolute;
            left: -120px;
            bottom: -120px;
            width: 300px;
            height: 300px;
            border-radius: 999px;
            border: 45px solid rgba(6, 78, 59, 0.06);
            animation: ringBreathe 8s ease-in-out infinite;
        }

        .login-container {
            position: relative;
            z-index: 2;
            max-width: 1180px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 54px;
            align-items: center;
        }

        .login-intro {
            max-width: 620px;
            animation: introRise 0.7s ease both;
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
            animation: softFloat 5s ease-in-out infinite;
        }

        .hero-badge span {
            width: 26px;
            height: 14px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--lime), var(--primary));
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .hero-badge span::after {
            content: "";
            position: absolute;
            inset: 2px;
            border-radius: inherit;
            background: rgba(255,255,255,0.42);
            animation: badgePulse 1.8s ease-in-out infinite;
        }

        .login-intro h1 {
            margin: 0;
            color: var(--dark);
            font-size: 58px;
            line-height: 1.08;
            letter-spacing: 0;
            font-weight: 950;
        }

        .login-intro h1 strong {
            color: #65a30d;
        }

        .login-title-line {
            white-space: nowrap;
        }

        .login-intro p {
            max-width: 620px;
            margin: 22px 0 28px;
            color: #475569;
            font-size: 17px;
            line-height: 1.85;
        }

        .role-list {
            display: grid;
            gap: 14px;
            max-width: 620px;
        }

        .role-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
            border-radius: 24px;
            background: rgba(255,255,255,0.88);
            border: 1px solid rgba(6,78,59,0.10);
            box-shadow: var(--shadow-soft);
        }

        .role-icon {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            flex-shrink: 0;
        }

        .role-item strong {
            display: block;
            color: var(--primary);
            font-size: 16px;
            font-weight: 950;
            margin-bottom: 4px;
        }

        .role-item small {
            color: var(--muted);
            line-height: 1.5;
        }

        .login-card {
            background: #ffffff;
            border: 1px solid rgba(6, 78, 59, 0.10);
            border-radius: 34px;
            padding: 36px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            animation: cardRise 0.8s ease 0.12s both;
        }

        .login-card::before {
            content: "";
            position: absolute;
            right: -80px;
            top: -80px;
            width: 190px;
            height: 190px;
            border-radius: 999px;
            background: rgba(163, 230, 53, 0.18);
        }

        .login-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, transparent 0%, rgba(255,255,255,0.62) 46%, transparent 58%);
            transform: translateX(-115%);
            animation: cardSheen 7s ease-in-out infinite;
            pointer-events: none;
        }

        .login-card-content {
            position: relative;
            z-index: 3;
        }

        .login-logo {
            width: 72px;
            height: 72px;
            margin: 0 auto 18px;
            border-radius: 22px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 14px 28px rgba(6,78,59,0.10);
        }

        .login-logo::before {
            content: "";
            position: absolute;
            inset: -5px;
            border-radius: 27px;
            background: conic-gradient(from 0deg, rgba(163,230,53,0), rgba(163,230,53,0.9), rgba(15,118,110,0.72), rgba(163,230,53,0));
            animation: logoRing 5s linear infinite;
            z-index: -1;
        }

        .login-logo img {
            width: 58px;
            height: 58px;
            object-fit: contain;
        }

        .login-card h2 {
            margin: 0 0 8px;
            color: var(--primary);
            font-size: 30px;
            font-weight: 950;
            text-align: center;
        }

        .login-card .login-subtitle {
            margin: 0 0 24px;
            color: var(--muted);
            text-align: center;
            line-height: 1.65;
            font-size: 14px;
        }

        .role-tabs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 22px;
        }

        .role-tab {
            border: 1px solid var(--border);
            background: #ffffff;
            color: var(--primary);
            padding: 12px 10px;
            border-radius: 16px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 950;
            transition: 0.25s ease;
        }

        .role-tab.active,
        .role-tab:hover {
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            box-shadow: 0 12px 26px rgba(6, 78, 59, 0.18);
            transform: translateY(-2px);
        }

        .role-tab.active {
            animation: activeTabPulse 3.2s ease-in-out infinite;
        }

        .error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 14px;
            border-radius: 16px;
            margin-bottom: 18px;
            font-weight: 800;
            line-height: 1.55;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .credential-hint {
            margin: -7px 0 18px;
            padding: 11px 13px;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            background: #f0fdf4;
            color: #166534;
            font-size: 12px;
            font-weight: 750;
            line-height: 1.5;
        }

        .demo-credential {
            display: block;
            margin-top: 4px;
            color: #065f46;
            font-weight: 900;
        }

        label {
            display: block;
            color: #111827;
            font-size: 14px;
            font-weight: 950;
            margin-bottom: 8px;
        }

        #loginIdentityInput,
        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            min-height: 50px;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 16px;
            background: #ffffff;
            color: #1f2937;
            font-size: 14px;
            transition: 0.25s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-2);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 6px 0 22px;
            flex-wrap: wrap;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
        }

        .remember-label input {
            width: 16px;
            height: 16px;
        }

        .help-link {
            color: var(--primary);
            font-size: 13px;
            font-weight: 900;
        }

        .login-button {
            width: 100%;
            min-height: 52px;
            border: none;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            font-size: 15px;
            font-weight: 950;
            cursor: pointer;
            transition: 0.25s ease;
            box-shadow: 0 16px 32px rgba(6, 78, 59, 0.22);
            position: relative;
            overflow: hidden;
        }

        .login-button::before {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            left: -45%;
            width: 35%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.34), transparent);
            transform: skewX(-18deg);
            transition: 0.45s ease;
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(6, 78, 59, 0.28);
        }

        .login-button:hover::before {
            left: 112%;
        }

        .login-bottom {
            margin-top: 22px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            text-align: center;
        }

        .login-bottom a {
            color: var(--primary);
            font-weight: 950;
            font-size: 14px;
        }

        @keyframes loginBackdrop {
            0% {
                background-position: 0% 0%, 100% 100%, 0 0;
            }
            100% {
                background-position: 12% 8%, 88% 92%, 0 0;
            }
        }

        @keyframes dotDrift {
            0% {
                transform: translate3d(0, 0, 0);
            }
            100% {
                transform: translate3d(-18px, 24px, 0);
            }
        }

        @keyframes ringBreathe {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.04);
                opacity: 0.72;
            }
        }

        @keyframes introRise {
            from {
                opacity: 0;
                transform: translateY(18px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes cardRise {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes softFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        @keyframes badgePulse {
            0%, 100% {
                opacity: 0.35;
                transform: translateX(-4px);
            }
            50% {
                opacity: 0.85;
                transform: translateX(4px);
            }
        }

        @keyframes cardSheen {
            0%, 48% {
                transform: translateX(-115%);
            }
            70%, 100% {
                transform: translateX(115%);
            }
        }

        @keyframes logoRing {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes activeTabPulse {
            0%, 100% {
                box-shadow: 0 12px 26px rgba(6, 78, 59, 0.18);
            }
            50% {
                box-shadow: 0 16px 32px rgba(15, 118, 110, 0.28);
            }
        }

        /* ================= FOOTER ================= */

        /* ==================================================
           FOOTER FINAL SERAGAM
           Untuk Beranda, Informasi, Syarat, Daftar, Login
           ================================================== */

        .footer-modern,
        .footer-modern.reveal {
            background:
                radial-gradient(circle at top right, rgba(163, 230, 53, 0.15), transparent 22%),
                linear-gradient(135deg, #022c22 0%, #064e3b 55%, #0f766e 100%) !important;
            color: rgba(255,255,255,0.92) !important;
            padding: 62px 7% 24px !important;
            margin-top: 0 !important;
            text-align: left !important;
            opacity: 1 !important;
            animation: none !important;
        }

        .footer-container {
            max-width: 1420px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.35fr 1fr 1fr;
            gap: 80px;
            align-items: flex-start;
        }

        .footer-brand {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .footer-brand img {
            width: 58px;
            height: 58px;
            min-width: 58px;
            object-fit: contain;
            background: rgba(255,255,255,0.10);
            border-radius: 16px;
            padding: 8px;
        }

        .footer-brand-text h3 {
            margin: 0 0 14px;
            max-width: 520px;
            font-size: 22px;
            line-height: 1.35;
            color: #ffffff;
            font-weight: 950;
            letter-spacing: 0.2px;
        }

        .footer-brand-text p {
            margin: 0;
            max-width: 560px;
            color: rgba(255,255,255,0.82);
            line-height: 1.8;
            font-size: 16px;
            font-weight: 500;
        }

        .footer-title {
            margin: 0 0 18px;
            font-size: 21px;
            font-weight: 950;
            color: #ffffff;
        }

        .footer-contact {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-contact li {
            margin-bottom: 15px;
        }

        .footer-contact a,
        .footer-contact span {
            color: rgba(255,255,255,0.86);
            text-decoration: none;
            font-size: 16px;
            line-height: 1.7;
            transition: 0.25s ease;
        }

        .footer-contact a:hover {
            color: #d9f99d;
        }

        .footer-social-text {
            margin: 0 0 20px;
            color: rgba(255,255,255,0.82);
            font-size: 16px;
            line-height: 1.7;
        }

        .footer-social {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 6px;
        }

        .footer-social a {
            width: 48px;
            height: 48px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.10);
            color: #ffffff;
            font-size: 20px;
            text-decoration: none;
            transition: 0.25s ease;
        }

        .footer-social a:hover {
            transform: translateY(-3px);
        }

        .footer-social a.instagram:hover {
            background: linear-gradient(135deg, #f58529, #dd2a7b, #8134af, #515bd4);
            color: #ffffff;
        }

        .footer-social a.tiktok:hover {
            background: #000000;
            color: #ffffff;
        }

        .footer-social a.youtube:hover {
            background: #ff0000;
            color: #ffffff;
        }

        .footer-social a.whatsapp:hover {
            background: #25d366;
            color: #ffffff;
        }

        .footer-bottom {
            max-width: 1420px;
            margin: 42px auto 0;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .footer-bottom p {
            margin: 0;
            color: rgba(255,255,255,0.82);
            font-size: 15px;
            line-height: 1.7;
        }

        /* Hilangkan navigasi bawah kalau masih ada */
        .footer-links,
        .footer-bottom-links {
            display: none !important;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .footer-container {
                grid-template-columns: 1fr 1fr;
                gap: 42px;
            }

            .footer-container > div:first-child {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 768px) {
            .footer-modern,
            .footer-modern.reveal {
                padding: 50px 5% 22px !important;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 34px;
            }

            .footer-brand {
                flex-direction: row;
                align-items: flex-start;
            }

            .footer-brand img {
                width: 50px;
                height: 50px;
                min-width: 50px;
            }

            .footer-brand-text h3 {
                font-size: 19px;
            }

            .footer-brand-text p,
            .footer-contact a,
            .footer-contact span,
            .footer-social-text {
                font-size: 14px;
            }

            .footer-social a {
                width: 44px;
                height: 44px;
                font-size: 18px;
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

            .login-page {
                padding: 56px 5%;
            }

            .login-intro h1 {
                font-size: 36px;
            }

            .login-intro p {
                font-size: 15px;
            }

            .role-list {
                text-align: left;
            }

            .login-card {
                padding: 26px;
                border-radius: 28px;
            }

            .role-tabs {
                grid-template-columns: 1fr;
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
                align-items: center;
                text-align: center;
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

            .login-page {
                padding: 56px 5%;
            }

            .login-intro h1 {
                font-size: 36px;
            }

            .login-intro p {
                font-size: 15px;
            }

            .role-list {
                text-align: left;
            }

            .login-card {
                padding: 26px;
                border-radius: 28px;
            }

            .role-tabs {
                grid-template-columns: 1fr;
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
                align-items: center;
                text-align: center;
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

        @media (max-width: 560px) {
            .login-title-line {
                white-space: normal;
            }
        }

        @media (max-width: 950px) {
            .login-container {
                grid-template-columns: 1fr;
                gap: 34px;
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

            .login-page {
                min-height: auto !important;
                padding: 38px 14px 46px !important;
            }

            .login-container {
                gap: 26px !important;
            }

            .login-intro {
                text-align: center !important;
                margin: 0 auto !important;
            }

            .login-intro h1 {
                font-size: 32px !important;
            }

            .login-intro p {
                margin: 16px auto 22px !important;
                font-size: 14.5px !important;
            }

            .hero-badge {
                margin-bottom: 16px !important;
            }

            .login-card {
                padding: 22px 16px !important;
                border-radius: 22px !important;
            }

            .login-card h2 {
                font-size: 25px !important;
            }

            .remember-row {
                align-items: flex-start !important;
            }

            .footer-brand {
                gap: 12px !important;
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

            .login-card {
                padding-left: 14px !important;
                padding-right: 14px !important;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
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

    $formAction = route('login');

    $selectedRole = old('role', request('role', 'admin'));
    $selectedRole = in_array($selectedRole, ['admin', 'pengasuh', 'santri'], true) ? $selectedRole : 'admin';
@endphp

@include('partials.public-navbar')

<main class="login-page">
    <div class="login-container">
        <section class="login-intro">
            <div class="hero-badge">
                <span></span>
                Login Sistem Pendaftaran
            </div>

            <h1>
                <span class="login-title-line">Masuk ke Sistem</span><br>
                <strong>Darul Furqon</strong>
            </h1>

            <p>
                Gunakan akun yang telah tersedia untuk mengakses dashboard sesuai peran.
                Admin dapat mengelola pendaftar, pengasuh dapat melihat laporan, dan santri dapat mengecek status pendaftaran.
            </p>

        </section>

        <section class="login-card">
            <div class="login-card-content">
                <div class="login-logo">
                    <img src="{{ asset('assets/img/logo-pondok.jpeg') }}" alt="Logo Pondok">
                </div>

                <h2>Login Akun</h2>
                <p class="login-subtitle">
                    Pilih peran, lalu masukkan identitas dan password akun.
                </p>

                <div class="role-tabs">
                    <button type="button" class="role-tab {{ $selectedRole === 'admin' ? 'active' : '' }}" data-role="admin">
                        Admin
                    </button>
                    <button type="button" class="role-tab {{ $selectedRole === 'pengasuh' ? 'active' : '' }}" data-role="pengasuh">
                        Pengasuh
                    </button>
                    <button type="button" class="role-tab {{ $selectedRole === 'santri' ? 'active' : '' }}" data-role="santri">
                        Santri
                    </button>
                </div>

                @if($errors->any())
                    <div class="error">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(session('status'))
                    <div class="error" style="background:#ecfdf5; border-color:#86efac; color:#064e3b;">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ $formAction }}" method="POST">
                    @csrf

                    <input type="hidden" name="role" id="selectedRole" value="{{ $selectedRole }}">

                    <div class="form-group">
                        <label id="loginIdentityLabel">{{ $selectedRole === 'santri' ? 'Nomor Induk Santri / Gmail' : 'Email / Gmail' }}</label>
                        <input
                            id="loginIdentityInput"
                            type="{{ $selectedRole === 'santri' ? 'text' : 'email' }}"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="{{ $selectedRole === 'santri' ? 'Masukkan nomor induk santri atau Gmail' : 'Masukkan email atau Gmail' }}"
                            required
                            autofocus>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input
                            type="password"
                            name="password"
                            placeholder="Masukkan password"
                            required>
                    </div>

                    <p class="credential-hint">
                        <span id="loginPasswordHint">
                            {{ $selectedRole === 'santri'
                                ? 'Password awal santri sama dengan nomor induk santri.'
                                : 'Gunakan password akun yang telah diberikan.' }}
                        </span>
                        @if(app()->isLocal())
                            <span
                                id="demoCredentialHint"
                                class="demo-credential"
                                data-admin="Demo: admin@darulfurqon.test / password"
                                data-pengasuh="Demo: pengasuh@darulfurqon.test / password"
                                data-santri="Demo: santri@darulfurqon.test / 2026009">
                            </span>
                        @endif
                    </p>

                    <div class="remember-row">
                        <label class="remember-label">
                            <input type="checkbox" name="remember">
                            Ingat saya
                        </label>

                        <a href="/informasi" class="help-link">
                            Butuh bantuan?
                        </a>
                    </div>

                    <button type="submit" class="login-button">
                        Masuk Sekarang
                    </button>
                </form>

                <div class="login-bottom">
                    <a href="{{ route('daftar.create') }}">Belum punya akun? Daftar santri baru</a>
                </div>
            </div>
        </section>
    </div>
</main>

@php
    $waDisplay = '0838-9916-2195';
    $waLink = '6283899162195';

    $emailPondok = 'darulfurqon108@gmail.com';

    $instagramUrl = 'https://www.instagram.com/darulfurqon10?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==';
    $tiktokUrl = 'https://www.tiktok.com/@pptq.darul.furqon3?is_from_webapp=1&sender_device=pc';
    $youtubeUrl = 'https://www.youtube.com/@darulfurqon';
@endphp

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
            <p class="footer-social-text">
                Ikuti kegiatan pondok melalui media sosial resmi kami.
            </p>

            <div class="footer-social">
                <a class="instagram" href="{{ $instagramUrl }}" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a class="tiktok" href="{{ $tiktokUrl }}" target="_blank" title="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                <a class="youtube" href="{{ $youtubeUrl }}" target="_blank" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                <a class="whatsapp" href="https://wa.me/{{ $waLink }}" target="_blank" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2026 Pondok Pesantren Tahfidzul Quran Darul Furqon. All rights reserved.</p>
    </div>
</footer>

<script>
    const roleButtons = document.querySelectorAll('.role-tab');
    const selectedRoleInput = document.getElementById('selectedRole');
    const loginIdentityLabel = document.getElementById('loginIdentityLabel');
    const loginIdentityInput = document.getElementById('loginIdentityInput');
    const loginPasswordHint = document.getElementById('loginPasswordHint');
    const demoCredentialHint = document.getElementById('demoCredentialHint');

    const updateIdentityCopy = (role) => {
        if (!loginIdentityLabel || !loginIdentityInput) {
            return;
        }

        if (role === 'santri') {
            loginIdentityLabel.textContent = 'Nomor Induk Santri / Gmail';
            loginIdentityInput.placeholder = 'Masukkan nomor induk santri atau Gmail';
            loginIdentityInput.type = 'text';
            loginPasswordHint.textContent = 'Password awal santri sama dengan nomor induk santri.';
        } else {
            loginIdentityLabel.textContent = 'Email / Gmail';
            loginIdentityInput.placeholder = 'Masukkan email atau Gmail';
            loginIdentityInput.type = 'email';
            loginPasswordHint.textContent = 'Gunakan password akun yang telah diberikan.';
        }

        if (demoCredentialHint) {
            demoCredentialHint.textContent = demoCredentialHint.dataset[role] ?? '';
        }
    };

    roleButtons.forEach(button => {
        button.addEventListener('click', () => {
            roleButtons.forEach(item => item.classList.remove('active'));
            button.classList.add('active');
            selectedRoleInput.value = button.dataset.role;
            updateIdentityCopy(button.dataset.role);
        });
    });

    updateIdentityCopy(selectedRoleInput.value);
</script>

</body>
</html>
