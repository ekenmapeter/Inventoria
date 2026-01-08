<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                    <a href="{{ route('forums.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                        Forums
                    </a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span>{{ $forum->name }}</span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $forum->name }}
                </h2>
                @if($forum->description)
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        {{ $forum->description }}
                    </p>
                @endif
            </div>
            @auth
                @if(auth()->user()->hasActiveSubscription() && !auth()->user()->isSuspended())
                    <x-button href="{{ route('topics.create', $forum) }}" variant="primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Topic
                    </x-button>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="space-y-6">
        @if($topics->count() > 0)
            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Topics</h3>
                    <span class="badge badge-primary">{{ $topics->total() }} total</span>
                </div>

                <div class="space-y-4">
                    @foreach($topics as $topic)
                        <div class="group border border-gray-200 dark:border-gray-700 rounded-lg p-5 hover:border-primary-300 dark:hover:border-primary-700 hover:shadow-md transition-all duration-200">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <x-user-avatar :user="$topic->user" size="lg" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                        <a href="{{ route('topics.show', $topic) }}" class="hover:underline">
                                            {{ $topic->title }}
                                        </a>
                                    </h4>
                                    <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-3">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            {{ $topic->user->name }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $topic->created_at->diffForHumans() }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                            {{ $topic->posts_count }} {{ Str::plural('reply', $topic->posts_count) }}
                                        </span>
                                    </div>
                                    @if($topic->body)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                            {{ Str::limit(strip_tags($topic->body), 150) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $topics->links() }}
                </div>
            </x-card>
        @else
            <x-card class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No topics yet</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Be the first to start a discussion!</p>
                @auth
                    @if(auth()->user()->hasActiveSubscription() && !auth()->user()->isSuspended())
                        <x-button href="{{ route('topics.create', $forum) }}" variant="primary">
                            Create First Topic
                        </x-button>
                    @endif
                @endauth
            </x-card>
        @endif
    </div>
</x-app-layout>
