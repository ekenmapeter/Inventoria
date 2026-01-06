<x-admin-layout>
    <div class="space-y-6">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.forums.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Forums</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Create Forum</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Forum</h1>
        </div>

        <x-card class="max-w-3xl">
            <form method="POST" action="{{ route('admin.forums.store') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Forum Name')" class="text-base font-semibold mb-2" />
                    <x-text-input 
                        id="name" 
                        class="input w-full" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        required 
                        autofocus 
                        placeholder="Enter forum name..."
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" class="text-base font-semibold mb-2" />
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4" 
                        class="input w-full" 
                        placeholder="Enter forum description...">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="is_active" 
                            value="1" 
                            {{ old('is_active', true) ? 'checked' : '' }} 
                            class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                        >
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Active</span>
                    </label>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Only active forums are visible to users.</p>
                </div>

                <div>
                    <x-input-label for="moderators" :value="__('Moderators')" class="text-base font-semibold mb-2" />
                    <select 
                        id="moderators" 
                        name="moderators[]" 
                        multiple 
                        class="input w-full min-h-[120px]"
                    >
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ in_array($user->id, old('moderators', [])) ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }}) - {{ ucfirst($user->role) }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Hold Ctrl (or Cmd on Mac) to select multiple moderators.</p>
                    <x-input-error :messages="$errors->get('moderators')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <x-button href="{{ route('admin.forums.index') }}" variant="ghost">
                        Cancel
                    </x-button>
                    <x-button type="submit" variant="primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Create Forum
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-admin-layout>
