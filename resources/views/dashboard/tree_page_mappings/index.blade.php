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
        </div>

        {{-- رأس الصفحة --}}
        <div class="perm-header">
            <div class="perm-header-left">
                <div class="perm-header-icon">
                    <i class="fa-solid fa-link"></i>
                </div>
                <div>
                    <h3>ربط عقد الشجرة بالصفحات</h3>
                    <p>إدارة الروابط بين عقد الشجرة والصفحات</p>
                </div>
            </div>
            <a class="perm-btn-add" href="{{ route('admin.tree-page-mappings.create') }}">
                <i class="fa-solid fa-plus"></i>
                <span>إضافة ربط جديد</span>
            </a>
        </div>

        {{-- البطاقة --}}
        <div class="perm-card">

            {{-- شريط الأدوات --}}
            <div class="perm-toolbar">
                <div class="perm-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="permSearch" placeholder="بحث بقيمة الشجرة أو اسم الصفحة..." autocomplete="off">
                </div>
                <div class="perm-bulk" id="permBulkBar">
                    <span class="perm-bulk-count" id="permBulkCount">0 محدد</span>
                    <button type="button" class="perm-bulk-btn" id="permBulkDeleteBtn">
                        <i class="fa-solid fa-trash-can"></i> حذف
                    </button>
                </div>
            </div>

            {{-- الجدول --}}
            <div class="perm-table-wrap">
                <table class="perm-table" id="permTable">
                    <thead>
                        <tr>
                            <th class="col-check">
                                <button type="button" class="perm-select-all" id="permSelectAll" title="تحديد الكل">
                                    <span class="perm-select-all-box" aria-hidden="true">
                                        <svg viewBox="0 0 16 16" class="perm-select-all-icon">
                                            <path d="M3 8.5l3.5 3.5L13 5" fill="none" stroke="currentColor"
                                                  stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg viewBox="0 0 16 16" class="perm-select-all-dash">
                                            <path d="M4 8h8" fill="none" stroke="currentColor"
                                                  stroke-width="2.5" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                </button>
                            </th>
                            <th class="col-index sortable" data-sort="index">
                                # <span class="sort-icon">▲</span>
                            </th>
                            <th class="sortable" data-sort="id">
                                المعرّف <span class="sort-icon">▲</span>
                            </th>
                            <th class="sortable" data-sort="treevalue">
                                قيمة الشجرة <span class="sort-icon">▲</span>
                            </th>
                            <th class="sortable" data-sort="treenode">
                                عقدة الشجرة <span class="sort-icon">▲</span>
                            </th>
                            <th class="sortable" data-sort="page">
                                الصفحة <span class="sort-icon">▲</span>
                            </th>
                            <th class="col-center sortable" data-sort="route">
                                المسار <span class="sort-icon">▲</span>
                            </th>
                            <th class="col-center sortable" data-sort="status">
                                الحالة <span class="sort-icon">▲</span>
                            </th>
                            <th class="col-actions">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="permTableBody">
                        @forelse($mappings as $mapping)

                            @php
                                $node = $nodes->first(
                                    fn ($item) =>
                                        (string) $item->value ===
                                        (string) $mapping->tree_value
                                );
                            @endphp

                            <tr data-name="{{ strtolower($mapping->tree_value . ' ' . ($node->label ?? '') . ' ' . ($mapping->page?->name ?? '') . ' ' . ($mapping->page?->slug ?? '')) }}"
                                data-id="{{ $mapping->id }}"
                                data-treevalue="{{ strtolower($mapping->tree_value) }}"
                                data-treenode="{{ strtolower(($node->label ?? '') . ' ' . ($node->label_eng ?? '')) }}"
                                data-page="{{ strtolower($mapping->page?->name ?? '') }}"
                                data-route="{{ strtolower($mapping->page?->route_path ?? '') }}"
                                data-status="{{ strtolower($mapping->page?->status ?? '') }}">
                                <td>
                                    <input type="checkbox" class="perm-check perm-row-check" value="{{ $mapping->id }}">
                                </td>
                                <td>
                                    <span class="perm-index">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <span class="perm-center-text">#{{ $mapping->id }}</span>
                                </td>
                                <td>
                                    <span class="perm-badge value">
                                        <i class="fa-solid fa-key"></i>
                                        {{ $mapping->tree_value }}
                                    </span>
                                </td>
                                <td>
                                    @if($node)
                                        <div class="perm-name">
                                            <span class="perm-name-icon">
                                                <i class="fa-solid fa-sitemap"></i>
                                            </span>
                                            <span class="perm-name-text">
                                                {{ $node->label }}
                                                @if($node->label_eng)
                                                    <span class="perm-subtext">{{ $node->label_eng }}</span>
                                                @endif
                                            </span>
                                        </div>
                                    @else
                                        <span class="perm-badge danger">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            العقدة غير موجودة
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="perm-name">
                                        <span class="perm-name-icon info">
                                            <i class="fa-solid fa-file-lines"></i>
                                        </span>
                                        <span class="perm-name-text">
                                            {{ $mapping->page?->name }}
                                            <span class="perm-subtext">{{ $mapping->page?->slug }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td class="col-center">
                                    @if($mapping->page?->route_path)
                                        <span class="perm-badge value">
                                            <i class="fa-solid fa-route"></i>
                                            {{ $mapping->page->route_path }}
                                        </span>
                                    @else
                                        <span class="perm-muted">—</span>
                                    @endif
                                </td>
                                <td class="col-center">
                                    @if($mapping->page?->status === 'active')
                                        <span class="perm-badge">
                                            <i class="fa-solid fa-circle-check"></i>
                                            نشط
                                        </span>
                                    @else
                                        <span class="perm-badge inactive">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            غير نشط
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="perm-actions">
                                        <a href="{{ route('admin.tree-page-mappings.show', ['tree_page_mapping' => $mapping->id]) }}"
                                           class="perm-action-btn view"
                                           title="عرض">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.tree-page-mappings.edit', ['tree_page_mapping' => $mapping->id]) }}"
                                           class="perm-action-btn edit"
                                           title="تعديل">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <button type="button"
                                                class="perm-action-btn delete perm-delete-btn"
                                                title="حذف"
                                                data-name="ربط {{ $mapping->tree_value }} - {{ $mapping->page?->name }}"
                                                data-url="{{ route('admin.tree-page-mappings.destroy', ['tree_page_mapping' => $mapping->id]) }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="perm-empty">
                                    <i class="fa-solid fa-inbox"></i>
                                    لا توجد روابط. اضغط على "إضافة ربط جديد" للبدء.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- نافذة الحذف المنبثقة --}}
<div class="perm-modal-overlay" id="permDeleteModal">
    <div class="perm-modal">
        <div class="perm-modal-icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h4 id="permModalTitle">حذف الربط؟</h4>
        <p id="permModalText">لا يمكن التراجع عن هذا الإجراء.</p>
        <div class="perm-modal-actions">
            <button type="button" class="perm-modal-btn" id="permModalCancel">إلغاء</button>
            <button type="button" class="perm-modal-btn danger" id="permModalConfirm">حذف</button>
        </div>
    </div>
</div>

{{-- نموذج الحذف الفردي --}}
<form id="permDeleteForm" method="POST" style="display:none">
    @csrf
    @method('DELETE')
</form>

<script>
(function () {
    'use strict';

    var tableBody   = document.getElementById('permTableBody');
    var searchInput = document.getElementById('permSearch');
    var selectAll   = document.getElementById('permSelectAll');
    var bulkBar     = document.getElementById('permBulkBar');
    var bulkCount   = document.getElementById('permBulkCount');
    var bulkBtn     = document.getElementById('permBulkDeleteBtn');
    var toastWrap   = document.getElementById('permToastWrap');

    /* -------- Toast ديناميكي -------- */
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

    /* -------- البحث -------- */
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            var rows = tableBody.querySelectorAll('tr[data-name]');
            rows.forEach(function (row) {
                row.style.display = row.getAttribute('data-name').indexOf(q) !== -1 ? '' : 'none';
            });
            updateBulkBar();
        });
    }

    /* -------- الترتيب -------- */
    var sortState = { key: null, dir: 'asc' };
    document.querySelectorAll('.perm-table thead th.sortable').forEach(function (th) {
        th.addEventListener('click', function () {
            var key = th.getAttribute('data-sort');
            if (sortState.key === key) {
                sortState.dir = sortState.dir === 'asc' ? 'desc' : 'asc';
            } else {
                sortState.key = key;
                sortState.dir = 'asc';
            }
            document.querySelectorAll('.perm-table thead th.sortable').forEach(function (h) {
                h.classList.remove('sorted-asc', 'sorted-desc');
            });
            th.classList.add(sortState.dir === 'asc' ? 'sorted-asc' : 'sorted-desc');

            var rows = Array.prototype.slice.call(tableBody.querySelectorAll('tr[data-name]'));
            rows.sort(function (a, b) {
                var av, bv;
                if (key === 'index' || key === 'id') {
                    av = parseInt(a.getAttribute('data-id'), 10);
                    bv = parseInt(b.getAttribute('data-id'), 10);
                    return sortState.dir === 'asc' ? av - bv : bv - av;
                }
                av = a.getAttribute('data-' + key) || '';
                bv = b.getAttribute('data-' + key) || '';
                if (av < bv) return sortState.dir === 'asc' ? -1 : 1;
                if (av > bv) return sortState.dir === 'asc' ? 1 : -1;
                return 0;
            });
            rows.forEach(function (r) { tableBody.appendChild(r); });
        });
    });

    /* -------- التحديد / الجماعي -------- */
    function visibleChecks() {
        return Array.prototype.filter.call(
            tableBody.querySelectorAll('.perm-row-check'),
            function (cb) { return cb.closest('tr').style.display !== 'none'; }
        );
    }

    function updateBulkBar() {
        var checks  = visibleChecks();
        var checked = checks.filter(function (cb) { return cb.checked; });

        bulkCount.textContent = checked.length + ' محدد';
        bulkBar.classList.toggle('show', checked.length > 0);

        if (selectAll) {
            selectAll.classList.remove('is-all', 'is-partial');
            if (checks.length > 0 && checked.length === checks.length) {
                selectAll.classList.add('is-all');
                selectAll.setAttribute('title', 'إلغاء تحديد الكل');
            } else if (checked.length > 0) {
                selectAll.classList.add('is-partial');
                selectAll.setAttribute('title', 'تحديد الكل');
            } else {
                selectAll.setAttribute('title', 'تحديد الكل');
            }
        }
    }

    if (selectAll) {
        selectAll.addEventListener('click', function () {
            var allChecked = selectAll.classList.contains('is-all');
            visibleChecks().forEach(function (cb) { cb.checked = !allChecked; });
            updateBulkBar();
        });
    }

    tableBody.addEventListener('change', function (e) {
        if (e.target.classList && e.target.classList.contains('perm-row-check')) {
            updateBulkBar();
        }
    });

    /* النقر على الخلية الأولى بالكامل */
    tableBody.addEventListener('click', function (e) {
        var cell = e.target.closest('td');
        if (!cell || cell.cellIndex !== 0) return;
        if (e.target.classList.contains('perm-row-check')) return;
        var cb = cell.querySelector('.perm-row-check');
        if (!cb) return;
        cb.checked = !cb.checked;
        updateBulkBar();
    });

    /* -------- النافذة المنبثقة -------- */
    var modal        = document.getElementById('permDeleteModal');
    var modalTitle   = document.getElementById('permModalTitle');
    var modalText    = document.getElementById('permModalText');
    var modalCancel  = document.getElementById('permModalCancel');
    var modalConfirm = document.getElementById('permModalConfirm');
    var pending      = null;

    function openModal(cfg) {
        pending = cfg;
        if (cfg.type === 'single') {
            modalTitle.textContent = 'حذف الربط؟';
            modalText.textContent  = 'هل أنت متأكد من حذف "' + cfg.name + '"؟ لا يمكن التراجع عن هذا الإجراء.';
        } else {
            modalTitle.textContent = 'حذف ' + cfg.ids.length + ' روابط؟';
            modalText.textContent  = 'سيتم إزالة الروابط المحددة نهائيًا.';
        }
        modal.classList.add('active');
    }
    function closeModal() {
        modal.classList.remove('active');
        pending = null;
    }

    modalCancel.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
    });

    tableBody.addEventListener('click', function (e) {
        var btn = e.target.closest('.perm-delete-btn');
        if (!btn) return;
        openModal({
            type: 'single',
            name: btn.getAttribute('data-name'),
            url:  btn.getAttribute('data-url'),
            row:  btn.closest('tr')
        });
    });

    bulkBtn.addEventListener('click', function () {
        var ids = visibleChecks()
            .filter(function (cb) { return cb.checked; })
            .map(function (cb) { return cb.value; });
        if (ids.length === 0) return;
        showToast('الحذف الجماعي غير متاح لهذه الصفحة.', 'error');
    });

    modalConfirm.addEventListener('click', function () {
        if (!pending) return;

        if (pending.type === 'single') {
            pending.row.classList.add('removing');
            var form = document.getElementById('permDeleteForm');
            form.action = pending.url;
            setTimeout(function () { form.submit(); }, 250);
        }
    });

    /* إخفاء تلقائي للإشعارات الأولية */
    document.querySelectorAll('.perm-toast').forEach(function (toast) {
        setTimeout(function () {
            toast.classList.add('hide');
            setTimeout(function () { toast.remove(); }, 300);
        }, 4000);
    });

    updateBulkBar();

})();
</script>

@endsection