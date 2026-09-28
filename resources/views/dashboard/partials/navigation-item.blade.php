@if(!empty($item['children']))

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

            @foreach($item['children'] as $child)

                @if(!empty($child['children']))

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

                            @foreach($child['children'] as $grandChild)

                                @include(
                                    'dashboard.partials.navigation-item',
                                    ['item' => $grandChild]
                                )

                            @endforeach

                        </ul>

                    </li>

                @else

                    <li class="sub-menu-item">

                        @if($child['page'])

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

            @endforeach

        </ul>

    </li>

@else

    <li class="menu-item">

        @if($item['page'])

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