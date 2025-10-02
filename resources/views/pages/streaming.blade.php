<x-layouts.stream>
    {{--
    @vite([ 'resources/js/videojs.js' ])
    --}}


    <div class="container">
        <div class="row">
            <div class="video-container">
                <video id="amazon-ivs-videojs" class="video-js vjs-16-9 vjs-big-play-centered" controls autoplay playsinline></video>
            </div>
        </div>
    </div>

    <script>
        (function play() {
            // Get playback URL from Amazon IVS API
            var PLAYBACK_URL = "{{ config('froumastream.videojs_playback_url') }}";

            // Register Amazon IVS as playback technology for Video.js
            registerIVSTech(videojs);
//
            //// Initialize player
            var player = videojs('amazon-ivs-videojs', {
               techOrder: ["AmazonIVS"]
            }, () => {
               console.log('Player is ready to use!');
               // Play stream
               player.src(PLAYBACK_URL);
            });
        })();
    </script>

    <livewire:chat />

</x-layouts.stream>