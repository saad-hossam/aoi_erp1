<div class="section-menu-left">

    <div class="box-logo">

        <a href="{{ route('admin.index') }}" id="site-logo-inner">

            <img
                id="logo_header"
                alt=""
                src="{{ asset('assets/dashboard') }}/images/logo/logo.png"
                data-light="images/logo/logo.png"
                data-dark="images/logo/logo.png"
            >

        </a>

        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>

    </div>

    <div class="center">

        {{-- Dashboard --}}
        <div class="center-item">

            <div class="center-heading">
                Main Home
            </div>

            <ul class="menu-list">

                <li class="menu-item">

                    <a href="{{ route('admin.index') }}">

                        <div class="icon">
                            <i class="icon-grid"></i>
                        </div>

                        <div class="text">
                            Dashboard
                        </div>

                    </a>

                </li>

            </ul>

        </div>

        <div class="center-item">

            <div class="center-heading">
                ERP System
            </div>

            @if(!empty($navigation))

                <div class="erp-root-title">

                    <div class="icon">
                        <i class="icon-grid"></i>
                    </div>

                    <div class="text">
                        {{ $navigation['root']->label }}
                    </div>

                </div>

                <ul class="menu-list">

                    @forelse($navigation['children'] as $item)

                        @include(
                            'dashboard.partials.navigation-item',
                            ['item' => $item]
                        )

                    @empty

                        <li class="menu-item">

                            <div class="text text-muted">
                                No navigation items
                            </div>

                        </li>

                    @endforelse

                </ul>

            @endif

        </div>
        {{-- Administration --}}
        <div class="center-item">

            <div class="center-heading">
                Administration
            </div>

            <ul class="menu-list">

                <li class="menu-item">

                    <a href="{{ route('admin.pages.index') }}">

                        <div class="icon">
                            <i class="icon-file"></i>
                        </div>

                        <div class="text">
                            Pages
                        </div>

                    </a>

                </li>

                <li class="menu-item">

                    <a href="{{ route('admin.tree-nodes.index') }}">

                        <div class="icon">
                            <i class="icon-grid"></i>
                        </div>

                        <div class="text">
                            Tree Nodes
                        </div>

                    </a>

                </li>

                <li class="menu-item">

                    <a href="{{ route('admin.tree-page-mappings.index') }}">

                        <div class="icon">
                            <i class="icon-link"></i>
                        </div>

                        <div class="text">
                            Tree Page Mappings
                        </div>

                    </a>

                </li>

            </ul>

        </div>

    </div>

</div>