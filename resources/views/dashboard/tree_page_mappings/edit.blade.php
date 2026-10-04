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
                    <h3>تعديل الربط</h3>
                    <p>تحديث الربط بين عقدة الشجرة والصفحة</p>
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
                <div class="perm-card-head-left">
                    <div class="perm-card-head-icon">
                        <i class="fa-solid fa-diagram-project"></i>
                    </div>
                    <div>
                        <h4>تعديل بيانات الربط</h4>
                        <p>الحقول المعلّمة بـ <span style="color:var(--p-danger);font-weight:700;">*</span> إلزامية</p>
                    </div>
                </div>
                <span class="perm-id-badge">
                    <i class="fa-solid fa-hashtag"></i>
                    المعرّف: {{ $mapping->id }}
                </span>
            </div>

            {{-- النموذج --}}
            <form action="{{ route('admin.tree-page-mappings.update', ['tree_page_mapping' => $mapping->id]) }}" method="POST">
                @csrf
                @method('PUT')

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
                                @foreach($nodes as $node)
                                    <option value="{{ $node->value }}"
                                        {{ old('tree_value', $mapping->tree_value) == $node->value ? 'selected' : '' }}>
                                        {{ $node->value }} - {{ $node->label }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="hint">
                                <i class="fa-solid fa-circle-info"></i>
                                يمكنك تغيير العقدة المرتبطة.
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
                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}"
                                        {{ old('page_id', $mapping->page_id) == $page->id ? 'selected' : '' }}>
                                        {{ $page->name }} - {{ $page->slug }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="hint">
                                <i class="fa-solid fa-circle-info"></i>
                                يمكنك تغيير الصفحة المرتبطة.
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
                        <span>تحديث الربط</span>
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