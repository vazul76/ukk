<?php

namespace App\Livewire\Front\Guru;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Guru;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $gurus = Guru::when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('nip', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nama')
            ->paginate($this->perPage);

        return view('livewire.front.guru.index', [
            'gurus' => $gurus,
        ]);
    }
}
