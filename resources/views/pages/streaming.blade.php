<x-layouts.app>
    <div class="container">
        <div class="row">
            <div class="video-container">
                <video id="amazon-ivs-videojs" class="video-js vjs-16-9 vjs-big-play-centered" controls autoplay playsinline></video>
            </div>
        </div>
    </div>

    <div>
        <div class="position-fixed bottom-0 start-0">
            <button id="chat-button" class="btn rounded-0 rounded-top bg-light-subtle text-light ask-question" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasChat" aria-controls="offcanvasChat">
                @lang('Do you have any question?')
            </button>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasChat" aria-labelledby="offcanvasChatLabel">
            <div class="offcanvas-header bg-body-tertiary text-light-subtle">
                <h5 class="offcanvas-title me-2" id="offcanvasChatLabel">
                    @lang('Here you can ask any question about stream content')
                </h5>
                <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <livewire:chat-questions />
                <br />
                <livewire:chat />
            </div>
        </div>
    </div>

    <script>
        window.onload = (event) => {
            // Video controls
            (function play() {
                // Get playback URL from Amazon IVS API
                var PLAYBACK_URL = "{{ config('froumastream.videojs_playback_url') }}";

                // Register Amazon IVS as playback technology for Video.js
                registerIVSTech(videojs);

                // Initialize player
                var player = videojs('amazon-ivs-videojs', {
                   techOrder: ["AmazonIVS"]
                }, () => {
                   console.log('Player is ready to use!');
                   // Play stream
                   player.src(PLAYBACK_URL);
                });
            })();
        };


        // Shows last question on opening chat
        document.querySelector("#chat-button").addEventListener("click", function() {
            scrollLastQuestionIntoView();
        });

        function scrollLastQuestionIntoView() {
            const chat = document.querySelector('#chat-content');
            const last = chat?.lastElementChild;
            if (last) last.scrollIntoView();
        }
    </script>
</x-layouts.app>