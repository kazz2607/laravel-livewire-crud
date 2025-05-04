<?php

namespace App\Livewire\Notes;

use Flux\Flux;
use App\Models\Notes;
use Livewire\Component;

class CreateNotes extends Component
{
    public $title;
    public $content;

    protected function rules()
    {
        return [
            'title' => 'required|string|unique:notes,title|max:255',
            'content' => 'required|string',
        ];
    }

    public function save()
    {
        $this->validate();
        // Assuming you have a Notes model and a notes table
        Notes::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);
        // Reset the form fields
        $this->reset();
        Flux::modal('create-note')->close();
        // Optionally, you can redirect or show a success message
        session()->flash('message', 'Note created successfully.');
        // Redirect to the notes page or show a success message
        $this->redirect(route('notes'), navigate: true);
    }

    public function render()
    {
        return view('livewire.notes.create-notes');
    }
}
