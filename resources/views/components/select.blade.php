@props(['disabled' => false])
<select {{ $attributes->merge(['class' => 'bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
    {{ $slot }}
</select>
