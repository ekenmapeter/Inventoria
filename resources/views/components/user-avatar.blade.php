@props(['user', 'size' => 'md'])

@php
    $sizeClasses = [
        'xs' => 'w-6 h-6 text-xs',
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
        'lg' => 'w-12 h-12 text-lg',
        'xl' => 'w-16 h-16 text-xl',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

@if($user->profile_photo_url)
    <img
        src="{{ $user->profile_photo_url }}"
        alt="{{ $user->name }}"
        class="rounded-full object-cover {{ $sizeClass }}"
    >
@else
    <div class="rounded-full bg-gradient-to-br from-primary-400 to-accent-500 flex items-center justify-center text-white font-semibold {{ $sizeClass }}">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
@endif

