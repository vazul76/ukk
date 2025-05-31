<?php

namespace App\Livewire\Front\Industri;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Industri;

class Index extends Component
{
    use WithPagination;
    
    public $search = '';
    public $perPage = 6;
    
    public function render()
    {
        $industries = Industri::when($this->search, function($query) {
                $query->where('nama', 'like', '%'.$this->search.'%')
                      ->orWhere('bidang_usaha', 'like', '%'.$this->search.'%')
                      ->orWhere('alamat', 'like', '%'.$this->search.'%');
            })
            ->orderBy('nama')
            ->paginate($this->perPage);
            
        return view('livewire.front.industri.index', compact('industries'));
    }
}