<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pondok Pesantren Tahfidzul Quran Darul Furqon</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary: #0f5132;
            --primary-2: #166534;
            --primary-dark: #052e1b;
            --lime: #a3e635;
            --lime-soft: #ecfccb;
            --soft-green: #ecfdf5;
            --bg-soft: #f7fbf8;
            --white: #ffffff;
            --text: #102033;
            --muted: #64748b;
            --border: #e5e7eb;
            --shadow: 0 22px 55px rgba(15, 81, 50, 0.12);
            --shadow-soft: 0 12px 32px rgba(15, 81, 50, 0.08);
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
            background: var(--bg-soft);
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

        /* =========================
           HERO
        ========================= */

        .hero-modern {
            position: relative;
            padding: 88px 7% 72px;
            background:
                radial-gradient(circle at top left, rgba(20, 108, 67, 0.08), transparent 32%),
                radial-gradient(circle at bottom right, rgba(192, 139, 44, 0.10), transparent 32%),
                #f7fbf8;
            overflow: hidden;
            border-bottom: 1px solid rgba(15, 81, 50, 0.08);
        }

        .hero-modern::before {
            content: "";
            position: absolute;
            top: 64px;
            right: 5%;
            width: 120px;
            height: 120px;
            background-image: radial-gradient(rgba(163, 230, 53, 0.18) 2px, transparent 2px);
            background-size: 14px 14px;
            opacity: 0.35;
        }

        .hero-modern-container {
            position: relative;
            z-index: 2;
            max-width: 1420px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(500px, 650px);
            gap: 72px;
            align-items: center;
        }

        .hero-content {
            max-width: 720px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 11px 19px;
            border-radius: 999px;
            background: #ffffff;
            border: 1px solid #d9f99d;
            color: var(--primary);
            font-size: 14px;
            font-weight: 950;
            box-shadow: var(--shadow-soft);
            margin-bottom: 24px;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
            animation-delay: 0.1s;
        }

        .hero-badge span {
            width: 24px;
            height: 13px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--lime), var(--primary));
            display: inline-block;
        }

        .hero-content h1 {
            margin: 0;
            color: var(--primary-dark);
            font-size: clamp(34px, 3.2vw, 52px);
            line-height: 1.12;
            letter-spacing: -0.8px;
            font-weight: 950;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
            animation-delay: 0.15s;
        }

        .hero-content h1 strong {
            color: #65a30d;
            font-weight: 950;
        }

        .hero-content p {
            max-width: 660px;
            margin: 24px 0 32px;
            color: #4b5563;
            font-size: 18px;
            line-height: 1.85;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
            animation-delay: 0.2s;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 30px;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
            animation-delay: 0.25s;
        }

        .reveal {
            opacity: 0;
            transform: translateY(28px);
            will-change: opacity, transform;
        }

        .reveal.active {
            animation: fadeInUp 0.8s ease forwards;
        }

        .hero-collage {
            position: relative;
            width: 100%;
            max-width: 650px;
            height: 620px;
            margin-left: auto;
            animation: float 12s ease-in-out infinite;
        }

        .collage-box {
            position: absolute;
            background-size: cover;
            background-repeat: no-repeat;
            border: 9px solid #ffffff;
            overflow: hidden;
            box-shadow: 0 24px 48px rgba(15, 81, 50, 0.20);
            opacity: 0;
            animation: fadeInUp 0.85s ease forwards;
        }

        .box-1 {
            animation-delay: 0.2s;
        }

        .box-2 {
            animation-delay: 0.30s;
        }

        .box-3 {
            animation-delay: 0.35s;
        }

        .box-4 {
            animation-delay: 0.40s;
        }

        .hero-spark {
            position: absolute;
            z-index: 6;
            color: var(--lime);
            line-height: 1;
            text-shadow: 0 12px 26px rgba(163, 230, 53, 0.30);
            animation: sparkle 2.6s ease-in-out infinite alternate;
        }

        .hero-stat {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 26px 32px;
            border-right: 1px solid #dbe7dd;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        .hero-stat:nth-child(1) {
            animation-delay: 0.22s;
        }

        .hero-stat:nth-child(2) {
            animation-delay: 0.28s;
        }

        .hero-stat:nth-child(3) {
            animation-delay: 0.34s;
        }

        .hero-stat:nth-child(4) {
            animation-delay: 0.40s;
        }

        .step-card {
            position: relative;
            min-height: 220px;
            padding: 28px;
            border-radius: 26px;
            background: #ffffff;
            border: 1px solid rgba(15, 81, 50, 0.08);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            transition: 0.25s ease;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        .step-card:nth-child(1) {
            animation-delay: 0.18s;
        }

        .step-card:nth-child(2) {
            animation-delay: 0.24s;
        }

        .step-card:nth-child(3) {
            animation-delay: 0.30s;
        }

        .step-card:nth-child(4) {
            animation-delay: 0.36s;
        }

        .step-card:nth-child(5) {
            animation-delay: 0.42s;
        }

        .step-card:nth-child(6) {
            animation-delay: 0.48s;
        }

        .gallery-item {
            width: 270px;
            height: 165px;
            border-radius: 22px;
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: var(--shadow-soft);
            border: 6px solid #ffffff;
            background: #ffffff;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        .gallery-item:nth-child(1) {
            animation-delay: 0.18s;
        }

        .gallery-item:nth-child(2) {
            animation-delay: 0.22s;
        }

        .gallery-item:nth-child(3) {
            animation-delay: 0.26s;
        }

        .gallery-item:nth-child(4) {
            animation-delay: 0.30s;
        }

        .footer-modern {
            padding: 28px 7%;
            text-align: center;
            background: var(--primary-dark);
            color: rgba(255, 255, 255, 0.82);
            opacity: 0;
            animation: fadeInUp 0.9s ease forwards;
            animation-delay: 0.4s;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 54px;
            padding: 0 30px;
            border-radius: 999px;
            font-size: 16px;
            font-weight: 950;
            transition: 0.25s ease;
        }

        .hero-btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            box-shadow: 0 16px 32px rgba(15, 81, 50, 0.22);
        }

        .hero-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(15, 81, 50, 0.26);
        }

        .hero-btn-outline {
            background: #ffffff;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .hero-btn-outline:hover {
            background: var(--primary);
            color: #ffffff;
            transform: translateY(-3px);
        }

        .hero-features {
            max-width: 760px;
            padding: 15px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.86);
            border: 1px solid rgba(15, 81, 50, 0.08);
            box-shadow: var(--shadow-soft);
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .hero-feature {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 205px;
        }

        .hero-feature-icon {
            width: 43px;
            height: 43px;
            border-radius: 14px;
            background: var(--soft-green);
            border: 1px solid #bbf7d0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .hero-feature strong {
            display: block;
            color: var(--primary);
            font-size: 14px;
            font-weight: 950;
        }

        .hero-feature small {
            display: block;
            color: var(--muted);
            font-size: 12px;
            margin-top: 2px;
        }

        /* =========================
           HERO COLLAGE
        ========================= */

        .hero-image-area {
            min-height: 630px;
            position: relative;
        }

        .hero-collage {
            position: relative;
            width: 100%;
            max-width: 650px;
            height: 620px;
            margin-left: auto;
        }

        .collage-box {
            position: absolute;
            background-size: cover;
            background-repeat: no-repeat;
            border: 9px solid #ffffff;
            overflow: hidden;
            box-shadow: 0 24px 48px rgba(15, 81, 50, 0.20);
        }

        .collage-box::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(15,81,50,0.08));
            pointer-events: none;
        }

        .box-1 {
            width: 360px;
            height: 405px;
            right: 0;
            bottom: 34px;
            border-radius: 42px;
            background-position: center center;
        }

        .box-2 {
            width: 340px;
            height: 205px;
            right: 70px;
            top: 0;
            border-radius: 42px;
            background-position: center top;
        }

        .box-3 {
            width: 315px;
            height: 330px;
            left: 10px;
            top: 176px;
            border-radius: 38px;
            background-position: left center;
        }

        .box-4 {
            width: 245px;
            height: 170px;
            left: 155px;
            bottom: 0;
            border-radius: 32px;
            background-position: center bottom;
        }

        .hero-seal {
            position: absolute;
            left: -14px;
            bottom: 138px;
            width: 138px;
            height: 138px;
            border-radius: 999px;
            background: var(--primary);
            color: #ffffff;
            border: 8px solid #ffffff;
            box-shadow: 0 20px 40px rgba(15, 81, 50, 0.26);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            z-index: 5;
            text-align: center;
        }

        .hero-seal span {
            width: 45px;
            height: 45px;
            border-radius: 999px;
            background: var(--lime);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 7px;
            font-size: 20px;
        }

        .hero-seal small {
            font-size: 12px;
            font-weight: 950;
            line-height: 1.25;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-spark {
            position: absolute;
            z-index: 6;
            color: var(--lime);
            line-height: 1;
            text-shadow: 0 12px 26px rgba(163, 230, 53, 0.30);
        }

        .spark-1 {
            right: -32px;
            bottom: 138px;
            font-size: 72px;
        }

        .spark-2 {
            right: 34px;
            bottom: 88px;
            font-size: 40px;
        }

        /* =========================
           STATS
        ========================= */

        .hero-stats {
            position: relative;
            z-index: 3;
            max-width: 1180px;
            margin: 58px auto 0;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(15, 81, 50, 0.08);
            border-radius: 32px;
            box-shadow: var(--shadow-soft);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            overflow: hidden;
        }

        .hero-stat {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 26px 32px;
            border-right: 1px solid #dbe7dd;
        }

        .hero-stat:last-child {
            border-right: none;
        }

        .hero-stat-icon {
            font-size: 34px;
        }

        .hero-stat strong {
            display: block;
            color: var(--primary-dark);
            font-size: 28px;
            font-weight: 950;
            line-height: 1;
        }

        .hero-stat small {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 14px;
        }

        /* =========================
           SECTION GLOBAL
        ========================= */

        .home-section {
            padding: 76px 7%;
            background: var(--bg-soft);
        }

        .home-section.white {
            background: #ffffff;
        }

        .section-heading {
            max-width: 860px;
            margin: 0 auto 40px;
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
            width: 22px;
            height: 12px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--lime), var(--primary));
        }

        .section-heading h2 {
            margin: 0 0 12px;
            color: var(--primary);
            font-size: clamp(30px, 2.6vw, 42px);
            line-height: 1.2;
            font-weight: 950;
        }

        .section-heading p {
            margin: 0 auto;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.75;
        }

        /* =========================
           ALUR
        ========================= */

        .steps-grid {
            max-width: 1420px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .step-card {
            position: relative;
            min-height: 220px;
            padding: 28px;
            border-radius: 26px;
            background: #ffffff;
            border: 1px solid rgba(15, 81, 50, 0.08);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            transition: 0.25s ease;
        }

        .step-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow);
        }

        .step-card::after {
            content: "";
            position: absolute;
            right: -50px;
            top: -50px;
            width: 120px;
            height: 120px;
            border-radius: 999px;
            background: rgba(163, 230, 53, 0.22);
        }

        .step-number {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: var(--primary);
            color: #ffffff;
            font-size: 16px;
            font-weight: 950;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }

        .step-card h3 {
            margin: 0 0 10px;
            color: var(--primary);
            font-size: 21px;
            font-weight: 950;
        }

        .step-card p {
            margin: 0;
            color: #4b5563;
            font-size: 15px;
            line-height: 1.72;
        }

        /* =========================
           GALERI
        ========================= */

        .gallery-section {
            overflow: hidden;
        }

        .gallery-wrapper {
            max-width: 1420px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 28px;
        }

        .gallery-track {
            display: flex;
            gap: 20px;
            width: max-content;
            animation: galleryMove 32s linear infinite;
        }

        .gallery-wrapper:hover .gallery-track {
            animation-play-state: paused;
        }

        .gallery-item {
            width: 270px;
            height: 165px;
            border-radius: 22px;
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: var(--shadow-soft);
            border: 6px solid #ffffff;
            background: #ffffff;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: 0.35s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.07);
        }

        @keyframes galleryMove {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-50%);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-12px);
            }
        }

        @keyframes sparkle {
            from {
                opacity: 0.82;
                transform: translateY(0) scale(1);
            }
            to {
                opacity: 1;
                transform: translateY(-6px) scale(1.05);
            }
        }

        /* =========================
           CTA
        ========================= */

        .cta-modern {
            max-width: 1420px;
            margin: 0 auto 76px;
            padding: 54px 7%;
            border-radius: 34px;
            background:
                radial-gradient(circle at top right, rgba(163, 230, 53, 0.22), transparent 32%),
                linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .cta-modern h2 {
            margin: 0 0 12px;
            font-size: clamp(30px, 2.8vw, 44px);
            line-height: 1.2;
            font-weight: 950;
        }

        .cta-modern p {
            max-width: 720px;
            margin: 0 auto 26px;
            color: rgba(255, 255, 255, 0.82);
            font-size: 16px;
            line-height: 1.75;
        }

        .cta-actions {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 14px;
        }

        .cta-btn {
            min-height: 50px;
            padding: 0 24px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
            transition: 0.25s ease;
        }

        .cta-btn-light {
            background: #ffffff;
            color: var(--primary);
        }

        .cta-btn-outline {
            border: 2px solid rgba(255, 255, 255, 0.75);
            color: #ffffff;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
        }

        .footer-modern {
            padding: 28px 7%;
            text-align: center;
            background: var(--primary-dark);
            color: rgba(255, 255, 255, 0.82);
        }

        .footer-modern p {
            margin: 0;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1200px) {
            .hero-modern-container {
                grid-template-columns: 1fr;
                gap: 50px;
                text-align: center;
            }

            .hero-content {
                max-width: 900px;
                margin: 0 auto;
            }

            .hero-content p {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-actions,
            .hero-features {
                justify-content: center;
                margin-left: auto;
                margin-right: auto;
            }

            .hero-collage {
                margin: 0 auto;
            }

            .steps-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .hero-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-stat:nth-child(2) {
                border-right: none;
            }

            .hero-stat:nth-child(1),
            .hero-stat:nth-child(2) {
                border-bottom: 1px solid #dbe7dd;
            }
        }

        @media (max-width: 820px) {
            .site-navbar {
                padding: 14px 5%;
                min-height: auto;
                flex-direction: column;
                align-items: flex-start;
            }

            .site-brand span {
                white-space: normal;
                font-size: 13px;
            }

            .site-nav-links {
                width: 100%;
                gap: 12px;
                flex-wrap: wrap;
            }

            .site-nav-links a {
                font-size: 13px;
            }

            .nav-cta {
                padding: 9px 14px;
            }

            .hero-modern {
                padding: 52px 5% 48px;
            }

            .hero-content h1 {
                font-size: 32px;
                letter-spacing: -0.4px;
            }

            .hero-content p {
                font-size: 15px;
            }

            .hero-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-btn {
                width: 100%;
            }

            .hero-features {
                display: grid;
                grid-template-columns: 1fr;
            }

            .hero-feature {
                min-width: 0;
            }

            .hero-image-area {
                min-height: auto;
            }

            .hero-collage {
                height: auto;
                max-width: 100%;
                display: grid;
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .collage-box {
                position: relative;
                width: 100%;
                height: 250px;
                left: auto;
                right: auto;
                top: auto;
                bottom: auto;
                border-radius: 28px;
            }

            .box-4,
            .hero-seal,
            .hero-spark {
                display: none;
            }

            .hero-stats {
                grid-template-columns: 1fr;
                margin-top: 36px;
                border-radius: 24px;
            }

            .hero-stat {
                border-right: none;
                border-bottom: 1px solid #dbe7dd;
            }

            .hero-stat:last-child {
                border-bottom: none;
            }

            .home-section {
                padding: 58px 5%;
            }

            .steps-grid {
                grid-template-columns: 1fr;
            }

            .gallery-item {
                width: 220px;
                height: 138px;
            }

            .cta-modern {
                margin: 0 5% 58px;
                padding: 38px 22px;
            }
        }

    /* =========================
       GALERI FINAL
    ========================= */

    .gallery-section.reveal {
        padding: 80px 7%;
        background: linear-gradient(180deg, #f7fbf8 0%, #f1f8f3 100%);
        overflow: hidden;
    }

    .gallery-wrapper.reveal {
        max-width: 1420px;
        margin: 0 auto;
        overflow: hidden;
        position: relative;
        padding: 20px 0;
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(15, 81, 50, 0.08);
        border-radius: 28px;
    }

    .gallery-wrapper::before,
    .gallery-wrapper::after {
        content: "";
        position: absolute;
        top: 0;
        width: 120px;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }

    .gallery-wrapper::before {
        left: 0;
        background: linear-gradient(to right, #f3f8f4 0%, rgba(243,248,244,0) 100%);
    }

    .gallery-wrapper::after {
        right: 0;
        background: linear-gradient(to left, #f3f8f4 0%, rgba(243,248,244,0) 100%);
    }

    .gallery-track {
        display: flex;
        gap: 24px;
        width: max-content;
        animation: galleryMove 32s linear infinite;
        align-items: center;
    }

    .gallery-wrapper:hover .gallery-track {
        animation-play-state: paused;
    }

    .gallery-item.reveal {
        width: 340px;
        height: 220px;
        border-radius: 26px;
        overflow: hidden;
        flex-shrink: 0;
        background: #ffffff;
        border: 1px solid rgba(15, 81, 50, 0.08);
        box-shadow: 0 10px 28px rgba(15, 81, 50, 0.07);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .gallery-item:nth-child(1) {
        animation-delay: 0.20s;
    }

    .gallery-item:nth-child(2) {
        animation-delay: 0.24s;
    }

    .gallery-item:nth-child(3) {
        animation-delay: 0.28s;
    }

    .gallery-item:nth-child(4) {
        animation-delay: 0.32s;
    }

    .gallery-item:nth-child(5) {
        animation-delay: 0.36s;
    }

    .gallery-item:nth-child(6) {
        animation-delay: 0.40s;
    }

    .gallery-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(15, 81, 50, 0.18);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.06);
    }

    @keyframes galleryMove {
        from {
            transform: translateX(0);
        }
        to {
            transform: translateX(-50%);
        }
    }

    /* =========================
       FOOTER FINAL
    ========================= */

    .footer-modern.reveal {
        background:
            radial-gradient(circle at top right, rgba(163, 230, 53, 0.15), transparent 22%),
            linear-gradient(135deg, #052e1b 0%, #0f5132 60%, #166534 100%);
        color: rgba(255,255,255,0.92);
        padding: 60px 7% 24px;
        margin-top: 70px;
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
        width: 52px;
        height: 52px;
        object-fit: contain;
        border-radius: 12px;
        background: rgba(255,255,255,0.08);
        padding: 6px;
    }

    .footer-brand-text h3 {
        margin: 0 0 10px;
        font-size: 20px;
        line-height: 1.3;
        font-weight: 800;
        color: #ffffff;
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
        font-weight: 800;
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
        color: #d9f99d;
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
        text-decoration: none;
        transition: 0.25s ease;
    }

    .footer-social a:hover {
        background: #a3e635;
        color: #0f5132;
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
        text-decoration: none;
        font-size: 14px;
        transition: 0.25s ease;
    }

    .footer-bottom-links a:hover {
        color: #d9f99d;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 992px) {
        .gallery-item {
            width: 300px;
            height: 200px;
        }

        .footer-container {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .gallery-section {
            padding: 60px 5%;
        }

        .gallery-item {
            width: 260px;
            height: 180px;
            border-radius: 20px;
        }

        .gallery-track {
            gap: 16px;
        }

        .footer-modern {
            padding: 50px 5% 22px;
        }

        .footer-container {
            grid-template-columns: 1fr;
            gap: 26px;
        }

        .footer-bottom {
            flex-direction: column;
            align-items: flex-start;
        }

        .footer-brand img {
            width: 46px;
            height: 46px;
        }
    }

    /* ==================================================
    FOOTER FINAL - SAMA DENGAN HALAMAN LAIN
    ================================================== */

    .footer-modern {
        background:
            radial-gradient(circle at top right, rgba(163, 230, 53, 0.15), transparent 22%),
            linear-gradient(135deg, #022c22 0%, #064e3b 55%, #0f766e 100%) !important;
        color: rgba(255,255,255,0.92) !important;
        padding: 60px 7% 24px !important;
        margin-top: 0 !important;
        text-align: left !important;
        opacity: 1 !important;
        animation: none !important;
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
        color: #d9f99d;
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
        text-decoration: none;
        transition: 0.25s ease;
    }

    .footer-social a:hover {
        background: #a3e635;
        color: #064e3b;
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
        text-decoration: none;
        font-size: 14px;
        transition: 0.25s ease;
    }

    .footer-bottom-links a:hover {
        color: #d9f99d;
    }

    @media (max-width: 1200px) {
        .footer-container {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .footer-modern {
            padding: 50px 5% 22px !important;
        }

        .footer-container {
            grid-template-columns: 1fr;
            gap: 28px;
        }

        .footer-bottom {
            flex-direction: column;
            align-items: flex-start;
        }

        .footer-brand img {
            width: 46px;
            height: 46px;
        }
    }

    /* ==================================================
    BACKGROUND BERANDA FINAL - SAMA SEPERTI LOGIN
    ================================================== */

    .hero-modern {
        position: relative !important;
        padding: 88px 7% 72px !important;
        background:
            radial-gradient(circle at 92% 10%, rgba(163, 230, 53, 0.30), transparent 30%),
            radial-gradient(circle at 0% 86%, rgba(15, 118, 110, 0.14), transparent 34%),
            linear-gradient(135deg, #ffffff 0%, #f0fdf4 55%, #fffdf4 100%) !important;
        overflow: hidden !important;
        border-bottom: none !important;
    }

    /* Pola titik-titik hijau di kanan seperti halaman login */
    .hero-modern::before {
        content: "" !important;
        position: absolute !important;
        top: 82px !important;
        right: 8% !important;
        width: 180px !important;
        height: 180px !important;
        background-image: radial-gradient(#a3e635 2px, transparent 2px) !important;
        background-size: 16px 16px !important;
        opacity: 0.45 !important;
        z-index: 1 !important;
    }

    /* Lingkaran besar lembut di kiri bawah seperti halaman login */
    .hero-modern::after {
        content: "" !important;
        position: absolute !important;
        left: -120px !important;
        bottom: -120px !important;
        width: 300px !important;
        height: 300px !important;
        border-radius: 999px !important;
        border: 45px solid rgba(6, 78, 59, 0.06) !important;
        z-index: 1 !important;
    }

    /* Supaya isi hero tetap di atas dekorasi background */
    .hero-modern-container {
        position: relative !important;
        z-index: 2 !important;
    }

    /* Supaya gambar kanan juga tetap di atas dekorasi */
    .hero-image-area,
    .hero-collage {
        position: relative !important;
        z-index: 3 !important;
    }

    /* Background section setelah hero dibuat lebih nyambung */
    .home-section {
        background: #ffffff !important;
    }

    .gallery-section,
    .home-section.gallery-section {
        background:
            radial-gradient(circle at top left, rgba(15, 118, 110, 0.07), transparent 30%),
            linear-gradient(180deg, #f7fbf8 0%, #f0fdf4 100%) !important;
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
       BERANDA COMPACT RESPONSIVE FINAL
       ================================================== */

    .hero-modern {
        padding: 64px 6% 52px !important;
    }

    .hero-modern-container,
    .steps-grid,
    .gallery-wrapper,
    .footer-container {
        width: min(1120px, calc(100% - 48px)) !important;
        max-width: 1120px !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    .hero-modern-container {
        grid-template-columns: minmax(0, 1fr) minmax(380px, 500px) !important;
        gap: 46px !important;
    }

    .hero-content {
        max-width: 600px !important;
    }

    .hero-content h1 {
        font-size: clamp(32px, 3vw, 46px) !important;
    }

    .hero-content p {
        max-width: 560px !important;
        margin: 18px 0 24px !important;
        font-size: 15.5px !important;
        line-height: 1.75 !important;
    }

    .hero-badge {
        padding: 9px 15px !important;
        font-size: 13.5px !important;
        margin-bottom: 18px !important;
    }

    .hero-btn {
        min-height: 48px !important;
        padding: 0 24px !important;
        font-size: 15px !important;
    }

    .hero-features {
        max-width: 620px !important;
        padding: 12px !important;
        border-radius: 20px !important;
        gap: 12px !important;
    }

    .hero-feature {
        min-width: 180px !important;
    }

    .hero-image-area {
        min-height: 500px !important;
    }

    .hero-collage {
        max-width: 500px !important;
        height: 500px !important;
    }

    .box-1 {
        width: 285px !important;
        height: 330px !important;
        border-radius: 34px !important;
    }

    .box-2 {
        width: 280px !important;
        height: 168px !important;
        right: 52px !important;
        border-radius: 34px !important;
    }

    .box-3 {
        width: 250px !important;
        height: 260px !important;
        top: 145px !important;
        border-radius: 32px !important;
    }

    .box-4 {
        width: 205px !important;
        height: 140px !important;
        left: 120px !important;
        border-radius: 28px !important;
    }

    .hero-seal {
        width: 112px !important;
        height: 112px !important;
        bottom: 112px !important;
    }

    .spark-1 {
        right: -18px !important;
        bottom: 116px !important;
        font-size: 56px !important;
    }

    .spark-2 {
        right: 28px !important;
        bottom: 76px !important;
        font-size: 34px !important;
    }

    .hero-stats {
        max-width: 960px !important;
        margin-top: 40px !important;
        border-radius: 24px !important;
    }

    .hero-stat {
        padding: 20px 24px !important;
    }

    .home-section,
    .gallery-section.reveal {
        padding: 58px 6% !important;
    }

    .section-heading {
        max-width: 740px !important;
        margin-bottom: 32px !important;
    }

    .section-heading h2 {
        font-size: clamp(28px, 2.6vw, 38px) !important;
    }

    .steps-grid {
        gap: 18px !important;
    }

    .step-card {
        min-height: 190px !important;
        padding: 22px !important;
        border-radius: 22px !important;
    }

    .gallery-wrapper {
        border-radius: 22px !important;
    }

    .gallery-track {
        gap: 16px !important;
    }

    .gallery-item {
        width: 225px !important;
        height: 140px !important;
        border-radius: 18px !important;
        border-width: 5px !important;
    }

    .cta-modern {
        width: min(1120px, calc(100% - 48px)) !important;
        max-width: 1120px !important;
        margin: 0 auto 58px !important;
        padding: 40px 44px !important;
        border-radius: 28px !important;
    }

    @media (max-width: 1200px) {
        .hero-modern-container {
            grid-template-columns: 1fr !important;
            max-width: 820px !important;
            text-align: center !important;
        }

        .hero-content,
        .hero-content p,
        .hero-features {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .hero-collage {
            margin: 0 auto !important;
        }
    }

    @media (max-width: 820px) {
        .hero-modern {
            padding: 46px 0 42px !important;
        }

        .hero-modern-container,
        .steps-grid,
        .gallery-wrapper,
        .footer-container,
        .cta-modern {
            width: min(820px, calc(100% - 32px)) !important;
            max-width: 820px !important;
        }

        .hero-content h1 {
            font-size: 31px !important;
        }

        .hero-actions {
            flex-direction: row !important;
            justify-content: center !important;
        }

        .hero-btn {
            width: auto !important;
            min-width: 150px !important;
        }

        .hero-features {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .home-section,
        .gallery-section.reveal {
            padding: 46px 0 !important;
        }

        .steps-grid {
            grid-template-columns: 1fr !important;
        }

        .cta-modern {
            padding: 32px 24px !important;
            border-radius: 24px !important;
        }
    }

    @media (max-width: 560px) {
        .hero-modern-container,
        .steps-grid,
        .gallery-wrapper,
        .footer-container,
        .cta-modern {
            width: calc(100% - 24px) !important;
            max-width: none !important;
        }

        .hero-actions,
        .cta-actions {
            flex-direction: column !important;
            align-items: stretch !important;
        }

        .hero-btn,
        .cta-btn {
            width: 100% !important;
        }

        .hero-features {
            grid-template-columns: 1fr !important;
        }

        .step-card,
        .cta-modern {
            border-radius: 20px !important;
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
    }

    @media (max-width: 560px) {
        .hero-image-area {
            min-height: 350px !important;
        }

        .hero-collage {
            max-width: 336px !important;
            height: 340px !important;
        }

        .box-1 {
            width: 198px !important;
            height: 230px !important;
            right: 0 !important;
            bottom: 22px !important;
            border-radius: 26px !important;
        }

        .box-2 {
            width: 190px !important;
            height: 118px !important;
            right: 42px !important;
            top: 0 !important;
            border-radius: 24px !important;
        }

        .box-3 {
            width: 178px !important;
            height: 190px !important;
            left: 0 !important;
            top: 104px !important;
            border-radius: 24px !important;
        }

        .box-4 {
            width: 150px !important;
            height: 96px !important;
            left: 86px !important;
            bottom: 0 !important;
            border-radius: 20px !important;
        }

        .hero-spark,
        .hero-seal {
            display: none !important;
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
    </style>
</head>

<body>

@php
    /*
        Pastikan gambar pondok berada di:
        public/assets/img/hero-pondok.png

        Jika nama file berbeda, ganti path di bawah ini.
    */
    $heroImage = asset('assets/img/hero-pondok.png');
@endphp
@include('partials.public-navbar')

<section class="hero-modern reveal">
    <div class="hero-modern-container">
        <div class="hero-content">
            <div class="hero-badge">
                <span></span>
                Penerimaan Santri Baru Online
            </div>

            <h1>
                Pendaftaran Online <br>
                Pondok Pesantren <br>
                Tahfidzul Quran <br>
                <strong>Darul Furqon</strong>
            </h1>

            <p>
                Membentuk generasi Qurani yang berilmu, berakhlak mulia,
                dan siap menjadi pribadi yang mandiri melalui pendidikan Islam
                terpadu di lingkungan pondok pesantren.
            </p>

            <div class="hero-actions">
                <a href="{{ route('daftar.create') }}" class="hero-btn hero-btn-primary">
                    Daftar Sekarang <span>→</span>
                </a>

                <a href="{{ url('/login?role=santri') }}" class="hero-btn hero-btn-outline">
                    Cek Status
                </a>
            </div>
        </div>

        <div class="hero-image-area">
            <div class="hero-collage">
                <div class="collage-box box-1" style="background-image: url('{{ $heroImage }}');"></div>
                <div class="collage-box box-2" style="background-image: url('{{ $heroImage }}');"></div>
                <div class="collage-box box-3" style="background-image: url('{{ $heroImage }}');"></div>
                <div class="collage-box box-4" style="background-image: url('{{ $heroImage }}');"></div>
                <div class="hero-spark spark-1">✦</div>
                <div class="hero-spark spark-2">✦</div>
            </div>
        </div>
    </div>
</section>

<section class="home-section white">
    <div class="section-heading reveal">
        <div class="mini-label">Alur Pendaftaran</div>
        <h2>Alur Pendaftaran Online</h2>
        <p>
            Pendaftaran santri baru dilakukan secara online mulai dari pengisian formulir,
            upload dokumen, upload bukti pembayaran, hingga verifikasi admin.
        </p>
    </div>

    <div class="steps-grid">
        <div class="step-card reveal">
            <div class="step-number">1</div>
            <h3>Isi Formulir Pendaftaran</h3>
            <p>
                Calon santri mengisi data diri, Gmail aktif, data orang tua atau wali,
                asal sekolah, kemampuan membaca Al-Quran, jumlah hafalan, riwayat penyakit,
                dan motivasi masuk pondok.
            </p>
        </div>

        <div class="step-card reveal">
            <div class="step-number">2</div>
            <h3>Upload Dokumen</h3>
            <p>
                Calon santri mengunggah dokumen pendaftaran seperti foto calon santri,
                Kartu Keluarga, dan Akta Lahir melalui formulir online.
            </p>
        </div>

        <div class="step-card reveal">
            <div class="step-number">3</div>
            <h3>Upload Bukti Pembayaran</h3>
            <p>
                Calon santri melihat informasi rekening pondok, melakukan pembayaran,
                lalu mengunggah bukti pembayaran pada halaman pendaftaran yang sama.
            </p>
        </div>

        <div class="step-card reveal">
            <div class="step-number">4</div>
            <h3>Verifikasi Admin</h3>
            <p>
                Admin memeriksa data pendaftaran, kelengkapan dokumen, dan bukti pembayaran
                dalam satu proses verifikasi.
            </p>
        </div>

        <div class="step-card reveal">
            <div class="step-number">5</div>
            <h3>Akun Santri Dibuat</h3>
            <p>
                Jika data dan pembayaran valid, admin membuat akun login santri menggunakan
                Gmail calon santri dan password awal yang diberikan oleh admin.
            </p>
        </div>

        <div class="step-card reveal">
            <div class="step-number">6</div>
            <h3>Santri Login Melihat Hasil</h3>
            <p>
                Santri login menggunakan Gmail dan password yang diberikan admin untuk melihat
                status akhir pendaftaran, data santri, foto, dan informasi bahwa pendaftaran
                telah berhasil.
            </p>
        </div>
    </div>
</section>

<section class="home-section gallery-section reveal">
    <div class="section-heading reveal">
        <div class="mini-label">Galeri Pondok</div>
        <h2>Galeri Kegiatan Pondok</h2>
        <p>
            Dokumentasi kegiatan santri dan aktivitas pondok pesantren.
        </p>
    </div>

    <div class="gallery-wrapper reveal">
        <div class="gallery-track">
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-1.jpeg') }}" alt="Galeri Kegiatan 1"></div>
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-2.jpeg') }}" alt="Galeri Kegiatan 2"></div>
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-3.jpeg') }}" alt="Galeri Kegiatan 3"></div>
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-4.jpeg') }}" alt="Galeri Kegiatan 4"></div>
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-5.jpeg') }}" alt="Galeri Kegiatan 5"></div>
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-6.jpeg') }}" alt="Galeri Kegiatan 6"></div>

            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-1.jpeg') }}" alt="Galeri Kegiatan 1"></div>
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-2.jpeg') }}" alt="Galeri Kegiatan 2"></div>
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-3.jpeg') }}" alt="Galeri Kegiatan 3"></div>
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-4.jpeg') }}" alt="Galeri Kegiatan 4"></div>
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-5.jpeg') }}" alt="Galeri Kegiatan 5"></div>
            <div class="gallery-item reveal"><img src="{{ asset('assets/img/kegiatan-6.jpeg') }}" alt="Galeri Kegiatan 6"></div>
        </div>
    </div>
</section>

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
                <li>
                    <a href="https://wa.me/{{ $waLink }}" target="_blank">
                        📞 {{ $waDisplay }}
                    </a>
                </li>
                <li>
                    <a href="mailto:{{ $emailPondok }}">
                        ✉ {{ $emailPondok }}
                    </a>
                </li>
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
