<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public $photo;
    public $tempPhotoUrl;

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => ['image', 'max:2048'],
        ]);

        $this->tempPhotoUrl = $this->photo->temporaryUrl();
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $oldEmail = $user->getOriginal('email'); // simpan email lama dulu

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($this->photo) {
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }

            $path = $this->photo->store('profile-photos', 'public');
            $user->foto = $path;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Update juga email siswa pakai email lama
        if ($user->isDirty('email') && $user->hasRole('siswa')) {
            \App\Models\Siswa::where('email', $oldEmail)->update([
                'email' => $user->email,
            ]);
        }

        $user->save();

        $this->reset('photo');
        $this->dispatch('profile-updated', name: $user->name);

        $this->redirect(request()->header('Referer'));
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
}