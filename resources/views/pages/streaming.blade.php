<x-simple>
    @php
    // video_quality comes from streaming name
    // it is hardcoded as is on nginx, its the path to the file

    $scren_size_cookie  = isset($_COOKIE['screen_size']) ? $_COOKIE['screen_size'] : '1920x1080';
    $video_quality      = 'big';
    $streaming_name     = 'PRUEBA';
    $height             = explode('x', $scren_size_cookie)[0];
    $width              = explode('x', $scren_size_cookie)[1];

    if ($height < 1000 || $width < 450) {
        $video_quality = 'small';
    }

    $dash_url = 'https://stream.froumastream.com/' . $video_quality . '/dash/' . $streaming_name . '.mpd';
    $hls_url  = 'https://stream.froumastream.com/' . $video_quality . '/hls/' . $streaming_name . '.m3u8';

    @endphp

    <div class="container">
        <div class="row">
            <video id="my-video" class="video-js vjs-fluid" controls preload="auto" poster="assets/images/frouma_big.png" data-setup="{}">
                <source src="<?php echo $dash_url ?>" type="application/dash+xml">
                <source src="<?php echo $hls_url  ?>" type="application/vnd.apple.mpegurl">
                <p class="vjs-no-js">Por favor, activa JavaScript en tu navegador o actualízalo a una versión que soporte<a href="https://videojs.com/html5-video-support/" target="_blank">vídeos en HTML5</a></p>
            </video>
        </div>
    </div>

    <x-chat />
    <script src="/js/streaming-chat.js" defer='defer'></script>
</x-simple>
