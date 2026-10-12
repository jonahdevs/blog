@props(['name', 'label', 'value' => '1', 'checked' => false, 'id' => null])

@php
    $id ??= $name;
@endphp

<div class="flex flex-col gap-1">
    <label for="{{ $id }}" class="flex items-center gap-2 text-sm font-medium text-on-surface dark:text-on-surface-dark has-checked:text-on-surface-strong dark:has-checked:text-on-surface-dark-strong has-disabled:cursor-not-allowed has-disabled:opacity-75">
        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="checkbox"
            value="{{ $value }}"
            @checked(old($name, $checked))
            {{ $attributes->merge(['class' => 'size-4 rounded-sm border border-outline accent-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed dark:border-outline-dark dark:accent-primary-dark dark:focus-visible:outline-primary-dark']) }}
        />
        <span>{{ $label }}</span>
    </label>

    <x-form.error :name="$name" />
</div>
