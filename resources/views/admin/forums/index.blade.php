<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Forums Management</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Create and manage forum categories</p>
            </div>
            <x-button href="{{ route('admin.forums.create') }}" variant="primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Forum
            </x-button>
        </div>

        @if($forums->count() > 0)
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($forums as $forum)
                    <x-card>
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $forum->name }}</h3>
                                @if($forum->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $forum->description }}</p>
                                @endif
                            </div>
                            <div class="flex-shrink-0">
                                @if($forum->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $forum->topics_count }} topics
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                {{ $forum->moderators_count }} moderators
                            </div>
                        </div>

                        <div class="flex items-center gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <x-button href="{{ route('admin.forums.edit', $forum) }}" variant="outline" size="sm" class="flex-1">
                                Edit
                            </x-button>
                            <form method="POST" action="{{ route('admin.forums.destroy', $forum) }}" onsubmit="return confirm('Are you sure you want to delete this forum?');" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" variant="danger" size="sm" class="w-full">
                                    Delete
                                </x-button>
                            </form>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @else
            <x-card class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No forums found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Create your first forum to get started.</p>
                <x-button href="{{ route('admin.forums.create') }}" variant="primary">
                    Create Forum
                </x-button>
            </x-card>
        @endif
    </div>
</x-admin-layout>
