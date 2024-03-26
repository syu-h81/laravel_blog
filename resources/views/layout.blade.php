<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
  <script src="{{ asset('/assets/js/app.js') }}" defer></script>
</head>
<body>
  <header>
    @include('header')
  </header>
  <br>
  <div class="container">
    @yield('content')
  </div>
  <footer class="footer bg-dark  fixed-bottom">
    @include('footer')
  </footer>
</body>
</html>