<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@yield('head')
<body>
@yield('content')
@yield('footer')
</body>
@yield('script')
</html>
