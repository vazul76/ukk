<?php
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Models\Siswa;
use App\Livewire\Front\Guru\Index as GuruIndex;
use App\Livewire\Front\Siswa\Index as SiswaIndex;
use App\Livewire\Front\Industri\Index as IndustriIndex;
use App\Livewire\Front\Pkl\Index as PklIndex;


// Route::get('/siswa', function () {
//     return "Siswa";
// })->middleware(['auth', 'verified','role:siswa','check_user_email'])
//  ->name('siswa');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified', 'check_user_email'])->group(function () {
    Route::get('/dashboard', function () {
        $siswaList = Siswa::with(['pklAktif.industri'])->get();
        return view('dashboard', compact('siswaList'));
    })
    ->name('dashboard');
    
    Route::get('/daftarguru', GuruIndex::class)->name('guru');
    Route::get('/daftarsiswa', SiswaIndex::class)->name('siswa');
    Route::get('/daftarindustri', IndustriIndex::class)->name('industri');
    Route::get('/daftarpkl', PklIndex::class)
        ->middleware('role:siswa')
        ->name('daftarpkl');    
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';