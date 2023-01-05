<button type="{{ $type }}" {{ $attributes->merge(['class'=>"{$class}"]) }}>
    @isset($icon)
        <i class="{{ $icon }}"></i>
    @endisset
    @isset($label)
        {{ $label }}
    @endisset
</button>