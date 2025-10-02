<!doctype html>
<html lang="{{  config('app.locale') }}" data-bs-theme="auto">

<x-head />

<body class="text-center" data-bs-theme="dark">

    <main class="w-100 m-auto">

        {{ $slot }}

    </main>

    <x-footer />
</body>

</html>