@props(['label', 'name', 'value' => 1, 'labelClass' => ''])

<label for="{{ $name }}"
    class="flex items-center text-sm text-gray-700 dark:text-gray-300 {{ $labelClass }}">
    <input type="hidden"
        name="{{ $name }}"
        value="0">
    <input type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes }}
        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mr-2">
    {{ $label }}
</label>

@error($name)
    <span class="text-red-500">{{ $message }}</span>
@enderror
