<div class="position-absolute fixed-bottom">
    <form wire:submit.prevent="sendMessage" method="POST">
        @csrf

        <div class="input-group">
            <input type="text" class="form-control border-dark rounded-0 rounded-top bg-body-secondary" wire:model="question">
            <button type="submit" class="btn btn-info rounded-0 rounded-top border-0 btn-send">@lang('Send')</button>
        </div>
    </form>
</div>