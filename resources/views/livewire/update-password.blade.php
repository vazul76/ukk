<div>
    <form wire:submit.prevent="updatePassword" class="space-y-6">
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
            <input wire:model="current_password" id="current_password" type="password" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
            <input wire:model="password" id="password" type="password" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input wire:model="password_confirmation" id="password_confirmation" type="password" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div class="flex items-center justify-end">
            <x-action-message class="mr-3" on="password-updated">
                {{ __('Saved.') }}
            </x-action-message>

            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Update Password
            </button>
        </div>
    </form>
</div>