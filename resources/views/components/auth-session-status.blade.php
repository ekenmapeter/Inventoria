@props(['status'])

@if ($status)
<<<<<<< HEAD
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
=======
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
        {{ $status }}
    </div>
@endif
