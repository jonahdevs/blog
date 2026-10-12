@props(['name', 'label' => null, 'options' => [], 'selected' => null, 'placeholder' => null, 'id' => null])

@php
    $id ??= $name;
    $hasError = $errors->has($name);
    $selectedValue = (string) old($name, $selected);
@endphp

<div class="flex w-full flex-col gap-1">
    @if ($label)
        <x-form.label :for="$id">{{ $label }}</x-form.label>
    @endif

    <select
        id="{{ $id }}"
        name="{{ $name }}"
        @if ($hasError) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif
        {{ $attributes->class([
            'w-full rounded-radius border bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 disabled:cursor-not-allowed disabled:opacity-75 dark:bg-surface-dark-alt/50',
            'border-outline focus-visible:outline-primary dark:border-outline-dark dark:focus-visible:outline-primary-dark' => ! $hasError,
            'border-danger focus-visible:outline-danger' => $hasError,
        ]) }}
    >
        @if ($placeholder)
            <option value="" @selected($selectedValue === '')>{{ $placeholder }}</option>
        @endif

        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected($selectedValue === (string) $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>

    <x-form.error :name="$name" />
</div>
