<?php

namespace App\Livewire\Front\Siswa;

use App\Models\Siswa;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $userMail;
    public $search = '';

    public function mount(){
        $this->userMail = Auth::user()->email;
    }
    public function render()
    {
        $siswaList = Siswa::query()
        ->when($this->search, function($query) {
            $query->where('nama', 'like', '%'.$this->search.'%')
                  ->orWhere('nis', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%');
        })
        ->get();
        return view('livewire.front.siswa.index',[
            'siswa'=>Siswa::where('email','=',$this->userMail)->first(),
            'siswaList' => $siswaList,
        ]);
    }
}