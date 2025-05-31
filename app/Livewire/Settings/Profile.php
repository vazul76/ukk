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

        // Handle photo upload
        if ($this->photo) {
            // Delete old photo if exists
            if ($user->foto && Storage::exists('public/'.$user->foto)) {
                Storage::delete('public/'.$user->foto);
            }
            
            // Store new photo
            $path = $this->photo->store('profile-photos', 'public');
            $user->foto = $path;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->reset('photo');
        $this->dispatch('profile-updated', name: $user->name);
        
        // Refresh page to show updated photo
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