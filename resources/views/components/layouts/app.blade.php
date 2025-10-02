<!doctype html>
<html lang="{{  config('app.locale') }}" data-bs-theme="auto">

<x-head />

<body class="text-center" data-bs-theme="dark">

    <main class="form-signin w-100 m-auto">
        <x-brand-copy />

        {{ $slot }}

        <x-frouma-copy />
    </main>

    <x-footer />
</body>

</html>