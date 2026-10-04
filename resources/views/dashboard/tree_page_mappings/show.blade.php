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
            @if(session('status'))
                <div class="perm-toast">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('status') }}</span>
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
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                <div>
                    <h3>تفاصيل الربط</h3>
                    <p>عرض كامل بيانات الربط بين العقدة والصفحة</p>
                </div>
            </div>
            <div class="perm-header-actions">
                <a class="perm-btn-back" href="{{ route('admin.tree-page-mappings.index') }}">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span>رجوع</span>
                </a>
                <a class="perm-btn-edit" href="{{ route('admin.tree-page-mappings.edit', ['tree_page_mapping' => $mapping->id]) }}">
                    <i class="fa-solid fa-pen"></i>
                    <span>تعديل</span>
                </a>
            </div>
        </div>

        {{-- البطاقة --}}
        <div class="perm-card">

            {{-- رأس البطاقة --}}
            <div class="perm-card-head">
                <div class="perm-card-head-left">
                    <div class="perm-card-head-icon">
                        <i class="fa-solid fa-link"></i>
                    </div>
                    <div>
                        <h4>معلومات الربط</h4>
                        <p>جميع الحقول معروضة للقراءة فقط</p>
                    </div>
                </div>
                <span class="perm-id-badge">
                    <i class="fa-solid fa-hashtag"></i>
                    المعرّف: {{ $mapping->id }}
                </span>
            </div>

            {{-- جسم البطاقة --}}
            <div class="perm-detail-body">
                <div class="perm-detail-grid">

                    {{-- معرّف الربط --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-hashtag"></i>
                            معرّف الربط
                        </div>
                        <div class="perm-detail-value mono">{{ $mapping->id }}</div>
                    </div>

                    {{-- قيمة الشجرة --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-key"></i>
                            قيمة الشجرة
                        </div>
                        <div class="perm-detail-value">
                            <span class="perm-badge value">
                                <i class="fa-solid fa-sitemap"></i>
                                {{ $mapping->tree_value }}
                            </span>
                        </div>
                    </div>

                    {{-- عقدة الشجرة --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-sitemap"></i>
                            عقدة الشجرة
                        </div>
                        @if($node)
                            <div class="perm-detail-value">
                                <div>
                                    {{ $node->label }}
                                    @if($node->label_eng)
                                        <span class="perm-subtext">{{ $node->label_eng }}</span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="perm-detail-value empty">غير متوفر</div>
                        @endif
                    </div>

                    {{-- الصفحة --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-file-lines"></i>
                            الصفحة
                        </div>
                        <div class="perm-detail-value">
                            @if($mapping->page?->name)
                                {{ $mapping->page->name }}
                            @else
                                <span class="empty" style="font-style:italic;color:var(--p-muted);font-weight:400;">غير متوفر</span>
                            @endif
                        </div>
                    </div>

                    {{-- Slug الصفحة --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-link"></i>
                            Slug الصفحة
                        </div>
                        @if($mapping->page?->slug)
                            <div class="perm-detail-value mono">{{ $mapping->page->slug }}</div>
                        @else
                            <div class="perm-detail-value empty">غير متوفر</div>
                        @endif
                    </div>

                    {{-- المسار --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-route"></i>
                            المسار
                        </div>
                        @if($mapping->page?->route_path)
                            <div class="perm-detail-value mono">{{ $mapping->page->route_path }}</div>
                        @else
                            <div class="perm-detail-value empty">غير متوفر</div>
                        @endif
                    </div>

                </div>
            </div>

            {{-- الفوتر --}}
            <div class="perm-detail-footer">
                <a href="{{ route('admin.tree-page-mappings.index') }}" class="perm-btn cancel">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span>رجوع</span>
                </a>
                <a href="{{ route('admin.tree-page-mappings.edit', ['tree_page_mapping' => $mapping->id]) }}" class="perm-btn submit">
                    <i class="fa-solid fa-pen"></i>
                    <span>تعديل الربط</span>
                </a>
            </div>
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