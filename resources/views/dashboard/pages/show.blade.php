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
                    <i class="fa-solid fa-file-circle-check"></i>
                </div>
                <div>
                    <h3>تفاصيل الصفحة</h3>
                    <p>عرض كامل بيانات الصفحة الحالية</p>
                </div>
            </div>
            <div class="perm-header-actions">
                <a class="perm-btn-back" href="{{ route('admin.pages.index') }}">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span>العودة للقائمة</span>
                </a>
                <a class="perm-btn-edit" href="{{ route('admin.pages.edit', ['page' => $page->id]) }}">
                    <i class="fa-solid fa-pen"></i>
                    <span>تعديل الصفحة</span>
                </a>
            </div>
        </div>

        {{-- البطاقة --}}
        <div class="perm-card">

            {{-- رأس البطاقة --}}
            <div class="perm-card-head">
                <div class="perm-card-head-left">
                    <div class="perm-card-head-icon">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <div>
                        <h4>بيانات الصفحة</h4>
                        <p>جميع الحقول معروضة للقراءة فقط</p>
                    </div>
                </div>
                <span class="perm-id-badge">
                    <i class="fa-solid fa-hashtag"></i>
                    ID: {{ $page->id }}
                </span>
            </div>

            {{-- جسم البطاقة --}}
            <div class="perm-detail-body">
                <div class="perm-detail-grid">

                    {{-- ID --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-hashtag"></i>
                            ID
                        </div>
                        <div class="perm-detail-value mono">{{ $page->id }}</div>
                    </div>

                    {{-- Name --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-file-lines"></i>
                            Name
                        </div>
                        <div class="perm-detail-value">{{ $page->name }}</div>
                    </div>

                    {{-- Slug --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-link"></i>
                            Slug
                        </div>
                        <div class="perm-detail-value mono">{{ $page->slug }}</div>
                    </div>

                    {{-- Type --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-tag"></i>
                            Type
                        </div>
                        <div class="perm-detail-value">
                            @if($page->type)
                                <span class="perm-type-badge">
                                    <i class="fa-solid fa-cube"></i>
                                    {{ $page->type }}
                                </span>
                            @else
                                <span class="empty">—</span>
                            @endif
                        </div>
                    </div>

                    {{-- Component --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-puzzle-piece"></i>
                            Component
                        </div>
                        @if($page->component)
                            <div class="perm-detail-value mono">{{ $page->component }}</div>
                        @else
                            <div class="perm-detail-value empty">—</div>
                        @endif
                    </div>

                    {{-- Controller --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-microchip"></i>
                            Controller
                        </div>
                        @if($page->controller)
                            <div class="perm-detail-value mono">{{ $page->controller }}</div>
                        @else
                            <div class="perm-detail-value empty">—</div>
                        @endif
                    </div>

                    {{-- Route Name --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-route"></i>
                            Route Name
                        </div>
                        <div class="perm-detail-value mono">{{ $page->route_name }}</div>
                    </div>

                    {{-- Route Path --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-signs-post"></i>
                            Route Path
                        </div>
                        <div class="perm-detail-value mono">{{ $page->route_path }}</div>
                    </div>

                    {{-- Status --}}
                    <div class="perm-detail-item full">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-circle-dot"></i>
                            Status
                        </div>
                        <div class="perm-detail-value">
                            @if($page->status === 'active')
                                <span class="perm-status-badge">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Active
                                </span>
                            @else
                                <span class="perm-status-badge inactive">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            {{-- الفوتر --}}
            <div class="perm-detail-footer">
                <a href="{{ route('admin.pages.index') }}" class="perm-btn cancel">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span>العودة</span>
                </a>
                <a href="{{ route('admin.pages.edit', ['page' => $page->id]) }}" class="perm-btn submit">
                    <i class="fa-solid fa-pen"></i>
                    <span>تعديل الصفحة</span>
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