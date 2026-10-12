@props(['name', 'label' => null, 'type' => 'text', 'value' => null, 'id' => null])

@php
    $id ??= $name;
    $hasError = $errors->has($name);
@endphp

<div class="flex w-full flex-col gap-1">
    @if ($label)
        <x-form.label :for="$id">{{ $label }}</x-form.label>
    @endif

    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        @unless ($type === 'password') value="{{ old($name, $value) }}" @endunless
        @if ($hasError) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif
        {{ $attributes->class([
            'w-full rounded-radius border bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 disabled:cursor-not-allowed disabled:opacity-75 dark:bg-surface-dark-alt/50',
            'border-outline focus-visible:outline-primary dark:border-outline-dark dark:focus-visible:outline-primary-dark' => ! $hasError,
            'border-danger focus-visible:outline-danger' => $hasError,
        ]) }}
    />

    <x-form.error :name="$name" />
</div>
