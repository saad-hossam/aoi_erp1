@extends('layouts.dashboard.app')
@section('content')

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">



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
                    <h3>تعديل الموظف #{{ $emp->EMP_NO }}</h3>
                    <p>قم بتحديث بيانات الموظف ثم احفظ التغييرات</p>
                </div>
            </div>
            <div class="perm-header-actions">
                <a class="perm-btn" href="{{ route('emps.index') }}">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span>العودة للقائمة</span>
                </a>
            </div>
        </div>

        {{-- مسار التنقل --}}
        <ul class="perm-breadcrumb">
            <li><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="sep"><i class="fa-solid fa-chevron-left"></i></li>
            <li><a href="{{ route('emps.index') }}">الموظفون</a></li>
            <li class="sep"><i class="fa-solid fa-chevron-left"></i></li>
            <li class="active">تعديل #{{ $emp->EMP_NO }}</li>
        </ul>

        {{-- البطاقة --}}
        <div class="perm-card">
            <div class="perm-card-header">
                <div class="perm-card-header-left">
                    <div class="perm-card-header-icon">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <div>
                        <h4>بيانات الموظف</h4>
                        <p>جميع الحقول المُعلَّمة بـ <span style="color:#ef4444;">*</span> مطلوبة</p>
                    </div>
                </div>
                <span class="perm-status-badge" id="permFormStatus">
                    <i class="fa-solid fa-circle"></i>
                    <span>جاهز</span>
                </span>
            </div>

            <form action="{{ route('emps.update', $emp->EMP_NO) }}"
                  method="POST"
                  id="permEmpForm"
                  class="form-new-product form-style-1"
                  autocomplete="off"
                  novalidate>
                @csrf
                @method('PUT')

                <div class="perm-card-body">
                    @include('dashboard.emps._form', ['submit' => 'تحديث الموظف'])
                </div>

                {{-- شريط الأزرار --}}
                <div class="perm-form-footer">
                    <div class="perm-form-footer-actions">
                        <a href="{{ route('emps.index') }}" class="perm-btn">
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

    var form       = document.getElementById('permEmpForm');
    var submitBtn  = document.getElementById('permSubmitBtn');
    var resetBtn   = document.getElementById('permResetBtn');
    var statusBadge = document.getElementById('permFormStatus');
    var toastWrap  = document.getElementById('permToastWrap');

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

    /* ================= حالة النموذج ================= */
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
        if (state === 'dirty') {
            span.textContent = 'تغييرات غير محفوظة';
        } else {
            span.textContent = 'جاهز';
        }
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

    form.addEventListener('input', function () {
        setStatus(isDirty() ? 'dirty' : 'clean');
    });
    form.addEventListener('change', function () {
        setStatus(isDirty() ? 'dirty' : 'clean');
    });

    /* ================= التحقق الفوري ================= */
    function attachValidation() {
        var fields = form.querySelectorAll('input, select, textarea');
        fields.forEach(function (field) {
            if (field.type === 'hidden' || field.type === 'checkbox' || field.type === 'radio') return;

            if (field.type === 'email') {
                field.addEventListener('blur', function () {
                    if (!field.value.trim()) {
                        field.classList.remove('is-valid', 'is-invalid');
                        return;
                    }
                    var ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value.trim());
                    field.classList.toggle('is-valid', ok);
                    field.classList.toggle('is-invalid', !ok);
                });
            }

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
            if (!confirm('هل تريد إعادة تعيين جميع الحقول إلى القيم الأصلية؟')) return;
            /* إعادة القيم الأصلية بدل مسح الحقول */
            var snapshot = new FormData(form);
            /* ملاحظة: form.reset() تُرجع القيم الافتراضية من HTML، وهي القيم الأصلية هنا */
            form.reset();
            form.querySelectorAll('.is-valid, .is-invalid').forEach(function (el) {
                el.classList.remove('is-valid', 'is-invalid');
            });
            setStatus('clean');
            showToast('تمت إعادة تعيين النموذج.');
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
    var firstField = form.querySelector('input:not([type="hidden"]):not([disabled]), select:not([disabled]), textarea:not([disabled])');
    if (firstField) firstField.focus();

})();
</script>

@endsection