<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class ChatQuestions extends Component
{
    private string $chat_file = 'chat_file.json';

    public array $messages = [];

    public function mount()
    {
        if (! Storage::exists($this->chat_file)) {
            Storage::put($this->chat_file, '');
        }

        $this->fetchMessages();
    }

    public function render()
    {
        return view('livewire.chat-questions');
    }

    public function fetchMessages()
    {
        $this->messages = json_decode(Storage::get($this->chat_file), true) ?? [];
    }
}
