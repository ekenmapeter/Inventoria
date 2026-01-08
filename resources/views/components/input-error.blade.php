@props(['messages'])

@if ($messages)
<<<<<<< HEAD
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
=======
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
