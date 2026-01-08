<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                    <a href="{{ route('forums.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Forums</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('forums.show', $topic->forum) }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ $topic->forum->name }}</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span>{{ Str::limit($topic->title, 40) }}</span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $topic->title }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Original Topic Post -->
        <x-card class="border-l-4 border-l-primary-500">
            <div class="flex items-start gap-4 mb-4">
                <div class="flex-shrink-0">
                    <x-user-avatar :user="$topic->user" size="lg" />
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $topic->user->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $topic->created_at->format('M d, Y') }} at {{ $topic->created_at->format('g:i A') }}
                            </p>
                        </div>
                        @can('update', $topic)
                            <div class="flex items-center gap-2">
                                <x-button href="{{ route('topics.edit', $topic) }}" variant="ghost" size="sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </x-button>
                                <form method="POST" action="{{ route('topics.destroy', $topic) }}" onsubmit="return confirm('Are you sure you want to delete this topic?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" variant="danger" size="sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </x-button>
                                </form>
                            </div>
                        @endcan
                    </div>
                    <div class="prose dark:prose-invert max-w-none">
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">{{ $topic->body }}</p>
                    </div>
                </div>
            </div>
        </x-card>

        <!-- Replies Section -->
        <x-card>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Replies
                    <span class="badge badge-primary ml-2">{{ $topic->posts->count() }}</span>
                </h3>
            </div>

            @if($topic->posts->count() > 0)
                <div class="space-y-6">
                    @foreach($topic->posts as $index => $post)
                        <div class="border-l-2 border-l-gray-200 dark:border-l-gray-700 pl-6 py-4 hover:border-l-primary-400 dark:hover:border-l-primary-600 transition-colors">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <x-user-avatar :user="$post->user" size="md" />
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ $post->user->name }}</h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                #{{ $index + 1 }} • {{ $post->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        @can('update', $post)
                                            <div class="flex items-center gap-2">
                                                <x-button href="{{ route('posts.edit', $post) }}" variant="ghost" size="sm">
                                                    Edit
                                                </x-button>
                                                <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Are you sure?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-button type="submit" variant="danger" size="sm">Delete</x-button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>
                                    <div class="prose dark:prose-invert max-w-none">
                                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">{{ $post->body }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <p>No replies yet. Be the first to reply!</p>
                </div>
            @endif
        </x-card>

        <!-- Reply Form -->
        @auth
            @if(auth()->user()->hasActiveSubscription() && !auth()->user()->isSuspended())
                <x-card>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Post a Reply</h3>
                    <form method="POST" action="{{ route('posts.store', $topic) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Your Reply
                            </label>
                            <textarea
                                id="body"
                                name="body"
                                rows="6"
                                class="input w-full"
                                required
                                placeholder="Write your reply here...">{{ old('body') }}</textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>
                        <x-button type="submit" variant="primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Post Reply
                        </x-button>
                    </form>
                </x-card>
            @else
                <x-card class="border-l-4 border-l-yellow-500 bg-yellow-50 dark:bg-yellow-900/20">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">
                                @if(auth()->user()->isSuspended())
                                    Account Suspended
                                @else
                                    Subscription Required
                                @endif
                            </h4>
                            <p class="text-sm text-yellow-700 dark:text-yellow-400">
                                @if(auth()->user()->isSuspended())
                                    Your account is suspended until {{ auth()->user()->suspended_until->format('M d, Y') }}. You cannot post replies.
                                @else
                                    You need an active subscription to post replies. Please contact an administrator to activate your subscription.
                                @endif
                            </p>
                        </div>
                    </div>
                </x-card>
            @endif
        @else
            <x-card class="border-l-4 border-l-blue-500 bg-blue-50 dark:bg-blue-900/20">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-1">Login Required</h4>
                        <p class="text-sm text-blue-700 dark:text-blue-400 mb-3">
                            Please <a href="{{ route('login') }}" class="underline font-medium hover:text-blue-900 dark:hover:text-blue-200">login</a> or <a href="{{ route('register') }}" class="underline font-medium hover:text-blue-900 dark:hover:text-blue-200">register</a> to post a reply.
                        </p>
                    </div>
                </div>
            </x-card>
        @endauth
    </div>
</x-app-layout>
