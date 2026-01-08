@props(['value'])

<<<<<<< HEAD
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
=======
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
    {{ $value ?? $slot }}
</label>
