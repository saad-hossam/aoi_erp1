<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    @include('includes.dashboard.head')
    @stack('styles')
</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">



                @include('includes.dashboard.sidebar')


                <div class="section-content-right">

                    @include('includes.dashboard.header')

                    <div class="main-content">

                        <div class="main-content-inner">

                            @yield('content')

                        </div>


                       @include('includes.dashboard.footer')
                    </div>

                </div>
            </div>
        </div>
    </div>

   @include('includes.dashboard.scripts')
   @stack('scripts')
</body>

</html>
