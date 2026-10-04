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
        --p-bg-soft: #fafbff;
    }
    .perm-page * { box-sizing: border-box; }

    /* ================= رأس الصفحة ================= */
    .perm-page .perm-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 20px;
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
        margin: 4px 0 0;
        font-size: 14px;
        color: var(--p-muted);
    }

    /* ================= مسار التنقل ================= */
    .perm-page .perm-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        list-style: none;
        padding: 0;
        margin: 0 0 18px;
        font-size: 13.5px;
    }
    .perm-page .perm-breadcrumb li {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--p-muted);
    }
    .perm-page .perm-breadcrumb li a {
        color: var(--p-muted);
        text-decoration: none;
    }
    .perm-page .perm-breadcrumb li a:hover { color: var(--p-primary); }
    .perm-page .perm-breadcrumb li.active {
        color: var(--p-primary);
        font-weight: 600;
    }
    .perm-page .perm-breadcrumb .sep { color: #cbd5e1; font-size: 11px; }

    /* ================= أزرار ================= */
    .perm-page .perm-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 12px;
        font-size: 14.5px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid var(--p-border);
        background: #fff;
        color: var(--p-text);
        transition: transform .2s ease, box-shadow .2s ease;
        font-family: inherit;
        white-space: nowrap;
    }
    .perm-page .perm-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        background: var(--p-bg);
    }
    .perm-page .perm-btn.primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        border: none;
        box-shadow: 0 6px 16px rgba(99, 102, 241, .35);
    }
    .perm-page .perm-btn.primary:hover {
        box-shadow: 0 10px 22px rgba(99, 102, 241, .45);
        color: #fff;
    }
    .perm-page .perm-btn.ghost-danger {
        color: var(--p-danger);
        border-color: #fecaca;
    }
    .perm-page .perm-btn.ghost-danger:hover {
        background: var(--p-danger-soft);
    }

    /* Spinner */
    .perm-page .perm-spinner {
        width: 16px; height: 16px;
        border: 2px solid rgba(255,255,255,.4);
        border-top-color: #fff;
        border-radius: 50%;
        animation: permSpin .7s linear infinite;
        display: none;
    }
    @keyframes permSpin { to { transform: rotate(360deg); } }
    .perm-page .perm-btn.loading .perm-spinner { display: inline-block; }
    .perm-page .perm-btn.loading .perm-btn-icon { display: none; }

    /* ================= البطاقة ================= */
    .perm-page .perm-card {
        background: #fff;
        border: 1px solid var(--p-border);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,.05);
        overflow: hidden;
    }
    .perm-page .perm-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 22px;
        border-bottom: 1px solid var(--p-border);
        background: #fff;
    }
    .perm-page .perm-card-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }
    .perm-page .perm-card-header-icon {
        width: 40px; height: 40px;
        border-radius: 11px;
        background: var(--p-primary-soft);
        color: var(--p-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }
    .perm-page .perm-card-header h4 {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: var(--p-text);
    }
    .perm-page .perm-card-header p {
        margin: 2px 0 0;
        font-size: 13px;
        color: var(--p-muted);
    }

    .perm-page .perm-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 600;
        background: var(--p-primary-soft);
        color: var(--p-primary);
        border: 1px solid #c7d2fe;
        white-space: nowrap;
    }
    .perm-page .perm-status-badge.dirty {
        background: #fffbeb;
        color: #b45309;
        border-color: #fcd34d;
    }

    .perm-page .perm-card-body {
        padding: 26px 22px;
    }

    /* ============================================ */
    /* 🎯 الشبكة: حقلان في الصف                     */
    /* ============================================ */
    .perm-page .perm-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px 18px;
        align-items: start;
    }
    .perm-page .perm-grid > .perm-full {
        grid-column: 1 / -1;
    }
    .perm-page .perm-grid > .alert {
        grid-column: 1 / -1;
    }

    @media (max-width: 640px) {
        .perm-page .perm-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
    }

    /* ============================================ */
    /* ✅ دعم fieldset.name و fieldset.Role          */
    /* ============================================ */
    .perm-page .perm-grid > fieldset {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin: 0;
        padding: 0;
        border: 0;
        min-width: 0;
    }
    .perm-page .perm-grid > fieldset > .body-title {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--p-text);
        margin: 0;
    }
    .perm-page .perm-grid > fieldset > .body-title .tf-color-1,
    .perm-page .perm-grid > fieldset > .body-title .required {
        color: var(--p-danger);
        margin-inline-start: 3px;
    }
    .perm-page .perm-grid > fieldset > .body-title .text-tiny {
        font-size: 12px;
        font-weight: 400;
        color: var(--p-muted);
        margin-inline-start: 4px;
    }

    /* حقول الإدخال داخل fieldset */
    .perm-page .perm-grid > fieldset > input[type="text"],
    .perm-page .perm-grid > fieldset > input[type="email"],
    .perm-page .perm-grid > fieldset > input[type="password"],
    .perm-page .perm-grid > fieldset > input[type="number"],
    .perm-page .perm-grid > fieldset > input[type="search"],
    .perm-page .perm-grid > fieldset > input[type="date"],
    .perm-page .perm-grid > fieldset > input[type="time"],
    .perm-page .perm-grid > fieldset > input[type="tel"],
    .perm-page .perm-grid > fieldset > input[type="url"],
    .perm-page .perm-grid > fieldset > select,
    .perm-page .perm-grid > fieldset > textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid var(--p-border);
        border-radius: 10px;
        font-size: 15px;
        color: var(--p-text);
        background: var(--p-bg);
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        font-family: inherit;
        line-height: 1.4;
        box-sizing: border-box;
        flex: none;
    }
    .perm-page .perm-grid > fieldset > input:focus,
    .perm-page .perm-grid > fieldset > select:focus,
    .perm-page .perm-grid > fieldset > textarea:focus {
        background: #fff;
        border-color: var(--p-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .12);
    }
    .perm-page .perm-grid > fieldset > input::placeholder {
        color: #9ca3af;
    }

    /* ============================================ */
    /* الحقول العامة (label + input)                 */
    /* ============================================ */
    .perm-page .perm-field {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin: 0;
        min-width: 0;
    }
    .perm-page .perm-field > label,
    .perm-page .perm-field > .body-title {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--p-text);
        margin: 0;
    }
    .perm-page .perm-field > label .required,
    .perm-page .perm-field > .body-title .required,
    .perm-page .perm-field > .body-title .tf-color-1 {
        color: var(--p-danger);
        margin-inline-start: 3px;
    }

    /* حقول الإدخال */
    .perm-page .perm-field > input[type="text"],
    .perm-page .perm-field > input[type="email"],
    .perm-page .perm-field > input[type="password"],
    .perm-page .perm-field > input[type="number"],
    .perm-page .perm-field > input[type="search"],
    .perm-page .perm-field > select,
    .perm-page .perm-field > textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid var(--p-border);
        border-radius: 10px;
        font-size: 15px;
        color: var(--p-text);
        background: var(--p-bg);
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        font-family: inherit;
        line-height: 1.4;
        box-sizing: border-box;
    }
    .perm-page .perm-field > input:focus,
    .perm-page .perm-field > select:focus,
    .perm-page .perm-field > textarea:focus {
        background: #fff;
        border-color: var(--p-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .12);
    }
    .perm-page .perm-field > input::placeholder {
        color: #9ca3af;
    }

    /* ============================================ */
    /* قائمة الصلاحيات (شبكة checkboxes)             */
    /* ============================================ */
    .perm-page .perm-perms-box {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 10px;
        padding: 16px;
        background: var(--p-bg);
        border: 1px solid var(--p-border);
        border-radius: 12px;
        max-height: 420px;
        overflow-y: auto;
    }
    .perm-page .perm-perms-box::-webkit-scrollbar { width: 8px; }
    .perm-page .perm-perms-box::-webkit-scrollbar-track { background: transparent; }
    .perm-page .perm-perms-box::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 4px;
    }
    .perm-page .perm-perms-box::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }

    /* عنصر صلاحية واحد */
    .perm-page .perm-perm-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 10px;
        border: 1px solid var(--p-border);
        background: #fff;
        font-size: 13.5px;
        font-weight: 500;
        color: var(--p-text);
        cursor: pointer;
        margin: 0;
        transition: border-color .2s ease, background .2s ease, transform .15s ease;
        user-select: none;
        min-width: 0;
    }
    .perm-page .perm-perm-item:hover {
        border-color: var(--p-primary);
        background: var(--p-primary-soft);
        transform: translateY(-1px);
    }
    .perm-page .perm-perm-item input[type="checkbox"] {
        width: 18px;
        height: 18px;
        min-width: 18px;
        accent-color: var(--p-primary);
        cursor: pointer;
        margin: 0;
        flex-shrink: 0;
    }
    .perm-page .perm-perm-item .perm-perm-name {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        flex: 1;
        min-width: 0;
    }
    .perm-page .perm-perm-item:has(input:checked) {
        border-color: var(--p-primary);
        background: var(--p-primary-soft);
    }
    .perm-page .perm-perm-item:has(input:checked) .perm-perm-name {
        color: var(--p-primary);
        font-weight: 600;
    }

    /* شريط أدوات الصلاحيات */
    .perm-page .perm-perms-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }
    .perm-page .perm-perms-counter {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        background: var(--p-primary-soft);
        color: var(--p-primary);
        border: 1px solid #c7d2fe;
    }
    .perm-page .perm-perms-tools {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .perm-page .perm-perms-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: 8px;
        border: 1px solid var(--p-border);
        background: #fff;
        color: var(--p-text);
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s ease;
        font-family: inherit;
    }
    .perm-page .perm-perms-btn:hover {
        border-color: var(--p-primary);
        background: var(--p-primary-soft);
        color: var(--p-primary);
    }

    /* ================= رسائل الخطأ ================= */
    .perm-page .perm-error {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 6px;
        font-size: 13px;
        color: var(--p-danger);
        font-weight: 500;
    }
    .perm-page .perm-error::before {
        content: "\f06a";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        font-size: 12px;
    }
    .perm-page .alert-danger {
        display: block;
        padding: 10px 14px;
        border-radius: 10px;
        background: var(--p-danger-soft);
        color: var(--p-danger);
        font-size: 13px;
        font-weight: 500;
        border: 1px solid #fecaca;
        margin: 0 0 16px;
    }

    /* ================= شريط أزرار الأسفل ================= */
    .perm-page .perm-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        padding: 18px 22px;
        border-top: 1px solid var(--p-border);
        background: var(--p-bg-soft);
    }
    .perm-page .perm-form-footer-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .perm-page .perm-help {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: var(--p-muted);
        margin: 0;
    }

    /* ================= إشعار ================= */
    .perm-page .perm-toast-wrap {
        position: fixed;
        top: 24px; left: 24px;
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

    /* ================= استجابة الجوال ================= */
    @media (max-width: 640px) {
        .perm-page .perm-header h3 { font-size: 20px; }
        .perm-page .perm-header-icon { width: 48px; height: 48px; font-size: 20px; }
        .perm-page .perm-card-body { padding: 20px 16px; }
        .perm-page .perm-card-header { padding: 14px 16px; }
        .perm-page .perm-form-footer { padding: 16px; }
        .perm-page .perm-form-footer-actions { width: 100%; }
        .perm-page .perm-form-footer-actions .perm-btn { flex: 1; }
        .perm-page .perm-toast-wrap { top: 12px; left: 12px; right: 12px; }
        .perm-page .perm-toast { min-width: auto; }
        .perm-page .perm-perms-box {
            grid-template-columns: 1fr;
            max-height: 320px;
        }
    }
</style>

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
            @if($errors->any())
                <div class="perm-toast error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>يرجى مراجعة الحقول المطلوبة.</span>
                </div>
            @endif
        </div>

        {{-- رأس الصفحة --}}
        <div class="perm-header">
            <div class="perm-header-left">
                <div class="perm-header-icon">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
                <div>
                    <h3>تعديل الدور: {{ $role->name }}</h3>
                    <p>قم بتحديث بيانات الدور والصلاحيات المرتبطة به</p>
                </div>
            </div>
            <a class="perm-btn" href="{{ route('roles.index') }}">
                <i class="fa-solid fa-arrow-right"></i>
                <span>العودة للقائمة</span>
            </a>
        </div>

        {{-- مسار التنقل --}}
        <ul class="perm-breadcrumb">
            <li><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="sep"><i class="fa-solid fa-chevron-left"></i></li>
            <li><a href="{{ route('roles.index') }}">الأدوار</a></li>
            <li class="sep"><i class="fa-solid fa-chevron-left"></i></li>
            <li class="active">تعديل الدور</li>
        </ul>

        {{-- البطاقة --}}
        <div class="perm-card">
            <div class="perm-card-header">
                <div class="perm-card-header-left">
                    <div class="perm-card-header-icon">
                        <i class="fa-solid fa-id-badge"></i>
                    </div>
                    <div>
                        <h4>بيانات الدور</h4>
                        <p>جميع الحقول المُعلَّمة بـ <span style="color:#ef4444;">*</span> مطلوبة</p>
                    </div>
                </div>
                <span class="perm-status-badge" id="permFormStatus">
                    <i class="fa-solid fa-circle"></i>
                    <span>جاهز</span>
                </span>
            </div>

            <form method="POST"
                  action="{{ route('roles.update', $role->id) }}"
                  id="permRoleForm"
                  class="form-new-product form-style-1"
                  autocomplete="off"
                  novalidate>
                @csrf
                @method('PUT')

                <div class="perm-card-body">
                    @include('dashboard.roles._form', ['submit' => 'Update Role'])
                </div>

                {{-- شريط الأزرار --}}
                <div class="perm-form-footer">
                    <div class="perm-form-footer-actions">
                        <a href="{{ route('roles.index') }}" class="perm-btn">
                            <i class="fa-solid fa-xmark"></i>
                            <span>إلغاء</span>
                        </a>
                        <button type="reset" class="perm-btn ghost-danger" id="permResetBtn">
                            <i class="fa-solid fa-rotate-right"></i>
                            <span>إعادة تعيين</span>
                        </button>
                    </div>
                    <div class="perm-form-footer-actions">
                        <span class="perm-help" style="margin:0;">
                            <i class="fa-regular fa-keyboard"></i>
                            اضغط <kbd style="background:#fff;border:1px solid #e5e7eb;border-radius:5px;padding:1px 6px;font-size:11px;">Ctrl + Enter</kbd> للحفظ
                        </span>
                        <button type="submit" class="perm-btn primary" id="permSubmitBtn">
                            <span class="perm-spinner" aria-hidden="true"></span>
                            <i class="fa-solid fa-floppy-disk perm-btn-icon"></i>
                            <span class="perm-btn-text">حفظ التغييرات</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    var form        = document.getElementById('permRoleForm');
    var submitBtn   = document.getElementById('permSubmitBtn');
    var resetBtn    = document.getElementById('permResetBtn');
    var statusBadge = document.getElementById('permFormStatus');
    var toastWrap   = document.getElementById('permToastWrap');

    /* ================= Toast ================= */
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

    /* إخفاء تلقائي للإشعارات الأولية */
    document.querySelectorAll('.perm-toast').forEach(function (toast) {
        setTimeout(function () {
            toast.classList.add('hide');
            setTimeout(function () { toast.remove(); }, 300);
        }, 4000);
    });

    /* ================= حالة النموذج (Dirty Tracking) ================= */
    var initialState = new FormData(form);
    var initialKey = '';
    initialState.forEach(function (v, k) {
        if (k === '_token' || k === '_method') return;
        initialKey += k + '=' + v + '&';
    });

    function setStatus(state) {
        if (!statusBadge) return;
        statusBadge.classList.toggle('dirty', state === 'dirty');
        var span = statusBadge.querySelector('span');
        span.textContent = state === 'dirty' ? 'تغييرات غير محفوظة' : 'جاهز';
    }

    function isDirty() {
        var current = new FormData(form);
        var key = '';
        current.forEach(function (v, k) {
            if (k === '_token' || k === '_method') return;
            key += k + '=' + v + '&';
        });
        return key !== initialKey;
    }

    form.addEventListener('input', function () { setStatus(isDirty() ? 'dirty' : 'clean'); });
    form.addEventListener('change', function () { setStatus(isDirty() ? 'dirty' : 'clean'); });

    /* ================= عدّاد الصلاحيات المحددة ================= */
    var permCounter = document.getElementById('permCounter');

    function updatePermCounter() {
        if (!permCounter) return;
        var checked = form.querySelectorAll('input[name="permissions[]"]:checked').length;
        permCounter.querySelector('span').textContent = checked + ' محددة';
    }

    var selectAllPermsBtn = document.getElementById('permSelectAllPerms');
    var clearAllPermsBtn  = document.getElementById('permClearAllPerms');

    if (selectAllPermsBtn) {
        selectAllPermsBtn.addEventListener('click', function () {
            form.querySelectorAll('input[name="permissions[]"]').forEach(function (cb) {
                cb.checked = true;
            });
            updatePermCounter();
            setStatus(isDirty() ? 'dirty' : 'clean');
        });
    }
    if (clearAllPermsBtn) {
        clearAllPermsBtn.addEventListener('click', function () {
            form.querySelectorAll('input[name="permissions[]"]').forEach(function (cb) {
                cb.checked = false;
            });
            updatePermCounter();
            setStatus(isDirty() ? 'dirty' : 'clean');
        });
    }

    form.querySelectorAll('input[name="permissions[]"]').forEach(function (cb) {
        cb.addEventListener('change', updatePermCounter);
    });
    updatePermCounter();

    /* ================= التحقق الفوري ================= */
    function attachValidation() {
        var fields = form.querySelectorAll('input, select, textarea');
        fields.forEach(function (field) {
            if (field.type === 'hidden' || field.type === 'checkbox' || field.type === 'radio') return;

            if (field.hasAttribute('required')) {
                field.addEventListener('blur', function () {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        field.classList.remove('is-valid');
                    } else {
                        field.classList.remove('is-invalid');
                        field.classList.add('is-valid');
                    }
                });
            }
        });
    }
    attachValidation();

    /* ================= حالة التحميل ================= */
    form.addEventListener('submit', function (e) {
        form.querySelectorAll('.is-invalid').forEach(function (el) {
            el.classList.remove('is-invalid');
        });

        var firstInvalid = null;
        form.querySelectorAll('[required]').forEach(function (field) {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                if (!firstInvalid) firstInvalid = field;
            }
        });

        if (firstInvalid) {
            e.preventDefault();
            firstInvalid.focus();
            showToast('يرجى تعبئة جميع الحقول المطلوبة.', 'error');
            return;
        }

        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        var textEl = submitBtn.querySelector('.perm-btn-text');
        if (textEl) textEl.textContent = 'جاري الحفظ...';
    });

    /* ================= Ctrl + Enter للحفظ ================= */
    form.addEventListener('keydown', function (e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            submitBtn.click();
        }
    });

    /* ================= زر إعادة التعيين ================= */
    if (resetBtn) {
        resetBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (!confirm('هل تريد إعادة التعيين إلى القيم الأصلية؟')) return;
            form.reset();
            form.querySelectorAll('.is-valid, .is-invalid').forEach(function (el) {
                el.classList.remove('is-valid', 'is-invalid');
            });
            updatePermCounter();
            setStatus('clean');
            showToast('تمت إعادة التعيين إلى القيم الأصلية.');
        });
    }

    /* ================= تحذير عند المغادرة ================= */
    window.addEventListener('beforeunload', function (e) {
        if (isDirty() && !submitBtn.classList.contains('loading')) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    /* تركيز أول حقل تلقائياً */
    var firstField = form.querySelector('input:not([type="hidden"]):not([disabled]):not([type="checkbox"]), select:not([disabled]), textarea:not([disabled])');
    if (firstField) firstField.focus();

})();
</script>

@endsection