@props(['disabled' => false])

@php
$hasError = $errors->has($attributes->get('name'));
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 bg-white text-gray-900 rounded-lg shadow-sm w-full ' .
               ($hasError 
                   ? 'border-red-500 focus:border-red-500 focus:ring-red-500 text-red-900' 
                   : 'focus:border-teal-500 focus:ring-teal-500')
]) !!}>