@extends('layouts.dashboard.app')
@section('content')

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


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
                    <i class="fa-solid fa-file-circle-plus"></i>
                </div>
                <div>
                    <h3>إنشاء صفحة جديدة</h3>
                    <p>أضف صفحة جديدة إلى النظام مع تحديد خصائصها</p>
                </div>
            </div>
            <a class="perm-btn-back" href="{{ route('admin.pages.index') }}">
                <i class="fa-solid fa-arrow-right"></i>
                <span>العودة للقائمة</span>
            </a>
        </div>

        {{-- البطاقة --}}
        <div class="perm-card">

            {{-- رأس البطاقة --}}
            <div class="perm-card-head">
                <div class="perm-card-head-icon">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <h4>بيانات الصفحة</h4>
                    <p>الحقول المعلّمة بـ <span style="color:var(--p-danger);font-weight:700;">*</span> إلزامية</p>
                </div>
            </div>

            {{-- النموذج --}}
            <form action="{{ route('admin.pages.store') }}" method="POST">
                @csrf

                <div class="perm-form-body">
                    <div class="perm-form-grid">

                        {{-- Name --}}
                        <div class="perm-field full">
                            <label for="name">
                                Page Name <span class="req">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Enter page name"
                                value="{{ old('name') }}"
                                class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                                required
                            >
                            @error('name')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="perm-field">
                            <label for="slug">
                                Slug <span class="req">*</span>
                            </label>
                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                placeholder="example-page"
                                value="{{ old('slug') }}"
                                class="{{ $errors->has('slug') ? 'is-invalid' : '' }}"
                                required
                            >
                            <span class="hint">معرّف فريد للصفحة (Unique identifier).</span>
                            @error('slug')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Type --}}
                        <div class="perm-field">
                            <label for="type">
                                Page Type <span class="req">*</span>
                            </label>
                            <select
                                id="type"
                                name="type"
                                class="{{ $errors->has('type') ? 'is-invalid' : '' }}"
                                required
                            >
                                <option value="">Select Type</option>
                                <option value="application" {{ old('type', 'application') === 'application' ? 'selected' : '' }}>
                                    Application
                                </option>
                                <option value="report" {{ old('type') === 'report' ? 'selected' : '' }}>
                                    Report
                                </option>
                                <option value="form" {{ old('type') === 'form' ? 'selected' : '' }}>
                                    Form
                                </option>
                                <option value="external" {{ old('type') === 'external' ? 'selected' : '' }}>
                                    External
                                </option>
                            </select>
                            @error('type')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Component --}}
                        <div class="perm-field">
                            <label for="component">
                                Component <span class="optional">(اختياري)</span>
                            </label>
                            <input
                                type="text"
                                id="component"
                                name="component"
                                placeholder="dashboard.pages.example"
                                value="{{ old('component') }}"
                                class="{{ $errors->has('component') ? 'is-invalid' : '' }}"
                            >
                            <span class="hint">اسم Blade view أو المكوّن المستخدم في الصفحة.</span>
                            @error('component')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Controller --}}
                        <div class="perm-field">
                            <label for="controller">
                                Controller <span class="optional">(اختياري)</span>
                            </label>
                            <input
                                type="text"
                                id="controller"
                                name="controller"
                                placeholder="App\Http\Controllers\ExampleController"
                                value="{{ old('controller') }}"
                                class="{{ $errors->has('controller') ? 'is-invalid' : '' }}"
                            >
                            <span class="hint">الـ Controller المسؤول عن الصفحة.</span>
                            @error('controller')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Route Name --}}
                        <div class="perm-field">
                            <label for="route_name">
                                Route Name <span class="req">*</span>
                            </label>
                            <input
                                type="text"
                                id="route_name"
                                name="route_name"
                                placeholder="admin.example"
                                value="{{ old('route_name') }}"
                                class="{{ $errors->has('route_name') ? 'is-invalid' : '' }}"
                                required
                            >
                            <span class="hint">اسم الـ Route في Laravel.</span>
                            @error('route_name')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Route Path --}}
                        <div class="perm-field">
                            <label for="route_path">
                                Route Path <span class="req">*</span>
                            </label>
                            <input
                                type="text"
                                id="route_path"
                                name="route_path"
                                placeholder="example"
                                value="{{ old('route_path') }}"
                                class="{{ $errors->has('route_path') ? 'is-invalid' : '' }}"
                                required
                            >
                            <span class="hint">المسار المستخدم في الـ URL.</span>
                            @error('route_path')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="perm-field">
                            <label for="status">
                                Status <span class="req">*</span>
                            </label>
                            <select
                                id="status"
                                name="status"
                                class="{{ $errors->has('status') ? 'is-invalid' : '' }}"
                                required
                            >
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                            @error('status')
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
                    <a href="{{ route('admin.pages.index') }}" class="perm-btn cancel">
                        <i class="fa-solid fa-xmark"></i>
                        <span>إلغاء</span>
                    </a>
                    <button type="submit" class="perm-btn submit">
                        <i class="fa-solid fa-check"></i>
                        <span>إنشاء الصفحة</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    var toastWrap = document.getElementById('permToastWrap');

    /* إخفاء تلقائي للإشعارات */
    document.querySelectorAll('.perm-toast').forEach(function (toast) {
        setTimeout(function () {
            toast.classList.add('hide');
            setTimeout(function () { toast.remove(); }, 300);
        }, 4500);
    });

    /* توليد Slug تلقائياً من الاسم (اختياري - يمكن حذفه) */
    var nameInput = document.getElementById('name');
    var slugInput = document.getElementById('slug');
    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function () {
            if (slugInput.dataset.touched === '1') return;
            if (slugInput.value.trim() !== '') return;
            slugInput.value = this.value
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        });
        slugInput.addEventListener('input', function () {
            slugInput.dataset.touched = '1';
        });
    }

})();
</script>

@endsection