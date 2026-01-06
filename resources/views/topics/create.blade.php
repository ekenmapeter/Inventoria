<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                <a href="{{ route('forums.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Forums</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('forums.show', $forum) }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ $forum->name }}</a>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                Create New Topic
            </h2>
        </div>
    </x-slot>

    <x-card class="max-w-3xl mx-auto">
        <form method="POST" action="{{ route('topics.store', $forum) }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="title" :value="__('Topic Title')" class="text-base font-semibold mb-2" />
                <x-text-input 
                    id="title" 
                    class="input w-full text-lg" 
                    type="text" 
                    name="title" 
                    :value="old('title')" 
                    required 
                    autofocus 
                    placeholder="Enter a descriptive title for your topic..."
                />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Choose a clear, descriptive title that summarizes your topic.
                </p>
            </div>

            <div>
                <x-input-label for="body" :value="__('Content')" class="text-base font-semibold mb-2" />
                <textarea 
                    id="body" 
                    name="body" 
                    rows="12" 
                    class="input w-full" 
                    required 
                    placeholder="Write your topic content here...">{{ old('body') }}</textarea>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Be clear and detailed in your description to help others understand your topic.
                </p>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <x-button href="{{ route('forums.show', $forum) }}" variant="ghost">
                    Cancel
                </x-button>
                <x-button type="submit" variant="primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Topic
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
