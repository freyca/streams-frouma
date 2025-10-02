<?php

namespace App\Livewire;

use App\InteractsWithChat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Chat extends Component
{
    use InteractsWithChat;

    public string $question = '';

    public function mount()
    {
        $this->initChat();
    }

    public function sendMessage()
    {
        if (! Auth::check()) {
            return;
        }

        $this->validate([
            'question' => 'required|string|min:3',
        ]);

        $this->messageReceived();

        $this->reset('question');
    }

    public function render()
    {
        return view('livewire.chat');
    }

    public function messageReceived()
    {
        $this->saveChatQuestion(
            date('H:i'),
            auth()->user()->name,
            $this->question,
        );
    }
}
