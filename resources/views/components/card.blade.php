@props(['hover' => true, 'padding' => 'p-6'])

<div {{ $attributes->merge(['class' => 'card ' . ($hover ? 'hover:shadow-lg hover:-translate-y-0.5' : '') . ' ' . $padding]) }}>
    {{ $slot }}
</div>

