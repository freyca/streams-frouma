<div>
    <div class="position-static">
        <div class="position-absolute bottom-0 start-0">
            <button id="chat-button" class="btn rounded-0 rounded-top bg-light-subtle text-light ask-question" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasChat" aria-controls="offcanvasChat">
                @lang('Do you have any question?')
            </button>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasChat" aria-labelledby="offcanvasChatLabel">
        <div class="offcanvas-header bg-body-tertiary text-light-subtle">
            <h5 class="offcanvas-title" id="offcanvasChatLabel">@lang('Here you can ask any question about stream content')</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="chat-content" class="text-start overflow-scroll" style="overflow: auto;">
                @foreach ($this->messages as $message)
                    <p class="rounded p-2 bg-dark-subtle bubble-chat">
                        <small class="text-secondary">
                            {{ $message['date'] }}
                        </small>
                        <span class="user-email text-decoration-underline">
                            {{ $message['user'] }}
                        </span>
                        {{': ' . $message['question'] }}
                    </p>
                @endforeach
            </div>
            <br />
        </div>

        <div class="position-absolute fixed-bottom">
            <form wire:submit.prevent="sendMessage" method="POST">
                @csrf

                <div class="input-group">
                    <input type="text" class="form-control border-dark rounded-0 rounded-top bg-body-secondary" wire:model="question">
                    <button type="submit" class="btn btn-info rounded-0 rounded-top border-0 btn-send">@lang('Send')</button>
                </div>
            </form>
        </div>
    </div>
</div>