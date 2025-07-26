<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Comment extends Component
{
    public Model $commentable;
    public bool $showForm = false;

    public function render()
    {
        return view('livewire.comment', [
            'comments' => $this->commentable->comments,
        ]);
    }

    public function toggle()
    {
        $this->showForm = !$this->showForm;
    }
}
