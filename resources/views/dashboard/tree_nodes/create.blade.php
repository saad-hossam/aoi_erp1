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
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div>
                    <h3>إضافة مستخدم جديد</h3>
                    <p>أنشئ حساب مستخدم جديد وحدّد الأدوار المسندة إليه</p>
                </div>
            </div>
            <a class="perm-btn-back" href="{{ route('users.index') }}">
                <i class="fa-solid fa-arrow-right"></i>
                <span>العودة للمستخدمين</span>
            </a>
        </div>

        {{-- البطاقة --}}
        <div class="perm-card">

            {{-- رأس البطاقة --}}
            <div class="perm-card-head">
                <div class="perm-card-head-icon">
                    <i class="fa-solid fa-user-gear"></i>
                </div>
                <div>
                    <h4>بيانات المستخدم</h4>
                    <p>الحقول المعلّمة بـ <span style="color:var(--p-danger);font-weight:700;">*</span> إلزامية</p>
                </div>
            </div>

            {{-- النموذج --}}
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="perm-form-body">
                    <div class="perm-form-grid">

                        {{-- الاسم --}}
                        <div class="perm-field">
                            <label for="name">
                                الاسم <span class="req">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="أدخل الاسم"
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

                        {{-- البريد الإلكتروني --}}
                        <div class="perm-field">
                            <label for="email">
                                البريد الإلكتروني <span class="req">*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="أدخل البريد الإلكتروني"
                                value="{{ old('email') }}"
                                class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                required
                            >
                            @error('email')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- كلمة المرور --}}
                        <div class="perm-field">
                            <label for="password">
                                كلمة المرور <span class="req">*</span>
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="أدخل كلمة المرور"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                                required
                            >
                            @error('password')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- تأكيد كلمة المرور --}}
                        <div class="perm-field">
                            <label for="password_confirmation">
                                تأكيد كلمة المرور <span class="req">*</span>
                            </label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="أعد إدخال كلمة المرور"
                                required
                            >
                        </div>

                        {{-- الأدوار --}}
                        <div class="perm-field full">
                            <label>
                                تعيين الأدوار <span class="req">*</span>
                            </label>
                            <div class="perm-roles-grid">
                                @forelse($roles as $role)
                                    <label class="perm-role-item">
                                        <input
                                            type="checkbox"
                                            name="roles[]"
                                            value="{{ $role->id }}"
                                            {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}
                                        >
                                        <span class="perm-role-label">
                                            <i class="fa-solid fa-shield-halved" style="font-size:12px;opacity:.7;margin-left:4px;"></i>
                                            {{ $role->name }}
                                        </span>
                                    </label>
                                @empty
                                    <span class="perm-muted">لا توجد أدوار متاحة.</span>
                                @endforelse
                            </div>
                            @error('roles')
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
                    <a href="{{ route('users.index') }}" class="perm-btn cancel">
                        <i class="fa-solid fa-xmark"></i>
                        <span>إلغاء</span>
                    </a>
                    <button type="submit" class="perm-btn submit">
                        <i class="fa-solid fa-check"></i>
                        <span>حفظ المستخدم</span>
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