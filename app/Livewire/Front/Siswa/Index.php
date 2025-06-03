<?php

namespace App\Livewire\Front\Siswa;

use App\Models\Siswa;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $userMail;
    public $search = '';

    public function mount() {
        $this->userMail = Auth::user()->email;
    }

    public function render()
    {
        $siswaList = Siswa::query()
            ->select([
                'id',
                'nama',
                'nis',
                'email',
                'gender',
                'alamat',
                'kontak',
                'status_lapor_pkl',
                DB::raw('format_gender(gender) as gender_label') // Tambahkan ini
            ])
            ->when($this->search, function($query) {
                $query->where('nama', 'like', '%'.$this->search.'%')
                      ->orWhere('nis', 'like', '%'.$this->search.'%')
                      ->orWhere('email', 'like', '%'.$this->search.'%');
            })
            ->get();

        return view('livewire.front.siswa.index', [
            'siswa' => Siswa::where('email', $this->userMail)
                        ->select([
                            'id',
                            'nama',
                            'gender',
                            
                            DB::raw('format_gender(gender) as gender_label') // Untuk siswa login
                        ])
                        ->first(),
            'siswaList' => $siswaList,
        ]);
    }
}