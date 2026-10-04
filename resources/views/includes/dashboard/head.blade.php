    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم · إدارة الصلاحيات</title>
    <!-- Bootstrap RTL (for quick layout, but we'll add custom styles) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome 6 (free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Font: Cairo for Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: #f5f7fb;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* ========== LAYOUT ========== */
        .app-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ========== SIDEBAR (section-menu-left) ========== */
        .section-menu-left {
            width: 280px;
            background: #ffffff;
            border-left: 1px solid #e9eef5;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.02);
            transition: all 0.3s;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
        }

        .box-logo {
            padding: 24px 16px 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #f1f4f9;
        }

        .box-logo a {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .box-logo img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 2px solid #e9eef5;
            transition: 0.2s;
        }

        .box-logo img:hover {
            border-color: #3b82f6;
        }

        .button-show-hide {
            display: none;
        }

        /* center items */
        .center {
            padding: 16px 12px 32px;
        }

        .center-item {
            margin-bottom: 28px;
        }

        .center-heading {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #94a3b8;
            margin-bottom: 10px;
            padding-right: 12px;
            border-right: 3px solid #3b82f6;
            line-height: 1.2;
        }

        .menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            margin-bottom: 4px;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            color: #334155;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.2s;
            position: relative;
        }

        .menu-item a .icon {
            width: 24px;
            text-align: center;
            color: #64748b;
            font-size: 18px;
            transition: 0.2s;
        }

        .menu-item a .text {
            flex: 1;
        }

        .menu-item a:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .menu-item a:hover .icon {
            color: #3b82f6;
            transform: scale(1.05);
        }

        .menu-item a.active {
            background: #eef2ff;
            color: #2563eb;
            font-weight: 600;
        }

        .menu-item a.active .icon {
            color: #2563eb;
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0; /* prevent overflow */
        }

        /* ========== HEADER DASHBOARD ========== */
        .header-dashboard {
            background: #ffffff;
            border-bottom: 1px solid #e9eef5;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .header-dashboard .wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 76px;
            gap: 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
            min-width: 0;
        }

        .header-left .logo {
            display: none; /* hidden because sidebar has logo, but we keep for mobile */
        }

        .button-show-hide {
            display: none;
            font-size: 24px;
            color: #1e293b;
            cursor: pointer;
        }

        .form-search {
            display: flex;
            align-items: center;
            background: #f8fafc;
            border-radius: 40px;
            padding: 0 6px 0 16px;
            border: 1px solid #e2e8f0;
            transition: 0.2s;
            width: 100%;
            max-width: 420px;
            position: relative;
        }

        .form-search:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            background: #ffffff;
        }

        .form-search .name {
            flex: 1;
            border: none;
            background: transparent;
            padding: 12px 0;
            font-size: 15px;
            outline: none;
            font-family: 'Cairo', sans-serif;
            color: #1e293b;
        }

        .form-search .name::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .form-search .button-submit button {
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 18px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 50%;
            transition: 0.2s;
        }

        .form-search .button-submit button:hover {
            color: #3b82f6;
            background: #eef2ff;
        }

        /* hide the default search popup content for now – we use live search */
        .box-content-search {
            display: none;
        }

        .header-grid {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .popup-wrap .dropdown-toggle {
            background: transparent;
            border: none;
            padding: 8px 10px;
            border-radius: 12px;
            color: #1e293b;
            transition: 0.2s;
            position: relative;
        }

        .popup-wrap .dropdown-toggle:hover {
            background: #f1f5f9;
        }

        .header-item {
            position: relative;
            display: inline-block;
            font-size: 20px;
            color: #475569;
        }

        .header-item .text-tiny {
            position: absolute;
            top: -6px;
            left: -8px;
            background: #ef4444;
            color: white;
            font-size: 10px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-user .image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3b82f6;
            font-weight: 700;
            font-size: 16px;
        }

        .header-user .body-title {
            font-weight: 600;
            font-size: 14px;
        }

        .header-user .text-tiny {
            font-size: 12px;
            color: #64748b;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-radius: 16px;
            padding: 12px;
            min-width: 260px;
            margin-top: 8px !important;
        }

        .dropdown-menu .user-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            color: #1e293b;
            text-decoration: none;
            transition: 0.2s;
        }

        .dropdown-menu .user-item:hover {
            background: #f1f5f9;
        }

        .dropdown-menu .user-item .icon {
            width: 20px;
            color: #64748b;
        }

        /* ========== INTERACTIVE TABLE PAGE ========== */
        .page-content {
            padding: 28px 32px 40px;
            flex: 1;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.3px;
        }

        .page-header h1 i {
            color: #3b82f6;
            margin-left: 8px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #ffffff;
            padding: 20px 22px;
            border-radius: 20px;
            border: 1px solid #e9eef5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.08);
            border-color: #dbeafe;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3b82f6;
            font-size: 22px;
        }

        .stat-info h3 {
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }

        .stat-info p {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        /* table card */
        .table-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e9eef5;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .table-toolbar {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            border-bottom: 1px solid #f1f4f9;
        }

        .table-toolbar h2 {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
        }

        .toolbar-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Cairo', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .btn:active {
            transform: scale(0.96);
        }

        .btn-primary {
            background: #3b82f6;
            color: #fff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            background: #2563eb;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-danger {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #e2e8f0;
            color: #334155;
        }

        .btn-outline:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 13px;
        }

        /* ripple effect */
        .btn .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple-anim 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-anim {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* table */
        .table-responsive {
            overflow-x: auto;
            padding: 0 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        thead th {
            text-align: right;
            padding: 16px 20px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #64748b;
            background: #fafcff;
            border-bottom: 2px solid #e9eef5;
            cursor: pointer;
            user-select: none;
            transition: 0.15s;
            white-space: nowrap;
        }

        thead th:hover {
            color: #3b82f6;
            background: #f1f7ff;
        }

        thead th i {
            font-size: 11px;
            margin-right: 6px;
            opacity: 0.4;
            transition: 0.2s;
        }

        thead th.active i {
            opacity: 1;
            color: #3b82f6;
        }

        tbody tr {
            border-bottom: 1px solid #f1f4f9;
            transition: all 0.2s;
            animation: fadeInRow 0.4s ease forwards;
            opacity: 0;
        }

        @keyframes fadeInRow {
            to {
                opacity: 1;
                transform: translateY(0);
            }
            from {
                opacity: 0;
                transform: translateY(10px);
            }
        }

        tbody tr:hover {
            background: #f8fafc;
            transform: scale(1.002);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: #1e293b;
            vertical-align: middle;
        }

        .permission-name {
            font-weight: 600;
            color: #0f172a;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            background: #eef2ff;
            color: #2563eb;
        }

        .badge-success {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-warning {
            background: #fef9c3;
            color: #ca8a04;
        }

        .action-btns {
            display: flex;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .action-btn:hover {
            background: #eef2ff;
            color: #3b82f6;
            transform: scale(1.1);
        }

        .action-btn.delete:hover {
            background: #fee2e2;
            color: #ef4444;
        }

        /* checkbox */
        .checkbox-cell {
            width: 50px;
            text-align: center;
        }

        .custom-checkbox {
            width: 20px;
            height: 20px;
            accent-color: #3b82f6;
            border-radius: 6px;
            cursor: pointer;
        }

        /* toast */
        .toast-container {
            position: fixed;
            bottom: 30px;
            left: 30px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 380px;
        }

        .toast {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px 20px;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 14px;
            border-right: 4px solid #3b82f6;
            animation: slideIn 0.3s ease forwards;
            font-weight: 500;
            font-size: 14px;
            color: #1e293b;
        }

        .toast.success {
            border-right-color: #22c55e;
        }

        .toast.error {
            border-right-color: #ef4444;
        }

        .toast i {
            font-size: 20px;
        }

        .toast.success i {
            color: #22c55e;
        }

        .toast.error i {
            color: #ef4444;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .toast.hide {
            animation: slideOut 0.3s ease forwards;
        }

        @keyframes slideOut {
            to {
                opacity: 0;
                transform: translateX(-40px);
            }
        }

        /* modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            opacity: 0;
            pointer-events: none;
            transition: 0.2s;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .modal-box {
            background: #ffffff;
            border-radius: 28px;
            padding: 32px 36px;
            max-width: 440px;
            width: 90%;
            box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.3);
            transform: scale(0.95);
            transition: 0.2s;
            text-align: center;
        }

        .modal-overlay.active .modal-box {
            transform: scale(1);
        }

        .modal-box .icon-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fee2e2;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 28px;
            color: #ef4444;
        }

        .modal-box h3 {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .modal-box p {
            color: #64748b;
            margin-bottom: 28px;
            font-size: 15px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .modal-actions .btn {
            min-width: 120px;
            justify-content: center;
        }

        /* inline delete animation */
        .row-deleting {
            animation: rowDelete 0.4s ease forwards;
        }

        @keyframes rowDelete {
            to {
                opacity: 0;
                transform: translateX(-30px);
                height: 0;
                padding: 0;
                border: none;
                margin: 0;
                overflow: hidden;
            }
        }

        /* responsive */
        @media (max-width: 992px) {
            .section-menu-left {
                position: fixed;
                right: -300px;
                top: 0;
                height: 100vh;
                z-index: 1000;
                transition: 0.3s;
                box-shadow: -10px 0 40px rgba(0, 0, 0, 0.1);
            }

            .section-menu-left.open {
                right: 0;
            }

            .button-show-hide {
                display: block !important;
            }

            .header-left .logo {
                display: block;
            }

            .header-left .logo img {
                height: 40px;
                width: auto;
            }

            .page-content {
                padding: 20px 16px 32px;
            }

            .header-dashboard .wrap {
                height: 68px;
                padding: 0 16px;
            }

            .form-search {
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 22px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .table-toolbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .toolbar-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .header-user .body-title {
                display: none;
            }

            .header-user .text-tiny {
                display: none;
            }

            .header-user .image {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .stat-info h3 {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .modal-box {
                padding: 24px;
            }
        }

        /* RTL adjustments */
        [dir="rtl"] .menu-item a .icon {
            margin-left: 4px;
        }

        [dir="rtl"] .center-heading {
            border-right: 3px solid #3b82f6;
            border-left: none;
            padding-right: 12px;
            padding-left: 0;
        }

        [dir="rtl"] .form-search {
            padding: 0 16px 0 6px;
        }

        [dir="rtl"] .toast {
            border-right: 4px solid #3b82f6;
            border-left: none;
        }

        /* custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 20px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
