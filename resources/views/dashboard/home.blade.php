@extends('layouts.dashboard.app')


@section('content')
        <div class="page-content">
                <div class="page-header">
                    <h1><i class="fas fa-shield-alt"></i> إدارة الصلاحيات</h1>
                    <button class="btn btn-primary" id="addPermissionBtn"><i class="fas fa-plus"></i> إضافة صلاحية</button>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid" id="statsGrid">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-key"></i></div>
                        <div class="stat-info">
                            <h3 id="totalCount">0</h3>
                            <p>إجمالي الصلاحيات</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-eye"></i></div>
                        <div class="stat-info">
                            <h3 id="visibleCount">0</h3>
                            <p>الظاهرة حالياً</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <h3 id="activeCount">0</h3>
                            <p>نشطة</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-ban"></i></div>
                        <div class="stat-info">
                            <h3 id="inactiveCount">0</h3>
                            <p>غير نشطة</p>
                        </div>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="table-card">
                    <div class="table-toolbar">
                        <h2><i class="fas fa-list" style="color:#3b82f6; margin-left:8px;"></i> قائمة الصلاحيات</h2>
                        <div class="toolbar-actions">
                            <button class="btn btn-outline btn-sm" id="bulkDeleteBtn" disabled><i class="fas fa-trash"></i> حذف المحدد</button>
                            <button class="btn btn-outline btn-sm" id="clearSelectionBtn"><i class="fas fa-times"></i> إلغاء التحديد</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="permissionsTable">
                            <thead>
                                <tr>
                                    <th class="checkbox-cell"><input type="checkbox" class="custom-checkbox" id="selectAllCheckbox"></th>
                                    <th data-sort="id" class="active"># <i class="fas fa-sort"></i></th>
                                    <th data-sort="name">الصلاحية <i class="fas fa-sort"></i></th>
                                    <th data-sort="slug">المعرف <i class="fas fa-sort"></i></th>
                                    <th data-sort="status">الحالة <i class="fas fa-sort"></i></th>
                                    <th data-sort="created">تاريخ الإنشاء <i class="fas fa-sort"></i></th>
                                    <th>إجراءات</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- rows will be injected by JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection

