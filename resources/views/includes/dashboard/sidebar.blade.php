{{-- resources/views/dashboard/partials/section-menu-left.blade.php --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<div class="section-menu-left" id="sidebar">
    <div class="box-logo">
        <a href="{{ route('admin.index') }}" id="site-logo-inner">
            <img id="logo_header" alt="logo"
                 src="{{ asset('assets/front/assets') }}/images/logo_ar.png">
        </a>
        <div class="button-show-hide" id="sidebarClose" style="display: none;">
            <i class="fas fa-times"></i>
        </div>
    </div>

    <div class="center">
        {{-- ============ الرئيسية ============ --}}
        <div class="center-item">
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{ route('admin.index') }}"
                       class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <div class="icon"><i class="fas fa-th-large"></i></div>
                        <div class="text">لوحة التحكم</div>
                    </a>
                </li>
            </ul>
        </div>

        {{-- ============ الإدارة ============ --}}
        <div class="center-item">
            <div class="center-heading">الإدارة</div>
            <ul class="menu-list">

                <li class="menu-item">
                    <a href="{{ route('emps.index') }}"
                       class="{{ request()->routeIs('emps.*') ? 'active' : '' }}">
                        <div class="icon"><i class="fas fa-user"></i></div>
                        <div class="text">المستخدمون</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('permissions.index') }}"
                       class="{{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                        <div class="icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="text">الصلاحيات</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('roles.index') }}"
                       class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                        <div class="icon"><i class="fas fa-user-tag"></i></div>
                        <div class="text">الأدوار</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.pages.index') }}"
                       class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                        <div class="icon"><i class="fas fa-file-alt"></i></div>
                        <div class="text">الصفحات</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.tree-nodes.index') }}"
                       class="{{ request()->routeIs('admin.tree-nodes.*') ? 'active' : '' }}">
                        <div class="icon"><i class="fas fa-sitemap"></i></div>
                        <div class="text">عقد الشجرة</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.tree-page-mappings.index') }}"
                       class="{{ request()->routeIs('admin.tree-page-mappings.*') ? 'active' : '' }}">
                        <div class="icon"><i class="fas fa-link"></i></div>
                        <div class="text">ربط الشجرة بالصفحات</div>
                    </a>
                </li>

            </ul>
        </div>

        {{-- ============ نظام ERP الديناميكي (Navigation) ============ --}}
        @if(!empty($navigation))
            <div class="center-item">
                <div class="center-heading">{{ $navigation['root']->label }}</div>

                <ul class="menu-list">
                    @forelse($navigation['children'] as $item)
                        @can($item['node']->label)
                            @include('dashboard.partials.navigation-item', ['item' => $item])
                        @endcan
                    @empty
                        <li class="menu-item">
                            <div class="text text-muted">لا توجد عناصر</div>
                        </li>
                    @endforelse
                </ul>
            </div>
        @endif

    </div>
</div>