<section class="w-full">
    @include('partials.settings-heading')
    <x-settings.layout>
        <div class="max-w-5xl mx-auto bg-white p-2 rounded-3xl shadow-md dark:bg-zinc-900 dark:text-white">
            <!-- Profile + Form -->
            <div class="flex flex-col md:flex-row md:space-x-6 items-start">
                <div class="relative w-24 h-24 rounded-full overflow-hidden">
                    @if($tempPhotoUrl)
                        <img src="{{ $tempPhotoUrl }}" alt="Preview Foto Profil" class="w-full h-full object-cover">
                    @else
                        <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/default-profile.png') }}" 
                            alt="Foto Profil" 
                            class="w-full h-full object-cover">
                    @endif
                    
                    <!-- Edit Button -->
                    <label for="photo-upload" class="absolute bottom-2 right-3 bg-gray-500/80 w-8 h-8 aspect-square flex items-center justify-center rounded-full text-white text-xs cursor-pointer shadow">
    ✎
                        <input wire:model="photo" 
                            id="photo-upload" 
                            type="file" 
                            class="hidden" 
                            accept="image/*">
                    </label>
                </div>

                @error('photo')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror

                <!-- Form Section -->
                <div class="flex-1 w-full space-y-8">
                    <!-- Profile Information Form -->
                    <form wire:submit.prevent="updateProfileInformation" class="space-y-6">
                        <h3 class="text-lg font-semibold mb-2">Profile Information</h3>
                        
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block mb-1 font-medium">Your Name</label>
                            <input wire:model="name" 
                                   id="name" 
                                   type="text" 
                                   class="w-full border border-gray-300 p-3 rounded-xl @error('name') border-red-500 @enderror" 
                                   required 
                                   autofocus 
                                   autocomplete="name" 
                                   value="{{ auth()->user()->name }}" />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block mb-1 font-medium">Email Address</label>
                            <input wire:model="email" 
                                   id="email" 
                                   type="email" 
                                   class="w-full border border-gray-300 p-3 rounded-xl @error('email') border-red-500 @enderror" 
                                   required 
                                   autocomplete="email" 
                                   value="{{ auth()->user()->email }}" />
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Save Button for Profile -->
                        <div class="flex items-center justify-between">
                            <div>
                                <x-action-message on="profile-updated" class="text-green-600">
                                    {{ __('Saved.') }}
                                </x-action-message>
                            </div>
                            <button type="submit" 
                                    class="bg-gray-400 hover:bg-zinc-500 text-white px-6 py-3 rounded-xl transition-colors">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-settings.layout>
</section>