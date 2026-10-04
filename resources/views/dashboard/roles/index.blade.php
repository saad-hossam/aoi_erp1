@extends('layouts.dashboard.app')
@section('content')

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* ============================================ */
    /* متغيرات + نطاق محصور                         */
    /* ============================================ */
    .perm-page {
        --p-primary: #6366f1;
        --p-primary-soft: #eef2ff;
        --p-danger: #ef4444;
        --p-danger-soft: #fef2f2;
        --p-success: #10b981;
        --p-border: #e5e7eb;
        --p-text: #1f2937;
        --p-muted: #6b7280;
        --p-bg: #f9fafb;
    }
    .perm-page * { box-sizing: border-box; }

    /* ================= رأس الصفحة ================= */
    .perm-page .perm-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }
    .perm-page .perm-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .perm-page .perm-header-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: 0 8px 20px rgba(99, 102, 241, .3);
        flex-shrink: 0;
    }
    .perm-page .perm-header h3 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: var(--p-text);
    }
    .perm-page .perm-header p {
        margin: 3px 0 0;
        font-size: 14px;
        color: var(--p-muted);
    }

    .perm-page .perm-btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 22px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff !important;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        box-shadow: 0 6px 16px rgba(99, 102, 241, .35);
        transition: transform .2s ease, box-shadow .2s ease;
        white-space: nowrap;
    }
    .perm-page .perm-btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(99, 102, 241, .45);
        color: #fff;
    }

    /* ================= البطاقة ================= */
    .perm-page .perm-card {
        background: #fff;
        border: 1px solid var(--p-border);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,.05);
        overflow: hidden;
    }

    /* ================= شريط الأدوات ================= */
    .perm-page .perm-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
        padding: 18px 22px;
        border-bottom: 1px solid var(--p-border);
        background: #fff;
    }
    .perm-page .perm-search {
        position: relative;
        flex: 1;
        min-width: 220px;
        max-width: 400px;
    }
    .perm-page .perm-search i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--p-muted);
        font-size: 15px;
        pointer-events: none;
        z-index: 1;
    }
    .perm-page .perm-search input {
        width: 100%;
        padding: 12px 14px 12px 42px;
        border: 1px solid var(--p-border);
        border-radius: 10px;
        font-size: 15px;
        color: var(--p-text);
        background: var(--p-bg);
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }
    .perm-page .perm-search input:focus {
        background: #fff;
        border-color: var(--p-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .12);
    }

    /* ================= الجدول ================= */
    .perm-page .perm-table-wrap { overflow-x: auto; }
    .perm-page .perm-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        min-width: 800px;
    }
    .perm-page .perm-table thead th {
        background: var(--p-bg);
        color: var(--p-muted);
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px;
        text-align: right;
        padding: 16px 18px;
        border-bottom: 1px solid var(--p-border);
        white-space: nowrap;
        user-select: none;
        vertical-align: middle;
    }
    .perm-page .perm-table thead th.sortable {
        cursor: pointer;
        transition: color .2s ease, background .2s ease;
    }
    .perm-page .perm-table thead th.sortable:hover {
        color: var(--p-primary);
        background: var(--p-primary-soft);
    }
    .perm-page .perm-table thead th .sort-icon {
        margin-right: 6px;
        font-size: 11px;
        opacity: .35;
        transition: opacity .2s ease, transform .2s ease;
        display: inline-block;
    }
    .perm-page .perm-table thead th.sorted-asc .sort-icon { opacity: 1; color: var(--p-primary); }
    .perm-page .perm-table thead th.sorted-desc .sort-icon {
        opacity: 1; color: var(--p-primary);
        transform: rotate(180deg);
    }

    .perm-page .perm-table tbody td {
        padding: 16px 18px;
        font-size: 15px;
        color: var(--p-text);
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        text-align: right;
    }
    .perm-page .perm-table tbody tr { transition: background .15s ease; }
    .perm-page .perm-table tbody tr:hover { background: #fafbff; }
    .perm-page .perm-table tbody tr:last-child td { border-bottom: none; }
    .perm-page .perm-table tbody tr.removing {
        opacity: 0;
        transform: translateX(-20px);
        transition: opacity .3s ease, transform .3s ease;
    }

    @keyframes permRowIn {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .perm-page .perm-table tbody tr[data-name] {
        animation: permRowIn .35s ease both;
    }
    .perm-page .perm-table tbody tr[data-name]:nth-child(1)  { animation-delay: .02s; }
    .perm-page .perm-table tbody tr[data-name]:nth-child(2)  { animation-delay: .04s; }
    .perm-page .perm-table tbody tr[data-name]:nth-child(3)  { animation-delay: .06s; }
    .perm-page .perm-table tbody tr[data-name]:nth-child(4)  { animation-delay: .08s; }
    .perm-page .perm-table tbody tr[data-name]:nth-child(5)  { animation-delay: .10s; }

    .perm-page .perm-table .col-check   { width: 56px; }
    .perm-page .perm-table .col-index   { width: 80px; }
    .perm-page .perm-table .col-actions { width: 130px; text-align: left; }

    /* ================= مربع اختيار الصف ================= */
    .perm-page .perm-table tbody .perm-check,
    .perm-page input.perm-check[type="checkbox"] {
        -webkit-appearance: none !important;
        appearance: none !important;
        width: 24px !important;
        height: 24px !important;
        min-width: 24px !important;
        border: 2px solid #cbd5e1 !important;
        border-radius: 7px !important;
        cursor: pointer !important;
        background-color: #fff !important;
        background-image: none !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        background-size: 16px 16px !important;
        vertical-align: middle !important;
        margin: 0 !important;
        padding: 0 !important;
        display: inline-block !important;
        box-sizing: border-box !important;
        transition: all .2s ease !important;
        box-shadow: 0 1px 2px rgba(0,0,0,.05) !important;
    }
    .perm-page .perm-table tbody .perm-check:hover,
    .perm-page input.perm-check[type="checkbox"]:hover {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .18) !important;
        transform: scale(1.08) !important;
    }
    .perm-page .perm-table tbody .perm-check:focus,
    .perm-page input.perm-check[type="checkbox"]:focus {
        outline: none !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .28) !important;
    }
    .perm-page .perm-table tbody .perm-check:checked,
    .perm-page input.perm-check[type="checkbox"]:checked {
        background-color: #6366f1 !important;
        border-color: #6366f1 !important;
        background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23ffffff' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round' d='M3 8.5l3.5 3.5L13 5'/%3E%3C/svg%3E") !important;
        box-shadow: 0 4px 12px rgba(99, 102, 241, .4) !important;
    }

    .perm-page .perm-table tbody td:first-child { cursor: pointer; }

    /* ============ تحديد الكل ============ */
    .perm-page .perm-select-all {
        -webkit-appearance: none !important;
        appearance: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 26px !important;
        height: 26px !important;
        padding: 0 !important;
        border: 2px solid #cbd5e1 !important;
        background: #fff !important;
        border-radius: 7px !important;
        cursor: pointer !important;
        transition: all .2s ease !important;
        vertical-align: middle !important;
        box-shadow: 0 1px 2px rgba(0,0,0,.05) !important;
    }
    .perm-page .perm-select-all:hover {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .18) !important;
        transform: scale(1.08) !important;
    }
    .perm-page .perm-select-all-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: #fff;
    }
    .perm-page .perm-select-all-icon,
    .perm-page .perm-select-all-dash {
        width: 16px;
        height: 16px;
        display: none;
    }
    .perm-page .perm-select-all.is-partial {
        background: #6366f1 !important;
        border-color: #6366f1 !important;
    }
    .perm-page .perm-select-all.is-partial .perm-select-all-dash { display: block !important; }
    .perm-page .perm-select-all.is-all {
        background: #6366f1 !important;
        border-color: #6366f1 !important;
    }
    .perm-page .perm-select-all.is-all .perm-select-all-icon { display: block !important; }

    /* ================= شارة الفهرس ================= */
    .perm-page .perm-index {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: var(--p-primary-soft);
        color: var(--p-primary);
        font-weight: 700;
        font-size: 13px;
    }

    /* ================= خلية الاسم ================= */
    .perm-page .perm-name {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 600;
        font-size: 15px;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    .perm-page .perm-name-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        color: var(--p-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }
    .perm-page .perm-name-text { color: var(--p-text); }

    /* ================= شارات الصلاحيات ================= */
    .perm-page .perm-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 11px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 600;
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        margin: 2px;
    }
    .perm-page .perm-badge-more {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 11px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 600;
        background: var(--p-primary-soft);
        color: var(--p-primary);
        border: 1px solid #c7d2fe;
        margin: 2px;
        cursor: pointer;
    }
    .perm-page .perm-badge-empty {
        display: inline-block;
        font-size: 13px;
        color: #9ca3af;
    }

    /* ================= أزرار الإجراءات ================= */
    .perm-page .perm-actions {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        flex-direction: row-reverse;
    }
    .perm-page .perm-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 10px;
        border: 1px solid var(--p-border);
        background: #fff;
        color: var(--p-muted);
        font-size: 15px;
        cursor: pointer;
        text-decoration: none;
        padding: 0;
        transition: all .2s ease;
    }
    .perm-page .perm-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0,0,0,.08);
    }
    .perm-page .perm-action-btn.edit:hover {
        background: var(--p-primary-soft);
        color: var(--p-primary);
        border-color: #c7d2fe;
    }
    .perm-page .perm-action-btn.delete:hover {
        background: var(--p-danger-soft);
        color: var(--p-danger);
        border-color: #fecaca;
    }

    /* ================= حالة فارغة ================= */
    .perm-page .perm-empty {
        text-align: center;
        padding: 60px 20px;
        color: var(--p-muted);
        font-size: 15px;
    }
    .perm-page .perm-empty i {
        font-size: 40px;
        display: block;
        margin-bottom: 12px;
        color: #d1d5db;
    }

    /* ================= ترقيم الصفحات ================= */
    .perm-page .perm-pagination {
        padding: 18px 22px;
        border-top: 1px solid var(--p-border);
        display: flex;
        justify-content: flex-end;
    }
    .perm-page .perm-pagination .pagination {
        margin: 0;
        gap: 6px;
        direction: rtl;
        flex-wrap: wrap;
    }
    .perm-page .perm-pagination .page-item .page-link {
        border: 1px solid var(--p-border);
        border-radius: 10px !important;
        color: var(--p-text);
        font-size: 14px;
        font-weight: 600;
        padding: 9px 14px;
        transition: all .2s ease;
        direction: ltr;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .perm-page .perm-pagination .page-link:hover {
        background: var(--p-primary-soft);
        color: var(--p-primary);
        border-color: #c7d2fe;
    }
    .perm-page .perm-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-color: transparent;
        color: #fff;
    }

    /* ================= إشعار ================= */
    .perm-page .perm-toast-wrap {
        position: fixed;
        top: 24px;
        left: 24px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 380px;
    }
    .perm-page .perm-toast {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px 20px;
        background: #fff;
        border-radius: 12px;
        border-right: 4px solid var(--p-success);
        box-shadow: 0 12px 28px rgba(0,0,0,.12);
        min-width: 280px;
        font-size: 15px;
        color: var(--p-text);
        font-weight: 500;
        animation: permToastIn .35s ease both;
        flex-direction: row-reverse;
    }
    .perm-page .perm-toast i { color: var(--p-success); font-size: 19px; }
    .perm-page .perm-toast.error { border-right-color: var(--p-danger); }
    .perm-page .perm-toast.error i { color: var(--p-danger); }
    @keyframes permToastIn {
        from { opacity: 0; transform: translateX(-40px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    .perm-page .perm-toast.hide {
        opacity: 0;
        transform: translateX(-40px);
        transition: opacity .3s ease, transform .3s ease;
    }

    /* ================= النافذة المنبثقة ================= */
    .perm-page .perm-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(17, 24, 39, .55);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 10000;
        opacity: 0;
        visibility: hidden;
        transition: opacity .25s ease, visibility .25s ease;
    }
    .perm-page .perm-modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    .perm-page .perm-modal {
        background: #fff;
        border-radius: 16px;
        padding: 28px;
        width: 100%;
        max-width: 440px;
        box-shadow: 0 24px 60px rgba(0,0,0,.25);
        transform: scale(.92);
        transition: transform .25s ease;
        text-align: right;
    }
    .perm-page .perm-modal-overlay.active .perm-modal { transform: scale(1); }
    .perm-page .perm-modal-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: var(--p-danger-soft);
        color: var(--p-danger);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 16px;
    }
    .perm-page .perm-modal h4 {
        margin: 0 0 8px;
        font-size: 20px;
        font-weight: 700;
        color: var(--p-text);
    }
    .perm-page .perm-modal p {
        margin: 0 0 22px;
        font-size: 15px;
        color: var(--p-muted);
        line-height: 1.55;
    }
    .perm-page .perm-modal-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-start;
        flex-direction: row-reverse;
    }
    .perm-page .perm-modal-btn {
        padding: 11px 20px;
        border-radius: 10px;
        border: 1px solid var(--p-border);
        background: #fff;
        color: var(--p-text);
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s ease;
        font-family: inherit;
    }
    .perm-page .perm-modal-btn:hover { background: var(--p-bg); }
    .perm-page .perm-modal-btn.danger {
        background: var(--p-danger);
        border-color: var(--p-danger);
        color: #fff;
    }
    .perm-page .perm-modal-btn.danger:hover { background: #dc2626; }

    /* ================= استجابة الجوال ================= */
    @media (max-width: 640px) {
        .perm-page .perm-header h3 { font-size: 20px; }
        .perm-page .perm-header-icon { width: 48px; height: 48px; font-size: 20px; }
        .perm-page .perm-toolbar { padding: 14px 16px; }
        .perm-page .perm-table thead th,
        .perm-page .perm-table tbody td { padding: 13px 14px; font-size: 14px; }
        .perm-page .perm-pagination { justify-content: center; }
        .perm-page .perm-toast-wrap { top: 12px; left: 12px; right: 12px; }
        .perm-page .perm-toast { min-width: auto; }
        .perm-page .perm-actions { gap: 6px; }
        .perm-page .perm-action-btn { width: 34px; height: 34px; font-size: 13px; }
        .perm-page .perm-name { gap: 8px; }
        .perm-page .perm-name-icon { width: 32px; height: 32px; font-size: 13px; }
    }
</style>

{{-- ✅ .perm-page يلتف على كل شيء بما في ذلك النافذة --}}
<div class="main-content-inner perm-page" dir="rtl">
    <div class="main-content-wrap">

        {{-- الإشعارات --}}
        <div class="perm-toast-wrap" id="permToastWrap" role="status" aria-live="polite">
            @if(session('success'))
                <div class="perm-toast">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="perm-toast error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
        </div>

        {{-- رأس الصفحة --}}
        <div class="perm-header">
            <div class="perm-header-left">
                <div class="perm-header-icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <h3>الأدوار</h3>
                    <p>إدارة جميع أدوار النظام والصلاحيات المرتبطة بها</p>
                </div>
            </div>
            <a class="perm-btn-add" href="{{ route('roles.create') }}">
                <i class="fa-solid fa-plus"></i>
                <span>إضافة دور جديد</span>
            </a>
        </div>

        {{-- البطاقة --}}
        <div class="perm-card">
            <div class="perm-toolbar">
                <div class="perm-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="permSearch" placeholder="بحث في الأدوار..." autocomplete="off">
                </div>
            </div>

            <div class="perm-table-wrap">
                <table class="perm-table" id="permTable">
                    <thead>
                        <tr>
                            <th class="col-check">
                                <button type="button" class="perm-select-all" id="permSelectAll" title="تحديد الكل">
                                    <span class="perm-select-all-box" aria-hidden="true">
                                        <svg viewBox="0 0 16 16" class="perm-select-all-icon">
                                            <path d="M3 8.5l3.5 3.5L13 5" fill="none" stroke="currentColor"
                                                  stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg viewBox="0 0 16 16" class="perm-select-all-dash">
                                            <path d="M4 8h8" fill="none" stroke="currentColor"
                                                  stroke-width="2.5" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                </button>
                            </th>
                            <th class="col-index sortable" data-sort="index">
                                # <span class="sort-icon">▲</span>
                            </th>
                            <th class="sortable" data-sort="name">
                                اسم الدور <span class="sort-icon">▲</span>
                            </th>
                            <th class="sortable" data-sort="permissions">
                                الصلاحيات <span class="sort-icon">▲</span>
                            </th>
                            <th class="col-actions">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="permTableBody">
                        @forelse($roles as $role)
                            @php
                                $permNames = $role->permissions->pluck('name')->map(fn($n) => strtolower($n))->implode(' ');
                            @endphp
                            <tr data-name="{{ strtolower($role->name) }}"
                                data-permissions="{{ $permNames }}">
                                <td>
                                    <input type="checkbox" class="perm-check perm-row-check" value="{{ $role->id }}">
                                </td>
                                <td>
                                    <span class="perm-index">{{ $roles->firstItem() + $loop->index }}</span>
                                </td>
                                <td>
                                    <div class="perm-name">
                                        <span class="perm-name-icon">
                                            <i class="fa-solid fa-user-shield"></i>
                                        </span>
                                        <span class="perm-name-text">{{ $role->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php $perms = $role->permissions; @endphp
                                    @if($perms->isEmpty())
                                        <span class="perm-badge-empty">— لا توجد صلاحيات —</span>
                                    @else
                                        @foreach($perms->take(4) as $permission)
                                            <span class="perm-badge">
                                                <i class="fa-solid fa-key"></i>
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                        @if($perms->count() > 4)
                                            <span class="perm-badge-more"
                                                  title="{{ $perms->skip(4)->pluck('name')->implode(', ') }}">
                                                <i class="fa-solid fa-plus"></i>
                                                {{ $perms->count() - 4 }} أخرى
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="perm-actions">
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="perm-action-btn edit"
                                           title="تعديل">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <button type="button"
                                                class="perm-action-btn delete perm-delete-btn"
                                                title="حذف"
                                                data-name="{{ $role->name }}"
                                                data-url="{{ route('roles.destroy', $role->id) }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="perm-empty">
                                    <i class="fa-solid fa-inbox"></i>
                                    لا توجد أدوار. اضغط على "إضافة دور جديد" لإنشاء واحد.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($roles->hasPages())
                <div class="perm-pagination">
                    {{ $roles->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    {{-- ✅ النافذة الآن داخل .perm-page --}}
    <div class="perm-modal-overlay" id="permDeleteModal">
        <div class="perm-modal">
            <div class="perm-modal-icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h4 id="permModalTitle">حذف الدور؟</h4>
            <p id="permModalText">لا يمكن التراجع عن هذا الإجراء.</p>
            <div class="perm-modal-actions">
                <button type="button" class="perm-modal-btn" id="permModalCancel">إلغاء</button>
                <button type="button" class="perm-modal-btn danger" id="permModalConfirm">حذف</button>
            </div>
        </div>
    </div>

    {{-- ✅ النموذج داخل .perm-page --}}
    <form id="permDeleteForm" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>

</div>{{-- ⬅️ إغلاق .perm-page --}}

<script>
(function () {
    'use strict';

    var tableBody   = document.getElementById('permTableBody');
    var searchInput = document.getElementById('permSearch');
    var selectAll   = document.getElementById('permSelectAll');
    var toastWrap   = document.getElementById('permToastWrap');

    /* -------- Toast ديناميكي -------- */
    function showToast(msg, type) {
        type = type || 'success';
        var t = document.createElement('div');
        t.className = 'perm-toast' + (type === 'error' ? ' error' : '');
        var icon = type === 'error' ? 'fa-circle-exclamation' : 'fa-circle-check';
        t.innerHTML = '<i class="fa-solid ' + icon + '"></i><span>' + msg + '</span>';
        toastWrap.appendChild(t);
        setTimeout(function () {
            t.classList.add('hide');
            setTimeout(function () { t.remove(); }, 300);
        }, 4000);
    }

    /* -------- البحث -------- */
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            var rows = tableBody.querySelectorAll('tr[data-name]');
            rows.forEach(function (row) {
                var name = row.getAttribute('data-name');
                var perms = row.getAttribute('data-permissions') || '';
                row.style.display = (name.indexOf(q) !== -1 || perms.indexOf(q) !== -1) ? '' : 'none';
            });
            updateSelectAll();
        });
    }

    /* -------- الترتيب -------- */
    var sortState = { key: null, dir: 'asc' };
    document.querySelectorAll('.perm-table thead th.sortable').forEach(function (th) {
        th.addEventListener('click', function () {
            var key = th.getAttribute('data-sort');
            if (sortState.key === key) {
                sortState.dir = sortState.dir === 'asc' ? 'desc' : 'asc';
            } else {
                sortState.key = key;
                sortState.dir = 'asc';
            }
            document.querySelectorAll('.perm-table thead th.sortable').forEach(function (h) {
                h.classList.remove('sorted-asc', 'sorted-desc');
            });
            th.classList.add(sortState.dir === 'asc' ? 'sorted-asc' : 'sorted-desc');

            var rows = Array.prototype.slice.call(tableBody.querySelectorAll('tr[data-name]'));
            rows.sort(function (a, b) {
                var av, bv;
                if (key === 'index') {
                    av = parseInt(a.querySelector('.perm-index').textContent.trim(), 10);
                    bv = parseInt(b.querySelector('.perm-index').textContent.trim(), 10);
                } else {
                    av = a.getAttribute('data-' + key) || '';
                    bv = b.getAttribute('data-' + key) || '';
                }
                if (av < bv) return sortState.dir === 'asc' ? -1 : 1;
                if (av > bv) return sortState.dir === 'asc' ? 1 : -1;
                return 0;
            });
            rows.forEach(function (r) { tableBody.appendChild(r); });
        });
    });

    /* -------- التحديد -------- */
    function visibleChecks() {
        return Array.prototype.filter.call(
            tableBody.querySelectorAll('.perm-row-check'),
            function (cb) { return cb.closest('tr').style.display !== 'none'; }
        );
    }

    function updateSelectAll() {
        if (!selectAll) return;
        var checks  = visibleChecks();
        var checked = checks.filter(function (cb) { return cb.checked; });

        selectAll.classList.remove('is-all', 'is-partial');
        if (checks.length > 0 && checked.length === checks.length) {
            selectAll.classList.add('is-all');
            selectAll.setAttribute('title', 'إلغاء تحديد الكل');
        } else if (checked.length > 0) {
            selectAll.classList.add('is-partial');
            selectAll.setAttribute('title', 'تحديد الكل');
        } else {
            selectAll.setAttribute('title', 'تحديد الكل');
        }
    }

    if (selectAll) {
        selectAll.addEventListener('click', function () {
            var allChecked = selectAll.classList.contains('is-all');
            visibleChecks().forEach(function (cb) { cb.checked = !allChecked; });
            updateSelectAll();
        });
    }

    tableBody.addEventListener('change', function (e) {
        if (e.target.classList && e.target.classList.contains('perm-row-check')) {
            updateSelectAll();
        }
    });

    /* النقر على الخلية الأولى بالكامل */
    tableBody.addEventListener('click', function (e) {
        var cell = e.target.closest('td');
        if (!cell || cell.cellIndex !== 0) return;
        if (e.target.classList.contains('perm-row-check')) return;
        var cb = cell.querySelector('.perm-row-check');
        if (!cb) return;
        cb.checked = !cb.checked;
        updateSelectAll();
    });

    /* -------- النافذة المنبثقة -------- */
    var modal        = document.getElementById('permDeleteModal');
    var modalTitle   = document.getElementById('permModalTitle');
    var modalText    = document.getElementById('permModalText');
    var modalCancel  = document.getElementById('permModalCancel');
    var modalConfirm = document.getElementById('permModalConfirm');
    var pending      = null;

    function openModal(cfg) {
        pending = cfg;
        if (cfg.type === 'single') {
            modalTitle.textContent = 'حذف الدور؟';
            modalText.textContent  = 'هل أنت متأكد من حذف "' + cfg.name + '"؟ لا يمكن التراجع عن هذا الإجراء.';
        }
        modal.classList.add('active');
    }
    function closeModal() {
        modal.classList.remove('active');
        pending = null;
    }

    modalCancel.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
    });

    tableBody.addEventListener('click', function (e) {
        var btn = e.target.closest('.perm-delete-btn');
        if (!btn) return;
        openModal({
            type: 'single',
            name: btn.getAttribute('data-name'),
            url:  btn.getAttribute('data-url'),
            row:  btn.closest('tr')
        });
    });

    modalConfirm.addEventListener('click', function () {
        if (!pending) return;
        pending.row.classList.add('removing');
        var form = document.getElementById('permDeleteForm');
        form.action = pending.url;
        setTimeout(function () { form.submit(); }, 250);
    });

    /* إخفاء تلقائي للإشعارات الأولية */
    document.querySelectorAll('.perm-toast').forEach(function (toast) {
        setTimeout(function () {
            toast.classList.add('hide');
            setTimeout(function () { toast.remove(); }, 300);
        }, 4000);
    });

    updateSelectAll();

})();
</script>

@endsection
       