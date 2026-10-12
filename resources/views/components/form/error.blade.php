@props(['name'])

@error($name)
    <small id="{{ $name }}-error" {{ $attributes->merge(['class' => 'pl-0.5 text-danger']) }}>{{ $message }}</small>
@enderror
