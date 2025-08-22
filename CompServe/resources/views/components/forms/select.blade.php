@props([
    'label' => '',
    'name',
    'error' => false,
    'class' => '',
    'labelClass' => '',
])

@if ($label)
    <label for="{{ $name }}"
        {{ $attributes->merge(['class' => 'block ml-1 text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 ' . $labelClass]) }}>
        {{ $label }}
    </label>
@endif

<select id="{{ $name }}"
    name="{{ $name }}"
    {{ $attributes->merge([
        'class' =>
            'w-full px-2 py-1.5 rounded-lg text-gray-700 dark:text-gray-300
                bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent ' .
            $class,
    ]) }}>
    {{ $slot }}
</select>

@error($name)
    <span class="text-red-500 text-sm">{{ $message }}</span>
@enderror
