<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pendaftaran Santri Baru</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary: #0f5132;
            --primary-2: #166534;
            --primary-dark: #052e1b;
            --lime: #a3e635;
            --soft-bg: #f4faf5;
            --white: #ffffff;
            --text: #102033;
            --muted: #64748b;
            --border: #dfe9e2;
            --shadow-soft: 0 14px 34px rgba(15, 81, 50, 0.08);
            --shadow-card: 0 18px 45px rgba(15, 81, 50, 0.10);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 88% 16%, rgba(163, 230, 53, 0.18), transparent 20%),
                radial-gradient(circle at 10% 85%, rgba(15, 81, 50, 0.08), transparent 22%),
                linear-gradient(135deg, #f7fbf8 0%, #edf6ef 55%, #f7fbf8 100%);
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            top: 160px;
            right: 90px;
            width: 140px;
            height: 140px;
            background-image: radial-gradient(#b7ea67 2px, transparent 2px);
            background-size: 16px 16px;
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: "";
            position: fixed;
            left: -110px;
            bottom: -110px;
            width: 280px;
            height: 280px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(15, 81, 50, 0.12), transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .page-wrapper,
        .content-wrapper,
        .main-wrapper,
        main {
            position: relative;
            z-index: 2;
        }

        .page-hero {
            max-width: 1240px;
            margin: 36px auto 24px;
            padding: 42px 32px;
            border-radius: 32px;
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(15, 81, 50, 0.08);
            box-shadow: var(--shadow-soft);
            text-align: center;
        }

        .page-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            border-radius: 999px;
            background: #ffffff;
            border: 1px solid #d9f99d;
            color: var(--primary);
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .page-badge::before {
            content: "";
            width: 22px;
            height: 12px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--lime), var(--primary));
        }

        .page-hero h1 {
            margin: 0 0 14px;
            color: var(--primary-dark);
            font-size: clamp(34px, 4vw, 54px);
            line-height: 1.18;
            font-weight: 900;
            letter-spacing: -0.8px;
        }

        .page-hero p {
            max-width: 880px;
            margin: 0 auto;
            color: #5b6b7f;
            font-size: 17px;
            line-height: 1.8;
        }

        .modern-card {
            background: rgba(255, 255, 255, 0.86);
            border: 1px solid rgba(15, 81, 50, 0.08);
            border-radius: 24px;
            box-shadow: var(--shadow-soft);
        }

        .section-box {
            max-width: 1240px;
            margin: 0 auto 28px;
            position: relative;
            z-index: 2;
        }

        .page-container {
            width: min(1240px, calc(100% - 40px));
            margin: 0 auto 48px;
            position: relative;
            z-index: 2;
        }

        .form-shell {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(15, 81, 50, 0.08);
            border-radius: 28px;
            padding: 28px;
            box-shadow: var(--shadow-card);
        }

        @media (max-width: 768px) {
            .page-hero {
                margin: 24px 14px 20px;
                padding: 30px 18px;
                border-radius: 24px;
            }

            .page-hero h1 {
                font-size: 32px;
            }

            .page-hero p {
                font-size: 15px;
                line-height: 1.75;
            }

            .page-container {
                width: calc(100% - 24px);
                margin-bottom: 32px;
            }

            .form-shell {
                padding: 18px;
                border-radius: 20px;
            }

            body::before {
                right: 18px;
                top: 140px;
                width: 90px;
                height: 90px;
                background-size: 12px 12px;
            }

            body::after {
                width: 180px;
                height: 180px;
                left: -70px;
                bottom: -70px;
            }
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
            max-width: 900px;
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

        .info-wrapper {
            padding: 86px 7%;
            background: transparent;
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
        }

        .section-heading p {
            margin: 0 auto;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.75;
        }

        /* ================= CARDS ================= */

        .info-two-column {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 26px;
            margin-bottom: 26px;
        }

        .info-card {
            position: relative;
            background: #ffffff;
            border: 1px solid rgba(6, 78, 59, 0.10);
            border-radius: 30px;
            padding: 30px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            transition: 0.25s ease;
        }

        .info-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow);
        }

        .info-card::after {
            content: "";
            position: absolute;
            right: -48px;
            top: -48px;
            width: 120px;
            height: 120px;
            border-radius: 999px;
            background: rgba(163, 230, 53, 0.22);
        }

        .info-card-content {
            position: relative;
            z-index: 2;
        }

        .info-card h2 {
            margin: 0 0 18px;
            color: var(--primary);
            font-size: 26px;
            line-height: 1.2;
            font-weight: 950;
        }

        .info-desc {
            color: #475569;
            line-height: 1.75;
            margin: 0 0 20px;
            font-size: 15px;
        }

        .info-total {
            background: linear-gradient(135deg, #ecfdf5, #f7fee7);
            border: 1px solid #86efac;
            color: var(--primary);
            padding: 18px;
            border-radius: 20px;
            font-weight: 950;
            font-size: 24px;
            margin-bottom: 18px;
        }

        .info-total span {
            display: block;
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 5px;
            font-weight: 800;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row span:first-child {
            color: #334155;
            font-weight: 800;
        }

        .info-row span:last-child {
            color: var(--primary);
            font-weight: 950;
            white-space: nowrap;
        }

        /* ================= ACTIVITY ================= */

        .activity-section {
            margin: 30px 0;
        }

        .activity-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
        }

        .activity-card {
            background: #ffffff;
            border: 1px solid rgba(6, 78, 59, 0.10);
            border-radius: 28px;
            padding: 26px;
            box-shadow: var(--shadow-soft);
            transition: 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .activity-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow);
        }

        .activity-number {
            width: 44px;
            height: 44px;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            font-size: 17px;
            font-weight: 950;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }

        .activity-card-head {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        .activity-card-head .activity-number {
            flex: 0 0 44px;
            margin-bottom: 0;
        }

        .activity-card-head h3 {
            margin: 0;
            min-width: 0;
        }

        .activity-card h3 {
            margin: 0 0 14px;
            color: var(--primary);
            font-size: 20px;
            font-weight: 950;
            line-height: 1.25;
        }

        .activity-card ul {
            margin: 0;
            padding-left: 18px;
        }

        .activity-card li {
            margin-bottom: 9px;
            color: #475569;
            line-height: 1.65;
            font-size: 14px;
        }

        .activity-card ul ul {
            margin-top: 7px;
            margin-bottom: 8px;
            padding-left: 18px;
        }

        .activity-card em {
            color: var(--primary);
            font-weight: 900;
        }

        /* ================= CONTACT & MAP ================= */

        .contact-list {
            display: grid;
            gap: 16px;
        }

        .contact-line {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            color: #475569;
            line-height: 1.6;
            padding: 14px;
            border-radius: 18px;
            background: #f8fffb;
            border: 1px solid #dbe7dd;
        }

        .contact-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: var(--soft);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
            border: 1px solid #bbf7d0;
        }

        .contact-line strong {
            color: var(--primary);
            font-weight: 950;
        }

        .contact-line a {
            color: var(--primary-2);
            text-decoration: none;
            font-weight: 900;
        }

        .contact-line a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        .social-section {
            margin-top: 26px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        .social-section h3 {
            color: var(--primary);
            margin: 0 0 16px;
            font-size: 22px;
            font-weight: 950;
        }

        .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 16px;
            font-weight: 950;
            text-decoration: none;
            transition: 0.25s ease;
        }

        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-soft);
        }

        .social-link.instagram {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
        }

        .social-link.tiktok {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            color: #0f172a;
        }

        .social-link.youtube {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .social-link.whatsapp {
            background: #ecfdf5;
            border: 1px solid #86efac;
            color: #15803d;
        }

        .social-link i {
            font-size: 18px;
        }

        .map-frame {
            width: 100%;
            height: 430px;
            border: 0;
            border-radius: 24px;
            margin-top: 10px;
            box-shadow: var(--shadow-soft);
        }

        .map-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 18px;
            padding: 13px 18px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            font-weight: 950;
            transition: 0.25s ease;
            box-shadow: 0 12px 26px rgba(6, 78, 59, 0.18);
        }

        .map-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 32px rgba(6, 78, 59, 0.22);
        }

        /* ================= CTA FOOTER ================= */

        .cta-consistent {
            margin: 56px auto 0;
            max-width: 1420px;
            padding: 0 7%;
        }

        .cta-consistent-box {
            background: linear-gradient(135deg, #065f46 0%, #0f766e 55%, #2f9e63 100%);
            border-radius: 34px;
            padding: 52px 42px;
            box-shadow: 0 18px 40px rgba(6, 95, 70, 0.18);
            position: relative;
            overflow: hidden;
        }

        .cta-consistent-box::before {
            content: "";
            position: absolute;
            top: -40px;
            right: -40px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }

        .cta-consistent-box::after {
            content: "";
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .cta-consistent-inner {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 28px;
            flex-wrap: wrap;
        }

        .cta-consistent-content {
            flex: 1 1 620px;
        }

        .cta-consistent-content h2 {
            margin: 0 0 16px;
            font-size: clamp(32px, 3vw, 58px);
            line-height: 1.15;
            font-weight: 900;
            color: #ffffff;
        }

        .cta-consistent-content p {
            margin: 0;
            max-width: 760px;
            color: rgba(255,255,255,0.90);
            font-size: 17px;
            line-height: 1.8;
        }

        .cta-consistent-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 16px;
            flex: 0 0 auto;
            flex-wrap: wrap;
        }

        .cta-consistent-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 190px;
            min-height: 58px;
            padding: 0 28px;
            border-radius: 999px;
            font-size: 16px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.25s ease;
            border: 2px solid transparent;
        }

        .cta-consistent-btn-primary {
            background: #ffffff;
            color: #065f46;
            box-shadow: 0 10px 24px rgba(0,0,0,0.12);
        }

        .cta-consistent-btn-primary:hover {
            transform: translateY(-3px);
            background: #f8fafc;
        }

        .cta-consistent-btn-outline {
            background: transparent;
            color: #ffffff;
            border-color: rgba(255,255,255,0.75);
        }

        .cta-consistent-btn-outline:hover {
            transform: translateY(-3px);
            background: rgba(255,255,255,0.10);
            border-color: #ffffff;
        }

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
            grid-template-columns: 1.4fr 1fr 1fr;
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
            .activity-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

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

            .info-wrapper {
                padding: 62px 5%;
            }

            .info-two-column,
            .activity-grid {
                grid-template-columns: 1fr;
            }

            .info-row {
                flex-direction: column;
                gap: 4px;
            }

            .info-row span:last-child {
                white-space: normal;
            }

            .map-frame {
                height: 330px;
            }

            .cta-consistent-box {
                padding: 38px 22px;
            }

            .cta-consistent-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .cta-consistent-actions {
                justify-content: flex-start;
                width: 100%;
            }

            .cta-consistent-btn {
                width: 100%;
                min-width: 100%;
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

        .section-heading::before {
            content: "" !important;
            position: absolute !important;
            left: -120px !important;
            bottom: -145px !important;
            width: 300px !important;
            height: 300px !important;
            border-radius: 999px !important;
            border: 46px solid rgba(6, 78, 59, 0.045) !important;
            pointer-events: none !important;
            z-index: 0 !important;
        }

        .section-heading::after {
            content: "" !important;
            position: absolute !important;
            top: 52px !important;
            right: 8% !important;
            width: 190px !important;
            height: 190px !important;
            background-image: radial-gradient(rgba(163, 230, 53, 0.76) 2px, transparent 2px) !important;
            background-size: 16px 16px !important;
            opacity: 0.38 !important;
            pointer-events: none !important;
            z-index: 0 !important;
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

            .section-heading::before {
                left: -165px !important;
                bottom: -170px !important;
            }

            .section-heading::after {
                top: 34px !important;
                right: -24px !important;
                width: 132px !important;
                height: 132px !important;
                background-size: 13px 13px !important;
                opacity: 0.30 !important;
            }

            .section-heading h2 {
                font-size: 34px !important;
            }

            .section-heading p {
                font-size: 15px !important;
            }
        }

        /* ==================================================
           HERO INFORMASI FINAL
           Samakan ukuran judul dengan halaman Syarat dan Daftar
           ================================================== */

        .page-hero {
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

        .page-hero::before {
            top: 52px !important;
            right: 8% !important;
            width: 190px !important;
            height: 190px !important;
            background-image: radial-gradient(rgba(163, 230, 53, 0.76) 2px, transparent 2px) !important;
            background-size: 16px 16px !important;
            opacity: 0.38 !important;
            pointer-events: none !important;
            z-index: 0 !important;
        }

        .page-hero::after {
            left: -120px !important;
            bottom: -145px !important;
            width: 300px !important;
            height: 300px !important;
            border: 46px solid rgba(6, 78, 59, 0.045) !important;
            pointer-events: none !important;
            z-index: 0 !important;
        }

        .page-hero > * {
            position: relative !important;
            z-index: 1 !important;
        }

        .page-badge {
            background: transparent !important;
            border: 1px solid rgba(163, 230, 53, 0.72) !important;
            color: #064e3b !important;
            font-size: 15px !important;
            font-weight: 950 !important;
            box-shadow: 0 12px 28px rgba(6, 78, 59, 0.08) !important;
            margin-bottom: 24px !important;
        }

        .page-badge::before {
            width: 26px !important;
            height: 14px !important;
            flex: 0 0 26px !important;
            background: linear-gradient(90deg, var(--lime), var(--primary)) !important;
        }

        .page-hero h1 {
            margin: 0 0 18px !important;
            color: #064e3b !important;
            font-size: clamp(38px, 4.1vw, 62px) !important;
            line-height: 1.1 !important;
            letter-spacing: 0 !important;
            font-weight: 950 !important;
        }

        .page-hero p {
            max-width: 860px !important;
            margin: 0 auto !important;
            color: #475569 !important;
            font-size: 17px !important;
            line-height: 1.8 !important;
        }

        @media (max-width: 950px) {
            .page-hero {
                padding: 38px 24px 40px !important;
                border-radius: 26px !important;
                margin-bottom: 34px !important;
            }

            .page-hero::before {
                top: 34px !important;
                right: -24px !important;
                width: 132px !important;
                height: 132px !important;
                background-size: 13px 13px !important;
                opacity: 0.30 !important;
            }

            .page-hero::after {
                left: -165px !important;
                bottom: -170px !important;
            }

            .page-hero h1 {
                font-size: 34px !important;
            }

            .page-hero p {
                font-size: 15px !important;
            }
        }

        /* ==================================================
           INFORMASI CONTENT WIDTH FINAL
           Samakan lebar semua area kotak dengan hero informasi
           ================================================== */

        .page-container,
        .content-container {
            width: 100% !important;
            max-width: 1420px !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .info-two-column,
        .activity-section,
        .activity-grid,
        .cta-modern {
            width: 100% !important;
        }

        .info-card,
        .activity-card {
            min-width: 0 !important;
        }

        .page-hero::before,
        .page-hero::after,
        .section-heading::before,
        .section-heading::after {
            display: none !important;
            content: none !important;
        }

        @media (max-width: 950px) {
            .page-container,
            .content-container {
                width: 100% !important;
                max-width: 100% !important;
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
            justify-content: flex-start !important;
            align-items: center !important;
            gap: 16px !important;
            flex-wrap: nowrap !important;
            text-align: left !important;
        }

        .cta-actions a,
        .syarat-note-actions a {
            white-space: nowrap !important;
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
           FOOTER BRAND TITLE FINAL
           Samakan judul pondok dengan halaman syarat/daftar/login
           ================================================== */

        .footer-modern .footer-brand .footer-brand-text h3 {
            font-size: 22px !important;
            line-height: 1.35 !important;
            font-weight: 950 !important;
            letter-spacing: 0.2px !important;
        }

        @media (max-width: 768px) {
            .footer-modern .footer-brand .footer-brand-text h3 {
                font-size: 19px !important;
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
            width: min(1120px, calc(100% - 48px)) !important;
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

        .info-two-column,
        .activity-grid {
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

        .info-card-content {
            padding: 28px !important;
        }

        .activity-card {
            padding: 24px !important;
        }

        .activity-card-head {
            gap: 12px !important;
            margin-bottom: 16px !important;
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
                width: min(820px, calc(100% - 32px)) !important;
                max-width: 820px !important;
                padding: 30px 24px 32px !important;
                border-radius: 24px !important;
            }

            .info-card-content,
            .activity-card {
                padding: 22px !important;
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
            .page-container,
            .page-hero,
            .section-heading {
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

            .info-card,
            .activity-card,
            .cta-modern,
            .syarat-note {
                border-radius: 20px !important;
            }

            .info-card-content,
            .activity-card {
                padding: 18px !important;
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

            .info-wrapper {
                padding: 40px 0 52px !important;
            }

            .info-row {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 5px !important;
            }

            .info-row span:last-child {
                white-space: normal !important;
            }

            .activity-grid {
                grid-template-columns: 1fr !important;
            }

            .activity-card-head {
                align-items: flex-start !important;
            }

            .contact-line {
                padding: 12px !important;
            }

            .social-links {
                display: grid !important;
                grid-template-columns: 1fr !important;
            }

            .social-link,
            .map-button {
                width: 100% !important;
                justify-content: center !important;
                text-align: center !important;
            }

            .map-frame {
                height: 300px !important;
                min-height: 300px !important;
            }

            .cta-modern {
                grid-template-columns: 1fr !important;
                gap: 22px !important;
                text-align: left !important;
            }

            .cta-actions {
                flex-direction: column !important;
                align-items: stretch !important;
            }

            .cta-btn {
                width: 100% !important;
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
           INFORMASI HERO FONT FINAL
           ================================================== */

        .info-wrapper .page-hero h1 {
            max-width: 980px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            font-size: clamp(30px, 3vw, 46px) !important;
            line-height: 1.16 !important;
            font-weight: 800 !important;
            letter-spacing: 0 !important;
        }

        .info-wrapper .page-hero p {
            max-width: 920px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            font-size: 16px !important;
            line-height: 1.7 !important;
        }

        .info-wrapper .page-badge {
            font-size: 14px !important;
            line-height: 1.2 !important;
        }

        @media (max-width: 768px) {
            .info-wrapper .page-hero h1 {
                max-width: 620px !important;
                font-size: 30px !important;
                line-height: 1.22 !important;
            }

            .info-wrapper .page-hero p {
                max-width: 620px !important;
                font-size: 14.5px !important;
                line-height: 1.65 !important;
            }
        }

        @media (max-width: 420px) {
            .info-wrapper .page-hero h1 {
                font-size: 27px !important;
            }

            .info-wrapper .page-badge {
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

    $alamatPondok = 'Pondok Pesantren Tahfidzul Quran Darul Furqon, Malang, Jawa Timur.';

    $pesanWa = rawurlencode(
        "Assalamu'alaikum, saya ingin bertanya mengenai informasi pendaftaran santri baru Pondok Pesantren Tahfidzul Quran Darul Furqon."
    );

    $instagramUrl = 'https://www.instagram.com/darulfurqon10?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==';
    $tiktokUrl = 'https://www.tiktok.com/@pptq.darul.furqon3?is_from_webapp=1&sender_device=pc';
    $youtubeUrl = 'https://www.youtube.com/@darulfurqon';

    $mapsUrl = 'https://www.google.com/maps/search/?api=1&query=Pondok%20Pesantren%20Tahfidzul%20Quran%20Darul%20Furqon%20Malang';
@endphp

@include('partials.public-navbar')

<main class="info-wrapper">
    <div class="page-hero">
        <div class="page-badge">Informasi Pendaftaran</div>
        <h1>Informasi Pendaftaran Santri Baru</h1>
        <p>
            Informasi biaya, kegiatan santri, kontak, dan lokasi Pondok Pesantren
            Tahfidzul Quran Darul Furqon Malang.
        </p>
    </div>

    <div class="page-container">
        <div class="info-two-column">
            <section class="info-card">
                <div class="info-card-content">
                    <h2>Biaya Pendaftaran</h2>

                    <div class="info-total">
                        <span>Total Pembayaran Awal</span>
                        Rp. 2.650.000,-
                    </div>

                    <div class="info-row">
                        <span>Uang Ma'had / Infaq Pesantren</span>
                        <span>Rp. 2.000.000,-</span>
                    </div>

                    <div class="info-row">
                        <span>Almamater</span>
                        <span>Rp. 200.000,-</span>
                    </div>

                    <div class="info-row">
                        <span>Syahriyyah Bulanan</span>
                        <span>Rp. 450.000,-</span>
                    </div>
                </div>
            </section>

            <section class="info-card">
                <div class="info-card-content">
                    <h2>Biaya Bulanan / Syahriyyah</h2>

                    <div class="info-total">
                        <span>Total Syahriyyah</span>
                        Rp. 450.000,-
                    </div>

                    <div class="info-row">
                        <span>Makan pagi dan sore</span>
                        <span>Termasuk</span>
                    </div>

                    <div class="info-row">
                        <span>Pembayaran listrik</span>
                        <span>Termasuk</span>
                    </div>

                    <div class="info-row">
                        <span>Pembayaran air / PDAM</span>
                        <span>Termasuk</span>
                    </div>

                    <div class="info-row">
                        <span>Wi-Fi</span>
                        <span>Termasuk</span>
                    </div>
                </div>
            </section>
        </div>

        <section class="activity-section">
            <div class="section-heading">
                <div class="mini-label">Kegiatan Pondok</div>
                <h2>Kegiatan Santri</h2>
                <p>
                    Kegiatan santri dirancang untuk membentuk kedisiplinan, akhlak, dan peningkatan hafalan Al-Quran.
                </p>
            </div>

            <div class="activity-grid">
                <div class="activity-card">
                    <div class="activity-card-head">
                        <div class="activity-number">1</div>
                        <h3>Kegiatan Harian</h3>
                    </div>
                    <ul>
                        <li>Setoran hafalan ba'da Shubuh.</li>
                        <li>Setoran muroja'ah ba'da Ashar dan ba'da Isya'.</li>
                        <li><em>Ziyadah minimal 1 halaman dan muroja'ah maksimal 5 halaman.</em></li>
                        <li>Sholat berjama'ah.</li>
                        <li>Tasmi' pagi.</li>
                    </ul>
                </div>

                <div class="activity-card">
                    <div class="activity-card-head">
                        <div class="activity-number">2</div>
                        <h3>Kegiatan Pekanan</h3>
                    </div>
                    <ul>
                        <li>Pengajian kitab: Tibyan fi Adab, Risalatul Mahid, Adabul Alim wal Muta'alim, Lubabul Hadist.</li>
                        <li>Muhadhoroh.</li>
                        <li>Pembacaan Surah Yasin, Tahlil, Diba', Burdah, dan lainnya.</li>
                        <li>Senam pagi setiap Sabtu.</li>
                        <li>Ro'an pesantren setiap Ahad pagi.</li>
                    </ul>
                </div>

                <div class="activity-card">
                    <div class="activity-card-head">
                        <div class="activity-number">3</div>
                        <h3>Kegiatan Bulanan</h3>
                    </div>
                    <ul>
                        <li>Khataman awal bulan.</li>
                        <li>Ziaroh makam auliya'.</li>
                    </ul>
                </div>

                <div class="activity-card">
                    <div class="activity-card-head">
                        <div class="activity-number">4</div>
                        <h3>Kegiatan Tahunan</h3>
                    </div>
                    <ul>
                        <li>Ziaroh Walisongo.</li>
                        <li>Wisuda Tahfidz.</li>
                        <li>PHBI dan PHBN.</li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="info-two-column">
            <section class="info-card">
                <div class="info-card-content">
                    <h2>Informasi Kontak</h2>

                    <div class="contact-list">
                        <div class="contact-line">
                            <div class="contact-icon">☎</div>
                            <div>
                                <strong>Telepon / WhatsApp:</strong><br>
                                <a href="https://wa.me/{{ $waLink }}?text={{ $pesanWa }}" target="_blank">
                                    {{ $waDisplay }}
                                </a>
                            </div>
                        </div>

                        <div class="contact-line">
                            <div class="contact-icon">✉</div>
                            <div>
                                <strong>Email:</strong><br>
                                <a href="mailto:{{ $emailPondok }}?subject=Informasi%20Pendaftaran%20Santri%20Baru">
                                    {{ $emailPondok }}
                                </a>
                            </div>
                        </div>

                        <div class="contact-line">
                            <div class="contact-icon">⏰</div>
                            <div>
                                <strong>Jam Layanan:</strong><br>
                                <span>08.00 - 16.00 WIB</span>
                            </div>
                        </div>

                        <div class="contact-line">
                            <div class="contact-icon">📍</div>
                            <div>
                                <strong>Alamat:</strong><br>
                                <a href="{{ $mapsUrl }}" target="_blank">
                                    {{ $alamatPondok }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="social-section">
                        <h3>Media Sosial Pondok</h3>

                        <div class="social-links">
                            <a href="{{ $instagramUrl }}" target="_blank" class="social-link instagram">
                                <i class="fa-brands fa-instagram"></i> Instagram
                            </a>

                            <a href="{{ $tiktokUrl }}" target="_blank" class="social-link tiktok">
                                <i class="fa-brands fa-tiktok"></i> TikTok
                            </a>

                            <a href="{{ $youtubeUrl }}" target="_blank" class="social-link youtube">
                                <i class="fa-brands fa-youtube"></i> YouTube
                            </a>

                            <a href="https://wa.me/{{ $waLink }}" target="_blank" class="social-link whatsapp">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="info-card">
                <div class="info-card-content">
                    <h2>Lokasi Pondok Pesantren</h2>

                    <p class="info-desc">
                        Lokasi Pondok Pesantren Tahfidzul Quran Darul Furqon dapat dilihat melalui peta berikut.
                    </p>

                    <iframe
                        class="map-frame"
                        src="https://www.google.com/maps?q=Pondok%20Pesantren%20Tahfidzul%20Quran%20Darul%20Furqon%20Malang&output=embed"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <a href="{{ $mapsUrl }}" target="_blank" class="map-button">
                        Buka Lokasi di Google Maps
                    </a>
                </div>
            </section>
        </div>

        <section class="cta-modern">
            <div>
                <h2>Siap Melakukan Pendaftaran?</h2>
                <p>
                    Setelah memahami informasi biaya, kegiatan, kontak, dan lokasi pondok,
                    calon santri dapat langsung melakukan pendaftaran secara online.
                </p>
            </div>

            <div class="cta-actions">
                <a href="{{ route('daftar.create') }}" class="cta-btn cta-btn-light">Daftar Sekarang</a>
                <a href="{{ route('beranda') }}" class="cta-btn cta-btn-outline">Kembali ke Beranda</a>
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
