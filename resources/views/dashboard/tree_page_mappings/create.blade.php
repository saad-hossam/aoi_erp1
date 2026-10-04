@extends('layouts.dashboard.app')
@section('content')

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
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

    /* ================= رأس الصفحة ================= */
    .perm-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }
    .perm-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .perm-header-icon {
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
    }
    .perm-header h3 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: var(--p-text);
    }
    .perm-header p {
        margin: 3px 0 0;
        font-size: 14px;
        color: var(--p-muted);
    }

    .perm-btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 22px;
        background: #fff;
        color: var(--p-text) !important;
        border: 1px solid var(--p-border);
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }
    .perm-btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        background: var(--p-bg);
        color: var(--p-text);
    }

    /* ================= البطاقة ================= */
    .perm-card {
        background: #fff;
        border: 1px solid var(--p-border);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,.05);
        overflow: hidden;
    }

    /* ================= رأس البطاقة ================= */
    .perm-card-head {
        padding: 20px 26px;
        border-bottom: 1px solid var(--p-border);
        background: #fff;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .perm-card-head-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--p-primary-soft);
        color: var(--p-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }
    .perm-card-head h4 {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: var(--p-text);
    }
    .perm-card-head p {
        margin: 2px 0 0;
        font-size: 13px;
        color: var(--p-muted);
    }

    /* ================= جسم النموذج ================= */
    .perm-form-body {
        padding: 26px;
    }

    .perm-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    @media (max-width: 768px) {
        .perm-form-grid { grid-template-columns: 1fr; }
    }

    .perm-field {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .perm-field.full { grid-column: 1 / -1; }

    .perm-field label {
        font-size: 14px;
        font-weight: 600;
        color: var(--p-text);
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .perm-field label .req {
        color: var(--p-danger);
        font-weight: 700;
    }
    .perm-field label .optional {
        color: var(--p-muted);
        font-size: 12px;
        font-weight: 500;
        margin-right: 4px;
    }

    .perm-field input,
    .perm-field select,
    .perm-field textarea {
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
        text-align: right;
    }
    .perm-field input:focus,
    .perm-field select:focus,
    .perm-field textarea:focus {
        background: #fff;
        border-color: var(--p-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .12);
    }
    .perm-field input.is-invalid,
    .perm-field select.is-invalid {
        border-color: var(--p-danger);
        background: var(--p-danger-soft);
    }
    .perm-field input.is-invalid:focus,
    .perm-field select.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, .14);
    }

    .perm-field .hint {
        font-size: 12.5px;
        color: var(--p-muted);
        line-height: 1.5;
        display: flex;
        align-items: center;
        gap: 6px;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    .perm-field .hint i { font-size: 11px; }

    .perm-field .error-msg {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: var(--p-danger);
        font-weight: 600;
        background: var(--p-danger-soft);
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 6px 10px;
        margin-top: 4px;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    .perm-field .error-msg i { font-size: 12px; }

    /* ================= الفوتر ================= */
    .perm-form-footer {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        padding: 20px 26px;
        border-top: 1px solid var(--p-border);
        background: var(--p-bg);
        flex-wrap: wrap;
        flex-direction: row-reverse;
    }

    .perm-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        border: 1px solid transparent;
        transition: transform .2s ease, box-shadow .2s ease, background .2s ease, color .2s ease;
    }
    .perm-btn:hover { transform: translateY(-2px); }

    .perm-btn.cancel {
        background: #fff;
        color: var(--p-text);
        border-color: var(--p-border);
    }
    .perm-btn.cancel:hover {
        background: #fff;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        color: var(--p-text);
    }

    .perm-btn.submit {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff !important;
        box-shadow: 0 6px 16px rgba(99, 102, 241, .35);
    }
    .perm-btn.submit:hover {
        box-shadow: 0 10px 22px rgba(99, 102, 241, .45);
        color: #fff;
    }

    /* ================= التنبيهات ================= */
    .perm-toast-wrap {
        position: fixed;
        top: 24px;
        left: 24px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 380px;
    }
    .perm-toast {
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
    .perm-toast i { color: var(--p-success); font-size: 19px; }
    .perm-toast.error { border-right-color: var(--p-danger); }
    .perm-toast.error i { color: var(--p-danger); }
    @keyframes permToastIn {
        from { opacity: 0; transform: translateX(-40px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    .perm-toast.hide {
        opacity: 0;
        transform: translateX(-40px);
        transition: opacity .3s ease, transform .3s ease;
    }

    /* ================= استجابة الجوال ================= */
    @media (max-width: 640px) {
        .perm-header h3 { font-size: 20px; }
        .perm-header-icon { width: 48px; height: 48px; font-size: 20px; }
        .perm-form-body { padding: 18px; }
        .perm-card-head { padding: 16px 18px; }
        .perm-form-footer { padding: 16px 18px; }
        .perm-btn { flex: 1; justify-content: center; }
        .perm-toast-wrap { top: 12px; left: 12px; right: 12px; }
        .perm-toast { min-width: auto; }
    }
</style>

<div class="main-content-inner perm-page" dir="rtl">
    <div class="main-content-wrap">

        {{-- الإشعارات --}}
        <div class="perm-toast-wrap" id="permToastWrap">
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
                    <span>يوجد {{ $errors->count() }} خطأ في النموذج. يرجى المراجعة.</span>
                </div>
            @endif
        </div>

        {{-- رأس الصفحة --}}
        <div class="perm-header">
            <div class="perm-header-left">
                <div class="perm-header-icon">
                    <i class="fa-solid fa-link"></i>
                </div>
                <div>
                    <h3>إضافة ربط جديد</h3>
                    <p>اربط عقدة من شجرة ERP بصفحة في النظام</p>
                </div>
            </div>
            <a class="perm-btn-back" href="{{ route('admin.tree-page-mappings.index') }}">
                <i class="fa-solid fa-arrow-right"></i>
                <span>العودة للقائمة</span>
            </a>
        </div>

        {{-- البطاقة --}}
        <div class="perm-card">

            {{-- رأس البطاقة --}}
            <div class="perm-card-head">
                <div class="perm-card-head-icon">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
                <div>
                    <h4>إنشاء ربط</h4>
                    <p>الحقول المعلّمة بـ <span style="color:var(--p-danger);font-weight:700;">*</span> إلزامية</p>
                </div>
            </div>

            {{-- النموذج --}}
            <form action="{{ route('admin.tree-page-mappings.store') }}" method="POST">
                @csrf

                <div class="perm-form-body">
                    <div class="perm-form-grid">

                        {{-- عقدة الشجرة --}}
                        <div class="perm-field">
                            <label for="tree_value">
                                عقدة الشجرة <span class="req">*</span>
                            </label>
                            <select
                                id="tree_value"
                                name="tree_value"
                                class="{{ $errors->has('tree_value') ? 'is-invalid' : '' }}"
                                required
                            >
                                <option value="">— اختر عقدة الشجرة —</option>

                                @foreach($nodes as $node)
                                    <option value="{{ $node->value }}"
                                        {{ old('tree_value') == $node->value ? 'selected' : '' }}>
                                        {{ $node->value }} - {{ $node->label }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="hint">
                                <i class="fa-solid fa-circle-info"></i>
                                اختر العقدة من الشجرة الهرمية.
                            </span>
                            @error('tree_value')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- الصفحة --}}
                        <div class="perm-field">
                            <label for="page_id">
                                الصفحة <span class="req">*</span>
                            </label>
                            <select
                                id="page_id"
                                name="page_id"
                                class="{{ $errors->has('page_id') ? 'is-invalid' : '' }}"
                                required
                            >
                                <option value="">— اختر الصفحة —</option>

                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}"
                                        {{ old('page_id') == $page->id ? 'selected' : '' }}>
                                        {{ $page->name }} - {{ $page->slug }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="hint">
                                <i class="fa-solid fa-circle-info"></i>
                                اختر الصفحة التي سيتم ربطها بالعقدة.
                            </span>
                            @error('page_id')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- الفوتر --}}
                <div class="perm-form-footer">
                    <a href="{{ route('admin.tree-page-mappings.index') }}" class="perm-btn cancel">
                        <i class="fa-solid fa-xmark"></i>
                        <span>إلغاء</span>
                    </a>
                    <button type="submit" class="perm-btn submit">
                        <i class="fa-solid fa-check"></i>
                        <span>إنشاء الربط</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    /* إخفاء تلقائي للإشعارات */
    document.querySelectorAll('.perm-toast').forEach(function (toast) {
        setTimeout(function () {
            toast.classList.add('hide');
            setTimeout(function () { toast.remove(); }, 300);
        }, 4500);
    });

})();
</script>

@endsection