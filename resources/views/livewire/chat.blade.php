<div class="position-absolute fixed-bottom">
    <form wire:submit.prevent="sendMessage" method="POST">
        @csrf

        <div class="input-group">
            <input
                type="text"
                class="form-control border-dark rounded-0 rounded-top bg-body-secondary"
                wire:model="question"
            >

            <button
                type="submit"
                class="btn btn-info rounded-0 rounded-top border-0 btn-send"
                wire:loading.attr="disabled"
                wire:target="sendMessage"
                :disabled="$wire.question.length < 3"
            >
                <span wire:loading.remove wire:target="sendMessage">
                    @lang('Send')
                </span>
                <span wire:loading wire:target="sendMessage">
                    @lang('Sending...')
                </span>
            </button>
        </div>
    </form>
</div>