<div id="chat-content" class="text-start text-break" style="overflow: auto;" wire:poll="fetchMessages">
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