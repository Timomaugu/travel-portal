<!-- resources/views/components/x-select.blade.php -->

@props([
    'name',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Select One',
])

<div class="mb-4">
    <label for="{{ $name }}" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ ucwords(str_replace('_', ' ', $name)) }}</label>
    <select 
        id="{{ $name }}"
        name="{{ $name }}"
        @if($selected) value="{{ $selected }}" @endif
        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
    >
        <option value="" disabled @if(!$selected) selected @endif>{{ $placeholder }}</option>
        @foreach($options as $key => $label)
            <option value="{{ $key }}" @if($key == $selected) selected @endif>{{ $label }}</option>
        @endforeach
    </select>
</div>
