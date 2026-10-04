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
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
                <div>
                    <h3>تفاصيل عقدة الشجرة</h3>
                    <p>عرض كامل بيانات العقدة الحالية</p>
                </div>
            </div>
            <div class="perm-header-actions">
                <a class="perm-btn-back" href="{{ route('admin.tree-nodes.index') }}">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span>رجوع</span>
                </a>
                <a class="perm-btn-edit" href="{{ route('admin.tree-nodes.edit', ['tree_node' => $node->value]) }}">
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
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <div>
                        <h4>بيانات العقدة</h4>
                        <p>جميع الحقول معروضة للقراءة فقط</p>
                    </div>
                </div>
                <span class="perm-id-badge">
                    <i class="fa-solid fa-hashtag"></i>
                    القيمة: {{ $node->value }}
                </span>
            </div>

            {{-- جسم البطاقة --}}
            <div class="perm-detail-body">
                <div class="perm-detail-grid">

                    {{-- الكود --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-hashtag"></i>
                            الكود
                        </div>
                        <div class="perm-detail-value">
                            <span class="perm-badge value">
                                <i class="fa-solid fa-key"></i>
                                {{ $node->value }}
                            </span>
                        </div>
                    </div>

                    {{-- المستوى --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-layer-group"></i>
                            المستوى
                        </div>
                        <div class="perm-detail-value">
                            <span class="perm-badge level">
                                <i class="fa-solid fa-layer-group"></i>
                                {{ $node->ilevel }}
                            </span>
                        </div>
                    </div>

                    {{-- الاسم بالعربي --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-font"></i>
                            الاسم بالعربي
                        </div>
                        <div class="perm-detail-value">{{ $node->label }}</div>
                    </div>

                    {{-- الاسم بالإنجليزي --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-language"></i>
                            الاسم بالإنجليزي
                        </div>
                        @if($node->label_eng)
                            <div class="perm-detail-value">{{ $node->label_eng }}</div>
                        @else
                            <div class="perm-detail-value empty">—</div>
                        @endif
                    </div>

                    {{-- الأب --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-arrow-up"></i>
                            الأب
                        </div>
                        @if($node->parent_value)
                            <div class="perm-detail-value">
                                <span class="perm-badge value">
                                    <i class="fa-solid fa-sitemap"></i>
                                    {{ $node->parent_value }}
                                </span>
                            </div>
                        @else
                            <div class="perm-detail-value empty">— جذر —</div>
                        @endif
                    </div>

                    {{-- نوع العنصر --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-tag"></i>
                            نوع العنصر
                        </div>
                        @if($node->node_type)
                            <div class="perm-detail-value">
                                <span class="perm-badge type">
                                    <i class="fa-solid fa-cube"></i>
                                    {{ $node->node_type }}
                                </span>
                            </div>
                        @else
                            <div class="perm-detail-value empty">—</div>
                        @endif
                    </div>

                    {{-- حالة العنصر --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-circle-dot"></i>
                            حالة العنصر
                        </div>
                        @if($node->istate)
                            <div class="perm-detail-value">
                                <span class="perm-badge">
                                    <i class="fa-solid fa-circle-check"></i>
                                    {{ $node->istate }}
                                </span>
                            </div>
                        @else
                            <div class="perm-detail-value empty">—</div>
                        @endif
                    </div>

                    {{-- كود الفورم --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-file-code"></i>
                            كود الفورم
                        </div>
                        @if($node->form_code)
                            <div class="perm-detail-value mono">{{ $node->form_code }}</div>
                        @else
                            <div class="perm-detail-value empty">—</div>
                        @endif
                    </div>

                    {{-- اسم الـ Object --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-microchip"></i>
                            اسم الـ Object
                        </div>
                        @if($node->obj_name)
                            <div class="perm-detail-value mono">{{ $node->obj_name }}</div>
                        @else
                            <div class="perm-detail-value empty">—</div>
                        @endif
                    </div>

                    {{-- نوع النظام --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-server"></i>
                            نوع النظام
                        </div>
                        @if($node->sys_type)
                            <div class="perm-detail-value">
                                <span class="perm-badge type">
                                    <i class="fa-solid fa-network-wired"></i>
                                    {{ $node->sys_type }}
                                </span>
                            </div>
                        @else
                            <div class="perm-detail-value empty">—</div>
                        @endif
                    </div>

                    {{-- كود الفرع --}}
                    <div class="perm-detail-item">
                        <div class="perm-detail-label">
                            <i class="fa-solid fa-building"></i>
                            كود الفرع
                        </div>
                        @if($node->branch_code)
                            <div class="perm-detail-value mono">{{ $node->branch_code }}</div>
                        @else
                            <div class="perm-detail-value empty">—</div>
                        @endif
                    </div>

                </div>
            </div>

            {{-- الفوتر --}}
            <div class="perm-detail-footer">
                <a href="{{ route('admin.tree-nodes.index') }}" class="perm-btn cancel">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span>رجوع</span>
                </a>
                <a href="{{ route('admin.tree-nodes.edit', ['tree_node' => $node->value]) }}" class="perm-btn submit">
                    <i class="fa-solid fa-pen"></i>
                    <span>تعديل العقدة</span>
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