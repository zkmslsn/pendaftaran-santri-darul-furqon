<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Santri Baru</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- Gaya khusus halaman formulir; gaya bersama tetap berasal dari style.css. --}}
    <style>
        :root {
            --primary: #064e3b;
            --primary-2: #0f766e;
            --primary-3: #16a34a;
            --dark: #022c22;
            --lime: #a3e635;
            --soft: #f0fdf4;
            --white: #ffffff;
            --text: #102033;
            --muted: #64748b;
            --border: #dbe7dd;
            --danger: #dc2626;
            --warning: #f59e0b;
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
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        a {
            text-decoration: none;
        }

        /* ================= NAVBAR ================= */
        .navbar.main-navbar {
            width: 100%;
            min-height: 76px;
            padding: 0 7%;
            font-family: Arial, sans-serif;
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
            background: transparent;
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
            font-size: 16px;
            font-weight: 950;
            line-height: 1.3;
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
            font-size: 17px;
            font-weight: 900;
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
            width: 100%;
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

        /* ================= WRAPPER ================= */
        .form-wrapper {
            min-height: calc(100vh - 76px);
            padding: 74px 7% 86px;
            background:
                radial-gradient(circle at 92% 10%, rgba(163, 230, 53, 0.28), transparent 28%),
                radial-gradient(circle at 0% 86%, rgba(15, 118, 110, 0.12), transparent 34%),
                linear-gradient(135deg, #ffffff 0%, #f0fdf4 55%, #fffdf4 100%);
            position: relative;
            isolation: isolate;
            overflow: hidden;
        }

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

        .form-container {
            width: min(1120px, calc(100% - 48px));
            max-width: 1120px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .section-heading {
            width: 100%;
            margin: 0 auto 32px;
            padding: 38px 34px 40px;
            border-radius: 28px;
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background:
                radial-gradient(circle at top right, rgba(163, 230, 53, 0.18), transparent 28%),
                radial-gradient(circle at bottom left, rgba(255, 255, 255, 0.07), transparent 24%),
                linear-gradient(135deg, #064e3b 0%, #0f766e 58%, #238b52 100%);
            box-shadow: 0 22px 50px rgba(6, 78, 59, 0.18);
            overflow: hidden;
            position: relative;
            text-align: center;
        }

        .section-heading::before {
            content: "";
            position: absolute;
            top: -70px;
            right: -50px;
            width: 190px;
            height: 190px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
        }

        .section-heading::after {
            content: "";
            position: absolute;
            left: -70px;
            bottom: -80px;
            width: 220px;
            height: 220px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.055);
        }

        .section-heading > * {
            position: relative;
            z-index: 2;
        }

        .mini-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 9px 15px;
            border: 1px solid rgba(255, 255, 255, 0.42);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.10);
            color: #ffffff;
            font-size: 13.5px;
            font-weight: 950;
            margin-bottom: 18px;
        }

        .mini-label::before {
            content: "";
            width: 26px;
            height: 14px;
            flex: 0 0 26px;
            border-radius: 999px;
            background: linear-gradient(90deg, #d9f99d, #ffffff);
        }

        .section-heading h2 {
            margin: 0 0 18px;
            color: #ffffff;
            font-size: clamp(32px, 3.4vw, 50px);
            line-height: 1.1;
            font-weight: 950;
        }

        .section-heading p {
            max-width: 760px;
            margin: 0 auto;
            color: rgba(255, 255, 255, 0.88);
            font-size: 15.5px;
            line-height: 1.75;
        }

        /* ================= FORM CARD ================= */
        .form-card {
            background: #ffffff;
            border: 1px solid rgba(6, 78, 59, 0.10);
            border-radius: 24px;
            padding: 28px;
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
        }

        .form-section {
            position: relative;
            z-index: 2;
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid var(--border);
        }

        .form-section:last-of-type {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .section-head {
            display: block;
            margin: 0 0 24px;
            padding: 18px 22px;
            border: 1px solid rgba(6, 78, 59, 0.13);
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(240, 253, 244, 0.88) 100%);
            box-shadow: 0 16px 34px rgba(6, 78, 59, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.72);
            position: relative;
            overflow: hidden;
        }

        .section-head::before {
            content: "";
            position: absolute;
            left: 0;
            top: 18px;
            bottom: 18px;
            width: 6px;
            border-radius: 0 999px 999px 0;
            background: linear-gradient(180deg, var(--lime), var(--primary-2));
        }

        .section-icon {
            display: none;
        }

        .section-head h2 {
            display: flex;
            align-items: center;
            gap: 11px;
            margin: 0 0 8px;
            color: #064e3b;
            font-size: 25px;
            line-height: 1.22;
            font-weight: 950;
        }

        .section-head h2::before {
            content: "";
            width: 30px;
            height: 12px;
            flex: 0 0 30px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--lime), var(--primary));
            box-shadow: 0 8px 18px rgba(6, 78, 59, 0.15);
        }

        .section-head p {
            max-width: 780px;
            margin: 0;
            color: #526376;
            font-size: 14.5px;
            line-height: 1.7;
            font-weight: 600;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 24px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            color: #111827;
            font-size: 14px;
            font-weight: 950;
            margin-bottom: 8px;
        }

        .required {
            color: var(--danger);
        }

        input,
        select,
        textarea {
            width: 100%;
            min-height: 48px;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            background: #ffffff;
            color: #1f2937;
            font-size: 14px;
            transition: 0.25s ease;
            font-family: inherit;
        }

        textarea {
            min-height: 92px;
            resize: vertical;
        }

        .textarea-small {
            min-height: 48px;
            height: 48px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-2);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
        }

        .form-help {
            margin-top: 6px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.45;
        }

        .error-text {
            margin-top: 6px;
            color: var(--danger);
            font-size: 12px;
            font-weight: 800;
        }

        .field-needs-attention {
            border-color: var(--warning) !important;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.14) !important;
        }

        /* ================= UPLOAD ================= */
        .upload-payment-layout {
            display: block;
        }

        .document-upload-card {
            background: radial-gradient(circle at top right, rgba(163, 230, 53, 0.10), transparent 26%), linear-gradient(180deg, #ffffff 0%, #fbfffc 100%);
            border: 1px solid rgba(6, 78, 59, 0.10);
            border-radius: 20px;
            padding: 18px 22px;
            box-shadow: var(--shadow-soft);
        }

        .document-upload-card h3 {
            margin: 0 0 8px;
            color: var(--primary);
            font-size: 28px;
            line-height: 1.2;
            font-weight: 950;
        }

        .document-upload-card .card-desc {
            margin: 0 0 10px;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .upload-format-note {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 8px 0 22px;
            padding: 10px 14px;
            border-radius: 999px;
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            color: #064e3b;
            font-size: 13px;
            font-weight: 900;
        }

        .document-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .document-box {
            background: #ffffff;
            border: 1px dashed #94a3b8;
            border-radius: 20px;
            padding: 20px;
            transition: 0.25s ease;
            min-height: 160px;
        }

        .document-box:hover {
            border-color: var(--primary-2);
            background: #f8fffb;
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(6, 78, 59, 0.09);
        }

        .document-box label {
            display: block;
            margin-bottom: 12px;
            color: #111827;
            font-size: 15px;
            font-weight: 950;
        }

        .document-box input[type="file"] {
            width: 100%;
            min-height: auto;
            padding: 12px;
            border: 1px dashed #94a3b8;
            border-radius: 15px;
            background: #f8fafc;
            cursor: pointer;
        }

        .document-box input[type="file"]::file-selector-button {
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            padding: 10px 14px;
            border-radius: 12px;
            font-weight: 900;
            cursor: pointer;
            margin-right: 10px;
        }

        /* ================= BUTTONS ================= */
        .form-actions {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 30px;
            padding-top: 26px;
            border-top: 1px solid var(--border);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 52px;
            border-radius: 999px;
            padding: 0 26px;
            font-weight: 950;
            transition: 0.25s ease;
            text-decoration: none;
            font-family: inherit;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #ffffff;
            border: none;
            box-shadow: 0 16px 32px rgba(6, 78, 59, 0.22);
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: #ffffff;
        }

        .btn:hover {
            transform: translateY(-3px);
        }

        .submit-btn {
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        /* ================= MODAL FINAL ================= */
        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(2, 44, 34, 0.64);
            backdrop-filter: blur(8px);
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-card {
            position: relative;
            width: min(620px, 100%);
            max-height: 88vh;
            overflow: hidden;
            background: #ffffff;
            border-radius: 28px;
            box-shadow: 0 30px 90px rgba(2, 44, 34, 0.35);
            border: 1px solid rgba(6, 78, 59, 0.12);
            animation: modalFadeUp 0.25s ease;
        }

        .modal-card.large {
            width: min(760px, 100%);
        }

        .modal-close {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 42px;
            height: 42px;
            border: 1px solid #dbe7dd;
            border-radius: 999px;
            background: #ffffff;
            color: #064e3b;
            font-size: 26px;
            font-weight: 700;
            cursor: pointer;
            z-index: 3;
        }

        .modal-header {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            padding: 34px 34px 24px;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-icon {
            width: 58px;
            height: 58px;
            min-width: 58px;
            border-radius: 18px;
            background: linear-gradient(135deg, #064e3b, #0f766e);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: 950;
            box-shadow: 0 12px 26px rgba(6, 78, 59, 0.22);
        }

        .modal-icon.warning {
            background: linear-gradient(135deg, #f59e0b, #b45309);
        }

        .modal-icon.success {
            background: linear-gradient(135deg, #10b981, #0f766e);
        }

        .modal-header h2 {
            margin: 0 42px 8px 0;
            color: #064e3b;
            font-size: 30px;
            line-height: 1.2;
            font-weight: 950;
        }

        .modal-header p {
            margin: 0;
            color: #64748b;
            font-size: 15px;
            line-height: 1.7;
            font-weight: 600;
        }

        .modal-body {
            max-height: 52vh;
            overflow-y: auto;
            padding: 26px 34px;
        }

        .modal-body p {
            margin: 0;
            color: #334155;
            font-size: 16px;
            line-height: 1.9;
            font-weight: 500;
        }

        .modal-note {
            margin-top: 16px;
            padding: 16px 18px;
            border-radius: 18px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            font-size: 14px;
            line-height: 1.7;
            font-weight: 700;
        }

        .modal-list {
            margin: 0;
            padding-left: 22px;
            color: #92400e;
            font-size: 15px;
            line-height: 1.75;
            font-weight: 800;
        }

        .modal-list li {
            margin-bottom: 7px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 22px 34px;
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
        }

        .btn-modal-outline,
        .btn-modal-primary {
            min-width: 150px;
            min-height: 50px;
            border-radius: 999px;
            padding: 0 24px;
            font-size: 15px;
            font-weight: 950;
            cursor: pointer;
            transition: 0.25s ease;
            font-family: inherit;
        }

        .btn-modal-outline {
            background: #ffffff;
            color: #064e3b;
            border: 2px solid #064e3b;
        }

        .btn-modal-primary {
            background: linear-gradient(135deg, #064e3b, #0f766e);
            color: #ffffff;
            border: 2px solid #064e3b;
        }

        .btn-modal-outline:hover,
        .btn-modal-primary:hover {
            transform: translateY(-2px);
        }

        @keyframes modalFadeUp {
            from {
                opacity: 0;
                transform: translateY(18px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ================= FOOTER ================= */
        .footer-modern {
            background: radial-gradient(circle at top right, rgba(163, 230, 53, 0.15), transparent 22%), linear-gradient(135deg, #022c22 0%, #064e3b 55%, #0f766e 100%);
            color: rgba(255,255,255,0.92);
            padding: 62px 7% 24px;
            text-align: left;
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

        .footer-brand-text h3,
        .footer-title {
            margin: 0 0 14px;
            color: #ffffff;
            font-weight: 950;
        }

        .footer-brand-text h3 {
            max-width: 520px;
            font-size: 22px;
            line-height: 1.35;
        }

        .footer-title {
            font-size: 21px;
        }

        .footer-brand-text p,
        .footer-contact a,
        .footer-contact span,
        .footer-social-text {
            color: rgba(255,255,255,0.82);
            font-size: 16px;
            line-height: 1.75;
        }

        .footer-contact {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-contact li {
            margin-bottom: 15px;
        }

        .footer-contact a {
            color: rgba(255,255,255,0.86);
        }

        .footer-social {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 16px;
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
            transition: 0.25s ease;
        }

        .footer-social a:hover {
            transform: translateY(-3px);
        }

        .footer-bottom {
            max-width: 1420px;
            margin: 42px auto 0;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.12);
            text-align: center;
        }

        .footer-bottom p {
            margin: 0;
            color: rgba(255,255,255,0.82);
            font-size: 15px;
            line-height: 1.7;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1200px) {
            .document-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .footer-container {
                grid-template-columns: 1fr 1fr;
                gap: 42px;
            }

            .footer-container > div:first-child {
                grid-column: 1 / -1;
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
                font-size: 14px;
                white-space: normal;
            }

            .nav-links {
                width: 100%;
                flex-wrap: wrap;
                gap: 12px;
                margin-left: 0;
            }

            .nav-links a,
            .nav-links .nav-login {
                font-size: 14px;
            }

            .form-wrapper {
                padding: 62px 5%;
            }

            .form-container {
                width: min(820px, calc(100% - 32px));
                max-width: 820px;
            }

            .section-heading {
                padding: 30px 24px 32px;
                border-radius: 24px;
            }

            .form-card {
                padding: 22px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: 1;
            }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .form-actions .btn,
            .form-actions button {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 700px) {
            .document-grid {
                grid-template-columns: 1fr;
            }

            .document-upload-card {
                padding: 24px;
            }

            .document-upload-card h3 {
                font-size: 24px;
            }

            .modal-overlay {
                padding: 16px;
            }

            .modal-card {
                border-radius: 22px;
                max-height: 86vh;
            }

            .modal-header,
            .modal-body,
            .modal-actions {
                padding-left: 22px;
                padding-right: 22px;
            }

            .modal-header h2 {
                font-size: 24px;
            }

            .modal-actions {
                flex-direction: column;
            }

            .btn-modal-outline,
            .btn-modal-primary {
                width: 100%;
            }

            .footer-modern {
                padding: 50px 5% 22px;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 34px;
            }
        }

        @media (max-width: 640px) {
            .form-container {
                width: calc(100% - 24px);
                max-width: none;
            }

            .section-heading {
                padding: 26px 18px 28px;
                border-radius: 20px;
                margin-bottom: 24px;
            }

            .section-heading h2 {
                font-size: 29px;
            }

            .form-card {
                padding: 18px;
                border-radius: 20px;
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

            .form-wrapper {
                padding: 40px 0 52px !important;
            }

            .section-head {
                padding: 16px 18px !important;
            }

            .section-head h2 {
                align-items: flex-start !important;
                font-size: 21px !important;
            }

            .document-upload-card {
                padding: 18px !important;
            }

            .document-box {
                min-height: auto !important;
                padding: 16px !important;
            }

            .document-box input[type="file"]::file-selector-button {
                display: block !important;
                width: 100% !important;
                margin: 0 0 10px !important;
            }

            .upload-format-note {
                width: 100% !important;
                border-radius: 16px !important;
                align-items: flex-start !important;
            }

            .modal-card {
                width: min(100%, calc(100vw - 24px)) !important;
                max-height: calc(100dvh - 24px) !important;
            }

            .modal-header {
                align-items: flex-start !important;
                gap: 12px !important;
            }

            .modal-header h2 {
                margin-right: 42px !important;
                overflow-wrap: anywhere !important;
            }

            .modal-body {
                max-height: calc(100dvh - 260px) !important;
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

            .form-container {
                width: calc(100% - 20px) !important;
            }
        }

        /* ==================================================
           DAFTAR HERO FONT FINAL
           ================================================== */

        .form-wrapper .section-heading h2 {
            max-width: 980px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            font-size: clamp(30px, 3vw, 46px) !important;
            line-height: 1.16 !important;
            font-weight: 800 !important;
            letter-spacing: 0 !important;
        }

        .form-wrapper .section-heading p {
            max-width: 920px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            font-size: 16px !important;
            line-height: 1.7 !important;
        }

        .form-wrapper .section-heading .mini-label {
            font-size: 14px !important;
            line-height: 1.2 !important;
        }

        @media (max-width: 768px) {
            .form-wrapper .section-heading h2 {
                max-width: 620px !important;
                font-size: 30px !important;
                line-height: 1.22 !important;
            }

            .form-wrapper .section-heading p {
                max-width: 620px !important;
                font-size: 14.5px !important;
                line-height: 1.65 !important;
            }
        }

        @media (max-width: 420px) {
            .form-wrapper .section-heading h2 {
                font-size: 27px !important;
            }

            .form-wrapper .section-heading .mini-label {
                font-size: 13px !important;
            }
        }
    </style>
</head>

<body>
{{-- Kontak resmi dipusatkan di sini agar tautan header dan footer tetap konsisten. --}}
@php
    $waDisplay = '0838-9916-2195';
    $waLink = '6283899162195';
    $emailPondok = 'darulfurqon108@gmail.com';
    $instagramUrl = 'https://www.instagram.com/darulfurqon10?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==';
    $tiktokUrl = 'https://www.tiktok.com/@pptq.darul.furqon3?is_from_webapp=1&sender_device=pc';
    $youtubeUrl = 'https://www.youtube.com/@darulfurqon';
@endphp

{{-- Navigasi utama halaman publik. --}}
@include('partials.public-navbar')

{{-- Formulir utama dibagi per kelompok data agar mudah ditinjau calon santri. --}}
<main class="form-wrapper">
    <div class="form-container">
        <div class="section-heading">
            <div class="mini-label">Data Pendaftaran</div>
            <h2>Form Pendaftaran Online</h2>
            <p>
                Pastikan seluruh data yang diisi sesuai dengan identitas asli.
                Data dan dokumen akan diverifikasi oleh admin pondok.
            </p>
        </div>

        <form id="pendaftaranForm" action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data" class="form-card" novalidate>
            @csrf

            {{-- Bagian 1: identitas calon santri. --}}
            <section class="form-section">
                <div class="section-head">
                    <div class="section-icon">👤</div>
                    <div>
                        <h2>Data Calon Santri</h2>
                        <p>Isi data diri calon santri sesuai identitas yang benar. Pondok hanya menerima santri putri.</p>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="required">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                        @error('nama') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Gmail Calon Santri <span class="required">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Gmail aktif calon santri" required>
                        <span class="form-help">Gmail ini digunakan untuk akun login santri setelah diverifikasi admin.</span>
                        @error('email') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Nomor WhatsApp Calon Santri <span class="required">*</span></label>
                        <input type="text" name="wa_santri" value="{{ old('wa_santri') }}" placeholder="Contoh: 081234567890" required>
                        <span class="form-help">Nomor WhatsApp calon santri. Jika belum memiliki nomor pribadi, isi nomor yang dapat dihubungi.</span>
                        @error('wa_santri') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin <span class="required">*</span></label>
                        <select name="jenis_kelamin" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir <span class="required">*</span></label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukkan tempat lahir" required>
                        @error('tempat_lahir') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir <span class="required">*</span></label>
                        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                        @error('tgl_lahir') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Asal Sekolah <span class="required">*</span></label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" placeholder="Masukkan asal sekolah" required>
                        @error('asal_sekolah') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap <span class="required">*</span></label>
                        <textarea name="alamat" class="textarea-small" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="error-text">{{ $message }}</div> @enderror
                    </div>
                </div>
            </section>

            {{-- Bagian 2: identitas dan kontak orang tua/wali. --}}
            <section class="form-section">
                <div class="section-head">
                    <div class="section-icon">👪</div>
                    <div>
                        <h2>Data Orang Tua / Wali</h2>
                        <p>Isi data wali yang dapat dihubungi oleh pihak pondok.</p>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Ayah <span class="required">*</span></label>
                        <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" placeholder="Masukkan nama ayah" required>
                        @error('nama_ayah') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Pekerjaan Ayah <span class="required">*</span></label>
                        <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" placeholder="Masukkan pekerjaan ayah" required>
                        @error('pekerjaan_ayah') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Ibu <span class="required">*</span></label>
                        <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" placeholder="Masukkan nama ibu" required>
                        @error('nama_ibu') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Pekerjaan Ibu <span class="required">*</span></label>
                        <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" placeholder="Masukkan pekerjaan ibu" required>
                        @error('pekerjaan_ibu') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group full">
                        <label>Nomor WhatsApp Orang Tua / Wali Santri <span class="required">*</span></label>
                        <input type="text" name="wa_wali" value="{{ old('wa_wali') }}" placeholder="Contoh: 081234567890" required>
                        <span class="form-help">Nomor ini dipakai admin untuk mengirim informasi verifikasi, akun login, dan informasi pembayaran.</span>
                        @error('wa_wali') <div class="error-text">{{ $message }}</div> @enderror
                    </div>
                </div>
            </section>

            {{-- Bagian 3: kemampuan, kesehatan, dan motivasi calon santri. --}}
            <section class="form-section">
                <div class="section-head">
                    <div class="section-icon">📖</div>
                    <div>
                        <h2>Kemampuan Calon Santri</h2>
                        <p>Isi kemampuan membaca Al-Quran, hafalan, riwayat kesehatan, dan motivasi calon santri.</p>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Kemampuan Membaca Al-Quran <span class="required">*</span></label>
                        <select name="kemampuan_membaca_alquran" required>
                            <option value="">-- Pilih Kemampuan --</option>
                            <option value="Lancar" {{ old('kemampuan_membaca_alquran') == 'Lancar' ? 'selected' : '' }}>Lancar</option>
                            <option value="Cukup" {{ old('kemampuan_membaca_alquran') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                            <option value="Belum Lancar" {{ old('kemampuan_membaca_alquran') == 'Belum Lancar' ? 'selected' : '' }}>Belum Lancar</option>
                        </select>
                        @error('kemampuan_membaca_alquran') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Jumlah Hafalan <span class="required">*</span></label>
                        <input type="text" name="jumlah_hafalan" value="{{ old('jumlah_hafalan') }}" placeholder="Contoh: 1 juz / 5 surat / belum ada" required>
                        @error('jumlah_hafalan') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Riwayat Penyakit <span class="required">*</span></label>
                        <input type="text" name="riwayat_penyakit" value="{{ old('riwayat_penyakit') }}" placeholder="Isi '-' jika tidak ada riwayat penyakit" required>
                        @error('riwayat_penyakit') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Motivasi Masuk Pondok <span class="required">*</span></label>
                        <textarea name="motivasi_masuk_pondok" class="textarea-small" placeholder="Tuliskan motivasi masuk pondok" required>{{ old('motivasi_masuk_pondok') }}</textarea>
                        @error('motivasi_masuk_pondok') <div class="error-text">{{ $message }}</div> @enderror
                    </div>
                </div>
            </section>

            {{-- Bagian 4: dokumen wajib dan bukti pembayaran. --}}
            <section class="form-section">
                <div class="section-head">
                    <div class="section-icon">📎</div>
                    <div>
                        <h2>Upload Dokumen Pendaftaran</h2>
                        <p>Unggah dokumen pendaftaran dan bukti pembayaran untuk proses verifikasi admin.</p>
                    </div>
                </div>

                <div class="upload-payment-layout">
                    <div class="document-upload-card">
                        <h3>Dokumen yang Harus Diupload</h3>
                        <p class="card-desc">Pastikan semua file terlihat jelas sebelum dikirim.</p>

                        <div class="upload-format-note">
                            📌 Format JPG, JPEG, PNG, PDF. Maksimal 2MB.
                        </div>

                        <div class="document-grid">
                            <div class="document-box">
                                <label>Foto Calon Santri <span class="required">*</span></label>
                                <input type="file" name="foto" accept=".jpg,.jpeg,.png" required>
                                @error('foto') <div class="error-text">{{ $message }}</div> @enderror
                            </div>

                            <div class="document-box">
                                <label>Kartu Keluarga <span class="required">*</span></label>
                                <input type="file" name="kartu_keluarga" accept=".jpg,.jpeg,.png,.pdf" required>
                                @error('kartu_keluarga') <div class="error-text">{{ $message }}</div> @enderror
                            </div>

                            <div class="document-box">
                                <label>Akta Lahir <span class="required">*</span></label>
                                <input type="file" name="akta_lahir" accept=".jpg,.jpeg,.png,.pdf" required>
                                @error('akta_lahir') <div class="error-text">{{ $message }}</div> @enderror
                            </div>

                            <div class="document-box">
                                <label>Bukti Pembayaran <span class="required">*</span></label>
                                <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf" required>
                                @error('bukti_pembayaran') <div class="error-text">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="form-actions">
                <a href="{{ route('beranda') }}" class="btn btn-outline">← Kembali ke Beranda</a>
                <button type="button" id="submitRegistrationBtn" class="btn btn-primary submit-btn">Kirim Dokumen</button>
            </div>
        </form>
    </div>
</main>

<div class="modal-overlay" id="requiredFieldsModal" aria-hidden="true">
    <div class="modal-card large" role="dialog" aria-modal="true" aria-labelledby="requiredFieldsTitle">
        <button type="button" class="modal-close" id="closeRequiredModal" aria-label="Tutup popup">×</button>
        <div class="modal-header">
            <div class="modal-icon warning">!</div>
            <div>
                <h2 id="requiredFieldsTitle">Lengkapi data dulu</h2>
                <p>Masih ada data atau dokumen yang belum lengkap. Lengkapi bagian berikut sebelum mengirim dokumen.</p>
            </div>
        </div>
        <div class="modal-body">
            <ul id="requiredFieldsList" class="modal-list"></ul>
        </div>
        <div class="modal-actions">
            <button type="button" class="btn-modal-primary" id="reviewRequiredFields">Lengkapi Data</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="registrationConfirmModal" aria-hidden="true">
    <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="registrationConfirmTitle">
        <button type="button" class="modal-close" id="closeConfirmModal" aria-label="Tutup popup">×</button>
        <div class="modal-header">
            <div class="modal-icon">?</div>
            <div>
                <h2 id="registrationConfirmTitle">Apakah data sudah benar?</h2>
                <p>Pastikan semua data dan dokumen sudah sesuai sebelum dikirim.</p>
            </div>
        </div>
        <div class="modal-body">
            <p>
                Jika masih ingin mengubah data, klik tombol <strong>Edit Lagi</strong>.
                Jika semua data sudah benar, klik <strong>Lanjut Kirim</strong> untuk mengirimkan dokumen pendaftaran.
            </p>
        </div>
        <div class="modal-actions">
            <button type="button" class="btn-modal-outline" id="editConfirmData">Edit Lagi</button>
            <button type="button" class="btn-modal-primary" id="confirmRegistrationSubmit">Lanjut Kirim</button>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="modal-overlay show" id="registrationSuccessModal" aria-hidden="false">
        <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="registrationSuccessTitle">
            <button type="button" class="modal-close" id="closeSuccessModal" aria-label="Tutup popup">×</button>
            <div class="modal-header">
                <div class="modal-icon success">✓</div>
                <div>
                    <h2 id="registrationSuccessTitle">Data berhasil terkirim</h2>
                    <p>Data dan dokumen pendaftaran sudah masuk ke sistem.</p>
                </div>
            </div>
            <div class="modal-body">
                <p>
                    Pendaftaran berhasil dikirim. Data, dokumen, dan bukti pembayaran sedang menunggu verifikasi admin.
                </p>
                <div class="modal-note">
                    Jika pendaftaran dinyatakan diterima, admin akan membuat akun santri aktif dan mengirimkan informasi login kepada calon santri atau wali.
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-primary" id="finishSuccessModal">Tutup</button>
            </div>
        </div>
    </div>
@endif

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
            <p class="footer-social-text">Ikuti kegiatan pondok melalui media sosial resmi kami.</p>
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

{{-- Validasi sisi klien dan pengelolaan modal; validasi final tetap dilakukan controller. --}}
<script>
    const registrationForm = document.getElementById('pendaftaranForm');
    const submitRegistrationButton = document.getElementById('submitRegistrationBtn');

    const requiredFieldsModal = document.getElementById('requiredFieldsModal');
    const requiredFieldsList = document.getElementById('requiredFieldsList');
    const closeRequiredModalButton = document.getElementById('closeRequiredModal');
    const reviewRequiredFieldsButton = document.getElementById('reviewRequiredFields');

    const confirmModal = document.getElementById('registrationConfirmModal');
    const closeConfirmModalButton = document.getElementById('closeConfirmModal');
    const editConfirmDataButton = document.getElementById('editConfirmData');
    const confirmRegistrationSubmitButton = document.getElementById('confirmRegistrationSubmit');

    const successModal = document.getElementById('registrationSuccessModal');
    const closeSuccessModalButton = document.getElementById('closeSuccessModal');
    const finishSuccessModalButton = document.getElementById('finishSuccessModal');

    const serverErrors = @json($errors->all());
    let firstFieldToReview = null;

    // Mengambil nama field yang manusiawi untuk pesan validasi.
    function getFieldLabel(field) {
        const wrapper = field.closest('.form-group, .document-box');
        const label = wrapper ? wrapper.querySelector('label') : null;
        return (label ? label.textContent : field.name)
            .replace('*', '')
            .replace(/\s+/g, ' ')
            .trim();
    }

    // Menjaga scroll halaman terkunci selama salah satu modal terbuka.
    function popupIsOpen() {
        return [requiredFieldsModal, confirmModal, successModal].some(modal => {
            return modal && modal.classList.contains('show');
        });
    }

    function updateBodyScroll() {
        document.body.style.overflow = popupIsOpen() ? 'hidden' : '';
    }

    function openModal(modal) {
        if (!modal) return;
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
        updateBodyScroll();
    }

    function closeModal(modal) {
        if (!modal) return;
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        updateBodyScroll();
    }

    // Menampilkan seluruh kekurangan sekaligus dan menyimpan field pertama untuk difokuskan.
    function showRequiredFieldsModal(messages, firstInvalidField = null) {
        firstFieldToReview = firstInvalidField;
        requiredFieldsList.innerHTML = '';

        messages.forEach(message => {
            const item = document.createElement('li');
            item.textContent = message;
            requiredFieldsList.appendChild(item);
        });

        openModal(requiredFieldsModal);
        reviewRequiredFieldsButton.focus();
    }

    function focusFirstFieldToReview() {
        if (firstFieldToReview) {
            firstFieldToReview.scrollIntoView({ behavior: 'smooth', block: 'center' });
            setTimeout(() => firstFieldToReview.focus({ preventScroll: true }), 350);
        }
    }

    // Memeriksa field wajib, format Gmail/WhatsApp, dan batas ukuran dokumen.
    function validateRequiredFields() {
        const messages = [];
        let firstInvalidField = null;

        registrationForm
            .querySelectorAll('.field-needs-attention')
            .forEach(field => field.classList.remove('field-needs-attention'));

        Array.from(registrationForm.querySelectorAll('[required]')).forEach(field => {
            const label = getFieldLabel(field);
            const isEmpty = field.type === 'file'
                ? field.files.length === 0
                : field.value.trim() === '';

            if (isEmpty) {
                messages.push(`${label} wajib diisi.`);
            } else if (!field.checkValidity()) {
                messages.push(`${label} belum sesuai format yang diminta.`);
            }

            if (isEmpty || !field.checkValidity()) {
                field.classList.add('field-needs-attention');
                firstInvalidField = firstInvalidField || field;
            }
        });

        if (messages.length > 0) {
            showRequiredFieldsModal(messages, firstInvalidField);
            return false;
        }

        return true;
    }

    // Meminta konfirmasi terakhir sebelum data dikirim ke server.
    function openConfirmModal() {
        if (!validateRequiredFields()) {
            return;
        }

        openModal(confirmModal);
        closeConfirmModalButton.focus();
    }

    // Menonaktifkan tombol saat submit untuk mencegah pengiriman ganda.
    function submitRegistration() {
        if (!validateRequiredFields()) {
            closeModal(confirmModal);
            return;
        }

        confirmRegistrationSubmitButton.disabled = true;
        confirmRegistrationSubmitButton.textContent = 'Mengirim...';
        registrationForm.submit();
    }

    submitRegistrationButton.addEventListener('click', openConfirmModal);

    closeRequiredModalButton.addEventListener('click', () => closeModal(requiredFieldsModal));
    reviewRequiredFieldsButton.addEventListener('click', () => {
        closeModal(requiredFieldsModal);
        focusFirstFieldToReview();
    });

    requiredFieldsModal.addEventListener('click', event => {
        if (event.target === requiredFieldsModal) {
            closeModal(requiredFieldsModal);
        }
    });

    closeConfirmModalButton.addEventListener('click', () => closeModal(confirmModal));
    editConfirmDataButton.addEventListener('click', () => closeModal(confirmModal));
    confirmRegistrationSubmitButton.addEventListener('click', submitRegistration);

    confirmModal.addEventListener('click', event => {
        if (event.target === confirmModal) {
            closeModal(confirmModal);
        }
    });

    if (successModal) {
        openModal(successModal);

        if (finishSuccessModalButton) {
            finishSuccessModalButton.focus();
            finishSuccessModalButton.addEventListener('click', () => closeModal(successModal));
        }

        if (closeSuccessModalButton) {
            closeSuccessModalButton.addEventListener('click', () => closeModal(successModal));
        }

        successModal.addEventListener('click', event => {
            if (event.target === successModal) {
                closeModal(successModal);
            }
        });
    }

    if (serverErrors.length > 0) {
        showRequiredFieldsModal(serverErrors);
    }

    document.addEventListener('keydown', event => {
        if (event.key !== 'Escape') {
            return;
        }

        if (requiredFieldsModal.classList.contains('show')) {
            closeModal(requiredFieldsModal);
            return;
        }

        if (confirmModal.classList.contains('show')) {
            closeModal(confirmModal);
            return;
        }

        if (successModal && successModal.classList.contains('show')) {
            closeModal(successModal);
        }
    });

    registrationForm.addEventListener('input', event => {
        if (event.target.classList.contains('field-needs-attention')) {
            event.target.classList.remove('field-needs-attention');
        }
    });

    registrationForm.addEventListener('change', event => {
        if (event.target.classList.contains('field-needs-attention')) {
            event.target.classList.remove('field-needs-attention');
        }
    });
</script>
</body>
</html>
