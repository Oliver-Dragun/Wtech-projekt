<!doctype html>
<html lang="en" class="@yield('html_class')">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Wtech')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-components.css') }}" />
  </head>
  <body class="@yield('body_class')">

    @section('page_header')
      @include('partials.header')
    @show

    <div class="ps-page-content">
      @yield('content')
    </div>

    @section('page_footer')
      @include('partials.footer')
    @show

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    @vite('resources/js/app.js')
    @stack('scripts')
  </body>
</html>
