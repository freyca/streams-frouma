<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Chat extends Component
{
    private string $chat_file = 'chat_file.json';

    public string $question = '';

    public function mount()
    {
        if (! Storage::exists($this->chat_file)) {
            Storage::put($this->chat_file, '');
        }
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
        $received_data = [
            'date' => date('H:i'),
            'user' => auth()->user()->name,
            'question' => $this->question,
        ];

        $chat_file_contents = Storage::get($this->chat_file);
        $actual_decoded_data = json_decode($chat_file_contents, true);

        if (is_null($actual_decoded_data)) {
            $actual_decoded_data = [];
        }

        array_push($actual_decoded_data, $received_data);
        $coded_data = json_encode($actual_decoded_data);

        $fullPath = Storage::path($this->chat_file);
        file_put_contents($fullPath, $coded_data, LOCK_EX);
    }
}
