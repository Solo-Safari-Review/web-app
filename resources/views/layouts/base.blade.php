<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ "Reveazy | "}} @yield('title', "Review and Easy")</title>
  @include('layouts.header')
  @yield('header')
</head>
<body class="d-flex flex-row">
  @yield('left-sidebar')

  <main class="d-flex flex-column">
    @yield('main')

    <footer>
      @yield('footer')
    </footer>
  </main>

  @include('layouts.script')
  @stack('scripts')
</body>
</html>
