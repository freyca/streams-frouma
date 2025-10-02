<!doctype html>
<html lang="{{  config('app.locale') }}" data-bs-theme="auto">

<x-head />

<body class="text-center" data-bs-theme="dark">
    <!-- Load IVS from a CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.14.3/video-js.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.14.3/video.min.js"></script>
    <script src="https://player.live-video.net/1.45.0/amazon-ivs-videojs-tech.min.js"></script>

    @vite([
        'resources/js/app.js',
    ])

    <main class="w-100 m-auto">
        {{ $slot }}
    </main>

    <x-footer />
</body>

</html>