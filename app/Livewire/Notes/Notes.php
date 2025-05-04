<?php

namespace App\Livewire\Notes;

use App\Models\Notes as ModelsNotes;
use Livewire\Component;
use Livewire\WithPagination;
use Flux\Flux;

class Notes extends Component
{
    public $noteId;
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $notes = ModelsNotes::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.notes.notes', [
            'notes' => $notes,
        ]);
    }

    public function edit($id)
    {
        $this->dispatch('edit-note', $id);
    }

    public function delete($id)
    {
        $this->noteId = $id;
        Flux::modal('delete-note')->show();
    }

    public function confirmDelete()
    {
        $note = ModelsNotes::find($this->noteId);
        if ($note) {
            $note->delete();
            Flux::modal('delete-note')->close();
            // session()->flash('message', 'Note deleted successfully.');
            // // Redirect to the notes page or show a success message
            $this->redirect(route('notes'), navigate: true);
        }
    }
}
