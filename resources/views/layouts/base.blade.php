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
  <x-modals.confirm-send-review></x-modals.confirm-send-review>
  <x-modals.confirm-delete-review></x-modals.confirm-delete>
  <x-modals.confirm></x-modals.confirm>
  <x-modals.confirm-delete></x-modals.confirm-delete>

  @if (session()->has('success'))
  <x-modals.success message="{{ session('success') }}"></x-modals.success>
  @endif

  <main class="flex flex-col min-h-screen w-full">
    <div class="flex flex-col min-h-screen mt-10 xl:mt-0">
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
