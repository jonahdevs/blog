@props(['for' => null])

<label @if ($for) for="{{ $for }}" @endif {{ $attributes->merge(['class' => 'w-fit pl-0.5 text-sm text-on-surface dark:text-on-surface-dark']) }}>
    {{ $slot }}
</label>
