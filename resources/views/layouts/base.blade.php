<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ "Reveazy | "}} @yield('title', "Review and Easy")</title>
  @include('layouts.header')
  @yield('header')
</head>
<body class="flex">
  @include('layouts.left-sidebar')

  <main class="flex flex-col min-h-screen w-full">
    <div class="flex flex-col min-h-screen">
      @yield('main')
    </div>

    <footer class="w-full">
      @include('layouts.footer')
    </footer>
  </main>

  @include('layouts.script')
  @stack('scripts')
</body>
</html>
