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
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <h3>تعديل عقدة الشجرة</h3>
                    <p>تحديث بيانات العقدة الحالية في الشجرة الهرمية</p>
                </div>
            </div>
            <a class="perm-btn-back" href="{{ route('admin.tree-nodes.index') }}">
                <i class="fa-solid fa-arrow-right"></i>
                <span>العودة للقائمة</span>
            </a>
        </div>

        {{-- البطاقة --}}
        <div class="perm-card">

            {{-- رأس البطاقة --}}
            <div class="perm-card-head">
                <div class="perm-card-head-left">
                    <div class="perm-card-head-icon">
                        <i class="fa-solid fa-sitemap"></i>
                    </div>
                    <div>
                        <h4>تعديل بيانات العقدة</h4>
                        <p>الحقول المعلّمة بـ <span style="color:var(--p-danger);font-weight:700;">*</span> إلزامية</p>
                    </div>
                </div>
                <span class="perm-id-badge">
                    <i class="fa-solid fa-hashtag"></i>
                    القيمة: {{ $node->value }}
                </span>
            </div>

            {{-- النموذج --}}
            <form action="{{ route('admin.tree-nodes.update', ['tree_node' => $node->value]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="perm-form-body">
                    <div class="perm-form-grid">

                        {{-- قيمة العقدة (معطّلة) --}}
                        <div class="perm-field">
                            <label for="value">
                                قيمة العقدة <span class="optional">(للقراءة فقط)</span>
                            </label>
                            <input
                                type="text"
                                id="value"
                                value="{{ $node->value }}"
                                disabled
                            >
                            <span class="hint">
                                <i class="fa-solid fa-circle-info"></i>
                                هذه القيمة مُدارة بواسطة Oracle.
                            </span>
                        </div>

                        {{-- المستوى (معطّل) --}}
                        <div class="perm-field">
                            <label for="ilevel">
                                المستوى <span class="optional">(للقراءة فقط)</span>
                            </label>
                            <input
                                type="number"
                                id="ilevel"
                                value="{{ $node->ilevel }}"
                                disabled
                            >
                            <span class="hint">
                                <i class="fa-solid fa-circle-info"></i>
                                يتم حساب المستوى تلقائياً بناءً على العقدة الأب.
                            </span>
                        </div>

                        {{-- التسمية بالعربية --}}
                        <div class="perm-field">
                            <label for="label">
                                التسمية بالعربية <span class="req">*</span>
                            </label>
                            <input
                                type="text"
                                id="label"
                                name="label"
                                placeholder="أدخل التسمية بالعربية"
                                value="{{ old('label', $node->label) }}"
                                class="{{ $errors->has('label') ? 'is-invalid' : '' }}"
                                required
                            >
                            @error('label')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- التسمية بالإنجليزية --}}
                        <div class="perm-field">
                            <label for="label_eng">
                                التسمية بالإنجليزية <span class="optional">(اختياري)</span>
                            </label>
                            <input
                                type="text"
                                id="label_eng"
                                name="label_eng"
                                placeholder="أدخل التسمية بالإنجليزية"
                                value="{{ old('label_eng', $node->label_eng) }}"
                                class="{{ $errors->has('label_eng') ? 'is-invalid' : '' }}"
                            >
                            @error('label_eng')
                                <span class="error-msg">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- العقدة الأب --}}
                        <div class="perm-field full">
                            <label for="parent_value">
                                العقدة الأب <span class="req">*</span>
                            </label>
                            <select
                                id="parent_value"
                                name="parent_value"
                                class="{{ $errors->has('parent_value') ? 'is-invalid' : '' }}"
                                required
                            >
                                <option value="">— اختر العقدة الأب —</option>

                                @foreach ($parents as $parent)
                                    <option
                                        value="{{ $parent->value }}"
                                        {{ (string) old('parent_value', $node->parent_value) === (string) $parent->value ? 'selected' : '' }}
                                    >
                                        {{ $parent->label }} ({{ $parent->value }})
                                    </option>
                                @endforeach
                            </select>
                            <span class="hint">
                                <i class="fa-solid fa-circle-info"></i>
                                عند تغيير العقدة الأب، قد يتم إعادة حساب المستوى تلقائياً.
                            </span>
                            @error('parent_value')
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
                    <a href="{{ route('admin.tree-nodes.index') }}" class="perm-btn cancel">
                        <i class="fa-solid fa-xmark"></i>
                        <span>إلغاء</span>
                    </a>
                    <button type="submit" class="perm-btn submit">
                        <i class="fa-solid fa-check"></i>
                        <span>تحديث العقدة</span>
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