  <!-- Bootstrap JS (for dropdowns) -->
  <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>

   
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            // ========== MOCK DATA ==========
            const permissionsData = [
                { id: 1, name: 'عرض المستخدمين', slug: 'users.view', status: 'active', created: '2025-01-10' },
                { id: 2, name: 'إضافة مستخدم', slug: 'users.create', status: 'active', created: '2025-01-12' },
                { id: 3, name: 'تعديل مستخدم', slug: 'users.edit', status: 'active', created: '2025-01-15' },
                { id: 4, name: 'حذف مستخدم', slug: 'users.delete', status: 'inactive', created: '2025-01-18' },
                { id: 5, name: 'عرض الأدوار', slug: 'roles.view', status: 'active', created: '2025-02-01' },
                { id: 6, name: 'إدارة الصلاحيات', slug: 'permissions.manage', status: 'active', created: '2025-02-05' },
                { id: 7, name: 'عرض التقارير', slug: 'reports.view', status: 'inactive', created: '2025-02-10' },
                { id: 8, name: 'تصدير البيانات', slug: 'data.export', status: 'active', created: '2025-02-14' },
                { id: 9, name: 'استيراد البيانات', slug: 'data.import', status: 'inactive', created: '2025-02-20' },
                { id: 10, name: 'إعدادات النظام', slug: 'settings.manage', status: 'active', created: '2025-02-25' },
            ];

            // ========== STATE ==========
            let data = [...permissionsData];
            let filteredData = [...data];
            let sortColumn = 'id';
            let sortDirection = 'asc'; // asc / desc
            let searchQuery = '';
            let selectedIds = new Set();
            let deleteTargetId = null;

            // ========== DOM REFS ==========
            const tableBody = document.getElementById('tableBody');
            const totalCount = document.getElementById('totalCount');
            const visibleCount = document.getElementById('visibleCount');
            const activeCount = document.getElementById('activeCount');
            const inactiveCount = document.getElementById('inactiveCount');
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const clearSelectionBtn = document.getElementById('clearSelectionBtn');
            const liveSearchInput = document.getElementById('liveSearchInput');
            const deleteModal = document.getElementById('deleteModal');
            const modalCancel = document.getElementById('modalCancel');
            const modalConfirm = document.getElementById('modalConfirm');
            const toastContainer = document.getElementById('toastContainer');
            const addPermissionBtn = document.getElementById('addPermissionBtn');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebar = document.getElementById('sidebar');

            // ========== HELPER: TOAST ==========
            function showToast(message, type = 'success') {
                const toast = document.createElement('div');
                toast.className = `toast ${type}`;
                const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
                toast.innerHTML = `<i class="fas ${icon}"></i> ${message}`;
                toastContainer.appendChild(toast);
                setTimeout(() => {
                    toast.classList.add('hide');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }

            // ========== RENDER ==========
            function render() {
                // Apply filter
                filteredData = data.filter(item => {
                    const q = searchQuery.toLowerCase();
                    return item.name.toLowerCase().includes(q) ||
                           item.slug.toLowerCase().includes(q) ||
                           item.status.toLowerCase().includes(q) ||
                           item.id.toString().includes(q);
                });

                // Apply sort
                filteredData.sort((a, b) => {
                    let valA = a[sortColumn];
                    let valB = b[sortColumn];
                    if (sortColumn === 'id') {
                        valA = Number(valA);
                        valB = Number(valB);
                    } else if (sortColumn === 'created') {
                        valA = new Date(valA);
                        valB = new Date(valB);
                    } else {
                        valA = String(valA).toLowerCase();
                        valB = String(valB).toLowerCase();
                    }
                    if (valA < valB) return sortDirection === 'asc' ? -1 : 1;
                    if (valA > valB) return sortDirection === 'asc' ? 1 : -1;
                    return 0;
                });

                // Update stats
                totalCount.textContent = data.length;
                visibleCount.textContent = filteredData.length;
                const active = data.filter(i => i.status === 'active').length;
                activeCount.textContent = active;
                inactiveCount.textContent = data.length - active;

                // Build table rows
                tableBody.innerHTML = '';
                filteredData.forEach((item, index) => {
                    const tr = document.createElement('tr');
                    tr.dataset.id = item.id;
                    // stagger animation
                    tr.style.animationDelay = `${index * 0.03}s`;

                    // Checkbox
                    const tdCheck = document.createElement('td');
                    tdCheck.className = 'checkbox-cell';
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.className = 'custom-checkbox row-checkbox';
                    checkbox.checked = selectedIds.has(item.id);
                    checkbox.addEventListener('change', (e) => {
                        if (e.target.checked) {
                            selectedIds.add(item.id);
                        } else {
                            selectedIds.delete(item.id);
                        }
                        updateBulkButton();
                        updateSelectAll();
                    });
                    tdCheck.appendChild(checkbox);
                    tr.appendChild(tdCheck);

                    // ID
                    const tdId = document.createElement('td');
                    tdId.textContent = item.id;
                    tr.appendChild(tdId);

                    // Name
                    const tdName = document.createElement('td');
                    tdName.className = 'permission-name';
                    tdName.textContent = item.name;
                    tr.appendChild(tdName);

                    // Slug
                    const tdSlug = document.createElement('td');
                    tdSlug.textContent = item.slug;
                    tr.appendChild(tdSlug);

                    // Status badge
                    const tdStatus = document.createElement('td');
                    const badge = document.createElement('span');
                    badge.className = `badge ${item.status === 'active' ? 'badge-success' : 'badge-warning'}`;
                    badge.textContent = item.status === 'active' ? 'نشط' : 'غير نشط';
                    tdStatus.appendChild(badge);
                    tr.appendChild(tdStatus);

                    // Created
                    const tdCreated = document.createElement('td');
                    tdCreated.textContent = item.created;
                    tr.appendChild(tdCreated);

                    // Actions
                    const tdActions = document.createElement('td');
                    const actionDiv = document.createElement('div');
                    actionDiv.className = 'action-btns';

                    const editBtn = document.createElement('button');
                    editBtn.className = 'action-btn';
                    editBtn.innerHTML = '<i class="fas fa-edit"></i>';
                    editBtn.title = 'تعديل';
                    editBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        showToast(`تعديل: ${item.name}`, 'success');
                    });

                    const deleteBtn = document.createElement('button');
                    deleteBtn.className = 'action-btn delete';
                    deleteBtn.innerHTML = '<i class="fas fa-trash-alt"></i>';
                    deleteBtn.title = 'حذف';
                    deleteBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        openDeleteModal(item.id);
                    });

                    actionDiv.appendChild(editBtn);
                    actionDiv.appendChild(deleteBtn);
                    tdActions.appendChild(actionDiv);
                    tr.appendChild(tdActions);

                    tableBody.appendChild(tr);
                });

                // Update select all state
                updateSelectAll();
                updateBulkButton();

                // Update sort indicators in headers
                document.querySelectorAll('thead th[data-sort]').forEach(th => {
                    th.classList.remove('active');
                    const icon = th.querySelector('i');
                    if (icon) {
                        icon.className = 'fas fa-sort';
                    }
                    if (th.dataset.sort === sortColumn) {
                        th.classList.add('active');
                        if (icon) {
                            icon.className = sortDirection === 'asc' ? 'fas fa-sort-up' : 'fas fa-sort-down';
                        }
                    }
                });
            }

            // ========== SORT HANDLERS ==========
            document.querySelectorAll('thead th[data-sort]').forEach(th => {
                th.addEventListener('click', () => {
                    const col = th.dataset.sort;
                    if (sortColumn === col) {
                        sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                    } else {
                        sortColumn = col;
                        sortDirection = 'asc';
                    }
                    render();
                });
            });

            // ========== SEARCH ==========
            liveSearchInput.addEventListener('input', (e) => {
                searchQuery = e.target.value;
                render();
            });

            // ========== SELECT ALL ==========
            selectAllCheckbox.addEventListener('change', (e) => {
                const checked = e.target.checked;
                filteredData.forEach(item => {
                    if (checked) {
                        selectedIds.add(item.id);
                    } else {
                        selectedIds.delete(item.id);
                    }
                });
                render();
            });

            function updateSelectAll() {
                const visibleIds = filteredData.map(i => i.id);
                const allSelected = visibleIds.length > 0 && visibleIds.every(id => selectedIds.has(id));
                selectAllCheckbox.checked = allSelected;
            }

            function updateBulkButton() {
                bulkDeleteBtn.disabled = selectedIds.size === 0;
            }

            // ========== BULK DELETE ==========
            bulkDeleteBtn.addEventListener('click', () => {
                if (selectedIds.size === 0) return;
                const count = selectedIds.size;
                if (confirm(`هل أنت متأكد من حذف ${count} صلاحية؟`)) {
                    // remove rows with animation
                    const rows = tableBody.querySelectorAll('tr');
                    rows.forEach(row => {
                        const id = Number(row.dataset.id);
                        if (selectedIds.has(id)) {
                            row.classList.add('row-deleting');
                        }
                    });
                    setTimeout(() => {
                        data = data.filter(item => !selectedIds.has(item.id));
                        selectedIds.clear();
                        render();
                        showToast(`تم حذف ${count} صلاحية`, 'success');
                    }, 400);
                }
            });

            // ========== CLEAR SELECTION ==========
            clearSelectionBtn.addEventListener('click', () => {
                selectedIds.clear();
                render();
            });

            // ========== DELETE MODAL ==========
            function openDeleteModal(id) {
                deleteTargetId = id;
                deleteModal.classList.add('active');
            }

            function closeDeleteModal() {
                deleteModal.classList.remove('active');
                deleteTargetId = null;
            }

            modalCancel.addEventListener('click', closeDeleteModal);
            modalConfirm.addEventListener('click', () => {
                if (deleteTargetId) {
                    const row = tableBody.querySelector(`tr[data-id="${deleteTargetId}"]`);
                    if (row) {
                        row.classList.add('row-deleting');
                        setTimeout(() => {
                            data = data.filter(item => item.id !== deleteTargetId);
                            selectedIds.delete(deleteTargetId);
                            render();
                            showToast('تم حذف الصلاحية', 'success');
                            closeDeleteModal();
                        }, 400);
                    } else {
                        closeDeleteModal();
                    }
                }
            });

            // close modal on overlay click
            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) closeDeleteModal();
            });

            // ========== ADD PERMISSION (mock) ==========
            addPermissionBtn.addEventListener('click', () => {
                const newId = Math.max(...data.map(i => i.id), 0) + 1;
                data.push({
                    id: newId,
                    name: 'صلاحية جديدة',
                    slug: 'new.permission',
                    status: 'active',
                    created: new Date().toISOString().split('T')[0]
                });
                render();
                showToast('تمت إضافة صلاحية جديدة', 'success');
            });

            // ========== RIPPLE EFFECT ON BUTTONS ==========
            document.querySelectorAll('.btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    ripple.className = 'ripple';
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = (e.clientX - rect.left - size/2) + 'px';
                    ripple.style.top = (e.clientY - rect.top - size/2) + 'px';
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                });
            });

            // ========== SIDEBAR TOGGLE (mobile) ==========
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('open');
                });
            }
            if (sidebarClose) {
                sidebarClose.style.display = 'block';
                sidebarClose.addEventListener('click', () => {
                    sidebar.classList.remove('open');
                });
            }
            // show toggle button on mobile via CSS, but we also ensure it's visible
            function checkMobile() {
                if (window.innerWidth <= 992) {
                    if (sidebarToggle) sidebarToggle.style.display = 'block';
                    if (sidebarClose) sidebarClose.style.display = 'block';
                } else {
                    if (sidebarToggle) sidebarToggle.style.display = 'none';
                    if (sidebarClose) sidebarClose.style.display = 'none';
                    sidebar.classList.remove('open');
                }
            }
            window.addEventListener('resize', checkMobile);
            checkMobile();

            // ========== INITIAL RENDER ==========
            render();

            // ========== LIVE SEARCH DEBOUNCE (optional) ==========
            let searchTimer;
            liveSearchInput.addEventListener('input', () => {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => {
                    searchQuery = liveSearchInput.value;
                    render();
                }, 200);
            });
        })();
    </script>

    