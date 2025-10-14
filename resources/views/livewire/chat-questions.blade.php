<div id="chat-content" class="text-start text-break" style="overflow: auto;" wire:poll="fetchChatMessages">
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

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('scrollToBottom', () => {
            // Wait until Livewire finishes the DOM diff AND the browser paints it
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    const chat = document.querySelector('#chat-content');
                    const last = chat?.lastElementChild;
                    if (last) last.scrollIntoView({ behavior: 'smooth' });
                });
            });
        });
    });
</script>