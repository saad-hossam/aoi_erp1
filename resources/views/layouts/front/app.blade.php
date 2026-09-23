<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
  @include('includes.front.head')
  @stack('styles')
</head>


<body class="gradient-bg">
 @include('includes.front.svg')
  <style>
    #header {
      padding-top: 8px;
      padding-bottom: 8px;
    }

    .logo__image {
      max-width: 220px;
    }
  </style>
    @include('includes.front.header')

  @yield('content')


  <hr class="mt-5 text-secondary" />
    @include('includes.front.footer')

    @include('includes.front.scripts')
    @stack('scripts')

</body>

</html>
