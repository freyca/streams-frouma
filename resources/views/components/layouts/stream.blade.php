<!doctype html>
<html lang="es" data-bs-theme="auto">

<x-head />

<body class="text-center" data-bs-theme="dark">

    {{--
        <script src="{{ asset('js/video.min.js') }}"></script>
    --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{--
    <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('js/streaming-chat.js') }}"></script>
    --}}

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