<?php

namespace App\Livewire\Notes;

use Flux\Flux;
use App\Models\Notes;
use Livewire\Component;
use Livewire\Attributes\On;

class EditNotes extends Component
{
    public $title;
    public $content;
    public $noteId;

    public function rules()
    {
        return [
            'title' => 'required|string|max:255|unique:notes,title,'. $this->noteId,
            'content' => 'required|string',
        ];
    }

    #[On('edit-note')]
    public function edit($id)
    {
        $note = Notes::findOrFail($id);
        if ($note) {
            $this->noteId = $note->id;
            $this->title = $note->title;
            $this->content = $note->content;
            Flux::modal('edit-note')->show();
        }
    }

    public function update()
    {
        $this->validate();
        // Assuming you have a Notes model and a notes table
        $note = Notes::find($this->noteId);
        if ($note) {
            $note->update([
                'title' => $this->title,
                'content' => $this->content,
            ]);
            // Reset the form fields
            $this->reset();
            Flux::modal('edit-note')->close();
            // Optionally, you can redirect or show a success message
            session()->flash('message', 'Note updated successfully.');
            // Redirect to the notes page or show a success message
            $this->redirect(route('notes'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.notes.edit-notes');
    }
}
