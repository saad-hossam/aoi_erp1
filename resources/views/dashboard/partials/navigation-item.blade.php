@if (!empty($item['children']))

    {{-- ===== Has children: render as a collapsible folder ===== --}}
    <li class="menu-item has-children">

        <a href="javascript:void(0);" class="menu-item-button">

            <div class="icon">
                <i class="icon-grid"></i>
            </div>

            <div class="text">
                {{ $item['node']->label }}
            </div>

        </a>

        <ul class="sub-menu">

            @foreach ($item['children'] as $child)
                

            
            {{-- <p>{{ 11 }}</p> --}}
                    @can($child['node']->label)

                @if (!empty($child['children']))

                    {{-- ===== Child has its own children: nested folder ===== --}}

                        <li class="menu-item has-children">

                            <a href="javascript:void(0);" class="menu-item-button">

                                <div class="icon">
                                    <i class="icon-folder"></i>
                                </div>

                                <div class="text">
                                    {{ $child['node']->label }}
                                </div>

                            </a>

                            <ul class="sub-menu">
                                @foreach ($child['children'] as $grandChild)
                                    @include('dashboard.partials.navigation-item', ['item' => $grandChild])
                                @endforeach
                            </ul>

                        </li>

                @else

                    {{-- ===== Leaf child: render as a link (or dead link) ===== --}}
                    <li class="sub-menu-item">

                        @if ($child['page'])
                            <a href="{{ url($child['page']->route_path) }}">
                                <div class="text">
                                    {{ $child['node']->label }}
                                </div>
                            </a>
                        @else
                            <a href="javascript:void(0);">
                                <div class="text">
                                    {{ $child['node']->label }}
                                </div>
                            </a>
                        @endif

                    </li>

                @endif
                    @endcan

            @endforeach

        </ul>

    </li>

@else

    {{-- ===== Leaf item ===== --}}
    <li class="menu-item">

        @if ($item['page'])
            <a href="{{ url($item['page']->route_path) }}">

                <div class="icon">
                    <i class="icon-grid"></i>
                </div>

                <div class="text">
                    {{ $item['node']->label }}
                </div>

            </a>
        @else
            <a href="javascript:void(0);">

                <div class="icon">
                    <i class="icon-grid"></i>
                </div>

                <div class="text">
                    {{ $item['node']->label }}
                </div>

            </a>
        @endif

    </li>

@endif